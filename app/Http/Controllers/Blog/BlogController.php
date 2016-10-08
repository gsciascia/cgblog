<?php

namespace App\Http\Controllers\Blog;

use App\Post;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    //

    /**
     * The post repository instance.
     */
    protected $blogRepository;
    protected $categories;

    /**
     * Assign Blog Repository to Controller
     *
     * @param  BackendPostRepository $post
     * @return void
     */
    public function __construct(BlogRepository $blog)
    {
        $this->blogRepository = $blog;

        $this->categories = $this->blogRepository->listCategories();
    }




    /**
     * Display HomePage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check the role of the user

        $posts = $this->blogRepository->listPosts();
        $categories = $this->categories;

        return view('blog.index', compact('posts','categories'));
    }


    /**
     * Display Category Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showPostsInCategory($id)
    {
        // Check the role of the user

        $posts = $this->blogRepository->listPostsInCategory($id);
        $categories = $this->categories;

        return view('blog.category', compact('posts','categories'));
    }



}
