<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';
    protected $fillable = ['title','description','min_description','meta_title',',meta_description','category_id','user_id','country_id','active'];


    public function postImages()
    {
        return $this->hasMany('App\Models\PostImage','post_id');
    }
    
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','post_tags','post_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }


}
