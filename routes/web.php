<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
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
});

Route::get('/about-me', function () {
    return view('pages.about');
})->name('about');
