<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    protected $table = 'labels';
    protected $fillable = ['title','description','logo','logo_png','logo_psd','logo_eps'];
}
