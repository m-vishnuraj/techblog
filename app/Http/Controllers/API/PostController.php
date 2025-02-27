<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mtownsend\ReadTime\ReadTime;

class PostController extends Controller
{
    public function index()
    {
        $result = User::join('posts', 'posts.user_id', '=', 'users.id')
            // ->join("category_posts", "category_posts.post_id", "=", "posts.id")
            // ->join("categories", "categories.id", "=", "category_posts.category_id")
            // ->join("post_tags", "post_tags.post_id", "=", "posts.id")
            // ->join("tags", "tags.id", "=", "post_tags.tag_id")
            ->orderBy('posts.created_at', 'DESC')
            ->get();
        $popular_posts = User::join('posts', 'posts.user_id', '=', 'users.id')->orderBy('views', 'DESC')->limit('5')->get();
        if ($result) {
            return response()->json([
                "status" => 1,
                "all_posts" => $result,
                "popular_posts" => $popular_posts,
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Operation Failed!!"
            ]);
        }
    }

    public function list()
    {
        $currentUser = Auth::user();
        $result = Post::where('user_id', '=', $currentUser->id)->orderBy('created_at', 'DESC')->get();
        $posts_count = $result->count();
        if ($result) {
            return response()->json([
                "status" => 1,
                "posts_count" => $posts_count,
                "user_details" => $currentUser,
                "posts" => $result
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Operation Failed!!"
            ]);
        }
    }

    public function addPosts(Request $request)
    {
        $rules = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required|string',
            'featuredimage' => 'required'
        ]);

        if ($request->hasFile('featuredimage')) {
            $imageName = $request->featuredimage->store('public/featured-image');
        }

        $data = new Post();
        $data->user_id = $request->user_id;
        $data->title = $rules['title'];
        $data->slug = $rules['slug'];
        $data->body = $rules['body'];
        $data->status = $request->status;
        $data->featuredimage = $imageName;
        $result = $data->save();
        $data->categories()->sync($request->categories);
        $data->tags()->sync($request->tags);

        if ($result) {
            return response()->json([
                "status" => 1,
                "message" => "Posts Added Successfully!!"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Operation Failed!!"
            ]);
        }
    }

    public function updatePosts(Request $request)
    {
        $rules = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required|string',
            'featuredimage' => 'required'
        ]);

        if ($request->hasFile('featuredimage')) {
            $imageName = $request->featuredimage->store('public/featured-image');

            $data = Post::find($request->id);
            $data->user_id = Auth::id();
            $data->title = $rules['title'];
            $data->slug = $rules['slug'];
            $data->body = $rules['body'];
            $data->status = $request->status;
            $data->featuredimage = $imageName;
            $result = $data->save();
            $data->categories()->sync($request->categories);
            $data->tags()->sync($request->tags);


            if ($result) {
                return response()->json([
                    "status" => 1,
                    "posts" => "Posts Updated Successfully!!"
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "message" => "Operation Failed!!"
                ]);
            }
        } else {
            $data = Post::find($request->id);
            $data->user_id = Auth::id();
            $data->title = $rules['title'];
            $data->slug = $rules['slug'];
            $data->body = $rules['body'];
            $data->status = $request->status;
            $result = $data->save();
            $data->categories()->sync($request->categories);
            $data->tags()->sync($request->tags);

            if ($result) {
                return response()->json([
                    "status" => 1,
                    "posts" => "Posts Updated Successfully!!"
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "message" => "Operation Failed!!"
                ]);
            }
        }
    }

    public function deletePosts($id)
    {
        $data = Post::find($id);
        $result = $data->delete();

        if ($result) {
            return response()->json([
                "status" => 1,
                "message" => "Posts Deleted Successfully!!"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Operation Failed!!"
            ]);
        }
    }
}
