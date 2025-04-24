<?php

namespace Fateme\User\Services;

class UserService
{
    public static function changePassword($user, $newpassword)
    {
        $user->password = bcrypt($newpassword);
        $user->save();

    }

}
