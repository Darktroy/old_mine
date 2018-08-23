<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountriesFollowers extends Model
{
    protected $table = 'countries_followers';
    protected $fillable = ['user_id', 'country_id', 'org_id', 'follow'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasone('App\Models\User', 'id', 'user_id');
    }
}
