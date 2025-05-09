<?php

namespace Database\Seeders;

use App\Models\Auto;
use App\Models\Drive;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(3)->create();
         Auto::factory(10)->create();
        Role::create([
            'name' => 'worker 1',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'worker 2',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'worker 3',
            'guard_name' => 'web'
        ]);
        Drive::factory(10)->create();
    }
}
