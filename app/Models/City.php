<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $fillable = ['id','name','country_id'];
    public $incrementing = false;


    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }

    protected function countyCities($country_id)
    {
        return self::where('country_id',$country_id)->get()->pluck('name','id');
    }
    protected  function arrayOfCountries($countries_ids = []){
        return self::whereIn('country_id',$countries_ids)->get();
    }
}
