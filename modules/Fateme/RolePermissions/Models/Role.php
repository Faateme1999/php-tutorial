<?php

namespace Fateme\RolePermissions\Models;

class Role extends \Spatie\Permission\Models\Role
{
    const ROLE_TEACHER = 'teacher';
    public static $roles = [
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH,
        ],
    ];
}
