<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Auth routes
Auth::routes();

Route::get('/', function () {
    return redirect('login');
})->middleware('guest');

Route::get('/register', function () {
    return redirect('/home');
});

//Home
Route::get('/home', 'HomeController@index');

//General routes

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'Users');
    Route::resource('category', 'Categories');
    Route::resource('product', 'Products');
    Route::resource('client', 'Clients');
    Route::resource('provider', 'Providers');
    //User
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'Users@profile');
        Route::put('/update/{id}', 'Users@updateProfile')->name('profile.update');
        Route::put('/updatePhoto/{id}', 'Users@updateProfilePhoto')->name('profile.updatePhoto');
        Route::put('/updatePassword/{id}', 'Users@updatePassword')->name('profile.updatePassword');
    });
    //Messages
    Route::resource('mailbox', 'Messages');
    Route::put('/mailbox/trash/{id}', 'Messages@moveToTrash')->name('mailbox.moveToTrash');
});

//Test Routes

Route::get('/testpws/{pass}', function ($pass) {
    return bcrypt($pass);
});
Route::get('/uprofile/{id}', function ($id) {
    return dd(\App\User::find($id));
});
Route::get('/datetime', function () {
    return date('Y-m-d h:i:s');
});
Route::get('/testSql', 'Users@testSql');