<?php

namespace Fateme\User\Repositories;

use Fateme\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
   return  User::query()->where('email',$email)->first();
    }
}
