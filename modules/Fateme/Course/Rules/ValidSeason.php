<?php

namespace Fateme\Course\Rules;

use Fateme\Course\Repositories\SeasonRepo;
use Fateme\RolePermissions\Models\Permission;
use Fateme\User\Repositories\UserRepo;
use Illuminate\Contracts\Validation\Rule;


class ValidSeason implements Rule
{
    public function passes($attribute, $value)
    {
        $season = resolve(SeasonRepo::class)->findByIdandCourseId($value, request()->route('course'));
        if ($season) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return "سرفصل انتخاب شده معتبر نمی باشد.";
    }

}
