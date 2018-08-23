<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validation;

class WorkExperience extends Model
{
    //
    protected $table = 'work_experiences';
    protected $fillable = ['maker_id','position','company','country','city','job_adescription','from','to'];

    public static function storeWorkExperience($request,$maker_id)
    {
        foreach ($request->work as $work) {
            // dd($work);
            $_this = new self;
            $work['country'] = $work['work_country'];
            $work['city'] = $work['work_city'];
            $work['maker_id'] = $maker_id;
            // dd($work);
            $_this->create($work);
        }
        // dd($request->all(),'work');
    }



}
