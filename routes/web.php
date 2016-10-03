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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


// Route for Backend panel
Route::group(['prefix' => 'backend', 'middleware'=>'role:admin|author' ], function(){


    Route::get('/', function () {
        return view('backend.index');
    });




});