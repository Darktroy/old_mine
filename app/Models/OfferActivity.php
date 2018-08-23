<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferActivity extends Model
{
    //
    protected $table = 'activities';

    protected function storeRecord($data){
        $activity = new self;
        $activity->name = $data['name'];
        if(!$activity->save()){
            return false;
        }

        return $activity;
    }

}
