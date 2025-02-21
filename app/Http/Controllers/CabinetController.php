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

class CabinetController extends Controller
{

    public function settings_show()
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        // dd($user); index
        return view('cabinet_settings', compact('user'));
    }

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
    public function all_post_show()
    {
        $id_user = Auth::user()->id;
        $posts = Post::where('id_user', $id_user)->get();
        $posts = $posts->reverse();
        return view('cabinet_all_post', compact('posts'));
    }

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
    public function edit_post_show()
    {
        $id_user = Auth::user()->id;
        // $post = Post::where('id', '=', '7')->first();
        $post =  DB::table('posts')->where('id_user',  $id_user)->orderBy('id', 'desc')->first();
        // dump($post);
        return view('cabinet_edit_post', compact('post'));
    }

    public function all_post_edit($id)
    {


        $post = Post::where('id', $id)->first();

        return view('cabinet_edit_post', compact('post'));
    }

    public function settings_edit(Request $request)
    {
        $new_name = $request->input('new_name');
        $id = Auth::user()->id;

        User::where('id', $id)
            ->update([
                "user_name" => $new_name
            ]);

        return redirect()->route('cabinet_settings');
    }

    public function edit_post(Request $request)
    {
        info($request);
        $user_name = Auth::user()->name;
        $id_user = Auth::user()->id;
        $post_id = $request->input('post_id');

        $post = Post::where('id', $post_id)->first();

        function convert_foto($inputFile, $outputFile)
        {
            $img = imagecreatefromjpeg($inputFile);
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
        // sleep(5);
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
        // Draft_post::where('id', 19)
        // ->update([
        //     'name_post' => $name_post,
        //     'text_post' => $text_post,
        //     'url_foto' => $url_foto,
        //     'text_post_2' => $text_post_2,
        //     'url_foto_2' => $url_foto_2,
        //     'text_post_3' => $text_post_3,
        //     'url_foto_3' => $url_foto_3
        // ]);


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

        return response()->json('eee', 200);
    }



    public function post_delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('cabinet_all_post');
    }





    // public function edit_post(Request $request)
    // {

    //     info($request);
    //     $name_post = $request->input('name_post');
    //     $url_foto = $request->url('preview');
    //     $post_id = $request->input('post_id');
    //     $text_post = $request->input('text_post');
     
    //     $post = Post::where('id', $post_id)->first();

    //     $id_user = Auth::user()->id;
    //     $user_name = Auth::user()->name;

    //     function convert_foto2($inputFile, $outputFile) // разные форматы приводим к JPG, сжимаем, уменьшаем размер
    //     {
    //         $file_info = getimagesize($inputFile);
    //         $mime_type = $file_info['mime'];
    //         info($mime_type);

    //         if ($mime_type == 'image/jpeg') {
    //             $img = imagecreatefromjpeg($inputFile);
    //         } elseif ($mime_type == 'image/png') {
    //             $img = imagecreatefrompng($inputFile);
    //         } elseif ($mime_type == 'image/gif') {
    //             $img = imagecreatefromgif($inputFile);
    //         } elseif ($mime_type == 'image/bmp') {
    //             $img = imagecreatefrombmp($inputFile);
    //         } elseif ($mime_type == 'image/webp') {
    //             $img = imagecreatefromwebp($inputFile);
    //         } else {
    //             return false;
    //         }

    //         $size = getimagesize($inputFile);
    //         $size_k = $size[0] / 1280;
    //         $new_size_x = $size[0] / $size_k;
    //         $new_size_y = $size[1] / $size_k;
    //         $new_img = imagecreatetruecolor($new_size_x, $new_size_y);
    //         imagecopyresampled($new_img, $img, 0, 0, 0, 0, $new_size_x, $new_size_y, $size[0], $size[1]);
    //         imagejpeg($new_img, $outputFile, 50);
    //         imagedestroy($img);
    //         imagedestroy($new_img);
    //     }

    //     $name_foto = $id_user . '-' . time() . '.jpg';

    //     $arr_preview = parse_url($request->preview);
    //     if (ltrim($arr_preview['path'], '/') == 'plug.jpg') $url_foto = null;
    //     else $url_foto = $arr_preview['path'];

    //     if (!empty($request->foto_1)) {
    //         $url_foto = 'storage/app/bot/images/' . '1_' . $name_foto;
    //         convert_foto2($request->foto_1, $url_foto);
    //     }

    //     $arr_preview2 = parse_url($request->preview2);
    //     if (ltrim($arr_preview2['path'], '/') == 'plug.jpg') $url_foto_2 = null;
    //     else $url_foto_2 = $arr_preview2['path'];

    //     $text_post_2 = null;

    //     if (!empty($request->input('checkbox_1'))) {
    //         $text_post_2 = $request->input('text_post_2');
    //         if (!empty($request->foto_2)) {
    //             $url_foto_2 = 'storage/app/bot/images/' . '2_' . $name_foto;
    //             convert_foto2($request->foto_2, $url_foto_2);
    //         }
    //     }

    //     $arr_preview3 = parse_url($request->preview3);
    //     if (ltrim($arr_preview3['path'], '/') == 'plug.jpg') $url_foto_3 = null;
    //     else $url_foto_3 = $arr_preview3['path'];
    //     $text_post_3 = null;

    //     if (!empty($request->input('checkbox_2'))) {
    //         $text_post_3 = $request->input('text_post_3');
    //         if (!empty($request->foto_3)) {
    //             $url_foto_3 = 'storage/app/bot/images/' . '3_' . $name_foto;
    //             convert_foto2($request->foto_3, $url_foto_3);
    //         }
    //     }

    //     $arr_preview4 = parse_url($request->preview4);
    //     if (ltrim($arr_preview4['path'], '/') == 'plug.jpg') $url_foto_4 = null;
    //     else $url_foto_4 = $arr_preview4['path'];
    //     $text_post_4 = null;

    //     if (!empty($request->input('checkbox_3'))) {
    //         $text_post_4 = $request->input('text_post_4');
    //         if (!empty($request->foto_4)) {
    //             $url_foto_4 = 'storage/app/bot/images/' . '4_' . $name_foto;
    //             convert_foto2($request->foto_4, $url_foto_4);
    //         }
    //     }

    //     $arr_preview5 = parse_url($request->preview5);
    //     if (ltrim($arr_preview5['path'], '/') == 'plug.jpg') $url_foto_5 = null;
    //     else $url_foto_5 = $arr_preview5['path'];
    //     $text_post_5 = null;

    //     if (true) {
    //         $text_post_5 = $request->input('text_post_5');
    //         if (!empty($request->foto_5)) {
    //             $url_foto_5 = 'storage/app/bot/images/' . '5_' . $name_foto;
    //             convert_foto2($request->foto_5, $url_foto_5);
    //         }
    //     }

    //     DB::table('posts')
    //     ->where('id', $post_id)
    //     ->update([
    //             'name_post' => $name_post,
    //             'text_post' => $text_post,
    //             'id_user' => $id_user,
    //             'user_name' => $user_name,
    //             'url_foto' => $url_foto,
    //             'url_foto_2' => $url_foto_2,
    //             'text_post_2' => $text_post_2,
    //             'url_foto_3' => $url_foto_3,
    //             'text_post_3' => $text_post_3,
    //             'url_foto_4' => $url_foto_4,
    //             'text_post_4' => $text_post_4,
    //             'url_foto_5' => $url_foto_5,
    //             'text_post_5' => $text_post_5,
    //         ]);

    //     return response()->json('ggg', 200);
    // }
}
