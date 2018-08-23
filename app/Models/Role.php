<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustRole;

class Role extends Model
{
    public $stimestamp = false;
   // protected $hidden = ['name'];


    public function users()
    {
      return  $this->belongsToMany('App\Models\User','role_user');
    }

}