<?php

namespace Fateme\Common\Providers;

use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends  ServiceProvider
{
    public function register()
    {
//        dd('test');
        $this->loadViewsFrom(__DIR__ . "/../Resources", "Common");
    }
    public function boot()
    {
    }
}
