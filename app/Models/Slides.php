<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    //
    protected $table = 'slides';
    protected $filable = ['title','caption','red_button_title','red_button_url','transparent_button_title','transparent_button_url','image','active'];
}
