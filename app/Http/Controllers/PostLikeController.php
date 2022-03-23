<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    function __construct() {
        $this->middleware("auth");
    }

    public function store(Post $post) {
        $user = auth()->user();
        if (!$post->likedBy($user)) {
            $post->likes()->create([
                "user_id" => $user->id
            ]);
        }

        return back();
    }

    public function destroy(Post $post) {
        $user = auth()->user();
        if ($post->likedBy($user)) {
            // $request->user()->likes()->where("post_id", $post->id)->delete();
            $user->likes()->where("post_id", $post->id)->delete();
        }

        return back();
    }
}
