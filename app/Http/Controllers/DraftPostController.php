<?php

namespace App\Http\Controllers;

use App\Models\Draft_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Create_post;
use App\Models\Post;


class DraftPostController extends Controller
{

    public function index($id)
    {
        $post = Draft_post::where('id', $id)->first();

        return view('draft_post', compact('post'));
    }

    public function show_post_bot($id)
    {
        $post = Create_post::where('id', $id)->first();

        return view('draft_post_bot', compact('post'));
    }

    public function draft_post_in_post($id)  // из черновика делаем пост в ленту
    {
        $draft_post = Draft_post::where('id', $id)->first();
        $post = Post::where('name_post', $draft_post->name_post)->first();
        info($post);
        if ($post == null) {
            Post::create([
                'name_post' => $draft_post->name_post,
                'text_post' => $draft_post->text_post,
                'id_user' => $draft_post->id_user,
                'user_name' => $draft_post->user_name,
                'url_foto' => $draft_post->url_foto,
                'url_foto_2' => $draft_post->url_foto_2,
                'text_post_2' => $draft_post->text_post_2,
                'url_foto_3' => $draft_post->url_foto_3,
                'text_post_3' => $draft_post->text_post_3,
                'url_foto_4' => $draft_post->url_foto_2,
                'text_post_4' => $draft_post->text_post_2,
                'url_foto_5' => $draft_post->url_foto_3,
                'text_post_5' => $draft_post->text_post_3,
            ]);

            return response()->json('ok', 200);

        } else return response()->json('nok', 200);
    }

    public function clear_draft_post($id)  // очищаем базу
    {
        Draft_post::where('id', $id)
            ->update([
                'name_post' => null,
                'text_post' => null,
                'url_foto' => null,
                'url_foto_2' => null,
                'text_post_2' => null,
                'url_foto_3' => null,
                'text_post_3' => null,
                'url_foto_4' => null,
                'text_post_4' => null,
                'url_foto_5' => null,
                'text_post_5' => null,
            ]);
        return response()->json('ok', 200);
    }


    public function cabinet_new_post()
    {
        return view('cabinet_new_post');
    }



    
    public function draft_post_create(Request $request)
    {
        info($request);
        $name_post = $request->input('name_post');
        $url_foto = $request->url('preview');

        $text_post = $request->input('text_post');
        $draft_post_id = $request->input('draft_post_id');
        // $draft_post = Draft_post::where('id', $draft_post_id)->first();

        $id_user = Auth::user()->id;
        $user_name = Auth::user()->name;

        function convert_foto2($inputFile, $outputFile) // разные форматы приводим к JPG, сжимаем, уменьшаем размер
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
            }else {
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

        $name_foto = $id_user . '-' . time() . '.jpg';

        $arr_preview = parse_url($request->preview);
        if (ltrim($arr_preview['path'], '/') == 'plug.jpg') $url_foto = null;
        else $url_foto = $arr_preview['path'];

        if (!empty($request->foto_1)) {
            $url_foto = 'storage/app/bot/images/' . '1_' . $name_foto;
            convert_foto2($request->foto_1, $url_foto);
        }

        $arr_preview2 = parse_url($request->preview2);
        if (ltrim($arr_preview2['path'], '/') == 'plug.jpg') $url_foto_2 = null;
        else $url_foto_2 = $arr_preview2['path'];

        $text_post_2 = null;

        if (!empty($request->input('checkbox_1'))) {
            $text_post_2 = $request->input('text_post_2');
            if (!empty($request->foto_2)) {
                $url_foto_2 = 'storage/app/bot/images/' . '2_' . $name_foto;
                convert_foto2($request->foto_2, $url_foto_2);
            }
        }

        $arr_preview3 = parse_url($request->preview3);
        if (ltrim($arr_preview3['path'], '/') == 'plug.jpg') $url_foto_3 = null;
        else $url_foto_3 = $arr_preview3['path'];
        $text_post_3 = null;

        if (!empty($request->input('checkbox_2'))) {
            $text_post_3 = $request->input('text_post_3');
            if (!empty($request->foto_3)) {
                $url_foto_3 = 'storage/app/bot/images/' . '3_' . $name_foto;
                convert_foto2($request->foto_3, $url_foto_3);
            }
        }

        $arr_preview4 = parse_url($request->preview4);
        if (ltrim($arr_preview4['path'], '/') == 'plug.jpg') $url_foto_4 = null;
        else $url_foto_4 = $arr_preview4['path'];
        $text_post_4 = null;

        if (!empty($request->input('checkbox_3'))) {
            $text_post_4 = $request->input('text_post_4');
            if (!empty($request->foto_4)) {
                $url_foto_4 = 'storage/app/bot/images/' . '4_' . $name_foto;
                convert_foto2($request->foto_4, $url_foto_4);
            }
        }

        $arr_preview5 = parse_url($request->preview5);
        if (ltrim($arr_preview5['path'], '/') == 'plug.jpg') $url_foto_5 = null;
        else $url_foto_5 = $arr_preview5['path'];
        $text_post_5 = null;

        if (true) {
            $text_post_5 = $request->input('text_post_5');
            if (!empty($request->foto_5)) {
                $url_foto_5 = 'storage/app/bot/images/' . '5_' . $name_foto;
                convert_foto2($request->foto_5, $url_foto_5);
            }
        }

        $db_draft_post =  Draft_post::where('id', $draft_post_id)
            ->update([
                'name_post' => $name_post,
                'text_post' => $text_post,
                'id_user' => $id_user,
                'user_name' => $user_name,
                'url_foto' => $url_foto,
                'url_foto_2' => $url_foto_2,
                'text_post_2' => $text_post_2,
                'url_foto_3' => $url_foto_3,
                'text_post_3' => $text_post_3,
                'url_foto_4' => $url_foto_4,
                'text_post_4' => $text_post_4,
                'url_foto_5' => $url_foto_5,
                'text_post_5' => $text_post_5,
            ]);

        return response()->json($db_draft_post, 200);
    }
}
