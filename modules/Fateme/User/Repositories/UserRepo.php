<?php

namespace Fateme\User\Repositories;

use Fateme\RolePermissions\Models\Permission;
use Fateme\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
   return  User::query()->where('email',$email)->first();
    }

        public function getTeachers()
    {
        return User::permission(Permission::PERMISSION_TEACH)->get();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }



}
