<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Jika user belum login, set posts menjadi koleksi kosong
        $posts = Auth::check()
            ? Post::where('user_id', Auth::id())->latest()->paginate(10)
            : collect(); 

        return view("home", compact("posts"));
    }
}
