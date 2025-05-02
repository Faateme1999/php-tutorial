<?php

namespace Fateme\Course\Rules;

use Fateme\User\Repositories\UserRepo;
use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Permission;
//use Fateme\RolePermissions\Models\Permission;


class ValidTeacher implements Rule
{
    public function passes($attribute, $value)
    {
        $user = resolve(UserRepo::class)->findById($value);
        return $user->hasPermissionTo('teach');
    }

    public function message()
    {
        return 'کاربر انتخاب شده یک مدرس معتبر نیست.';
    }
}
