<?php

namespace Fateme\Course\Database\Seeds;
use Fateme\RolePermissions\Models\Permission;
use Fateme\RolePermissions\Models\Role;
use Illuminate\Database\Seeder;


class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        foreach (\Fateme\RolePermissions\Models\Permission::$permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        foreach (\Fateme\RolePermissions\Models\Role::$roles as $name => $permissions) {
            Role::findOrCreate($name)->givePermissionTo($permissions);
        }
    }
}
