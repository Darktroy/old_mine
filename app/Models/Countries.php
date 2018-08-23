<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    //
    protected $table = 'countries';
    protected $fillable = ['name','nationality','flag'];


    public function country()
    {
        return $this->hasOne('App\Models\Country','id');
    }

}
