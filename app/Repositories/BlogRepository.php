<?php

namespace App\Repositories;


use App\Category;
use App\Post;

class BlogRepository
{

    protected $post;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }



    /**
     * Retrieve all the posts. This
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function listPosts()
    {
        $posts = $this->post->published()->get();
        return $posts;
    }



    /**
     * Retrieve all the categories.
     *
     * @param bool $category [ default = true ]  Use for switch list from active and trashed
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function listCategories()
    {

        $categories = $this->category->all();


       // $categories = $categories->paginate(10);

        return $categories;
    }




    /**
     * Retrieve all the posts in the selected category .
     *
     * @param int $id -  category Id
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function listPostsInCategory($id)
    {
        $categories = $this->category->find($id)->all();

        return $categories;
    }



}