<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    function __construct() {
        $this->middleware("auth")->only(["store"]);
    }

    public function index() {
        $posts = Post::with(['user', 'likes'])->latest()->paginate(10);

        return view("posts.index", [
            "posts" => $posts
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            "body" => "required"
        ]);

        $request->user()->posts()->create([
            "body" => $request->body
        ]);

        return back();
    }

    public function delete(Post $post) {
        $this->authorize("delete", $post);
        
        $post->delete();

        return back();

    }
}
