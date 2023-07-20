<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest();
        return view('welcome', [
            "posts" => Post::latest()->filter(request(["search","category","author"]))->get(),

        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            "post" => $post
        ]);
    }


}
