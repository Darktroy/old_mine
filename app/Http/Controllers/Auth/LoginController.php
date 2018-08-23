<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Country;
use Session;
use Validator;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLoginView()
    {
        $parent_title = 'Home';
        $page_title = 'Login';
        return view('site.login', compact('parent_title', 'page_title'));
    }

    // public function validateUser(Request $request){
    //     // dd($request->all());
    //     if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
    //         if(Auth::user()->type = 1){
    //             return redirect()->intended('/country/account');
    //         }elseif (Auth::user()->type = 3) {
    //             return redirect()->intended('/changemaker/account');
    //         }
    //     }else{
    // 		Session::flash('message','Failed To login');
    // 		return redirect()->back();
    // 	}
    // }
}
