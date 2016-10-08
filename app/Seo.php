<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    // Insert this because I don't have use the Laravel Table convention
    protected $table = 'seo';

    protected $fillable = ['title_tag', 'description_tag','seoble_id','seoble_type'];



    public function seoble()
    {
        return $this->morphTo();
    }
}
