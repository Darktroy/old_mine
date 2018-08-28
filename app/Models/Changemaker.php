<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Changemaker extends Model
{
    //
    public $errors = '';
    protected $table = 'changemakers';
    protected $fillable = [
            "last_name" , "first_name", "email", "private_link", "gender",
            "birth_date", "nationality", "country_id", "city_id", "address", "phone", "skills", "interestes",
            "facebook", "linked_in", "work_hours", "work_place", "work_time_from", "work_time_to",
            'profile','cv','cover_letter','other_doc','user_id','skills'
        ];

    public $roles = [
            "last_name" => "required",
            "first_name" => "required",
            "email" => "required|email|unique:changemakers",
            "p_link" => "unique:changemakers,private_link",
//            "private_link" => "unique:changemakers,private_link",
            "gender" => "required",
            "birth_date" =>"required|date",
            "nationality" => "required",
            "country_id" => "required",
            "city_id" => "required",
            "address" => "required",
            "phone" => "required",
            "skills" => "required",
            "interestes" => "",
            "work_hours" => "numeric",
            "work_place" => "required",
            "work_time_from" => "required",
            "work_time_to" => "required",
            'profile' => 'required|image|mimes:png,jpg,jpeg',
			'cv' => 'required|mimes:pdf,doc,docx',
			'cover_letter' =>'mimes:pdf,png,jpeg,jpg,doc,docx',
			'other_docs'=>'mimes:pdf,png,jpeg,jpg,doc,docx',
            'skills'=>'required'
    ];

   	public $cv = null;
	public $other_docs = null;
	public $cover_letter = null;
    // public $profile = null;


    protected static function newRecord($data, $id = null)
    {

        if ($id != null) {
            $change_maker = self::where('id', $id)->first();
        } else {
            $change_maker = new self();
        }

        (isset($data->last_name) && !empty($data->last_name)) ? $change_maker->last_name = $data->last_name : false;
        (isset($data->user_id) && !empty($data->user_id)) ? $change_maker->user_id = $data->user_id : false;
        (isset($data->first_name) && !empty($data->first_name)) ? $change_maker->first_name = $data->first_name : false;
        (isset($data->email) && !empty($data->email)) ? $change_maker->email = $data->email : false;
        (isset($data->job_title) && !empty($data->job_title)) ? $change_maker->job_title = $data->job_title : false;
        (isset($data->private_link) && !empty($data->private_link)) ? $change_maker->private_link = $data->private_link : false;
        (isset($data->nationality) && !empty($data->nationality)) ? $change_maker->nationality = $data->nationality : false;
        (isset($data->country_id) && !empty($data->country_id)) ? $change_maker->country_id = $data->country_id : false;
        (isset($data->city_id) && !empty($data->city_id)) ? $change_maker->city_id = $data->city_id : false;
        (isset($data->facebook) && !empty($data->facebook)) ? $change_maker->facebook = $data->facebook : false;
        (isset($data->twitter) && !empty($data->twitter)) ? $change_maker->twitter = $data->twitter : false;
        (isset($data->linked_in) && !empty($data->linked_in)) ? $change_maker->linked_in = $data->linked_in : false;
        (isset($data->address) && !empty($data->address)) ? $change_maker->address = $data->address : false;
        (isset($data->phone) && !empty($data->phone)) ? $change_maker->phone = $data->phone : false;
        (isset($data->gender) && !empty($data->gender)) ? $change_maker->gender = $data->gender : false;
        (isset($data->birth_date) && !empty($data->birth_date)) ? $change_maker->birth_date = $data->birth_date : false;
        (isset($data->work_hours) && !empty($data->work_hours)) ? $change_maker->work_hours = $data->work_hours : false;
        (isset($data->work_place) && !empty($data->work_place)) ? $change_maker->work_place = $data->work_place : false;
        (isset($data->work_time_from) && !empty($data->work_time_from)) ? $change_maker->work_time_from = $data->work_time_from : false;
        (isset($data->work_time_to) && !empty($data->work_time_to)) ? $change_maker->work_time_to = $data->work_time_to : false;
        (isset($data->interests) && !empty($data->interests)) ? $change_maker->interests = $data->interests : false;
        (isset($data->profile) && !empty($data->profile)) ? $change_maker->profile = $data->profile : false;
        (isset($data->other_docs) && !empty($data->other_docs)) ? $change_maker->other_docs = $data->other_docs : false;
        (isset($data->skills) && !empty($data->skills)) ? $change_maker->skills = $data->skills : false;

        if (!$change_maker->save()) {
            return fals;
        }
        return $change_maker;
    }


    public static function storeChangeMaker($request){
        $_this = new self;
        $data = $request->all();
        $user = self::relatedUser($request->email);
        if(!$_this->validateForm($_this->roles,$data)){
            return ['status'=>false,'errors'=>$_this->errors];
        };
        $_this->uploadFile($request);
        $data['cv'] = $_this->cv;
        $data['profile'] = $user->image;
        $data['cover_letter'] = $_this->cover_letter;
        $data['other_docs'] = $_this->other_docs;
//        $data['private_link'] = $data['private_link'];
        $data['private_link'] = $data['p_link'];
        $data['user_id'] = $user->id;
        // dd($data);
        $_this->create($data);
        $maker = self::orderBy('id','DESC')->first();
        return $maker;
    }

    public static function relatedUser($email)
    {
        return User::where('email',$email)->first();
    }

    public function validateForm($roles = [], $data = [])
    {
        $validator = Validator::make($data,$roles);
        if($validator->fails()){
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }


    public function uploadFile(Request $request)
	{

		$files = ['cv','cover_letter','other_doc'];

		if(!$this->validateForm($this->roles,$request->all())){
            
            $this->staus = false;
            return $this->errors;
        }

		foreach ($files as $file_name) {
			if($request->hasFile($file_name)){
				$name = str_random(12).'change_maker_'.$request->$file_name->getClientOriginalName();
				$request->$file_name->storeAs('media/files/',$name,'public');
				$this->$file_name = $name;
			};
		}
	}

    public static function lastMaker()
    {
        return self::orderBy('id','DESC')->first();
    }
    
    protected static function getChangeMakerByUserId($id)
    {
        return self::where('user_id',$id)->first();
    }

    public function interests()
    {
        return $this->hasMany('\App\UserInterest','user_id','user_id');
    }
    protected static function loggedInMaker()
    {
        return self::getChangeMakerByUserId(Auth::user()->id);
    }
}
