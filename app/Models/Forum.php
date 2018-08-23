<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    //
    protected $table = 'forums';
    protected $fillable = ['title','description','mini_description','active'];
}
