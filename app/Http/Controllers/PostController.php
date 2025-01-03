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
        $qq = 0;
        $posts = Post::all();
        $posts = $posts->reverse();
        foreach ($posts as $post) { 
        $post->like_plus();
       
        
        foreach ($post->like_plus as $like) { 
            if($like->like == 1)$qq++;
            // dump($like->like);
        }
        // dump($post->like_plus);
        // dump($post);
        $post->like = $qq;
        $qq = 0;
        
        }
        $comments = Comment::all();
        dump($posts); 
   
        return view('index',compact('posts', 'comments'));
    } 
}
