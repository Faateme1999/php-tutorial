<?php

namespace Fateme\RolePermissions\Models;

class Permission extends  \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_CATEGORIES = 'manage_categories';
    const PERMISSION_MANAGE_COURSES = 'manage_courses';
    const PERMISSION_MANAGE_OWN_COURSES = 'manage_own_courses';

    const PERMISSION_MANAGE_ROLE_PERMISSIONS = 'manage_role_permissions';
    const PERMISSION_TEACH = 'teach';
    const PERMISSION_SUPER_ADMIN = 'super_admin';

    public static $permissions = [
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_TEACH,
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_MANAGE_OWN_COURSES
    ];

}
