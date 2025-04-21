<?php

namespace Fateme\User\Providers;

use Carbon\Laravel\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/user_routes.php');
       /*dd('bar aye test service');*/
    }

}
