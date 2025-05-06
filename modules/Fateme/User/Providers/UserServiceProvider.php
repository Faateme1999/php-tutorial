<?php

namespace Fateme\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Fateme\User\Database\Seeds\UsersTableSeeder;
use Fateme\User\Http\Middleware\StoreUserIp;
use Fateme\User\Models\User;
use Fateme\User\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','User');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);

        config()->set('auth.providers.users.model',User::class);
        Gate::policy(User::class, UserPolicy::class);
        DatabaseSeeder::$seeders[] = UsersTableSeeder::class;
    }

    public function boot()
    {
       /*dd('bar aye test service');*/
        config()->set('sidebar.items.users', [
            "icon" => "i-users",
            "title" => "کاربران",
            "url" => url('users.index')
        ]);

        $this->app->booted(function () {
            config()->set('sidebar.items.users', [
                "icon" => "i-user__inforamtion",
                "title" => "اطلاعات کاربری",
                "url" => url('users.profile')
            ]);
        });
    }
}

