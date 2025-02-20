<?php

namespace App\Http\Controllers;

use App\Models\Draft_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Create_post;
use App\Models\Post;


class DraftPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $post = Draft_post::where('id', $id)->first();

        return view('draft_post', compact('post'));
    }



    public function show_post_bot($id)
    {

        $post = Create_post::where('id', $id)->first();

        //    abort(404);
        return view('draft_post_bot', compact('post'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function draft_post_in_post($id)
    {

        $draft_post = Draft_post::where('id', $id)->first();

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
        ]);

        // Draft_post::where('id', $id)->delete();

        return response()->json('ok', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function clear_draft_post($id)
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

    /**
     * Display the specified resource.
     */
    public function show(Draft_post $draft_post) {}


    public function cabinet_new_post()
    {

        // Storage::disk('local')->put('file.txt', 'Contents');
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

        function convert_foto2($inputFile, $outputFile)  // сжимаем фото
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

        $name_foto = $id_user . '-' . time() . '.jpg';

        $arr_preview = parse_url($request->preview);
        $url_foto = ltrim($arr_preview['path'], '/');

        if (!empty($request->foto_1)) {
            $url_foto = 'storage/app/bot/images/' . '1_' . $name_foto;
            convert_foto2($request->foto_1, $url_foto);
        }

        $arr_preview2 = parse_url($request->preview2);
        $url_foto_2 = ltrim($arr_preview2['path'], '/');

        $text_post_2 = null;
        if (!empty($request->input('checkbox_1'))) {
            $text_post_2 = $request->input('text_post_2');
            if (!empty($request->foto_2)) {
                $url_foto_2 = 'storage/app/bot/images/' . '2_' . $name_foto;
                convert_foto2($request->foto_2, $url_foto_2);
            }
        }

        $arr_preview3 = parse_url($request->preview3);
        $url_foto_3 = ltrim($arr_preview3['path'], '/');
        $text_post_3 = null;
        if (!empty($request->input('checkbox_2'))) {
            $text_post_3 = $request->input('text_post_3');
            if (!empty($request->foto_3)) {
                $url_foto_3 = 'storage/app/bot/images/' . '3_' . $name_foto;
                convert_foto2($request->foto_3, $url_foto_3);
            }
        }

        $arr_preview4 = parse_url($request->preview4);
        $url_foto_4 = ltrim($arr_preview4['path'], '/');
        $text_post_4 = null;
        if (!empty($request->input('checkbox_3'))) {
            $text_post_4 = $request->input('text_post_4');
            if (!empty($request->foto_4)) {
                $url_foto_4 = 'storage/app/bot/images/' . '4_' . $name_foto;
                convert_foto2($request->foto_4, $url_foto_4);
            }
        }

        $arr_preview5 = parse_url($request->preview5);
        $url_foto_5 = ltrim($arr_preview5['path'], '/');
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






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Draft_post $draft_post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Draft_post $draft_post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Draft_post $draft_post)
    {
        //
    }
}
