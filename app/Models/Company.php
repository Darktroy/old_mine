<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    //
    protected static function newRecord($data, $id = null)
    {
//        dd($data);
        if ($id != null) {
            $company = self::where('id', $id)->first();
        } else {
            $company = new self();
        }

        (isset($data->name) && !empty($data->name)) ? $company->name = $data->name : false;
        (isset($data->user_id) && !empty($data->user_id)) ? $company->user_id = $data->user_id : false;
        (isset($data->website) && !empty($data->website)) ? $company->website = $data->website : false;
        (isset($data->email) && !empty($data->email)) ? $company->email = $data->email : false;
        (isset($data->p_link) && !empty($data->p_link)) ? $company->p_link = $data->p_link : false;
        (isset($data->belongs_to) && !empty($data->belongs_to)) ? $company->belongs_to = $data->belongs_to : false;
        (isset($data->country_id) && !empty($data->country_id)) ? $company->country_id = $data->country_id : false;
        (isset($data->city_id) && !empty($data->city_id)) ? $company->city_id = $data->city_id : false;
        (isset($data->facebook) && !empty($data->facebook)) ? $company->facebook = $data->facebook : false;
        (isset($data->twitter) && !empty($data->twitter)) ? $company->twitter = $data->twitter : false;
        (isset($data->linked_in) && !empty($data->linked_in)) ? $company->linked_in = $data->linked_in : false;
        (isset($data->company_type) && !empty($data->company_type)) ? $company->company_type = $data->company_type : false;
        (isset($data->about) && !empty($data->about)) ? $company->about = $data->about : false;
        (isset($data->established) && !empty($data->established)) ? $company->established = $data->established : false;
        (isset($data->employees) && !empty($data->employees)) ? $company->employees = $data->employees : false;
        (isset($data->turn_over_from) && !empty($data->turn_over_from)) ? $company->turn_over_from = $data->turn_over_from : false;
        (isset($data->turn_over_to) && !empty($data->turn_over_to)) ? $company->turn_over_to = $data->turn_over_to : false;
        (isset($data->product_type) && !empty($data->product_type)) ? $company->product_type = $data->product_type : false;
        (isset($data->product_description) && !empty($data->product_description)) ? $company->product_description = $data->product_description : false;
        (isset($data->needs) && !empty($data->needs)) ? $company->needs = $data->needs : false;
        (isset($data->logo) && !empty($data->logo)) ? $company->logo = $data->logo : false;
        (isset($data->other_docs) && !empty($data->other_docs)) ? $company->other_docs = $data->other_docs : false;
        (isset($data->agree) && !empty($data->agree)) ? $company->agree = $data->agree : false;

        if (!$company->save()) {
            return fals;
        }
        return $company;
    }

    protected static function getCompanyByUserId($id)
    {
        return self::where('user_id', $id)->first();
    }

    public function getCompanyTypeAttribute($value)
    {
        return explode(',', $value);
    }

    public function getProductTypeAttribute($value)
    {
        return explode(',', $value);
    }

    public function person()
    {
        return $this->hasOne('App\Models\CompanyPerson', 'company_id');
    }

    public function phones()
    {
        return $this->hasMany('App\Models\PhoneAndFax', 'company_id')->where('phones.number_type', 'p');
    }

    public function faxes()
    {
        return $this->hasMany('App\Models\PhoneAndFax', 'company_id')->where('phones.number_type', 'f');
    }

    public function address()
    {
        return $this->hasMany('App\Models\CompanyAddress','company_id');
    }

    protected static function loggedInCompany()
    {
        return self::getCompanyByUserId(Auth::user()->id);
    }

}
