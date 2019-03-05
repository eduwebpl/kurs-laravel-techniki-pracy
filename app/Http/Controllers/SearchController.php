<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $posts = Post::published()
            ->where('title', 'like', "%$q%")
            ->paginate(3);

        $posts->appends(['q' => $q]);

        return view('pages.posts', compact('posts'));
    }
}
