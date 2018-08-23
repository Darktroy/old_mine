<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySector extends Model
{
    //
    protected $table = 'companies_sectors';

    protected static function storeRecord($data, $id = null)
    {
        if ($id != null) {
            $record = self::where('id', $id)->first();
        } else {
            $record = new self();
        }

        (isset($data['company_id']) && !empty($data['company_id'])) ? $record->company_id = $data['company_id'] : false;
        (isset($data['sector_id']) && !empty($data['sector_id'])) ? $record->sector_id = $data['sector_id'] : false;

        if (!$record->save()) {
            return false;
        }

        return $record;
    }

    protected static function companySectors($company_id)
    {
        return self::where('company_id', $company_id)->get();
    }
}
