<?php

namespace App\Http\Controllers\Common\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class BlogController extends Controller
{
    //
    public function index(){
        $posts = Post::OrderBy('id','DESC')->paginate(5);
        $recent = Post::orderByRaw("RAND()")->take(3)->get();
        $tags = Tag::orderByRaw("RAND()")->take(15)->get();
        $categories = Category::orderByRaw('RAND()')->take(5)->get();
        $parent_title = 'Blog';
        $page_title = 'All Posts';
        return view('site.blog.index',compact('posts','recent','tags','categories','parent_title','page_title'));
    }


}
