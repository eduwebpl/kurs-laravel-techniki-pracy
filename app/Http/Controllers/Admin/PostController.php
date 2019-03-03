<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected function validator($data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'type' => 'required|in:text,photo',
            'date' => 'nullable|date',
            'image' => 'nullable|image|max:1024',
            'content' => 'nullable'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request->all())->validate();

        if (isset($data['image'])) {
            $path = $request->file('image')->store('photos');
            $data['image'] = $path;
        }

        $post = Post::create($data);

        session()->flash('message', 'Post has been added!');

        return redirect(route('posts.single', $post->slug));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $this->validator($request->all())->validate();

        if (isset($data['image'])) {
            $path = $request->file('image')->store('photos');
            $data['image'] = $path;
        }

        $post->update($data);

        return back()->with('message', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect('/')->with('message', 'Post has been deleted!');
    }
}
