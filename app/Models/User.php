<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $guarded = [
        'id',
    ];

    public static function roleAutosClasses(string $role)
    {
        if (Role::where('name', $role)->exists()) {
            if ($role == 'worker 3') {
                return [1, 2, 3];
            } elseif ($role == 'worker 2') {
                return [1, 2];
            } elseif ($role == 'worker 1') {
                return [1];
            }
        }
        throw new \Exception("Role $role does not exist");
    }


    public function auto()
    {
        return $this->hasMany(Auto::class);
    }


}
