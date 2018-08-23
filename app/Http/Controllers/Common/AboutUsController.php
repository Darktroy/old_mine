<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Idea;
use App\Models\Theme;
use App\Models\Forum;
use App\Models\Label;

class AboutUsController extends Controller
{
    //
    public function idea(){
        $parent_title = 'Home';
        $page_title = 'Idea';
        $ideas = Idea::where('active',1)->get();
        return view('site.about.idea',compact('ideas','parent_title','page_title'));
    }
    public function getIdea( Request $request, $id){
        $data = Idea::findOrFail($id);
        $parent_title = 'Home';
        $page_title = $data->title;
        return view('site.about.singleIdea',compact('data','parent_title','page_title'));
    }

    public function themes(){
        $themes = Theme::where('active',1)->get();
        $parent_title = 'Home';
        $page_title = 'themes';
        return view('site.about.themes',compact('themes','parent_title','page_title'));
    }

    public function getTheme( Request $request, $id){
        $data = Theme::findOrFail($id);
        $parent_title = 'Home';
        $page_title = $data->title;
        return view('site.about.singleIdea',compact('data','parent_title','page_title'));
    }

    public function forums(){
        $forums = Forum::where('active',1)->get();
        $parent_title = 'Home';
        $page_title = 'forums';
        return view('site.about.forums',compact('forums','parent_title','page_title'));
    }

    public function getForum( Request $request, $id){
        $data = Forum::findOrFail($id);
        $parent_title = 'Home';
        $page_title = $data->title;
        return view('site.about.singleIdea',compact('data','parent_title','page_title'));
    }

    public function viewPanelGeoForm(){
        $page_title = 'GeoLocation';
        $sub_title = 'Edit Geo Location ';
        $search = false;
        return view('panel.about_us.geoMap',compact('page_title','sub_title','search'));
    }

    public function geoLocation(){
        $parent_title = 'Home';
        $page_title = 'Geo Location';
        return view('site.about.geoLocation',compact('parent_title','page_title'));
    }

    public function label(){
        $labels = Label::all();
        $parent_title = 'Home';
        $page_title = 'Social Label';
        return view('site.about.labels',compact('labels','parent_title','page_title'));
    }

}
