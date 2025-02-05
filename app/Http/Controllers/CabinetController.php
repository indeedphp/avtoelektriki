<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Draft_post;

class CabinetController extends Controller
{
 
    public function index()
    {

        // Storage::disk('local')->put('file.txt', 'Contents');
        return view('cabinet');
    }



  public function cabinet_new_post()
    {

        // Storage::disk('local')->put('file.txt', 'Contents');
        return view('cabinet_new_post');
    }
    public function cabinet_edit_post()
    {

        $post = Post::where('id', '=', '7')->first();

        // dump($post);
        return view('cabinet_edit_post', compact('post'));
    }


    public function edit_post(Request $request)
    {
        $id_user = Auth::user()->name;
        
        $post = Post::where('id', 7)->first();
     
        $reply_id = '7';
       
        info($request);
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

        $name_post = $request->input('name_post');
        $text_post = $request->input('text_post');
        $text_post_2 = $request->input('text_post_2');
        $text_post_3 = $request->input('text_post_3');

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
      
        DB::table('posts')
            ->where('id', $reply_id)
            ->update([
                'name_post' => $name_post,
                'text_post' => $text_post,
                'url_foto' => $url_foto,
                'text_post_2' => $text_post_2,
                'url_foto_2' => $url_foto_2,
                'text_post_3' => $text_post_3,
                'url_foto_3' => $url_foto_3
            ]);

        return response()->json('eee', 200);
    }



}
