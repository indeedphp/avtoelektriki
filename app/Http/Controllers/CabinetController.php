<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Draft_post;
use App\Models\User;
use App\Models\Comment;
use App\Models\LikeComment;
use Illuminate\Support\Facades\Hash;

class CabinetController extends Controller
{
    // ======================================================================================================
    public function settings_show()
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        // dd($user); indexedit_post_show
        return view('cabinet_settings', compact('user'));
    }
    // ======================================================================================================      
    public function statistic_show()
    {
        $id_user = Auth::user()->id;
        $posts = Post::where('id_user', $id_user)->get();
        $post_count = count($posts);
        $comments = Comment::where('id_user', $id_user)->get();
        $comments_count = count($comments);
        $like_comments = LikeComment::where('id_user', $id_user)->get();
        $like_comments_count = count($like_comments);
        $last_post =  DB::table('posts')->where('id_user',  $id_user)->orderBy('id', 'desc')->first();
        $last_comments =  DB::table('comments')->where('user_id',  $id_user)->orderBy('id', 'desc')->first();

        return view('cabinet_statistic', compact('post_count', 'comments_count', 'last_post', 'last_comments'));
    }
    // ======================================================================================================
    public function all_post_show()  // показываем все посты юзера с пагинацией
    {
        $id_user = Auth::user()->id;
        $posts = Post::orderBy('id', 'desc')->where('id_user', $id_user)->paginate(20);
        $count = $posts->total();
        // info($posts);
        return view('cabinet_all_post', compact('posts', 'count'));
    }
    // ======================================================================================================
    public function new_post_create()
    {
        $user_name = Auth::user()->user_name;
        $id_user = Auth::user()->id;

        if (empty(Draft_post::where('id_user', $id_user)->first())) $draft_post = Draft_post::create(['user_name' => $user_name, 'id_user' => $id_user]);
        else $draft_post = Draft_post::where('id_user', $id_user)->first();
        // Storage::disk('local')->put('file.txt', 'Contents');
        // info($draft_post);
        return view('cabinet_new_post', compact('draft_post'));
    }
    // =======================================================================================================
    public function edit_post_show($id_post = true)  // показываем пост юзера для правки
    {
        $id_user = Auth::user()->id;
    
        if ($id_post) $post = DB::table('posts')->where('id_user',  $id_user)->orderBy('id', 'desc')->first();
        else $post =  DB::table('posts')->where('id_user', $id_user)->where('id', $id_post)->orderBy('id', 'desc')->first();

        if ($post == null) abort(470); // кастомная ошибка вью errors/470 , нет поста у вас
        else return view('cabinet_edit_post', compact('post'));
    }
    // =======================================================================================================
    // public function all_post_edit($id)
    // {
    //     $post = Post::where('id', $id)->first();
    //     return view('cabinet_edit_post', compact('post'));
    // }
    // =======================================================================================================
    public function edit_name(Request $request)
    {
        $new_name = $request->input('new_name');
        $id = Auth::user()->id;

        User::where('id', $id)
            ->update([
                "user_name" => $new_name
            ]);

        return redirect()->route('cabinet_settings');
    }
    // ----------------------------------------------------------------------------
    public function edit_login(Request $request)
    {
        $new_login = $request->input('new_login');
        $id = Auth::user()->id;

        User::where('id', $id)
            ->update([
                "email" => $new_login
            ]);

        return redirect()->route('cabinet_settings');
    }
    // ---------------------------------------------------------------------------------
    public function edit_password(Request $request)
    {
        $new_password = $request->input('new_password');
        $password_hash = Hash::make($new_password);
        $id = Auth::user()->id;

        User::where('id', $id)
            ->update([
                "password" => $password_hash
            ]);

        return redirect()->route('cabinet_settings');
    }

    // =======================================================================================================
    public function edit_post(Request $request)
    {
        info($request);
        $user_name = Auth::user()->name;
        $id_user = Auth::user()->id;
        $post_id = $request->input('post_id');

        $post = Post::where('id', $post_id)->first();

        function convert_foto($inputFile, $outputFile) // разные форматы приводим к JPG, сжимаем, уменьшаем размер
        {
            $file_info = getimagesize($inputFile);
            $mime_type = $file_info['mime'];
            info($mime_type);

            if ($mime_type == 'image/jpeg') {
                $img = imagecreatefromjpeg($inputFile);
            } elseif ($mime_type == 'image/png') {
                $img = imagecreatefrompng($inputFile);
            } elseif ($mime_type == 'image/gif') {
                $img = imagecreatefromgif($inputFile);
            } elseif ($mime_type == 'image/bmp') {
                $img = imagecreatefrombmp($inputFile);
            } elseif ($mime_type == 'image/webp') {
                $img = imagecreatefromwebp($inputFile);
            } else {
                return false;
            }

            $size = getimagesize($inputFile);
            $size_k = $size[0] / 1280;
            $new_size_x = $size[0] / $size_k;
            $new_size_y = $size[1] / $size_k;
            $new_img = imagecreatetruecolor($new_size_x, $new_size_y);
            imagecopyresampled($new_img, $img, 0, 0, 0, 0, $new_size_x, $new_size_y, $size[0], $size[1]);
            imagejpeg($new_img, $outputFile, 50);
            imagedestroy($img);
            imagedestroy($new_img);
        }

        $url_foto = $post->url_foto;
        $url_foto_2 = $post->url_foto_2;
        $url_foto_3 = $post->url_foto_3;
        $url_foto_4 = $post->url_foto_4;
        $url_foto_5 = $post->url_foto_5;

        $name_post = $request->input('name_post');
        $text_post = $request->input('text_post');
        $text_post_2 = $request->input('text_post_2');
        $text_post_3 = $request->input('text_post_3');
        $text_post_4 = $request->input('text_post_4');
        $text_post_5 = $request->input('text_post_5');

        $name_foto = $id_user . '-' . time() . '.jpg';

        if (!empty($request->foto_1)) {
            $url_foto = 'storage/app/bot/images/' . '1_' . $name_foto;
            convert_foto($request->foto_1, $url_foto);
        }
        if (!empty($request->foto_2)) {
            $url_foto_2 = 'storage/app/bot/images/' . '2_' . $name_foto;
            convert_foto($request->foto_2, $url_foto_2);
        }
        if (!empty($request->foto_3)) {
            $url_foto_3 = 'storage/app/bot/images/' . '3_' . $name_foto;
            convert_foto($request->foto_3, $url_foto_3);
        }
        if (!empty($request->foto_4)) {
            $url_foto_4 = 'storage/app/bot/images/' . '4_' . $name_foto;
            convert_foto($request->foto_4, $url_foto_4);
        }
        if (!empty($request->foto_5)) {
            $url_foto_5 = 'storage/app/bot/images/' . '5_' . $name_foto;
            convert_foto($request->foto_5, $url_foto_5);
        }

        DB::table('posts')
            ->where('id', $post_id)
            ->update([
                'name_post' => $name_post,
                'text_post' => $text_post,
                'url_foto' => $url_foto,
                'text_post_2' => $text_post_2,
                'url_foto_2' => $url_foto_2,
                'text_post_3' => $text_post_3,
                'url_foto_3' => $url_foto_3,
                'text_post_4' => $text_post_4,
                'url_foto_4' => $url_foto_4,
                'text_post_5' => $text_post_5,
                'url_foto_5' => $url_foto_5
            ]);

        return response()->json('ok', 200);
    }
    // ======================================================================================================
    public function post_delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('cabinet_all_post');
    }
}
