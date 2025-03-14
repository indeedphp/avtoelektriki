<?php

namespace App\Http\Controllers;

// use Carbon\Carbon;
use App\Models\Post;
// use App\Models\Comment;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserData;
/*
|--------------------------------------------------------------------------
| ChannelController
|--------------------------------------------------------------------------
|
| каналы пользователей
|
*/

class ChannelController extends Controller
{
    // ---------------------------------------------------------------------------------------------
    public function index($id)  // показываем страницу channel с постами одного юзер   -views/channel
    {
        
        // $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        if (empty(UserData::where('user_id', $id)->first())) $user_data = UserData::where('user_id', 1)->first();
        else $user_data = UserData::where('user_id', $id)->first();
        info($user_data);
        return view('channel', ['id' => $id, 'user' => $user, 'user_data' => $user_data]);
    }
    // ---------------------------------------------------------------------------------------------

    public function show($id)  // для фетч запроса метод    -views/channel
    {
        $post_like_count = 0;
        $post_comment_count = 0;
        $post_like_active = false;

        $comment_like_count = 0;
        $comment_dislike_count = 0;
        $comment_like_active = false;
        $comment_dislike_active = false;
        $comment_made_user = false;

        $reply_like_count = 0;
        $reply_dislike_count = 0;
        $reply_like_active = false;
        $reply_dislike_active = false;
        $reply_made_user = false;

        if (!empty(Auth::user()->name)) $name = Auth::user()->name;
        else $name = 0;

        $posts = Post::where('id_user', '=', $id)->paginate(5);

        foreach ($posts as $post) {
            $post->like_plus();
            $post->comment_plus();

            $post->time = date('d-m-Y', strtotime($post->created_at));
            $text_post = Str::limit($post->text_post, 173);
            $text_post_end = Str::unwrap($post->text_post, Str::before($text_post, '...'));
            $post->text_post = $text_post;
            $post->text_post_end = $text_post_end;

            $text = null;
            $text_count = 0;

            if ($post->url_foto_2 != null) $text_count++;
            if ($post->url_foto_3 != null) $text_count++;
            if ($post->url_foto_4 != null) $text_count++;
            if ($post->url_foto_5 != null) $text_count++;

            if ($text_post_end != null) $text = 'развернуть текст';
            if ($text_count == 1) $text = 'развернуть текст и фото';
            if ($text_count == 2) $text = 'развернуть текст и 2 фото';
            if ($text_count == 3) $text = 'развернуть текст и 3 фото';
            if ($text_count == 4) $text = 'развернуть текст и 4 фото';
            $post->text_post_link = $text;

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
                $comment->time = date('d-m-Y', strtotime($comment->created_at));
                if ($name == $comment->id_user) $comment_made_user = true;
                foreach ($comment->reply_comment_plus as $reply_comment) {
                    $reply_comment->reply_like_plus();
                    $reply_comment->time = date('d-m-Y', strtotime($reply_comment->created_at));
                    if ($name == $reply_comment->id_user) $reply_made_user = true;
                    foreach ($reply_comment->reply_like_plus as $reply_like) {
                        if ($reply_like->like == 1) $reply_like_count++;
                        if ($reply_like->dislike == 1) $reply_dislike_count++;
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
                    $reply_comment->reply_made_user = $reply_made_user;
                    $reply_made_user = false;
                }

                foreach ($comment->like_comment_plus as $like_comment) {
                    if ($like_comment->like == 1) $comment_like_count++;
                    if ($name == $like_comment->id_user && $like_comment->like == 1) $comment_like_active = true;
                    if ($like_comment->dislike == 1) $comment_dislike_count++;
                    if ($name == $like_comment->id_user && $like_comment->dislike == 1) $comment_dislike_active = true;
                }

                $post_comment_count++;
                $comment->comment_like_active = $comment_like_active;
                $comment->comment_dislike_active = $comment_dislike_active;
                $comment_like_active = false;
                $comment_dislike_active = false;
                $comment->comment_like_count = $comment_like_count;
                $comment->comment_dislike_count = $comment_dislike_count;
                $comment_like_count = 0;
                $comment_dislike_count = 0;
                $comment->comment_made_user = $comment_made_user;
                $comment_made_user = false;
            }

            $post->post_like_active = $post_like_active;
            $post->post_comment_count = $post_comment_count;
            $post->post_like_count = $post_like_count;
            $post_like_active = false;
            $post_comment_count = 0;
            $post_like_count = 0;
        }

        return $posts;
    }

    // ---------------------------------------------------------------------------------------------

    public function index2($id)  // показываем страницу post с конкретным одним постом  -views/post
    {
        return view('post', ['id' => $id]);
    }
    // ---------------------------------------------------------------------------------------------

    public function show2($id)  // для фетч запроса метод
    {
        $post_like_count = 0;
        $post_comment_count = 0;
        $post_like_active = false;

        $comment_like_count = 0;
        $comment_dislike_count = 0;
        $comment_like_active = false;
        $comment_dislike_active = false;
        $comment_made_user = false;

        $reply_like_count = 0;
        $reply_dislike_count = 0;
        $reply_like_active = false;
        $reply_dislike_active = false;
        $reply_made_user = false;


        if (!empty(Auth::user()->name)) $name = Auth::user()->name;
        else $name = 0;

        $posts = Post::where('id', '=', $id)->paginate(5);

        foreach ($posts as $post) {
            $post->like_plus();
            $post->comment_plus();

            $post->time = date('d-m-Y', strtotime($post->created_at));
            $text_post = Str::limit($post->text_post, 173);
            $text_post_end = Str::unwrap($post->text_post, Str::before($text_post, '...'));
            $post->text_post = $text_post;
            $post->text_post_end = $text_post_end;

            $text = null;
            $text_count = 0;

            if ($post->url_foto_2 != null) $text_count++;
            if ($post->url_foto_3 != null) $text_count++;
            if ($post->url_foto_4 != null) $text_count++;
            if ($post->url_foto_5 != null) $text_count++;

            if ($text_post_end != null) $text = 'развернуть текст';
            if ($text_count == 1) $text = 'развернуть текст и фото';
            if ($text_count == 2) $text = 'развернуть текст и 2 фото';
            if ($text_count == 3) $text = 'развернуть текст и 3 фото';
            if ($text_count == 4) $text = 'развернуть текст и 4 фото';
            $post->text_post_link = $text;

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
                $comment->time = date('d-m-Y', strtotime($comment->created_at));
                if ($name == $comment->id_user) $comment_made_user = true;
                foreach ($comment->reply_comment_plus as $reply_comment) {
                    $reply_comment->reply_like_plus();
                    $reply_comment->time = date('d-m-Y', strtotime($reply_comment->created_at));
                    if ($name == $reply_comment->id_user) $reply_made_user = true;
                    foreach ($reply_comment->reply_like_plus as $reply_like) {
                        if ($reply_like->like == 1) $reply_like_count++;
                        if ($reply_like->dislike == 1) $reply_dislike_count++;
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
                    $reply_comment->reply_made_user = $reply_made_user;
                    $reply_made_user = false;
                }

                foreach ($comment->like_comment_plus as $like_comment) {
                    if ($like_comment->like == 1) $comment_like_count++;
                    if ($name == $like_comment->id_user && $like_comment->like == 1) $comment_like_active = true;
                    if ($like_comment->dislike == 1) $comment_dislike_count++;
                    if ($name == $like_comment->id_user && $like_comment->dislike == 1) $comment_dislike_active = true;
                }

                $post_comment_count++;
                $comment->comment_like_active = $comment_like_active;
                $comment->comment_dislike_active = $comment_dislike_active;
                $comment_like_active = false;
                $comment_dislike_active = false;
                $comment->comment_like_count = $comment_like_count;
                $comment->comment_dislike_count = $comment_dislike_count;
                $comment_like_count = 0;
                $comment_dislike_count = 0;
                $comment->comment_made_user = $comment_made_user;
                $comment_made_user = false;
            }

            $post->post_like_active = $post_like_active;
            $post->post_comment_count = $post_comment_count;
            $post->post_like_count = $post_like_count;
            $post_like_active = false;
            $post_comment_count = 0;
            $post_like_count = 0;
        }

        return $posts;
    }
}
