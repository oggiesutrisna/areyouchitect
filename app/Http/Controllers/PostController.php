<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //
    }

    public function debugtaikucing()
    {
        dd(Category::all()->toArray());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'content' => ['required'],
            'featured_image' => ['required'],
            'status' => ['required'],
            'published_at' => ['required', 'date'],
        ]);

        return Post::create($data);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'content' => ['required'],
            'featured_image' => ['required'],
            'status' => ['required'],
            'published_at' => ['required', 'date'],
        ]);

        $post->update($data);

        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json();
    }
}
