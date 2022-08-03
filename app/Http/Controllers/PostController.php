<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return view("add-blog-post-form", ['post' => $post]);
        // $data =  Post::all();
        // return view('add-blog-post-form', ['posts' => $data]);
    }
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return redirect('/')->with('status', 'Blog Post Form Data Has Been inserted');
    }
}
