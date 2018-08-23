<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPerson extends Model
{
    //
    protected $table = 'company_persons';

    protected static function newRecord($data, $id = null)
    {
        if ($id != null) {
            $person = self::where('id', $id)->first();
        } else {
            $person = new  self();
        }

        (isset($data['company_id']) && !empty($data['company_id'])) ? $person->company_id = $data['company_id'] : false;
        (isset($data['title']) && !empty($data['title'])) ? $person->title = $data['title'] : false;
        (isset($data['last_name']) && !empty($data['last_name'])) ? $person->last_name = $data['last_name'] : false;
        (isset($data['first_name']) && !empty($data['first_name'])) ? $person->first_name = $data['first_name'] : false;
        (isset($data['position']) && !empty($data['position'])) ? $person->position = $data['position'] : false;
        (isset($data['department']) && !empty($data['department'])) ? $person->department = $data['department'] : false;
        (isset($data['email']) && !empty($data['email'])) ? $person->email = $data['email'] : false;
        (isset($data['phone']) && !empty($data['phone'])) ? $person->phone = $data['phone'] : false;
        (isset($data['mobile']) && !empty($data['mobile'])) ? $person->mobile = $data['mobile'] : null;

        if (!$person->save()) {
            return false;
        }

        return $person;
    }

}
