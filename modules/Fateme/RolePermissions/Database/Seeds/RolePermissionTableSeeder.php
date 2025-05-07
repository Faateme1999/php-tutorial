<?php

namespace Fateme\RolePermissions\Database\Seeds;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
//        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
//        $adminRole = Role::firstOrCreate(['name' => 'admin']);
//
//        $permissions = Permission::all();
//        $superAdminRole->givePermissionTo($permissions);

        foreach (\Fateme\RolePermissions\Models\Permission::$permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        foreach (\Fateme\RolePermissions\Models\Role::$roles as $name => $permissions) {
            Role::findOrCreate($name)->givePermissionTo($permissions);
        }

//        foreach (\Fateme\RolePermissions\Models\Permission::$permissions as $permission) {
//            \Fateme\RolePermissions\Models\Permission::firstOrCreate(['name' => $permission]);
//        }
//        foreach (\Fateme\RolePermissions\Models\Role::$roles as $name => $permissions) {
//            $role = Role::firstOrCreate(['name' => $name]);  // یا findOrCreate بسته به پیاده‌سازی شما
//            $role->givePermissionTo($permissions);
//        }


    }
//    public function run()
//    {
//        foreach (\Fateme\RolePermissions\Models\Permission::$permissions as $permission) {
//            Permission::firstOrCreate([
//                'name' => $permission,
//                'guard_name' => 'web',
//            ]);
//        }
//
//        foreach (\Fateme\RolePermissions\Models\Role::$roles as $name => $permissions) {
//            $role = Role::firstOrCreate([
//                'name' => $name,
//                'guard_name' => 'web',
//            ]);
//            $role->givePermissionTo($permissions);
//        }
//    }

}
