<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    //
    protected $table = 'ideas';
    protected $fillable = ['title','description','active','mini_description'];
}
