<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tags';
    protected $fillable = ['tag'];
    
    public function post(){
        return $this->belongsToMany('App\Post','post_tags','post_id');
    }
}
