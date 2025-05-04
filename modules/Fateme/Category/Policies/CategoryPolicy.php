<?php

namespace Fateme\Category\Policies;

use Fateme\RolePermissions\Models\Permission;
use Fateme\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }
}
