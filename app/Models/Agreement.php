<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Agreement extends Model
{
    //
    protected $table = 'agreements';
    protected $fillable = ['title','min_description','description','country_id','user_id'];

    protected static function newRecord($data, $id = null)
    {
        // dd($data);
        if ($id != null) {
            $agreement = self::where('id', $id)->first();
        } else {
            $agreement = new  self();
        }

        (isset($data['title']) && !empty($data['title'])) ? $agreement->title = $data['title'] : false;
        (isset($data['min_description']) && !empty($data['min_description'])) ? $agreement->min_description = $data['min_description'] : false;
        (isset($data['description']) && !empty($data['description'])) ? $agreement->description = $data['description'] : false;
        $agreement->user_id = Auth::user()->id;
        $agreement->country_id = Auth::user()->country->id;

        if (!$agreement->save()) {
            return false;
        }

        return $agreement;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }
}
