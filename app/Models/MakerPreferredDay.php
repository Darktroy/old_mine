<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MakerPreferredDay extends Model
{
    //
    protected $table = 'maker_preferred_days';
    protected $fillable = ['maker_id','day'];

    public static function storeDays($request , $id)
    {
        foreach ($request->work_days as $day) {
            # code...
            // dd($day);
            $_this = new self;
            $_this->maker_id = $id;
            $_this->day = $day;
            
            $_this->save();
        }
        // dd($request->all());
    }
}
