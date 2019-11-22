<?php

// Register
Route::get('register', [
    'uses' => 'RegisterController@create',
    'as' => 'register'
]);

Route::post('register', [
    'uses' => 'RegisterController@store',
]);

Route::get('register/confirmation', [
    'uses' => 'RegisterController@confirm',
    'as' => 'register_confirmation'
]);

// Login
Route::get('login', [
    'uses' => 'LoginController@create',
    'as' => 'login'
]);

Route::post('login', [
    'uses' => 'LoginController@store',
]);

// Route::get('login/confirmation', [
//     'uses' => 'LoginController@confirm',
//     'as' => 'login_confirmation'
// ]);
