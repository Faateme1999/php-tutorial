<?php
Route::group(["namespace"=>"Fateme\RolePermissions\Http\Controllers",
    'middleware'=>['web','auth','verified','permission:manage_role_permissions']], function ($router) {
    $router->resource('role-permissions', 'RolePermissionsController');
});
