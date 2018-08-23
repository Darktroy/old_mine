<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
    protected $table = 'organizations';

    protected $fillable = ['country_id', 'city_id', 'org_name', 'dep_name', 'acronym', 'private_link', 'email', 'belong_to', 'org_type', 'status', 'address', 'website',
        'postal_code', 'manager_name', 'first_name', 'last_name', 'selected_by', 'facebook_link', 'linked_link', 'twitter_link'];

    protected $attributes = [
        'private_link' => "",
        'website' => "",
        'facebook_link' => "",
        'linked_link' => "",
        'twitter_link' => "",
        'postal_code' => "",
        'dep_name' => "",
        'acronym' => "",
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function organizationDetails()
    {
        return $this->hasOne('App\Models\OrganizationDescription', 'organization');
    }

    public function organizationContacts()
    {
        return $this->hasMany('App\Models\OrganizationPhonesFaxes', 'organization');
    }

    public function organizationContactPerson()
    {
        return $this->hasMany('App\Models\ContactPerson', 'organization');
    }

    public static function lastOrganization()
    {
        return self::orderBy('id', 'DESC')->first();
    }

    public function getCountryName()
    {
        return $this->country()->name1;
    }

    public function getCityName()
    {
        return $this->city()->name;
    }

    public function saveOragnizationDetails($data)
    {
        $_this = new self();
        $_this->country_id = $data['country_id'];
        $_this->city_id = $data['city_id'];
        $_this->org_name = $data['org_name'];
        $_this->dep_name = $data['dep_name'];
        $_this->acronym = $data['acronym'];
        $_this->private_link = $data['p_link'];
        $_this->email = $data['email'];
        $_this->status = $data['status'];
        $_this->website = $data['website'];
        $_this->postal_code = $data['postal_code'];
        $_this->manager_name = $data['manager_name'];
        $_this->first_name = $data['first_name'];
        $_this->last_name = $data['last_name'];
        $_this->facebook_link = $data['facebook_link'];
        $_this->linked_link = $data['linked_link'];
        $_this->twitter_link = $data['twitter_link'];

        if ($data['belong_to'] == 2) $_this->belong_to = $data['other_sector'];
        elseif ($data['belong_to'] == 0) $_this->belong_to = "Private";
        else $_this->belong_to = "Public";

        if ($data['org_type'] == 2) $_this->org_type = $data['other_org_type'];
        elseif ($data['org_type'] == 0) $_this->org_type = "Governmental Organization";
        else $_this->org_type = "Non-Governmental Organization";


        if ($data['selected_by'] == 2) $_this->selected_by = $data['other_selected_by'];
        elseif ($data['selected_by'] == 0) $_this->selected_by = "Election";
        else $_this->selected_by = "Employee";


        if ($data['address'] == 5) $_this->address = $data['other_address'];
        elseif ($data['address'] == 0) $_this->address = "Headquarter";
        elseif ($data['address'] == 1) $_this->address = "Office";
        elseif ($data['address'] == 2) $_this->address = "Branch";
        elseif ($data['address'] == 3) $_this->address = "Factury";
        else $_this->address = "Work space";

        $_this->saveOrFail();

        return $_this;
    }

    public static function saveUpdateOragnization($data, $id)
    {
        $_this = self::where('id', $id)->first();
        $_this->email = $data['email'];
        $_this->first_name = $data['first_name'];
        $_this->last_name = $data['last_name'];
        $_this->facebook_link = $data['facebook_link'];
        $_this->linked_link = $data['linked_link'];
        $_this->twitter_link = $data['twitter_link'];

        if ($data['org_type'] == 2) $_this->org_type = $data['other_org_type'];
        elseif ($data['org_type'] == 0) $_this->org_type = "Governmental Organization";
        else $_this->org_type = "Non-Governmental Organization";

        $_this->saveOrFail();

        return $_this;
    }
}
