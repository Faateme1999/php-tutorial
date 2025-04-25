<?php

Route::group(['namespace' => 'Fateme\Dashboard\Http\Controllers'], function ($router) {
         $router->get('/home', 'DashboardController@home')->name('home');
});

