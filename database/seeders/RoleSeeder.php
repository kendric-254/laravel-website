<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminPermissions = [
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

        $superuser = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $superuser->syncPermissions($superAdminPermissions);

        $role = Role::findByName('superAdmin'); 
        $role->givePermissionTo('deactivate-user');

        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'writer']);
        Role::firstOrCreate(['name' => 'user']);
        Role::firstOrCreate(['name' => 'Alumni']);
    }
}
