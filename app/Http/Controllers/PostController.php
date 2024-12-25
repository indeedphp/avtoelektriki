<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function show()  {
        $posts = Post::all();
        $posts = $posts->reverse();
        // dump($posts); 
   
        return view('index',compact('posts', ));
    } 
}
