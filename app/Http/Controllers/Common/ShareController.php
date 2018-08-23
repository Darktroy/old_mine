<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jorenvh\Share\Share;

class ShareController extends Controller
{
    public function facebookShare($link,$title)
    {
        $share = new Share();
        return $share->page($link, $title)->facebook();
    }

    public function twitterShare($link,$title)
    {
        $share = new Share();
        return $share->page($link, 'Your share text can be placed here')->twitter();
    }

    public function linkedInShare($link,$title)
    {
        $share = new Share();

        return $share->page($link, $title)->linkedin('Extra linkedin summary can be passed here');
    }

    public function gplusInShare($link,$title)
    {
        $share = new Share();
        return $share->page($link, $title)->googlePlus();
    }
}
