<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Tag;

class TagController extends Controller
{
    public function index($slug)
    {
        $posts = Post::published()
            ->whereHas('tags', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->latest('date')
            ->paginate(3);

        return view('pages.posts', compact('posts'));
    }
}
