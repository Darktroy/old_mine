<?php

namespace App\Http\Controllers\Common;

use App\Mail\InviteFriendEmail;
use App\Models\Country;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class GeneralController extends Controller
{
    //

    public function inviteFriend(Request $request)
    {

        Mail::to($request->email)->send(new InviteFriendEmail($request->all()));
        return response(['message' => 'mail send Successfully', 'status' => true]);

    }


}
