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
    public function show_channel_all_post($id)  // показываем страницу channel с постами одного юзер в минималистичном виде  -views/channel_all_post
    {
        
        // $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        if (empty(UserData::where('user_id', $id)->first())) $user_data = UserData::where('user_id', 1)->first();
        else $user_data = UserData::where('user_id', $id)->first();
        info($user_data);
        $posts = Post::orderBy('id', 'desc')->where('id_user', $id)->paginate(20);
        $count = $posts->total();
        return view('channel_all_post', ['id' => $id, 'user' => $user, 'user_data' => $user_data, 'count' => $count, 'posts' => $posts]);
    }

    // ---------------------------------------------------------------------------------------------

    public function show($id)  // для фетч запроса со страницы канал метод    -views/channel
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

        if (!empty(Auth::user()->id)) $id_user = Auth::user()->id;
        else $id_user = 0;

        $posts = Post::where('id_user', '=', $id)->paginate(5);  // меняем только эту строку в отличии от пост контроллера
 
        // -----------------------------------------------------------------------------------------

        foreach ($posts as $post) {
            $post->like_plus();
            $post->comment_plus();

            $user_data = UserData::where('user_id', $post->id_user)->first();
            if ($user_data == null || $user_data->sity == null) $post->author_sity = 'noSity';
            else $post->author_sity = $user_data->sity;

            ($post->id_user == $id_user) ? $post->author = false : $post->author = true;

            $post->time = date('d-m-Y', strtotime($post->created_at));
            $text_post = Str::limit($post->text_post, 173);
            // info($text_post);
            $text_post_end = Str::unwrap($post->text_post, rtrim($text_post, '.'));
            $post->text_post = $text_post;
            $post->text_post_end = $text_post_end;

            $text = null;
            $text_count = 0;

            if ($post->url_foto_2 != null) $text_count++;
            if ($post->url_foto_3 != null) $text_count++;
            if ($post->url_foto_4 != null) $text_count++;
            if ($post->url_foto_5 != null) $text_count++;
            
            if ($text_post_end != null) $text = 'развернуть текст';
            if ($text_count == 1) $text = 'развернуть текст с фото';
            if ($text_count == 2) $text = 'развернуть текст с 2 фото';
            if ($text_count == 3) $text = 'развернуть текст с 3 фото';
            if ($text_count == 4) $text = 'развернуть текст с 4 фото';
            if ($post->stuff != null && $text != null) $text = $text.' и видео';
            if ($text_post_end == null && $post->stuff != null && $text == null) $text = 'развернуть видео';

            $post->text_post_link = $text;

            foreach ($post->like_plus as $like) {
                if ($like->like == 1)
                    $post_like_count++;
                if ($id_user == $like->id_user && $like->like == 1) {
                    $post_like_active = true;
                }
            }

            foreach ($post->comment_plus as $comment) {
                $comment->like_comment_plus();
                $comment->reply_comment_plus();
                $comment->time = date('d-m-Y', strtotime($comment->created_at));
                ($comment->user_id == $id_user) ? $comment->author = false : $comment->author = true;
                if ($id_user == $comment->user_id) $comment_made_user = true;
                foreach ($comment->reply_comment_plus as $reply_comment) {
                    $reply_comment->reply_like_plus();
                    $reply_comment->time = date('d-m-Y', strtotime($reply_comment->created_at));
                    ($reply_comment->user_id == $id_user) ? $reply_comment->author = false : $reply_comment->author = true;
                    if ($id_user == $reply_comment->user_id) $reply_made_user = true;
                    foreach ($reply_comment->reply_like_plus as $reply_like) {
                        if ($reply_like->like == 1) $reply_like_count++;
                        if ($reply_like->dislike == 1) $reply_dislike_count++;
                        if ($id_user == $reply_like->id_user && $reply_like->like == 1) $reply_like_active = true;
                        if ($id_user == $reply_like->id_user && $reply_like->dislike == 1) $reply_dislike_active = true;
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
                    if ($id_user == $like_comment->id_user && $like_comment->like == 1) $comment_like_active = true;
                    if ($like_comment->dislike == 1) $comment_dislike_count++;
                    if ($id_user == $like_comment->id_user && $like_comment->dislike == 1) $comment_dislike_active = true;
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

    public function show2($id)  // для фетч запроса со страницы одного поста метод
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

        if (!empty(Auth::user()->id)) $id_user = Auth::user()->id;
        else $id_user = 0;

        $posts = Post::where('id', '=', $id)->paginate(5);  // меняем только эту строку в отличии от пост контроллера
 
        // ------------------------------------------------------------------------------------------

        foreach ($posts as $post) {
            $post->like_plus();
            $post->comment_plus();

            $user_data = UserData::where('user_id', $post->id_user)->first();
            if ($user_data == null || $user_data->sity == null) $post->author_sity = 'noSity';
            else $post->author_sity = $user_data->sity;

            ($post->id_user == $id_user) ? $post->author = false : $post->author = true;

            $post->time = date('d-m-Y', strtotime($post->created_at));
            $text_post = Str::limit($post->text_post, 173);
            // info($text_post);
            $text_post_end = Str::unwrap($post->text_post, rtrim($text_post, '.'));
            $post->text_post = $text_post;
            $post->text_post_end = $text_post_end;

            $text = null;
            $text_count = 0;

            if ($post->url_foto_2 != null) $text_count++;
            if ($post->url_foto_3 != null) $text_count++;
            if ($post->url_foto_4 != null) $text_count++;
            if ($post->url_foto_5 != null) $text_count++;
            
            if ($text_post_end != null) $text = 'развернуть текст';
            if ($text_count == 1) $text = 'развернуть текст с фото';
            if ($text_count == 2) $text = 'развернуть текст с 2 фото';
            if ($text_count == 3) $text = 'развернуть текст с 3 фото';
            if ($text_count == 4) $text = 'развернуть текст с 4 фото';
            if ($post->stuff != null && $text != null) $text = $text.' и видео';
            if ($text_post_end == null && $post->stuff != null && $text == null) $text = 'развернуть видео';

            $post->text_post_link = $text;

            foreach ($post->like_plus as $like) {
                if ($like->like == 1)
                    $post_like_count++;
                if ($id_user == $like->id_user && $like->like == 1) {
                    $post_like_active = true;
                }
            }

            foreach ($post->comment_plus as $comment) {
                $comment->like_comment_plus();
                $comment->reply_comment_plus();
                $comment->time = date('d-m-Y', strtotime($comment->created_at));
                ($comment->user_id == $id_user) ? $comment->author = false : $comment->author = true;
                if ($id_user == $comment->user_id) $comment_made_user = true;
                foreach ($comment->reply_comment_plus as $reply_comment) {
                    $reply_comment->reply_like_plus();
                    $reply_comment->time = date('d-m-Y', strtotime($reply_comment->created_at));
                    ($reply_comment->user_id == $id_user) ? $reply_comment->author = false : $reply_comment->author = true;
                    if ($id_user == $reply_comment->user_id) $reply_made_user = true;
                    foreach ($reply_comment->reply_like_plus as $reply_like) {
                        if ($reply_like->like == 1) $reply_like_count++;
                        if ($reply_like->dislike == 1) $reply_dislike_count++;
                        if ($id_user == $reply_like->id_user && $reply_like->like == 1) $reply_like_active = true;
                        if ($id_user == $reply_like->id_user && $reply_like->dislike == 1) $reply_dislike_active = true;
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
                    if ($id_user == $like_comment->id_user && $like_comment->like == 1) $comment_like_active = true;
                    if ($like_comment->dislike == 1) $comment_dislike_count++;
                    if ($id_user == $like_comment->id_user && $like_comment->dislike == 1) $comment_dislike_active = true;
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
