<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Http\Request;
use App\Changemaker;
class UserEducation extends Model
{
    //
    protected $table = 'user_education';
    protected $fillable = ['maker_id','degree','field','u_i_name','obtained_year'];
    public $user = '';
    public $errors = '';


    public static function storeUserEducation($request)
    {
        // dd($request->all(),'work_model');
        foreach($request->edu as $education){
            $_this = new self;
            $_this->user =  Changemaker::lastMaker();
            $education['obtained_year'] = date('Y-m-d',strtotime($education['obtained_year']));
            $education['maker_id'] = $_this->user->id;
            $_this->create($education);
        }

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

    

}
