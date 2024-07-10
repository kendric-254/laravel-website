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
        // Create a new user
        $user = User::create([
            'name' => 'Glenben Ngugi', 
            'email' => 'gn782000@gmail.com',
            'password' => bcrypt('g1l2e3n4')
        ]);

        // Create a new role
        $role = Role::create(['name' => 'SuperAdmin']);
        $superuserRole = Role::where('name', 'SuperAdmin')->first();
        $user->assignRole($superuserRole);


        // Define specific permissions for the Admin role
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
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
