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
     * Retrieve all the categories.
     *
     * @param bool $category [ default = true ]  Use for switch list from active and trashed
     * @return Array
     */
    public function listCategoriesHierarchy()
    {
        $list = $this->category->listTreeCategories();

        return   $list;
    }




    /**
     * Retrieve all the posts in the selected category .
     *
     * @param int $id -  category Id
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function listPostsInCategory($id)
    {
        try {

        $post = $this->category->find($id)->posts->where('status','publish')->all();

        } catch (\Exception $e) {

           abort(404);
        }


        return $post;
    }



    /**
     * Get Post Data .
     *pu
     * @param int $id -  post Id
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function getPostData($slug)
    {
        $post = $this->post->whereSlug($slug)->first();


        if($post){
            return $post;
        }

       return abort(404);

    }


}