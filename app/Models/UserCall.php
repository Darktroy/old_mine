<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCall extends Model
{
    //
    protected $table = 'user_calls';

    protected function storeRecord($data,$id = null){
        if(!empty($id) && $id != null){
            $user_call = self::where('id',$id)->first();
        }else{
            $user_call = new self();
        }

        $user_call->user_id = $data['user_id'];
        $user_call->call_id = $data['call_id'];
//        $user_call->country_id = $data['country_id'];

        if(!$user_call->save()){
            return false;
        }

        return $user_call;
    }

    public function user()
    {
        return $this->belongsToMany('App\User','user_id');
    }
}
