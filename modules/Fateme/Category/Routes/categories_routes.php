<?php


Route::group(["namespace"=>"Fateme\Category\Http\Controllers",
    'middleware'=>['web','auth','verified']], function ($router) {
   $router->resource('categories', 'CategoryController');
});



