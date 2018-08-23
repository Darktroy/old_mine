<?php

namespace App\Http\Controllers\Common\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Validator;
use Session;
use App\Models\Post;
use App\Models\Tag;

class CategoriesController extends Controller
{
    //
    public function index()
    {
        $page_title = 'Categories';
        $sub_title = 'Listing All Category';
        $search = false;
        $categories = Category::all();
        return view('panel.blog.categories.index', compact('categories','page_title','sub_title','search'));
    }

    public function newCategory()
    {
        $page_title = 'Categories';
        $sub_title = 'New Category';
        $search = false;
        return view('panel.blog.categories.new',compact('page_title','sub_title','search'));
    }

    public function storeCategory(Request $request)
    {
        $category = new Category();
        $rules = ['name' => 'required|min:5'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->name = $request->input('name');
        if($category->save()){
            Session::flash('message', 'category created successfully');
            return redirect()->route('categories');    
        }else{
            Session::flash('message', 'category created successfully');
            return redirect()->back();
        }
        
    }

    public function editCategory($id)
    {
        $page_title = 'Categories';
        $sub_title = 'Edit  Category';
        $search = false;
        $category = Category::findOrFail($id);
        return view('panel.blog.categories.edit', compact('category','page_title','sub_title','search'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $rules = ['name' => 'required|min:5'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $category->name = $request->input('name');
        $category->save();

        Session::flash('edit_category', 'category Updated successfully');
        return redirect()->route('categories');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('message', 'category deleted successfully');
        return redirect()->back();
    }

    public function viewCategory($title){
        $name = str_replace('-',' ',$title);
        $category = Category::where('name',$name)->first();
        $posts = $category->posts;
        $recent = Post::orderByRaw("RAND()")->take(3)->get();
        $tags = Tag::orderByRaw("RAND()")->take(15)->get();
        $categories = Category::orderByRaw('RAND()')->take(5)->get();
        $parent_title = 'Blog Categories';
        $page_title = $category->name;
        return view('site.blog.index',compact('categories','posts','recent','tags','parent_title','page_title'));
    }
}
