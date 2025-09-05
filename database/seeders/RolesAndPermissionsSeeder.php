<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $studentRole = Role::firstOrCreate(['name' => 'student']);
        $adminRole   = Role::firstOrCreate(['name' => 'admin']);

        // Optional: create permissions (for future fine-grained control)
        Permission::firstOrCreate(['name' => 'request assignment']);
        Permission::firstOrCreate(['name' => 'prepare assignment']);

        // Assign permissions to roles
        $studentRole->givePermissionTo('request assignment');
        $adminRole->givePermissionTo('prepare assignment');
    }
}
