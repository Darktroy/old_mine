<?php
/**
 * Created by PhpStorm.
 * User: Gehad
 * Date: 4/18/2018
 * Time: 2:47 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RolesUsers extends Model
{
    public $stimestamp = false;
    protected $table = 'role_user';


    public function users()
    {
        return  $this->belongsToMany('App\Models\User','user_id');
    }

    public function Roles()
    {
        return  $this->belongsToMany('App\Models\User','role_id');
    }

}