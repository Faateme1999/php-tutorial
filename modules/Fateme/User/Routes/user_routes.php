<?php
/*Route::get('test', function () {
    dd('bezane test to route ino neshon mide');
});*/

use Illuminate\Support\Facades\Auth;

Route::group(['namespace' => 'Fateme\User\Http\Controllers','middleware'=>'web'], function ($router) {
   Auth::routes(['verify' => true]);
});
