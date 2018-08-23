<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class News extends Model
{
    //
    protected $table = 'news';
    protected static function newRecord($data, $id = null)
    {
        // dd($data);
        if ($id != null) {
            $news = self::where('id', $id)->first();
        } else {
            $news = new  self();
        }

        (isset($data['title']) && !empty($data['title'])) ? $news->title = $data['title'] : false;
        (isset($data['mini_description']) && !empty($data['mini_description'])) ? $news->mini_description = $data['mini_description'] : false;
        (isset($data['description']) && !empty($data['description'])) ? $news->description = $data['description'] : false;
        (isset($data['active']) && !empty($data['active'])) ? $news->active = $data['active'] : false;
        (isset($data['slider']) && !empty($data['slider'])) ? $news->slider = $data['slider'] : false;
        (isset($data['poster']) && !empty($data['poster'])) ? $news->poster = $data['poster'] : false;
        $news->user_id = Auth::user()->id;
        $news->country_id = Auth::user()->country->id;


        if (!$news->save()) {
            return false;
        }

        return $news;
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
