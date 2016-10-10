<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'parent_id'
    ];



    /**
     * The many-to-many relationship between posts and categories.
     *
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'category_post');
    }


    /**
     * Relation with Seo table
     */
    public function seo()
    {
        return $this->morphMany('App\Seo', 'seoble');
    }


    /**
     * Relationship for retrieve parent Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Relationship for retrieve child Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }


    /**
     * Scope a query to only include direct child of a Parent Category
     *
     * @param $query
     * @param $parent_id  The category parent id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeChildOf($query, $parent_id)
    {
        return $query->where('parent_id', $parent_id);
    }






    /**
     * Generate list representation of the hierarchical Database items.
     *
     * @param integer $parent_id. Start to collect from this parent category
     * @param integer $exclude_branch. Exclude exploration of selected category and sub category line
     * @return array $data
     */


    public function listTreeCategories($parent_id = 0, $exclude_branch = 0)
    {
        $data = [];

        $root_categories = $this->childOf($parent_id)->get()->toArray();

        if (count($root_categories) > 0) {

            foreach ($root_categories as $category) {

                if ($category['id'] != $exclude_branch) {
                    $data[] = [
                        'id' => $category['id'],
                        'name' => $category['name'],
                        'parent_id' => $category['parent_id'],
                        'children' => $this->listTreeCategories($category['id'],$exclude_branch)
                    ];
                }

            }
        }


        return $data;
    }




    /**
     * Recursive function to linearize and retrieve depth of categories element in array
     *
     * @param array $categories Array with categories to process
     * @param integer $depth Level of depth
     * @param array $linearizeArray Array with partial linearized element during the recursive loop
     * @return array $linearizeArray  [ id , name, depth ]
     */
    public function linearizeCategoryArray($categories, $depth=0, $linearizeArray = null) {




        foreach ($categories as $key=>$category) {
            $linearizeArray[]=[
                 'id' => $category['id'],
                 'name' => $category['name'],
                 'depth'=>$depth,
            ];

            if( count( $category['children'] ) > 0 ){
                $linearizeArray = $this->linearizeCategoryArray( $category['children'], ($depth + 1), $linearizeArray );
            }

        }


        if (count($linearizeArray) > 0) {
            return $linearizeArray;
        } else {
            return array();
        }


    }


    /**
     * Delete the give category id  and all his sub-category and relative posts
     *
     * @param $id - The category id to delete
     * @return bool
     */
    public function deleteCategoryAndSubcategory($id)
    {
        $sub_categories = $this->linearizeCategoryArray($this->listTreeCategories($id));

        if(count($sub_categories)>0) {
            foreach ($sub_categories as $sub_category) {

                // Search if this sub-categories as post and

               $sub_category = $this->find($sub_category['id']);
                // Delete All posts in this category
                $sub_category->posts()->delete();

                // Delete entry in pivot
                $sub_category->posts()->detach();


                if (!$this->whereId($sub_category['id'])->delete()) {
                    return false;
                }

            }
        }

      if ($this->whereId($id)->delete()) {

            return true;
        }

        return false;

    }




    /**
     * Delete the selected category, passed from id, and his sub-categories
     *
     * @param $id - The Category to delete
     * @return bool
     */
    public function movePostsToCategory($category_id, $new_category_id)
    {

       if( \DB::table('category_post')->where('category_id', '=', $category_id)->update(array('category_id' => $new_category_id)) ){
           return true;
       }
        return false;
    }





    /**
     * Delete the selected category, passed from id, and his sub-categories
     *
     * @param $id - The Category to delete
     * @return bool
     */
    public function moveSubcategory($category_id, $new_parent_category_id)
    {
        return $this->where('parent_id',$category_id)->update(['parent_id' => $new_parent_category_id]);

    }

}
