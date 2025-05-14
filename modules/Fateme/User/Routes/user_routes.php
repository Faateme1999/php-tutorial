<?php

namespace Fateme\User\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Fateme\User\Http\Controllers\Auth\ResetPasswordController;
use Fateme\User\Http\Controllers\Auth\ForgotPasswordController;

Route::group([
    'namespace' => 'Fateme\User\Http\Controllers',
    'middleware'=> ['web','auth']
], function ($router) {
    Route::post('users/{user}/add/role', 'UserController@addRole')->name('users.addRole');
    Route::delete('users/{user}/remove/{role}/role', 'UserController@removeRole')->name('users.removeRole');
    Route::patch('users/{user}/manualVerify', 'UserController@manualVerify')->name('users.manualVerify');
    Route::post('users/photo', 'UserController@updatePhoto')->name('users.photo');
    Route::get('edit-profile', 'UserController@profile')->name('users.profile');
    Route::post('edit-profile', 'UserController@updateProfile')->name('users.profile.update');
    Route::get('tutors/{username}', "UserController@viewPofile")->name('viewProfile');
    Route::resource('users', 'UserController');

});


Route::group([
    'namespace' => 'Fateme\User\Http\Controllers',
    'middleware'=>'web'
], function ($router) {
   Route::post(uri:'/email/verify',action:'Auth\VerificationController@verify')->name('verification.verify');
   Route::post(uri:'/email/resend',action:'Auth\VerificationController@resend')->name('verification.resend');
   Route::get(uri:'/email/verify',action:'Auth\VerificationController@show')->name('verification.notice');

//   login
   Route::get(uri:'/login',action:'Auth\LoginController@showLoginForm')->name('login.show');
   Route::post(uri:'/login',action:'Auth\LoginController@login')->name('login.submit');


//   logout
   Route::any(uri:'/logout',action:'Auth\LoginController@logout')->name('logout');

//   reset password
   Route::get(uri:'/password/reset',action:'Auth\ForgotPasswordController@showVerifyCodeRequestForm')->name('password.request');
   Route::get(uri:'/password/reset/send',action:'Auth\ForgotPasswordController@sendVerifyCodeEmail')->name('password.sendVerifyCodeEmail');
   Route::post(uri:'/password/reset/check-verify-code',action:'Auth\ForgotPasswordController@checkVerifyCode')
       ->name('password.checkVerifyCode')
       ->middleware('throttle:5,1');

   Route::get(uri:'/password/change',action:'Auth\ResetPasswordController@showResetForm')
       ->name('password.showResetForm')->middleware('auth');
   Route::post(uri:'/password/change',action:'Auth\ResetPasswordController@reset')->name('password.update');


//   register
   Route::get(uri:'/register',action:'Auth\RegisterController@showRegistrationForm')->name('register.show');
   Route::post(uri:'/register',action:'Auth\RegisterController@register')->name('register.submit');




});


