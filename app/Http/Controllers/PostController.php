<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::active()->latest('created_at')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        // Menentukan status berdasarkan checkbox dan publish_date
        if ($request->has('is_draft')) {
            $status = 'Draft';
            $publish_date = null;
        } else {
            $status = $request->publish_date ? 'Schedule' : 'Active';
            $publish_date = $request->publish_date ? Carbon::parse($request->publish_date) : Carbon::now();
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $status,
            'publish_date' => $publish_date,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home')->with('success', 'Post berhasil ditambahkan.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {   
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Menentukan status berdasarkan checkbox dan publish_date
        if ($request->has('is_draft')) {
            $status = 'Draft';
            $publish_date = null;
        } else {
            $status = $request->publish_date ? 'Schedule' : 'Active';
            $publish_date = $request->publish_date ? Carbon::parse($request->publish_date) : Carbon::now();
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $status,
            'publish_date' => $publish_date,
        ]);

        return redirect()->route('home')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('home')->with('success', 'Post berhasil dihapus.');
    }
}

