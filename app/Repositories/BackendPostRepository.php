<?php

namespace App\Repositories;

use App\Category;
use App\Post;
use App\Seo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BackendPostRepository
{

    protected $post;

    /**
     * BackendPostRepository constructor.
     * @param Post $post
     * @param Category $category
     * @param Seo $seo
     */
    public function __construct(Post $post, Category $category, Seo $seo)
    {
        $this->post = $post;
        $this->seo = $seo;
        $this->category = $category;
    }


    public function find($id)
    {
        return $this->post->findOrFail($id);
    }


    /**
     *  Update post data
     *
     * @param $input_data  Store the request data sent from form
     * @param $id The post id update
     * @return bool
     */
    public function update($input_data, $id)
    {
        $post_obj = $this->post->find($id);

        $old_status = $post_obj->status;



        if ($post_obj->update($input_data)) {


            if (isset($input_data['categories'])) {
                $categories_id = array_values($input_data['categories']);
                $post_obj->categories()->sync($categories_id);
            }


            if($old_status!=$input_data && $old_status=='deleted'){
                $this->removeDeleteData($post_obj);
            }

            // Update seo object
            $post_obj->seo->find($id)->update($input_data);


        }

        return true;
    }


    /**
     *  Update post data
     *
     * @param $input_data  Store the request data sent from form
     * @param $id The post id update
     * @return bool
     */
    public function save($input_data)
    {
        $user = Auth::user();

        $post_obj = $user->posts()->create($input_data);


        if ($post_obj) {
            $categories_id = array_values($input_data['categories']);
            if (isset($input_data['categories'])) {
                $post_obj->categories()->sync($categories_id);
            }

            // Create seo object
            $seo_data = $this->seo->create($input_data);
            $post_obj->seo()->save($seo_data);

        }

        return true;
    }


    /**
     * Load all the post data. (incluse relationship)
     *
     * @param $id
     * @return array
     */
    public function load($id)
    {

        $post_obj = $this->find($id);

            $categories = $this->category->all();

            $categories_tree = $this->category->listTreeCategories();
            $categories = $this->category->linearizeCategoryArray($categories_tree);

            // Possible status post

            $status = array();
            // If post is deleted, we pass this information in $status variable for use it in view
            if ($post_obj->status == 'deleted') {
                 $status = ['deleted' => 'Deleted'];
            }

             $status = array_merge($status, ['draft' => 'Draft', 'publish' => 'Published']);


            // Get Ids of the categories set for the post
            $array_categories = [];
            foreach ($post_obj->categories->toArray() as $key => $category) {
                $array_categories [] = $category['id'];
            }

            // retrieve seo data
            $seo = $post_obj->seo->first();


            return [
                'post' => $post_obj,
                'all_categories' => $categories,
                'category_post' => $array_categories,
                'status' => $status,
                'seo' => $seo
            ];


    }


    /**
     *  Load categories from Category Model and retrieve it linearized
     *
     * @return array
     */
    public function loadCategories()
    {
        $categories_tree = $this->category->listTreeCategories();
        $categories = $this->category->linearizeCategoryArray($categories_tree);
        return $categories;
    }


    /**
     * Move post to trashed elements.
     * Save the date of cancellation and the author of the cancellation
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        if ($this->post->find($id)
            ->update(['deleted_at' => Carbon::now(),
                      'deleted_by' => Auth::user()->id,
                      'status' => 'deleted',
                     ]))
        {
            return true;
        }
        return false;
    }


    /**
     * Retrieve all the posts. This
     *
     * @param bool $include_trashed [ default = true ]  Use for switch list from active and trashed
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function listPosts($include_trashed = false)
    {
        // Check the role of the user
        if (Auth::user()->hasRole('admin')) {
            $posts = Post::with('user');
        } else {
            $user = User::find(Auth::user()->id);
            $posts = $user->posts();
        }

        // Check if the list must include trashed elements
        if ($include_trashed) {
            $posts = $posts->trashed();
        } else {
            $posts = $posts->active();
        }

        $posts = $posts->paginate(10);

        return $posts;
    }


    /**
     * Delete permanently the post from the table.
     *
     * @param $id
     * @return mixed
     */
    public function deleteTrashed($id)
    {
        $post =  $this->find($id);

        if (Auth::user()->can('managetrashed', $post)) {

            // Delete entry in pivot table
            $post->categories()->detach();
            // Delete post
            $post->delete();

            return \Response::json(['success' => 'Success!'], 200);
        } else {
            return \Response::json(['error' => 'Error! Access forbiden'], 403);
        }


    }






    /**
     * Load all the post data, but first check if the user have necessary rights
     *
     * @param $id
     * @return array
     */
    public function loadRestore($id)
    {

        $post_obj = $this->find($id);

        if (Auth::user()->can('managetrashed', $post_obj)) {

            return $this->load($id);

        } else {
            return \Response::json(['error' => 'Error! Access forbiden'], 403);
        }

    }



    public function removeDeleteData($post)
    {
       return  $post->update(['deleted_at'=>null, 'deleted_by'=>null]);

    }



}



