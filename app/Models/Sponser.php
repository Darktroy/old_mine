<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponser extends Model
{
    //
    protected $table = 'sponsers';
    protected $fillable = ['image','name','url','active','image_name'];
}
