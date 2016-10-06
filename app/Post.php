<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{



    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = ['published_at','deleted_at','publish_date'];

    protected $fillable = [
                             'title', 'abstract', 'content',
                             'status', 'publish_date',
                             'title_tag', 'description_tag',
                             'deleted_by', 'deleted_at'
    ];

    /**
     * Get the user that wrote the post.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Get the user that DELETE the post.
     */
    public function deletedBy()
    {
        return $this->belongsTo('App\User','deleted_by');
    }

    /**
     * The many-to-many relationship between posts and categories.
     *
     * @return BelongsToMany
     */
   public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_post');
    }


    /**
     * Scope for retrieve only not deleted element
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', '<>', 'deleted');

    }



    /**
     * Scope for retrieve only deleted element
     *
     * @param $query
     * @return mixed
     */
    public function scopeTrashed($query)
    {
        return $query->where('status', 'deleted');
    }





}
