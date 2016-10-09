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
     * Retrieve info about the category passed by $id
     *
     * @param int $id -  category Id
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function getCategory($id)
    {
        try {

            $category = $this->category->find($id);

            if (!empty($category)) {
                $category['seo'] = $category->seo()->first();
            }



            return $category;



        } catch (\Exception $e) {

            abort(404);
        }



    }




    /**
     * Get Post Data .
     *pu
     * @param int $id -  post Id
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function getPostData($slug)
    {
        try {

            $post = $this->post->whereSlug($slug)->first();

            if (!empty($post)) {
               // $post['seo'] = $post->seo->first();
            }

            if ($post) {
                return $post;
            }else{
                abort(404);
            }

        } catch (\Exception $e) {

            abort(404);
        }

    }


}