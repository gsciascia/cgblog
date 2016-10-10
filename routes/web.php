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




// Route for Backend panel
Route::group(['prefix' => 'backend', 'middleware'=>'role:admin|author' ], function(){


    Route::get('/', function () {
        return view('backend.index');
    })->name('dashboard');

    /*
     * Backend Categories Route
     *
     */
       Route::group(['middleware'=>'role:admin' ], function(){
       Route::resource('categories','Backend\BackendCategoryController',['except' => ['index','show']]);
       Route::get('categories/{parent_id?}', 'Backend\BackendCategoryController@index')->name('categories.index');
       Route::get('categories/delete/{category_id}', 'Backend\BackendCategoryController@delete')->name('categories.delete');

       /*
        * Backend User Route
        *
        */

       Route::resource('users','Backend\BackendUserController');
       Route::get('users/delete/{user_id}', 'Backend\BackendUserController@delete')->name('users.delete');

    });


    /*
     * Backend Post Route
     *
     */
    Route::delete('posts/destroyTrashed', 'Backend\BackendPostController@destroyTrashed')->name('posts.destroyTrashed');
    Route::resource('posts','Backend\BackendPostController',['except' => ['show']]);
    Route::get('posts/trash', 'Backend\BackendPostController@trash')->name('posts.trash');
    Route::get('posts/restore/{post}', 'Backend\BackendPostController@restore')->name('posts.restore');



    /*
     * Edit Profile User : Accessible for Admin And Author
     *
     */

    Route::get('profile', 'Backend\BackendUserController@editProfile')->name('user.profile');
    Route::post('profile/{profile}', 'Backend\BackendUserController@updateProfile');



});


Auth::routes();



/*
 * Public Post
 *
 */

Route::get('/', ['uses' => 'Blog\BlogController@index', 'as' => 'blog.index']);
Route::get('/{slug}','Blog\BlogController@showPost')->name('blog.showPost');


/*
 * Public Category
 *
 */
Route::get('/category/{name}','Blog\BlogController@showPostsInCategory')->name('blog.showPostsInCategory');


