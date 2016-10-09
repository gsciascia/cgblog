<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\User;
use App\Repositories\BackendPostRepository;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendPostController extends Controller
{


    /**
     * The post repository instance.
     */
    protected $postRepository;

    /**
     * Assign Category Model in Controller
     *
     * @param  BackendPostRepository $post
     * @return void
     */
    public function __construct(BackendPostRepository $post)
    {

        $this->postRepository = $post;
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check the role of the user

        $posts = $this->postRepository->listPosts();

        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_categories = $this->postRepository->loadCategories();

        return view('backend.posts.create', compact('all_categories'));
    }

    /**
    /**
     * Save the specified resource and check validation rule in PostCreateRequest.php
     *
     * @param  App\Http\Requests\PostCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {

        $this->postRepository->save($request);

        return redirect('/backend/posts');

    }


    /**
     * Show the form for editing the specified resource.
     * The rules for access are are stored in in app/Policies/Backend/BackendPostPolicy.php
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // Load all the data for the Post from the repository in app/Repositories/BackendPostRepository.php
        $data = $this->postRepository->load($id);

        // Check the policy for the post, that are stored in app/Policies/Backend/BackendPostPolicy.php
        /*
         *   [
            'post' => // The post Object
            'all_categories' // All the categories
            'category_post' // Id of all the categories set for the post
            'status' => // All status available for the post
             'seo' => // Seo data for the post
        ];
         */

        return view( 'backend.posts.edit', $data );
    }



    /**
     * Update the specified resource and check validation rule in PostUpdateRequest.php
     *
     * @param  App\Http\Requests\PostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = $this->postRepository->find($id);

        if ($this->postRepository->update($request, $id)) {
            \Session::flash('flash_message_success', 'Success!');
        }else{
            \Session::flash('flash_message_error', 'Error!');
        }

        return redirect()->route('posts.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     * The method can be called only via AJAX
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = $this->postRepository->find($id);

        $this->authorize('delete', $post);

        // check to see if the request is
        // an AJAX call.
        if ($request->ajax()) {
            $this->postRepository->delete($id);
        }
    }





    /**
     * Display a listing of the post soft-deleted.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $posts = $this->postRepository->listPosts(true);

        return view('backend.posts.trashed', compact('posts'));
    }


    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {

        // Load all the data for the Post from the repository in app/Repositories/BackendPostRepository.php
        $data = $this->postRepository->loadRestore($id);

        // Check the policy for the post, that are stored in app/Policies/Backend/BackendPostPolicy.php
        /*
         *   [
            'post' => // The post Object
            'all_categories' // All the categories
            'category_post' // Id of all the categories set for the post
            'status' => // All status available for the post
        ];
         */
      return view('backend.posts.edit', $data);
    }




    /**
     * Remove the specified resource earlier trashed ( soft delete ).
     * The method can be called only via AJAX
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTrashed(Request $request)
    {
        // check to see if the request is
        // an AJAX call.
        if ($request->ajax()) {
          return  $this->postRepository->deleteTrashed($request['id']);
         }
    }

}
