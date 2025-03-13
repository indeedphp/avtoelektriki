<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\UserData;
use App\Models\User;
// use Illuminate\Support\Facades\Notification;  // подключаем фасад Notification
// use App\Notifications\ComplaintNotification;  // подключаем нотификацию для жалоб
/*
|--------------------------------------------------------------------------
| PostController
|--------------------------------------------------------------------------
|
| показываем посты на главной странице
|
*/

class PostController extends Controller
{
    // --------------------------------------------------------------------------------------------------------------
    public function index()  // показываем главную страницу
    {
        $nots = [];
        if (Auth::check()) {  // если авторизирован то показываем нотификации (уведомления)
            $user = User::find(Auth::user()->id);
            foreach ($user->unreadNotifications as $notification) {
                $nots[] = $notification->data;
                $notification->markAsRead(); // помечаем нотификации что просмотрены
            }
        }
        return view('index', compact('nots'));
    }
    // -----------------------------------------------------------------------------------------------------------
    public function show()  // заполняем через апи главную страницу
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
        if (!empty(Auth::user()->id)) $id_user = Auth::user()->id;
        else $id_user = 0;
        // if (Auth::check()) {

        // }
        // info(Auth::user()->id);

        // $posts = Post::orderBy('id')->paginate(5);
        $posts = Post::orderBy('id', 'desc')->cursorPaginate(5);
        // $posts = Post::all();
        // $posts = $posts->reverse();

        // -----------------------------------------
        // $not=[];
        // $user = User::find(2);
        // foreach ($user->unreadNotifications as $notification) {
        //     $not[] = $notification->data;
        // }

        // ---------------------------------------------------

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
            if ($text_count == 1) $text = 'развернуть текст и фото';
            if ($text_count == 2) $text = 'развернуть текст и 2 фото';
            if ($text_count == 3) $text = 'развернуть текст и 3 фото';
            if ($text_count == 4) $text = 'развернуть текст и 4 фото';

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

        // return view('index', compact('posts'));


        // $posts->notdddd = $not;
        // info($posts->notdddd);

        return $posts;
    }
}
