<?php


Route::group(["namespace"=>"Fateme\Category\Http\Controllers",
    'middleware'=>['web','auth','verified','permission:manage_categories']], function ($router) {
   $router->resource('categories', 'CategoryController');
});


