<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneAndFax extends Model
{
    //
    protected $table = 'phones';

    protected static function storeRecord($data, $id = null)
    {
        if ($id != null) {
            $phone = self::where('id', $id)->first();
        } else {
            $phone = new self();
        }

        (isset($data['company_id']) && !empty($data['company_id'])) ? $phone->company_id = $data['company_id'] : false;
        (isset($data['number']) && !empty($data['number'])) ? $phone->number = $data['number'] : false;
        (isset($data['type']) && !empty($data['type'])) ? $phone->number_type = $data['type'] : false;
        if (!$phone->save()) {
            return false;
        }

        return $phone;

    }
}
