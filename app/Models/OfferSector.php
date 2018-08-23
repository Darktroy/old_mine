<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferSector extends Model
{
    //
    protected $table = 'offers_sectors';

    protected function storeRecord($data){

        $record = new self;
        $record->offer_id = $data['offer_id'];
        $record->sector_id = $data['sector_id'];
        if (!$record->save()){
            return false;
        }
        return $record;
    }
}
