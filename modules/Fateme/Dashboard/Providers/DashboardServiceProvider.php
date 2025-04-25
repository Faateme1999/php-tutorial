<?php

namespace Fateme\Dashboard\Providers;

//use Carbon\Laravel\ServiceProvider;
use \Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/dashboard_routes.php');
        $this->loadViewsFrom((__DIR__.'/../Resources/views'), 'Dashboard');
    }

}
