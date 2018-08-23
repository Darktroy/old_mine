<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallCountry extends Model
{
    //
    protected $table = 'call_countries';
    protected $fillable = ['call_id','country_id'];

    protected function storeRecord($data,$id = null){
        if( !empty($id) && $id != null){
            $call_country = CallCountry::where('id',$id)->first();
        }else{
            $call_country = new self;
        }

        $call_country->call_id = $data['call_id'];
        $call_country->country_id = $data['country_id'];
        if(!$call_country->save()){
            return false;
        }
        return $call_country;
    }

    public function calls()
    {
        return $this->hasMany('App\Models\Call','id','call_id');
    }

}
