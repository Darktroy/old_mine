<?php

namespace App\Http\Controllers\Common\Blog;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Models\PostImage;
use App\Models\PostTag;
use Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    //
    public function index()
    {
        $page_title = 'Posts';
        $sub_title = 'List All Posts ';
        $search = false;
        $posts = Post::orderBy('created_at', 'DESC')->paginate(100);
        return view('panel.blog.posts.index', compact('posts', 'page_title', 'sub_title', 'search'));
    }

    public function newPost(Request $request)
    {
        $page_title = 'Posts';
        $sub_title = 'new Post';
        $search = false;
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all()->pluck('tag')->toArray();
        return view('panel.blog.posts.new', compact('categories', 'page_title', 'sub_title', 'search', 'tags'));
    }

    public function storePost(Request $request)
    {
        $post = new Post();
        $rules = ['title' => 'required|min:5', 'category_id' => 'required', 'images'=>'required' , 'images.*' => 'image|mimes:png,jpg,jpeg', 'mini_description' => 'required|min:20|max:250', 'meta_description' => 'required|min:20|max:250'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->description = $request->input('description');
        $post->mini_description = $request->input('mini_description');
        $post->meta_title = $request->input('meta_title');
        $post->meta_description = $request->input('meta_description');
        $post->user_id = Auth::user()->id;
        $post->country_id = Auth::user()->country->id;
        $post->active = $request->input('active');


        $tags = $request->tags;

        if ($post->save()) {

            $images_names = [];

            if ($request->hasFile('images')) {
                foreach ($request->images as $image) {

                    $image = Image::make($image);
                    $image->resize(871, 326);
                    $image_name = str_replace('/', '.', str_random(20) . '_' . $image->mime());
                    $full_image = public_path('media/blog/posts/' . $image_name);
                    $image->save($full_image, 40);
                    $images_names[] = $image_name;
                }
            }
//            dd('here');

            foreach ($tags as $tag) {
                $newtag = new Tag();
                $newtag->tag = $tag;
                if (!$newtag->save()) {
                    Session::flash('message', 'Failed To Add Please Check Tags');
                    return redirect()->back();
                }
                $postTag = new PostTag();
                $postTag->post_id = $post->id;
                $postTag->tag_id = $newtag->id;
                $postTag->save();
            }

            foreach ($images_names as $name) {
                $image = new PostImage();
                $image->image = $name;
                $image->post_id = $post->id;
                if (!$image->save()) {
                    Session::flash('message', 'Failed To Add Please Check images');
                    return redirect()->back();
                }
            }

            Session::flash('message', 'Post Added Successfully');
//            return redirect()->route('posts');
            return redirect()->back();
        } else {
            Session::flash('message', 'failed To Add Post');
            return redirect()->back();
        }

    }


    public function editPost($id)
    {
        $categories = Category::pluck('name', 'id');
        $post = Post::find($id);
        $page_title = 'Posts';
        $sub_title = 'Edit Post';
        $search = false;
        $tags = Tag::all()->pluck('tag')->toArray();

        return view('panel.blog.posts.edit', compact('post', 'categories', 'tags', 'page_title', 'sub_title', 'search', 'tags'));
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $rules = ['title' => 'required|min:5', 'category_id' => 'required', 'images.*' => 'image|mimes:png,jpg,jpeg', 'mini_description' => 'required|min:20|max:250'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->description = $request->input('description');
        $post->mini_description = $request->input('mini_description');
        $post->meta_title = $request->input('meta_title');
        $post->meta_description = $request->input('meta_description');
        $post->user_id = Auth::user()->id;
        $post->country_id = Auth::user()->country->id;
        $post->active = $request->input('active');

        $tags = $request->tags;

        if ($post->save()) {

            PostTag::where('post_id', $post->id)->delete();

            $images_names = [];

            if ($request->hasFile('images')) {
                foreach ($request->images as $image) {
                    $image = Image::make($image);
                    $image->resize(871, 326);
                    $image_name = str_replace('/', '.', str_random(20) . '_' . $image->mime());
                    $full_image = public_path('media/blog/posts/' . $image_name);
                    $image->save($full_image, 40);
                    $images_names[] = $image_name;
                }
            }

            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    $newtag = new Tag();
                    $newtag->tag = $tag;
                    if (!$newtag->save()) {
                        Session::flash('message', 'Failed To Add Please Check Tags');
                        return redirect()->back();
                    }
                    $postTag = new PostTag();
                    $postTag->post_id = $post->id;
                    $postTag->tag_id = $newtag->id;
                    $postTag->save();
                }
            }
            if (!empty($request->post_tags)) {
                foreach ($request->post_tags as $tag) {
                    $postTag = new PostTag();
                    $postTag->post_id = $post->id;
                    $postTag->tag_id = $tag;
                    $postTag->save();
                }
            }

            foreach ($images_names as $name) {
                $image = new PostImage();
                $image->image = $name;
                $image->post_id = $post->id;
                if (!$image->save()) {
                    Session::flash('message', 'Failed To Add Please Check images');
                    return redirect()->back();
                }
            }

            Session::flash('message', 'Post Updated Successfully');
//            return redirect()->route('posts');
            return redirect()->back();
        } else {
            Session::flash('message', 'failed To Add Post');
            return redirect()->back();
        }
    }

    public function deletePost(Request $request, $id)
    {
        $post = Post::find($id);
        $image = $post->image;
        $id = $post->id;
        $post->delete();
        $image_path = public_path('media/blog/posts/' . $image);
        File::delete($image_path);
        if ($request->ajax()) {
            return response(['id' => $id, 'success' => 'Post Deleted Successfully']);
        } else {
            Session::flash('message', 'Post Deleted Successfully');
//            return redirect()->route('posts');
            return redirect()->back();
        }
    }

    public function deletePostImage($id)
    {
        $image = PostImage::findOrFail($id);
        $image_path = public_path('media/blog/posts/' . $image->image);
        if ($image->delete()) {
            if (!File::Delete($image_path)) {
                return response(['message' => 'Failed To Delete the Image']);
            }
            return response(['message' => 'image Delete Successfully', 'id' => $id]);
        } else {
            return response(['message' => 'Failed To Delete the Image']);
        }
    }

    function getCategoryPosts(Request $request, $id)
    {
        $posts = Post::where('category_id', $id)->get();
        if ($request->ajax()) {
            return response(['posts' => $posts]);
        }

        return $posts;
    }

    public function viewPost($title)
    {
        $tags = Tag::orderByRaw("RAND()")->take(15)->get();
        $categories = Category::orderByRaw('RAND()')->take(5)->get();
        $recent = Post::orderByRaw("RAND()")->take(3)->get();
        $name = str_replace('-', ' ', $title);
        $post = Post::where('title', $name)->first();
        $parent_title = 'Blog';
        $page_title = $post->title;
        return view('site.blog.single_post', compact('post', 'tags', 'categories', 'recent', 'parent_title', 'page_title'));
    }
}
