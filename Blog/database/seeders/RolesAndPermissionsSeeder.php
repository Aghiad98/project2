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

     // create permissions


       Permission::create(['name' => 'manage posts']);
       Permission::create(['name' => 'manage comment']);
       Permission::create(['name' => 'manage tags']);
       Permission::create(['name' => 'manage categories']);

       Permission::create(['name' => 'assign roles']);
       Permission::create(['name' => 'manage roles']);

// create roles and assign existing permissions
$adminRole = Role::create(['name' => 'admin']);
$adminRole->givePermissionTo(['manage posts' , 'manage comment' , 'assign roles', 'manage roles','manage tags','manage categories']);

$userRole = Role::create(['name' => 'user']);
$userRole->givePermissionTo(['manage posts' , 'manage comment']);

    }
}
