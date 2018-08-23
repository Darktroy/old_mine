<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    //
    protected $table = 'address';

    protected static function storeRecord($data, $id = null)
    {

        if ($id != null) {
            $record = self::where('id', $id)->first();
        } else {
            $record = new self();
        }

        (isset($data['company_id']) && !empty($data['company_id'])) ? $record->company_id = $data['company_id'] : false;
        (isset($data['type']) && !empty($data['type'])) ? $record->type_id = $data['type'] : false;
        (isset($data['postal']) && !empty($data['postal'])) ? $record->postal = $data['postal'] : false;
        (isset($data['address']) && !empty($data['address'])) ? $record->address = $data['address'] : false;

        if (!$record->save()) {
            return false;
        }

        return $record;
    }
}
