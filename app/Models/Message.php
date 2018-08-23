<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'contact_us_messages';
    protected $fillable = ['name', 'email', 'subject', 'message','user_id'];
}
