<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Validator;
use DB;
use Session;

use App\Models\{
    Role, User, Country
};

class SubUsersController extends Controller
{
    //
    public $status = false;
    public $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function storeUser(Request $request)
    {
//        dd($request->all());

        $validator = Validator::make($request->all(), $this->roles());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data = $request->all();
        $data['type'] = 4;
        $user = User::storeRecord($data);

        DB::beginTransaction();

        if ($user) {
            if (isset($request->role_id) && !empty($request->role_id) && count($request->role_id) >= 1) {
                $roles = Role::whereIn('id', $request->role_id)->get()->toArray();
                try {
                    $user->attachRoles($roles);
                } catch (Exception $e) {
                    $this->status = true;
                }
            }
        }

        if ($this->status !== true) {
            DB::commit();
            Session::flash('message', 'User Added Successfully');
        } else {
            Session::flash('message', 'some thing wrong Failed To add User');
        }
        return redirect()->back();
    }

    public function updateUser(Request $request, $id)
    {

        $validator = Validator::make($request->all(), $this->roles($id));
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data = $request->all();
        $data['type'] = 4;
        $user = User::storeRecord($data,$id);
        DB::beginTransaction();

        if ($user) {
            if (isset($request->role_id) && !empty($request->role_id) && count($request->role_id) >= 1) {
//                $user->syncRolesWithoutDetaching()
                $user->detachRoles($user->roles->toArray());
                $roles = Role::whereIn('id', $request->role_id)->get()->toArray();
                try {
                    $user->attachRoles($roles);
                } catch (Exception $e) {
                    $this->status = true;
                }
            }
        }

        if ($this->status !== true) {
            DB::commit();
            Session::flash('message', 'User update Successfully');
        } else {
            Session::flash('message', 'some thing wrong Failed To add User');
        }
        return redirect()->back();
    }

    public function viewAccount($id)
    {
        $user = User::where('id',$id)->with('country')->first();
        $links = [
            'Settings' => ['status' => 'active', 'url' => url('country/account'), 'name' => 'Settings', 'icon' => ' icon-cog3']];
        return view('site.country.account', compact('user', 'links'));

    }

    private function roles($id = null)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'position' => 'required',
            'organization' => 'required',
            'tel' => 'required',
            'phone' => 'required',
        ];

        if($id != null){
            $rules['email'] = 'required|email|unique:users,email,'.$id;
        }else{
            $rules['email'] = 'required|email|unique:users,email';
        }

        if($this->request->has('password')){
            $rules['password'] = 'required|confirmed';
        }

        return $rules;
    }


    public function deleteUser(Request $request, $id)
    {
        $user = User::where('id',$id)->first();
        if(!$user->delete()){
            return response(['id'=>$id,'message'=>'Failed To Delete User']);
        }

        return response(['id'=>$id,'message'=>'User Deleted Successfully']);
    }
}
