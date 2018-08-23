<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationPhonesFaxes extends Model
{
    protected $fillable = ['tel', 'phone', 'fax', 'ext', 'organization'];
    protected $attributes = [
        'tel' => '',
        'phone' => '',
        'fax' => '',
    ];

    public static function storeContactnumbers($request, $org_id)
    {
        foreach ($request->contact_phone as $phone) {
            $phone['organization'] = $org_id;
            OrganizationPhonesFaxes::create($phone);
        }
    }

    public static function updateContactnumbers($data, $id)
    {
            $orgCon = OrganizationPhonesFaxes::where('id',$id)->first();
            $orgCon->update($data);
            return $orgCon;
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organizations', 'organization');
    }
}
