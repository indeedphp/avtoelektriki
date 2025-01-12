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
        $qqqq =0;
        $qqqqq =0;
        $like_up = false;
        $like_comment_up = false;
        $dislike_comment_up = false;
        $name = 0;
        if (!empty(Auth::user()->name)) $name = Auth::user()->name;

        $posts = Post::all();
        $posts = $posts->reverse();
        foreach ($posts as $post) {
            $post->like_plus();
            $post->comment_plus();
            // dump($post->like_plus);
            foreach ($post->like_plus as $like) {
                if ($like->like == 1)
                    $qq++;
                if ($name == $like->id_user && $like->like == 1) {
                    $like_up = true;
                }
                
                // dump($like->like);
            }

            foreach ($post->comment_plus as $comment) {
                $comment->like_comment_plus();
                // dump($comment->like_comment_plus);
                foreach ($comment->like_comment_plus as $like_comment) {
                if ($like_comment->like == 1)$qqqq++;
                if ($name == $like_comment->id_user && $like_comment->like == 1) $like_comment_up = true;
                if ($like_comment->dislike == 1)$qqqqq++;
                if ($name == $like_comment->id_user && $like_comment->dislike == 1) $dislike_comment_up = true;
                }
                $qqq++;
                // dump($comment);
                $comment->like_comment_up = $like_comment_up;
                $comment->dislike_comment_up = $dislike_comment_up;
                $like_comment_up = false;
                $dislike_comment_up = false;
                $comment->comment_like = $qqqq;
                $comment->comment_dislike = $qqqqq;
                $qqqq = 0;
                $qqqqq = 0;


            }
            // dump($post->like_plus);
            // dump($post);
            $post->like_up = $like_up;
            $post->comment = $qqq;
            $post->like = $qq;
            $post->comment_like = $qqqq;
            $post->comment_dislike = $qqqqq;
    
            $like_up = false;
            $qq = 0;
            $qqq = 0;
        }
        // $comments = Comment::all();
        // dump($posts); 

        return view('index', compact('posts'));
    }
}
