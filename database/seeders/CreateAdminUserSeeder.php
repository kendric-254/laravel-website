<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the user already exists
        $user = User::firstOrCreate(
            ['email' => 'gn782000@gmail.com'], // Check for existing user by email
            [
                'name' => 'Glenben Ngugi',
                'password' => bcrypt('g1l2e3n4')
            ]
        );

        // Ensure the role exists
        $role = Role::firstOrCreate(['name' => 'SuperAdmin']);

        // Define specific permissions for the Admin role
        $permissions = [
            'view-user',
            'create-user',
            'update-user',
            'delete-user',
            'deactivate-user',
            'system-update',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'post-job',
            'manage-job-postings',
            'moderate-content'
        ];

        // Assign the permissions to the role
        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission]);
            $role->givePermissionTo($perm);
        }

        // Assign the role to the user
        $user->assignRole($role);
    }
}
