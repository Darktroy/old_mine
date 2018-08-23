<?php

namespace App\Http\Controllers\Panel\AboutUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use App\Models\Label;
use File;

class LabelsController extends Controller
{
    //
    public function index(){
        $labels = Label::all();
        $page_title = 'Lables';
        $search = false;
        $sub_title = 'List All Labels';
        return view('panel.about_us.labels.index',compact('labels','search','sub_title','page_title'));
    }

    public function newLabel(){
        $page_title = 'Lables';
        $search = false;
        $sub_title = 'New Label';
        return view('panel.about_us.labels.new',compact('page_title','search','sub_title'));
    }

    public function createLabel(Request $request){
        $label = new Label;
        $rules = [
            'title' => 'required|min:5',
            'description' => 'min:5',
            'logo'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'logo_png' => 'image|mimes:png',
            'logo_psd' => 'image|mimes:psd',
            'logo_eps' => 'image|mimes:eps'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                    ->withInput()->withErrors($validator);
        }

        // logo
        if($request->hasFile('logo')){
            $logo_name = str_random(6).'_logo_'.$request->logo->getClientOriginalName();
            $request->logo->storeAs('media/labels/logo',$logo_name,'public');
            $label->logo = $logo_name;
        }
        
        
        // png
        if($request->hasFile('logo_png')){
            $png_name = str_random(6).'_png_'.$request->logo_png->getClientOriginalName();
            $request->logo_png->storeAs('media/labels/logo_png',$png_name,'public');
            $label->logo_png = $png_name;
        }
        
        //  PSD
        if($request->hasFile('logo_psd')){
            $psd_name = str_random(6).'_psd_'.$request->logo_psd->getClientOriginalName();
            $request->storeAs('media/labels/logo_psd',$psd_name,'public');
            $label->logo_psd = $psd_name;
        }
        
        
        // EPS
        if($request->hasFile('logo_eps')){
            $eps_name = str_random(6).'_eps_'.$request->logo_eps->getClientOriginalName();
            $request->logo_eps->saveAs('media/labels/logo_eps',$eps_name,'public');
            $label->logo_eps = $eps_name;
        }
        
        $label->title = $request->title;
        $label->description = $request->description;
        $label->active = $request->active;
        
        if($label->save()){
            Session::flash('message','Label Created Successfully');
            return redirect()->route('labels');
        }else{
            Session::flash('message','Failed To Created Label');
            return redirect()->back();
        }
    }

    public function editLabel($id){
        $label = Label::findOrFail($id);
        $page_title = 'Lables';
        $search = false;
        $sub_title = 'Edit Label';
        return view('panel.about_us.labels.edit',compact('label','page_title','search','sub_title'));
    }


    public function updateLabel(Request $request, $id){
        $label = Label::findOrFail($id);
        $rules = [
            'title' => 'required|min:5',
            'description' => 'min:5',
            'logo'=>'image|mimes:jpeg,png,jpg|max:2048',
            'logo_png' => 'image|mimes:png',
            'logo_psd' => 'image|mimes:psd',
            'logo_eps' => 'image|mimes:eps'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                    ->withInput()->withErrors($validator);
        }

        // logo
        if($request->hasFile('logo')){
            $logo_name = str_random(12).'_logo_'.$request->logo->getClientOriginalName();
            $request->logo->storeAs('media/labels/logo',$logo_name,'public');
            $label->logo = $logo_name;
        }
        
        // png
        if($request->hasFile('logo_png')){
            $png_name = str_random(6).'_png_'.$request->logo_png->getClientOriginalName();
            $request->logo_png->storeAs('media/labels/logo_png',$png_name,'public');
            $label->logo_png = $png_name;
        }
        
        //  PSD
        if($request->hasFile('logo_psd')){
            $psd_name = str_random(6).'_psd_'.$request->logo_psd->getClientOriginalName();
            $request->storeAs('media/labels/logo_psd',$psd_name,'public');
            $label->logo_psd = $psd_name;
        }
        
        
        // EPS
        if($request->hasFile('logo_eps')){
            $eps_name = str_random(6).'_eps_'.$request->logo_eps->getClientOriginalName();
            $request->logo_eps->saveAs('media/labels/logo_eps',$eps_name,'public');
            $label->logo_eps = $eps_name;
        }
        
        $label->title = $request->title;
        $label->description = $request->description;
        $label->active = $request->active;
        
        if($label->save()){
            Session::flash('message','Label Updated Successfully');
            return redirect()->route('labels');
        }else{
            Session::flash('message','Failed To Created Label');
            return redirect()->back();
        }
    }

    public function deleteLabel($id){
        $label = Label::findOrFail($id);
        $logo = public_path('media/labels/logo/').$label->logo;
        $logo_png = public_path('media/labels/logo_png/').$label->logo_png;
        $logo_psd = public_path('media/labels/logo_psd/').$label->logo_psd;
        $logo_eps = public_path('media/labels/logo_eps/').$label->logo_eps;

        if($label->delete()){
            File::Delete($logo);
            File::Delete($logo_png);
            File::Delete($logo_psd);
            File::Delete($logo_eps);
           Session::flash('message','Label Deleted Successfully') ;
           return redirect()->back();
        }else{
            Session::flash('message','Failed To Delete The Lable') ;
            return redirect()->back();
        }
    }

}
