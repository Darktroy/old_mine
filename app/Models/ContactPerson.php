<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class ContactPerson extends Model
{
    protected $table = 'contact_person';
    public $errors = '';
    public $staus = true;
    protected $fillable = ['first_name', 'last_name', 'position', 'department', 'tel', 'ext', 'mobile','email', 'organization'];

    protected $attributes = [
        'position' => '',
        'department' => '',
        'tel' => '',
        'mobile' => ''
    ];

    public $roles = [
        "last_name" => "required",
        "first_name" => "required",
        "email" => "required|email",
        "organization" => "required"
    ];


    public function storeContactPerson($request,$org_id)
    {
        foreach ($request->contact_person as $person) {
            $person['organization'] = $org_id;
            if (!$this->validateForm($this->roles, $person)) {
                $this->staus = false;
                return $this->errors;
            }
            $_this = new self;
            $_this->first_name = $person['first_name'];
            $_this->last_name = $person['last_name'];
            $_this->position = $person['position'];
            $_this->department = $person['dept_name'];
            $_this->tel = $person['tel'];
            $_this->ext = $person['ext'];
            $_this->mobile = $person['mobile'];
            $_this->email = $person['email'];
            $_this->organization = $person['organization'];

            $_this->saveOrFail();
        }
    }

    public static function updateContactPerson($data, $id)
    {
        $orgCon = self::where('id',$id)->first();
        $orgCon->update($data);
    }


    public function validateForm($roles = [], $data = [])
    {
        $validator = Validator::make($data, $roles);
        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organizations', 'organization');
    }
}
