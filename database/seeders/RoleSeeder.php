<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

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

        $superuser = Role::create(['name' => 'SuperAdmin']);
        $superuser->syncPermissions($superAdminPermissions);

        
         Role::create(['name' => 'Admin']);
         Role::create(['name' => 'SuperAdmin']);
         Role::create(['name' => 'writer']);
         Role::create(['name' => 'user']);
         Role::create(['name' => 'Alumni']);
    }
}
