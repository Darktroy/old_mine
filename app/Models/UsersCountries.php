<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersCountries extends Model
{
    protected $table = 'users_countries';

    public function users()
    {
        return $this->hasMany('App\Models\User','id','user_id');
    }

    public function countries()
    {
        return $this->hasMany('App\Models\Country','id','country_id');
    }
}
