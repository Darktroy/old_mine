<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    //
    protected $table = 'calls';
    protected $fillable = ["for","title" ,"person","email","special_skills","task_details","deadline" ,"skills_details","selection" ,"number" ,"working_hours","gender" ,"from" ,"to" ,"workplace","benefits" ,"more",'user_id'/*,'user_type'*/];

    protected static function storeCall ($data,$id = null)
    {

        if(!empty($id) && $id != null){
            $call = self::where('id',$id)->first();
        }else{
            $call = new self;
        }
        $call->for = $data->for;
        $call->title = $data->title;
        $call->person = $data->person;
        $call->email = $data->email;
        $call->task_details = $data->task_details;
        $call->skills_details = $data->skills_details;
        $call->special_skills = $data->special_skills ? $data->special_skills : 0;
        $call->deadline = $data->deadline;
        $call->selection = $data->selection;
        $call->number = $data->number;
        $call->working_hours = $data->working_hours;
        $call->gender = $data->gender;
        $call->from = $data->from;
        $call->to = $data->to;
        $call->workplace = $data->workplace;
        $call->benefits = $data->benefits;
        $call->more = $data->more;
        $call->user_id = $data->user_id;
//        $call->user_type = $data->user_type;
        $call->activate = 1;
        if (isset($data->status) && !empty($data->status)){
            $call->status = $data->status;
        }else{
            $call->status = 0;
        }

        if(!$call->save()){
            return false;
        }
        return $call;

    }

    protected function updateStatus($call_id,$status){
        $call = self::callById($call_id);
        $call->status = $status;
        if (!$call->save()){
            return false;
        }
        return $call;
    }

    protected function updateActivation($call_id, $status)
    {
        $call = self::callById($call_id);
        $call->activate = $status;
        if (!$call->save()){
            return false;
        }
        return $call;
    }

    public function caller()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    protected static function callById($call_id){
        return self::where('id',$call_id)->first();
    }

    public function callCountries()
    {
        return $this->belongsToMany('App\Models\Country','call_countries','call_id');
    }

    public function callCities()
    {
        return $this->belongsToMany('App\Models\City','call_cities','call_id');
    }

    protected static function userCalls($user_id)
    {
        return self::where('user_id',$user_id)->with('callCountries')->with('callCities');
    }
}
