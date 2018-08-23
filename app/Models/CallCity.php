<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallCity extends Model
{
    //
    protected $table = 'call_cities';
    protected $fillable = ['call_id','country_id','city_id'];

    protected function storeRecord($data,$id = null){
        if( !empty($id) && $id != null){
            $call_city = CallCity::where('id',$id)->first();
        }else{
            $call_city = new self;
        }

        $call_city->call_id = $data['call_id'];
        $call_city->country_id = $data['country_id'];
        $call_city->city_id = $data['city_id'];
        if(!$call_city->save()){
            return false;
        }

        return $call_city;
    }
}
