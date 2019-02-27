<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            (object)[
                'id' => 1,
                'title' => 'You are done.',
                'content' => '<b>Fired. Do not show your face at the laundry again.</b> Stay
                away from Pinkman. Do not go near him. Ever. Are you listening
                to me?',
                'date' => '2019-02-20 10:59:52.234580 UTC (+00:00)',
                'type' => 'text',
                'image' => null
            ],
            (object)[
                'id' => 1,
                'title' => 'You are done.',
                'content' => '<b>Fired. Do not show your face at the laundry again.</b> Stay
                away from Pinkman. Do not go near him. Ever. Are you listening
                to me?',
                'date' => '2019-02-16 12:45:13.234580 UTC (+00:00)',
                'type' => 'photo',
                'image' => '/images/image-01.jpg'
            ],
        ];

        return view('pages.posts', compact('posts'));
    }
}
