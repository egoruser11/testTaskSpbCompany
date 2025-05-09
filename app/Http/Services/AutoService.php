<?php


namespace App\Http\Services;

use App\Models\Auto;
use App\Models\Drive;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AutoService
{

    private function isReadyCar($dates, $auto): bool
    {
        $isAutos = Drive::where('auto_id', $auto->id)->where('end', ">=", now())->where(function ($query) use ($dates) {
            $query->where('start', "<", $dates['start'])->where('end', ">", $dates['start'])
                ->orWhere(function ($query) use ($dates) {
                    $query->where('start', '<', $dates['start'])->where('end', '>', $dates['end']);

                })->orWhere(function ($query) use ($dates) {
                    $query->where('start', '>', $dates['start'])->where('end', '<', $dates['end']);
                });
        })->where('status', '!=', 0)->exists();
        if ($isAutos) {
            return false;
        }
        return true;
    }

    private function isReadyCars($classes, $dates): array
    {
        $autos = Auto::whereIn('class', $classes)->get();
        $result = [];
        foreach ($autos as $auto) {
            if (empty($auto->drives())) {
                $result[] = $auto;
            }
            if (self::isReadyCar($dates, $auto)) {
                $result[] = $auto;
            }
        }
        return $result;
    }

    public function run(array $data): Collection
    {
        $user = User::findOrFail($data['user_id']);
        $dates = [
            'start' => $data['start'],
            'end' => $data['end']
        ];
        $role = $user->getRoleNames()->toArray();
        if (empty($role)) {
            throw new \Exception("Role does not exist", 200);
        }
        $classes = User::roleAutosClasses($role[0]);
        $autos = collect($this->isReadyCars($classes, $dates));
        $autos = Auto::whereIn('id', $autos->pluck('id'));
        if (!empty($data['brand'])) {
            $autos = $autos->where('brand', "like", $data['brand']);
        }
        if (!empty($data['classes'])) {
            $autos = $autos->whereIn('class', $data['classes']);
        }
        $autos = $autos->get();
        return $autos;
    }

}

