<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferCountry extends Model
{
    //
    protected $table = 'offers_countries';

    protected static function storeRecord($data)
    {
        $record = new self();
        $record->country_id = $data['country_id'];
        $record->offer_id = $data['offer_id'];
        if($record->save()){
            return false;
        }

        return $record;
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer','id','offer_id');
    }

}
