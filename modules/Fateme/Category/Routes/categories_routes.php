<?php

Route::group(["namespace"=>"Fateme\Category\Http\Controllers",'middleware'=>[]], function ($router) {
   $router->resource('categories', 'CategoryController');
});

//['web','auth','verified']
