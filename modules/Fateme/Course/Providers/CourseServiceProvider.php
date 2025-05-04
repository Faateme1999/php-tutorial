<?php

namespace Fateme\Course\Providers;

use Fateme\Course\Database\Seeds\RolePermissionTableSeeder;
use Fateme\Course\Models\Course;
use Fateme\Course\Policies\CoursePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Database\Seeders\DatabaseSeeder;



class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/courses_routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views/', 'Courses');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang/');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang/', 'Courses');
        \Database\Seeders\DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;
        Gate::policy(Course::class, CoursePolicy::class);

    }

    public function boot()
    {
        $this->app->booted(function () {
        config()->set('sidebar.items.courses', [
            'icon' => 'i-courses',
            'title' => 'دوره ها',
            'url' => route('courses.index')

        ]);
        });
    }
}
