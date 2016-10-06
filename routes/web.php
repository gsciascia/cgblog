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

    // Categories Route
    Route::group(['middleware'=>'role:admin' ], function(){
       Route::resource('categories','Backend\BackendCategoryController',['except' => ['index','show']]);
       Route::get('categories/{parent_id?}', 'Backend\BackendCategoryController@index')->name('categories.index');
       Route::get('categories/delete/{category_id}', 'Backend\BackendCategoryController@delete')->name('categories.delete');

    });

    // Posts Route
    Route::delete('posts/destroyTrashed', 'Backend\BackendPostController@destroyTrashed')->name('posts.destroyTrashed');
    Route::resource('posts','Backend\BackendPostController',['except' => ['show']]);
    Route::get('posts/trash', 'Backend\BackendPostController@trash')->name('posts.trash');
    Route::get('posts/restore/{post}', 'Backend\BackendPostController@restore')->name('posts.restore');





});