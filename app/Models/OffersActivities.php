<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffersActivities extends Model
{
    //
    protected $table = 'offers_activities';
    protected $fillable = ['offer_id', 'activity_id'];
    public $timestamps = false;

    public static function storeRecord($activity_id, $offer_id)
    {
            $_this = new self;
            $_this->offer_id = $offer_id;
            $_this->activity_id = $activity_id;
            $_this->saveOrFail();
    }
}
