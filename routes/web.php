<?php

namespace Fateme\RolePermissions\Repositories;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/test', function () {
\Spatie\Permission\Models\Permission::create(['name' => 'manage_role_permissions']);
auth()->user()->givePermissionTo('manage_role_permissions');
return auth()->user()->permissions;
});

Route::get('/test-permissions', function () {
    $repo = new \Fateme\RolePermissions\Repositories\PermissionRepo();
    return $repo->all();
});










