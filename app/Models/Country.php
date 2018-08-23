<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries_details';
    protected $fillable = ['user_id', 'name', 'nationality', 'flag', 'description', 'phone_code'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function calls()
    {
        return $this->hasMany('App\Models\Call', 'id');
    }


}
