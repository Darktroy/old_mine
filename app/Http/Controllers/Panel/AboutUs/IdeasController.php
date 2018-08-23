<?php

namespace App\Http\Controllers\Panel\AboutUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Idea;
use Validator;
use Session;

class IdeasController extends Controller
{
    //
    public function index(){
        $page_title = 'Ideas';
        $sub_title = 'List All Ideas';
        $search = true;
        $ideas = Idea::paginate(50);
        return view('panel.about_us.idea.index',compact('ideas','sub_title','page_title','search'));
        // dd('test');
    }

    public function getIdea($id){
        $idea = Idea::findOrFail($id);
        return response(['idea'=>$idea]);
    }

    public function newIdea(){
        $page_title = 'Ideas';
        $sub_title = 'New Idea';
        $search = false;
        return view('panel.about_us.idea.new',compact('page_title','sub_title','search'));
    }

    public function createIdea(Request $request){
       $idea = new Idea;
       $rules = ['title'=>'required|min:5','description'=>'required|min:10','mini_description'=>'required|min:10|max:600'];
       $validator = Validator::make($request->all(),$rules);
       if($validator->fails()){
           return redirect()->back()
            ->withInput()
            ->withErrors($validator);
       }

       if($idea->create($request->all())){
           Session::flash('message','Idea Created Successfully');
           return redirect()->route('ideas');
       }
    }

    public function editIdea($id){
        $page_title = 'Ideas';
        $sub_title = 'List All Ideas';
        $search = false;
        $idea = Idea::findOrFail($id);
        return view('panel.about_us.idea.edit',compact('idea','page_title','sub_title','search'));
    }

    public function updateIdea(Request $request, $id){
        $idea = Idea::findOrFail($id);
        $rules = ['title'=>'required|min:5','description'=>'required|min:10','mini_description'=>'required|min:10|max:600'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        
        if($idea->update($request->all())){
            Session::flash('message','Idea updated Successfully');
            return redirect()->route('ideas');
        }
    }

    public function deleteIdea(Request $request, $id){
        $idea = Idea::findOrFail($id);
        if($idea->delete()){
            Session::flash('message','Idea Deleted Successfully ');
            return redirect()->route('ideas');
        }
    }
}
