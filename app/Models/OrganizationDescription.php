<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class OrganizationDescription extends Model
{
    public $errors = '';
    public $status = true;
    private $logo_name;
    private $other_doc_name;
    protected $table = 'organization_description';

    protected $fillable = ['about_us', 'established_on', 'no_of_emp', 'no_of_mem', 'services_desc', 'suggested_contribution', 'support_us', 'clarifications', 'suggest_plan',
        'logo', 'other_doc', 'organization', 'login_email', /*'other_sector' , 'other_address' , 'other_selected_by' , */
        'login_password'];
    protected $attributes = [
        'services_desc' => "",
        'suggested_contribution' => "",
        'clarifications' => "",
        'suggest_plan' => "",
        'logo' => "",
        'other_doc' => ""
    ];
    public $roles = [
        'logo' => 'required|mimes:jpeg,bmp,png,gif,tiff,jpg',
        'other_docs' => 'mimes:pdf,png,jpeg,jpg,doc,docx,csv,txt'
    ];


    public function organizations()
    {
        return $this->hasOne('App\Models\Organizations', 'id', 'organization')->orderBy('org_name', 'ASC');
    }


    public function user()
    {
        return $this->hasOne('App\Models\User', 'email', 'login_email');
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

    public function uploadFile(Request $request)
    {

        $files = ['logo', 'other_doc'];
        if (!$this->validateForm($this->roles, $request->all())) {
            $this->status = false;
            return $this->errors;
        }

        foreach ($files as $file_name) {
            if ($request->hasFile($file_name)) {
                $name = str_random(12) . 'country_' . $request->$file_name->getClientOriginalName();
                $request->$file_name->storeAs('media/files/', $name, 'public');
                $this->$file_name = $name;

                if ($file_name == 'logo') $this->logo_name = $name;
                else $this->other_doc_name = $name;
            };
        }
    }

    public static function storeCountry($request, $organization_id)
    {
        $_this = new self();
        $data = $request->all();
        $_this->uploadFile($request);
        $_this->about_us = $data['about_us'];
        $_this->services_desc = $data['services_desc'];
        $_this->suggested_contribution = $data['suggested_contribution'];
        $_this->support_us = $data['support_us'];
        $_this->clarifications = $data['clarifications'] ? $data['clarifications'] : "";
        $_this->suggest_plan = $data['suggest_plan'];
        $_this->logo = $_this->logo_name;
        $_this->other_doc = $_this->other_doc_name;
        $_this->login_email = $data['login_email'];
        $_this->login_password = $data['login_Password'];
        $_this->no_of_emp = $data['num_of_emp'];
        $_this->no_of_mem = $data['num_of_mem'];
        $_this->established_on = $data['established'];
//        $_this->other_sector = $data['other_sector'];
//        $_this->other_address = $data['other_address'];
//        $_this->other_selected_by = $data['other_selected_by'];
        $_this->organization = $organization_id;

        $_this->saveOrFail();

        return $_this;
    }

    public static function updateOrgDetails($data, $id)
    {
        $_this = self::where('organization', $id)->first();
        $_this->about_us = $data['about_us'];
        $_this->services_desc = $data['services_desc'];
        $_this->suggested_contribution = $data['suggested_contribution'];
        $_this->support_us = $data['support_us'];
        $_this->no_of_emp = $data['num_of_emp'];
        $_this->no_of_mem = $data['num_of_mem'];

        $_this->saveOrFail();

        return $_this;
    }
}
