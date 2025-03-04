<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::active()->orderByCreatedAtDesc()->paginate(10);
        
        return view('posts.index', compact('posts'));
    }

    // Menampilkan halaman create post
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'publish_date' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

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

    public function show(Int $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit(Int $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Int $id)
    {
        $request->validate([
            'title' => 'required|string|max:60',
            'content' => 'required|string',
            'publish_date' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        // Menentukan status berdasarkan checkbox dan publish_date
        if ($request->has('is_draft')) {
            $status = 'Draft';
            $publish_date = null;
        } else {
            $status = $request->publish_date ? 'Schedule' : 'Active';
            $publish_date = $request->publish_date ? Carbon::parse($request->publish_date) : Carbon::now();
        }

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $status,
            'publish_date' => $publish_date,
        ]);

        return redirect()->route('home')->with('success', 'Post berhasil diperbarui.');
    }

    // Menghapus post
    public function destroy(Int $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('home')->with('success', 'Post berhasil dihapus.');
    }
}
