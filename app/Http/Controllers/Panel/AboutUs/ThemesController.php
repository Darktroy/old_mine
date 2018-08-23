<?php

namespace App\Http\Controllers\Panel\AboutUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Theme;
use Session;
use Validator;

class ThemesController extends Controller
{
    //
    public function index(){
        $page_title = 'themes';
        $sub_title = 'List All themes';
        $search = true;
        $themes = theme::paginate(50);
        return view('panel.about_us.theme.index',compact('themes','sub_title','page_title','search'));
        // dd('test');
    }

    public function getTheme($id){
        $theme = theme::findOrFail($id);
        return response(['theme'=>$theme]);
    }

    public function newTheme(){
        $page_title = 'themes';
        $sub_title = 'New theme';
        $search = false;
        return view('panel.about_us.theme.new',compact('page_title','sub_title','search'));
    }

    public function createTheme(Request $request){
       $theme = new theme;
       $rules = ['title'=>'required|min:5','description'=>'required|min:10','mini_description'=>'required|min:10|max:600'];
       $validator = Validator::make($request->all(),$rules);
       if($validator->fails()){
           return redirect()->back()
            ->withInput()
            ->withErrors($validator);
       }

       if($theme->create($request->all())){
           Session::flash('message','theme Created Successfully');
           return redirect()->route('themes');
       }
    }

    public function editTheme($id){
        $page_title = 'themes';
        $sub_title = 'List All themes';
        $search = false;
        $theme = theme::findOrFail($id);
        return view('panel.about_us.theme.edit',compact('theme','page_title','sub_title','search'));
    }

    public function updateTheme(Request $request, $id){
        $theme = theme::findOrFail($id);
        $rules = ['title'=>'required|min:5','description'=>'required|min:10','mini_description'=>'required|min:10|max:600'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        if($theme->update($request->all())){
            Session::flash('message','theme updated Successfully');
            return redirect()->route('themes');
        }
    }

    public function deleteTheme(Request $request, $id){
        $theme = theme::findOrFail($id);
        if($theme->delete()){
            Session::flash('message','Theme Deleted Successfully ');
            return redirect()->route('themes');
        }
    }
}
