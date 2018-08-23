<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Models
use App\Models\User;

// Facades & libs & packages & helpers
use Auth;
use Validator;
use Session;

class UsersController extends Controller
{
    //     Validate Old password when update
    public function validatePassword(Request $request)
    {
        if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password])) {
            return response(['status' => true]);
        }
        return response(['status' => false]);
    }

    //     Change Password on update
    public function changePassword(Request $request)
    {
        $rules = ['password' => 'required|min:6|confirmed', 'password_confirmation' => 'required|min:6'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if (!User::storeRecord(['password' => $request->password], Auth::user()->id)) {
            Session::flash('message', 'Failed To Update Password');
            return redirect()->back();
        }

        Session::flash('message', 'Updated Successfully');
        return redirect()->back();
    }

}
