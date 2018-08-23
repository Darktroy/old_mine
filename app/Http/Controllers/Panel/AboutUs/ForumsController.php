<?php

namespace App\Http\Controllers\Panel\AboutUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Forum;
use Validator;
use Session;

class ForumsController extends Controller
{
    //
     public function index(){
        $page_title = 'Forums';
        $sub_title = 'List All Forums';
        $search = true;
        $forums = Forum::paginate(50);
        return view('panel.about_us.forum.index',compact('forums','sub_title','page_title','search'));
        // dd('test');
    }

    public function getForum($id){
        $forum = Forum::findOrFail($id);
        // dd($forum);
        return response(['forum'=>$forum]);
    }

    public function newForum(){
        $page_title = 'Forums';
        $sub_title = 'New Forum';
        $search = false;
        return view('panel.about_us.forum.new',compact('page_title','sub_title','search'));
    }

    public function createForum(Request $request){
       $Forum = new Forum;
       $rules = ['title'=>'required|min:5','description'=>'required|min:10','mini_description'=>'required|min:10|max:600'];
       $validator = Validator::make($request->all(),$rules);
       if($validator->fails()){
           return redirect()->back()
            ->withInput()
            ->withErrors($validator);
       }

       if($Forum->create($request->all())){
           Session::flash('message','Forum Created Successfully');
           return redirect()->route('forums');
       }
    }

    public function editForum($id){
        $page_title = 'Forums';
        $sub_title = 'List All Forums';
        $search = false;
        $forum = Forum::findOrFail($id);
        return view('panel.about_us.forum.edit',compact('forum','page_title','sub_title','search'));
    }

    public function updateForum(Request $request, $id){
        $Forum = Forum::findOrFail($id);
        $rules = ['title'=>'required|min:5','description'=>'required|min:10','mini_description'=>'required|min:10|max:600'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        
        if($Forum->update($request->all())){
            Session::flash('message','Forum updated Successfully');
            return redirect()->route('forums');
        }
    }

    public function deleteForum(Request $request, $id){
        $Forum = Forum::findOrFail($id);
        if($Forum->delete()){
            Session::flash('message','Forum Deleted Successfully ');
            return redirect()->route('forums');
        }
    }
}
