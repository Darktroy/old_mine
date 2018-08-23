<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\Sponser;
use Validator;
use Session;
use File;

class SponsersController extends Controller
{
    //
    public function index(){
        $page_title = 'Sponsers';
        $search = false;
        $sub_title = 'List All Sponsers';
        $sponsers = Sponser::paginate(50);
        return view('panel.sponsers.index',compact('sponsers','page_title','search','sub_title'));
    }

    public function newSponser(){
        $page_title = 'sponsers';
        $search = false;
        $sub_title = 'Add New Sponser';
        return view('panel.sponsers.new',compact('page_title','search','sub_title'));
    }

    public function createSponser(Request $request){
        // dd($request->all());
        $sponser = new Sponser();
        $rules = ['name'=>'required','image'=>'required|image','url'=>'url'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if($request->hasFile('image')){
            $image = Image::make($request->file('image'));
            $image->resize(200,100);
            $name = str_replace('/', '.', str_random(20) . '_' . $image->mime());
            $full_image = public_path('media/sponsers/' . $name);
            $image->save($full_image, 40);
            $sponser->image = url('/public/media/sponsers/') . '/' .$name;   
            $sponser->image_name = $name;   
        }

        $sponser->name = $request->input('name');
        $sponser->url = $request->input('url');
        $sponser->active = $request->input('active');
        if($sponser->save()){
            Session::flash('message','Sponser created Successfully');
            return redirect('panel/sponsers');
        }else{
            Session::flash('message','Failed To create The sponser');
            return redirect()->route('sponsers');
        }
    }

    public function editSponser($id){
        $page_title = 'sponsers';
        $search = false;
        $sub_title = 'Edit Sponser';
        $sponser = Sponser::findOrFail($id);
        return view('panel.sponsers.edit',compact('sponser','search','sub_title','page_title'));
    }

    public function UpdateSponser(Request $request , $id){
        $sponser = Sponser::findOrFail($id);
        $rules = ['name'=>'required','image'=>'image','url'=>'url'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if($request->hasFile('image')){
            $image = Image::make($request->file('image'));
            $image->resize(200,100);
            $name = str_replace('/', '.', str_random(20) . '_' . $image->mime());
            $full_image = public_path('media/sponsers/' . $name);
            $image->save($full_image, 40);
            $sponser->image = url('/public/media/sponsers/') . '/' .$name;   
            $sponser->image_name = $name;   
        }

        $sponser->name = $request->input('name');
        $sponser->url = $request->input('url');
        $sponser->active = $request->input('active');
        if($sponser->save()){
            Session::flash('message','Sponser Updated Successfully');
            return redirect()->route('sponsers');
        }else{
            Session::flash('message','Failed To create The sponser');
            return redirect()->route('sponsers');
        }
    }

    public function deleteSponser($id){
        $sponser = Sponser::findOrFail($id);
        $image = public_path('media/sponsers/'.$sponser->image_name);
        if($sponser->delete()){
            File::Delete($image);
            return response(['message'=>'sponser Deleted Successfully']);
        }else{
            return response(['message'=>'Failed To Delete the Sponser ']);
        }
    }
}
