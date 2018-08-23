<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table = 'change_maker_languages';
    protected $fillable = ['maker_id','lang_name','level'];

    public static function storeLanguages($request,$user_id)
    {
        // $data = $request
        foreach ($request->lang as $lang) {
            // dd($lang);
            $_this = new self;
            $lang['maker_id'] = $user_id;
            $_this->create($lang);
        }
        // dd($request->lang);
    }
}
