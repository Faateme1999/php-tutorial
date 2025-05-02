<?php

namespace Fateme\RolePermissions\Models;

class Permission extends  \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_CATEGORIES = 'manage_categories';

    const PERMISSION_MANAGE_ROLE_PERMISSIONS = 'manage_role_permissions';
    const PERMISSION_TEACH = 'teach';

    public static $permissions = [
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_TEACH,
    ];

}
