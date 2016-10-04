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
    })->name('dashboard');;


    Route::resource('categories','Backend\BackendCategoryController',['except' => ['index','show']]); //->middleware('auth');
    Route::get('categories/{parent_id?}', 'Backend\BackendCategoryController@index')->name('categories.index');
    Route::get('categories/delete/{category_id}', 'Backend\BackendCategoryController@delete')->name('categories.delete');





});