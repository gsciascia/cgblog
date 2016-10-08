<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{

    use Sluggable;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = ['published_at','deleted_at','publish_date'];

    protected $fillable = [
                             'title', 'abstract', 'content',
                             'status', 'publish_date',
                             'deleted_by', 'deleted_at',
                             'photo_filename','slug'
    ];


    public $image_path='/images/'; // Where we store images (Relative to Public folder)



    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



    /**
     * Get the user that wrote the post.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Relation with Seo table
     */
    public function seo()
    {
        return $this->morphMany('App\Seo', 'seoble');

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



    /**
     * Scope for retrieve only published element
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'publish')->where('publish_date', '<=', Carbon::now());
    }



    public function setPublishDateAttribute($date)
    {
        $this->attributes['publish_date'] = Carbon::createFromFormat('d/m/Y',$date);
    }

    public function getPublishDateAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }






}
