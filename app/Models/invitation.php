<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
    protected $table = 'invitation';
    protected $fillable = ['org_name','email','subj_name','country_id','content'];
}
