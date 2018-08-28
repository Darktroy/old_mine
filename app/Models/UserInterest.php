<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    //
    protected $table = 'user_interests';
    protected $fillable = ['user_id','interest_id'];

    public static function storeRecord($data, $id = null)
    {
        if ($id != null) {
            $record = self::where('id', $id)->first();
        } else {
            $record = new self();
        }

        (isset($data['user_id']) && !empty($data['user_id'])) ? $record->user_id = $data['user_id'] : false;
        (isset($data['interest_id']) && !empty($data['interest_id'])) ? $record->interest_id = $data['interest_id'] : false;

        if (!$record->save()) {
            return false;
        }

        return $record;
    }


    protected static function userInterests($user_id)
    {
        return self::where('user_id',$user_id)->get();
    }
    
    public static function storeUserInterest($data, $id )
    {
        
            $record = new self();
            $record->user_id = $id;
            $record->interest_id = $data;

        if (!$record->save()) {
            return false;
        }

        return $record;
    }
}
