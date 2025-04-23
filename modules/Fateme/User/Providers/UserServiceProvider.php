<?php

namespace Fateme\User\Providers;

//use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\ServiceProvider;
use Fateme\User\Models\User;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
       config()->set('auth.providers.users.model',User::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','User');
       /*dd('bar aye test service');*/

    }

}
