<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\Slides;
use Validator;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    //
    public function index()
    {
        $page_title = 'Slides';
        $search = true;
        $sub_title = 'Home Slider Gallery';
        $slides = Slides::paginate(10);
        return view('panel.slider.index', compact('page_title', 'search', 'sub_title', 'slides'));
    }

    public function newSlide()
    {
        $page_title = 'Slides';
        $search = false;
        $sub_title = 'Add New Slide';
        return view('panel.slider.new', compact('page_title', 'search', 'sub_title'));
    }

    public function storeSlide(Request $request)
    {
        $slide = new Slides;

        $rules = [
            'title' => 'required|min:5',
            'caption' => 'required|min:5',
            'red_button_title' => 'min:5',
            'red_button_url' => 'url',
            'transparent_button_title' => 'min:5',
            'transparent_button_url' => 'url',
            'image' => 'required|image|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $image = Image::make($request->file('image'));
        $image->resize(1539, 1035);
        $name = str_replace('/', '.', str_random(20) . '_' . $image->mime());
        $full_image = public_path('media/slider/' . $name);
        $image->save($full_image, 40);


        $slide->title = $request->input('title');
        $slide->caption = $request->input('caption');
        $slide->red_button_title = $request->input('red_button_title');
        $slide->red_button_url = $request->input('red_button_url');
        $slide->transparent_button_title = $request->input('transparent_button_title');
        $slide->transparent_button_url = $request->input('transparent_button_url');
        $slide->image = url('/public/media/slider/') . '/' . $name;
        $slide->image_name = $name;
        if(empty($request->input('active'))){
            $slide->active = 0;
        }else{
            $slide->active = $request->input('active');
        }
        if ($slide->save()) {
            Session::flash('message', 'slide Created Successfully');
            return redirect()->back();
        }

    }

    public function editSlide($id)
    {
        $slide = Slides::findOrFail($id);
        $page_title = 'Edit Slide';
        $search = false;
        $sub_title = 'Edit ' . $slide->title . ' slide';
        return view('panel.slider.edit', compact('page_title', 'slide', 'search', 'sub_title'));

    }

    public function updateSlide(Request $request, $id)
    {
        $slide = Slides::findOrFail($id);
        $rules = [
            'title' => 'required|min:5',
            'caption' => 'required|min:5',
            'red_button_title' => 'min:5',
            'red_button_url' => 'url',
            'transparent_button_title' => 'min:5',
            'transparent_button_url' => 'url',
            'image' => 'image|max:2048'
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if ($request->hasFile('image')) {
//            dd($request->file('image'));
            $image = Image::make($request->file('image'));
            $image->resize(1539, 1035);
            $name = str_replace('/', '.', str_random(20) . '_' . $image->mime());
            $full_image = public_path('media/slider/' . $name);
            $image->save($full_image, 40);
            $slide->image = url('/public/media/slider/') . '/' . $name;
            $slide->image_name = $name;
        }

        $slide->title = $request->input('title');
        $slide->caption = $request->input('caption');
        $slide->red_button_title = $request->input('red_button_title');
        $slide->red_button_url = $request->input('red_button_url');
        $slide->transparent_button_title = $request->input('transparent_button_title');
        $slide->transparent_button_url = $request->input('transparent_button_url');
        $slide->active = $request->input('active');

        if ($slide->save()) {
            Session::flash('message', 'slide Updated Successfully');
            return redirect()->back();
        }
    }

    public function deleteSlideImage(Request $request, $id)
    {
        $slide = Slides::findOrFail($id);
        $image = public_path('media/slider/' . $slide->image_name);

        if (File::delete($image)) {
            $slide->image = '';
            $slide->image_name = '';
            $slide->save();
            return response(['image Deleted Successfully Please select another image']);
        } else {
            return response(['failed to delete image not existed Please select image']);
        }

    }
}
