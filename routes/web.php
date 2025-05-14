<?php

namespace Fateme\RolePermissions\Repositories;
use Fateme\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Route;



Route::get('/test', function () {
//\Spatie\Permission\Models\Permission::create(['name' => 'manage_role_permissions']);
auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
return auth()->user()->permissions;
});















