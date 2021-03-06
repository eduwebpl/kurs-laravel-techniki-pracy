<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()->with(['tags', 'author'])->latest('date')->paginate(3);

        return view('pages.posts', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::published()->whereSlug($slug)->firstOrFail();

        return view('pages.post', compact('post'));
    }
}
