<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constants\Permission as PermissionConstant;
use App\Constants\Role as RoleConstant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $userGuard = 'api';

        // Seeding roles
        /** @var Role $ownerRole */
        $ownerRole = Role::query()->firstOrCreate([
            'name' => RoleConstant::ROLE_OWNER,
            'guard_name' => $userGuard,
        ]);

        /** @var Role $adminRole */
        $adminRole = Role::query()->firstOrCreate([
            'name' => RoleConstant::ROLE_ADMIN,
            'guard_name' => $userGuard,
        ]);

        /** @var Role $user */
        $user = Role::query()->firstOrCreate([
            'name' => RoleConstant::ROLE_USER,
            'guard_name' => $userGuard,
        ]);

        foreach (PermissionConstant::getAllPermissions() as $permission) {
            Permission::query()->firstOrCreate([
                'name' => $permission,
                'guard_name' => $userGuard,
            ]);
        }

        $ownerRole->syncPermissions(PermissionConstant::getAllPermissions());
        $adminRole->syncPermissions(PermissionConstant::getAdminPermissions());
        $user->syncPermissions(PermissionConstant::getUserPermissions());
    }
}
