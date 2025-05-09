<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssignRolesCommand extends Command
{
    protected $signature = 'roles:assign';
    protected $description = 'Assign worker roles to users 1-3 with api guard';

    public function handle()
    {
        $this->assignRolesToUsers();
        $this->info('Roles assigned successfully with web guard!');
    }


    protected function assignRolesToUsers()
    {
        for ($i = 1; $i <= 3; $i++) {
            $user = User::find($i);
            $roleName = "worker {$i}";

            if (!$user) {
                $this->error("User {$i} not found!");
                continue;
            }

            $user->assignRole($roleName);
            $this->info("Assigned role '{$roleName}' to user {$i}");
        }
    }
}
