<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    public function show()
    {
        // dd(Auth::user()->user_name);
        $qq = 0;
        $qqq = 0;
        $like_up = false;
        $name = 0;
        if(!empty(Auth::user()->name)) $name = Auth::user()->name;

        $posts = Post::all();
        $posts = $posts->reverse();
        foreach ($posts as $post) {
            $post->like_plus();
            $post->comment_plus();

            foreach ($post->like_plus as $like) {
                if ($like->like == 1)
                    $qq++;
                if ($name == $like->id_user && $like->like == 1){
                    $like_up = true;
                }
                    
                // dump($like->like);
            }
            foreach ($post->comment_plus as $comment) {
                $qqq++;
                // dump($like->like);
            }
            // dump($post->like_plus);
            // dump($post);
            $post->like_up = $like_up;
            $post->comment = $qqq;
            $post->like = $qq;
            $like_up = false;
            $qq = 0;
            $qqq = 0;
        }
        // $comments = Comment::all();
        // dump($posts); 

        return view('index', compact('posts'));
    }
}
