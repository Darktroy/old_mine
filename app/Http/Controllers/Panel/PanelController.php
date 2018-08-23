<?php

namespace App\Http\Controllers\Panel;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Validator;
use Session;

class PanelController extends Controller
{
    //

    public function panelDashboard()
    {
//        dd('test');
        return view('panel.index');
    }

    public function getAdminSettings()
    {
        $user = User::findOrFail(Auth::user()->id);
        $page_title = 'edit Admin Settings';
        $sub_title = 'Admin Details';
        $search = false;
        return view('panel.admin.editAdmin', compact('user', 'page_title', 'sub_title', 'search'));
    }

    public function updateAdminSettings(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $rules = ['name' => 'required|min:5', 'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed', 'image' => 'image'];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!empty($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'public/media/profile/';
            $file_name = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($path, $file_name);
            $user->image = $path . $file_name;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($user->save()) {
            Session::flash('message', 'Updated Successfully');
            return redirect()->back();
        }
    }

    public function getContactUsMessages()
    {
        $page_title = 'Contact us Messages';
        $sub_title = 'List All Messages';
        $search = true;
        $messages = Message::paginate(50);
        return view('panel.contact_us_messages', compact('messages', 'page_title', 'sub_title', 'search'));
    }

    public function getContactUsMessage($id)
    {
        $message = Message::findOrFail($id);
        if ($message) {
            return response(['message' => $message, 'status' => 'success']);
        } else {
            return response(['error' => 'Failed To get the message', 'status' => 'failed']);
        }
    }

    public function deleteContactUsMessage($id)
    {
        $message = Message::findOrFail($id);
//        dd($message);
        if ($message->delete()) {
            Session::flash('message','Message Deleted Successfully');
            return redirect()->back();
        } else {
            Session::flash('message','Failed To Delete The message');
            return redirect()->back();
        }
    }
}
