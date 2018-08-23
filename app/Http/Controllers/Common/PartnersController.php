<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnersController extends Controller
{
    //
    public function registerPartner()
    {
        return view('site.partners.register');
    }
}
