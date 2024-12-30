<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function show()  {
        $posts = Post::all();
        $posts = $posts->reverse();
        $comments = Comment::all();
        // dump($posts); 
   
        return view('index',compact('posts', 'comments'));
    } 
}
