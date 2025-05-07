<?php

namespace Fateme\Category\Providers;


use Fateme\Category\Models\Category;
use Fateme\Category\Policies\CategoryPolicy;
use Fateme\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/categories_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Categories');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        Gate::policy(Category::class, CategoryPolicy::class);
    }

    public function boot()
    {
        $this->app->booted(function () {
            config()->set('sidebar.items.categories', [
                "icon" => "i-categories",
                "title" => "دسته بندی ها",
                "url" => route('categories.index'),
                "permission"=>Permission::PERMISSION_MANAGE_CATEGORIES
            ]);
        });
//        config()->set('sidebar.items.categories', [
//            "icon" => "i-categories",
//            "title" => "دسته بندی ها",
//            "url" => route('categories.index')
//        ]);
    }

}
