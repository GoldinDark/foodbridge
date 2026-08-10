<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'verify-restaurant',
            'manage-users',
            'manage-articles',
            'manage-categories',
            'manage-badges',
            'view-audit-logs',
            'manage-foods',
            'claim-foods',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Berikan SEMUA permission ke role admin
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        // Restaurant hanya boleh manage-foods
        $restaurant = Role::findByName('restaurant');
        $restaurant->givePermissionTo(['manage-foods']);

        // User hanya boleh claim-foods
        $user = Role::findByName('user');
        $user->givePermissionTo(['claim-foods']);
    }
}