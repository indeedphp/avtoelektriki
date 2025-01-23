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
        $post_like_count = 0;
        $post_comment_count = 0;
        $post_like_active = false;
        
        $comment_like_count = 0;
        $comment_dislike_count = 0;
        $comment_like_active = false;
        $comment_dislike_active = false;

        $reply_like_count = 0;
        $reply_dislike_count = 0;
        $reply_like_active = false;
        $reply_dislike_active = false;

        if (!empty(Auth::user()->name)) $name = Auth::user()->name;
        else $name = 0;
        
        $posts = Post::orderBy('id')->paginate(5);

        // $posts = Post::all();
        // $posts = $posts->reverse();

        foreach ($posts as $post) {
            $post->like_plus();
            $post->comment_plus();
     
            foreach ($post->like_plus as $like) {
                if ($like->like == 1)
                    $post_like_count++;
                if ($name == $like->id_user && $like->like == 1) {
                    $post_like_active = true;
                }
            }

            foreach ($post->comment_plus as $comment) {
                $comment->like_comment_plus();
                $comment->reply_comment_plus();
                foreach ($comment->reply_comment_plus as $reply_comment) {
                    $reply_comment->reply_like_plus();
                    foreach ($reply_comment->reply_like_plus as $reply_like) {
                        if ($reply_like->like == 1)$reply_like_count++;
                        if ($reply_like->dislike == 1)$reply_dislike_count++;
                        if ($name == $reply_like->id_user && $reply_like->like == 1) $reply_like_active = true;
                        if ($name == $reply_like->id_user && $reply_like->dislike == 1) $reply_dislike_active = true;
                    }

                    $reply_comment->reply_like_count = $reply_like_count;
                    $reply_comment->reply_dislike_count = $reply_dislike_count;
                    $reply_comment->reply_like_active = $reply_like_active;
                    $reply_comment->reply_dislike_active = $reply_dislike_active;
                    $reply_like_active = false;
                    $reply_dislike_active = false;
                    $reply_like_count = 0;
                    $reply_dislike_count = 0;
                    $post_comment_count++;
                }

                foreach ($comment->like_comment_plus as $like_comment) {
                if ($like_comment->like == 1)$comment_like_count++;
                if ($name == $like_comment->id_user && $like_comment->like == 1) $comment_like_active = true;
                if ($like_comment->dislike == 1)$comment_dislike_count++;
                if ($name == $like_comment->id_user && $like_comment->dislike == 1) $comment_dislike_active = true;
                }

                $post_comment_count++;
                $comment->comment_like_active = $comment_like_active;
                $comment->comment_dislike_active = $comment_dislike_active;
                $comment_like_active = false;
                $comment_dislike_active = false;
                $comment->comment_like_count = $comment_like_count;
                $comment->comment_dislike = $comment_dislike_count;
                $comment_like_count = 0;
                $comment_dislike_count = 0;
            }

            $post->post_like_active = $post_like_active;
            $post->post_comment_count = $post_comment_count;
            $post->post_like_count = $post_like_count;
            $post_like_active = false;
            $post_comment_count = 0;
            $post_like_count = 0;
        }

        // return view('index', compact('posts'));
        return $posts;
    }
}
