<?php

namespace App\Http\Controllers\Site;

use App\Models\Message;
use App\Models\Slides;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
class HomeController extends Controller
{
    //

    public function index()
    {
        $slides = Slides::where('active', 1)->get();
        $posts = Post::orderBy('id','DESC')->take(4)->get();
        return view('site.Home.index', compact('slides','posts'));
    }

    public function contactUs(Request $request)
    {
        $message = new Message();
        $rules = ['name' => 'required', 'email' => 'required|email', 'subject' => 'required|min:5', 'message' => 'required|min:10'];
        $this->validate(request(), $rules);
        if ($message->create($request->all())) {
            return response(['thank you for contacting us']);
        } else {
            return response(['Failed to Send message please try again']);
        }
//        dd($request->all());
    }

}
