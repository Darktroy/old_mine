<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Offer extends Model
{
    //
    protected $table = 'offers';

    protected static function storeRecord($data,$id = null )
    {
        if ($id != null ){
            $offer = self::where('id',$id)->first();
        }else{
            $offer = new self;
        }

        $offer->title = $data->title;
        $offer->contact_person = $data->contactPerson;
        $offer->email = $data->email;
        $offer->phone = $data->phone;
        $offer->summary = $data->summary;
        $offer->description = $data->description;
        $offer->deadline = $data->deadline;
        $offer->activity_id = $data->activity_id;
        $offer->user_id = Auth::user()->id;

        if (isset($data->status) && !empty($data->status)){
            $offer->status = $data->status;
        }else{
            $offer->status = 0;
        }
        if(!$offer->save()){
            return false;
        }
        return $offer;
    }

    public function offerType()
    {
        return $this->belongsTo('App\Models\OfferActivity','activity_id');
    }

    public function activityName(){

    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function offerCountries()
    {
        return $this->belongsToMany('App\Models\Country','offer_countries','offer_id');
    }

    public function offerSectors()
    {
        return $this->hasMany('App\Models\OfferSector','offer_id');
    }

    protected static function offerById($offer_id)
    {
        return self::where('id',$offer_id)->first();
    }

    protected function updateActivation($offer_id, $status)
    {
        $offer = self::offerById($offer_id);
        $offer->active = $status;
        if (!$offer->save()){
            return false;
        }
        return $offer;
    }

    protected function updateStatus($offer_id,$status){
        $offer = self::offerById($offer_id);
        $offer->status = $status;
        if (!$offer->save()){
            return false;
        }
        return $offer;
    }

    public function getDeadlineAttribute($value)
    {
        $date = strtotime($value);
        return date('Y-m-d',$date);
    }


}
