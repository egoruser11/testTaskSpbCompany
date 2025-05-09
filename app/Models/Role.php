<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;

// Добавьте этот импорт

class Role extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guarded = ['id'];

    public static function assignRoles()
    {
        for ($i = 1; $i <= 3; $i++) {
            $roleName = "worker $i";
            if (!\Spatie\Permission\Models\Role::where('name', $roleName)
                ->where('guard_name', 'api')
                ->exists()) {

                \Spatie\Permission\Models\Role::create([
                    'name' => $roleName,
                    'guard_name' => 'api'
                ]);
            }
            $user = User::find($i);
            if ($user) {
                $user->assignRole($roleName);
            }
        }
    }
}
