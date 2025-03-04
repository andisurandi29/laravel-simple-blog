<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $query = Post::query();
        $query->where('user_id', Auth::id());
        $posts = $query->orderByCreatedAtDesc()->paginate(10);

        return view("home", compact("posts"));
    }
}
