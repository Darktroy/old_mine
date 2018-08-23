<?php

namespace App\Http\Controllers\Common;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Facades
use Session;
use Validator;
use Auth;
use Illuminate\Support\Facades\File;

//  Models
use App\Models\News;

class NewsController extends Controller
{
    //
    public function storeNews(Request $request)
    {
        // dd($request->all());
        $rules = ['title'=>'required|max:100','image'=>'required|image|mimes:png,jpg,jpeg','description'=>'required|min:50','mini_description'=>'required|min:10|max:150'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $news = $this->PrepareDataToStoreInNewsTable($request);

        if(!$news){
            Session::flash('message','Failed To Add News');
            return redirect()->back();
        }

        Session::flash('message','News Added Successfully');
        return redirect()->back();
    }

    public function updateNews(Request $request, $id)
    {
        $rules = ['title'=>'required|max:100','description'=>'required|min:50','mini_description'=>'required|min:10|max:150'];
        if(isset($request->image)){
            $rules['image'] = 'image|mimes:png,jpg,jpeg';
        }
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $news = $this->PrepareDataToStoreInNewsTable($request,$id);

        if(!$news){
            Session::flash('message','Failed To Update News');
            return redirect()->back();
        }

        Session::flash('message','News Updated Successfully');
        return redirect()->back();
    }

    public function deleteNews(Request $request , $id)
    {
        $news = News::find($id);
        $image = $news->poster;
        $news->delete();
        $image_path = public_path('media/news/' . $image);
        File::delete($image_path);
        if ($request->ajax()) {
            return response(['id' => $id, 'success' => 'News Deleted Successfully']);
        } else {
            Session::flash('message', 'News Deleted Successfully');
//            return redirect()->route('posts');
            return redirect()->back();
        }
    }

    private function PrepareDataToStoreInNewsTable(Request $request, $id = null)
    {
        // dd($request->all());
        $news = '';
        $news_data = [];
        try {

            if($request->hasFile('image')){
                $image_name = str_random(12) . '_news_' . $request->image->getClientOriginalName();
                $request->image->storeAs('media/news/', $image_name, 'public');
                $news_data['poster'] = $image_name;
            }

            
            $news_data['title'] = $request->title;
            $news_data['mini_description'] = $request->mini_description;
            $news_data['description'] = $request->description;
            $news_data['active'] = $request->active;


            if(isset($request->slider) && !empty($request->slider)){
                $news_data['slider'] = $request->slider;
            }
            
            $news = News::newRecord($news_data, $id);

        } catch (\Exception $e) {
            die($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }

        if(!isset($news) || empty($news)){
            return false;
        }

        return $news;

    }


    // view News
    public function viewNews($news_id, $country_id = null, $position = null)
    {
        $user = User::where('id', Auth::user()->id)->with('country')->first();
        $news = News::where('id', $news_id)->orderBy('created_at', 'DESC')->first();
        $parent_title = 'News';
        $page_title = $news->title;
        return view('site.country.news.view', compact('position', 'country_id', 'news','user','parent_title','page_title'));
    }

}
