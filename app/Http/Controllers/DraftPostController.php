<?php

namespace App\Http\Controllers;

use App\Models\Draft_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DraftPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Draft_post::where('id', 15)->first();
   
        return view('draft_post', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Draft_post $draft_post)
    {
        //
    }


    public function cabinet_new_post()
    {

        // Storage::disk('local')->put('file.txt', 'Contents');
        return view('cabinet_new_post');
    }

    public function draft_post_create(Request $request)
    {
        info($request);
        $name_post = $request->input('name_post');
        $text_post = $request->input('text_post');
        
        $id_user = Auth::user()->name;
        $user_name = Auth::user()->user_name;

        function convert_foto2($inputFile, $outputFile)
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
        $url_foto = null;
        if (!empty($request->foto_1)) {
            $url_foto = 'storage/app/bot/images/' . '1_' . $name_foto;
            convert_foto2($request->foto_1, $url_foto);
        }

        $url_foto_2 = null;
        $text_post_2 = null;
       if(!empty($request->input('checkbox_1'))){
        $text_post_2 = $request->input('text_post_2');
        if (!empty($request->foto_2)) {
            $url_foto_2 = 'storage/app/bot/images/' . '2_' . $name_foto;
            convert_foto2($request->foto_2, $url_foto_2);
        }

       }

       $url_foto_3 = null;
       $text_post_3 = null;
      if(!empty($request->input('checkbox_2'))){
       $text_post_3 = $request->input('text_post_3');
       if (!empty($request->foto_3)) {
           $url_foto_3 = 'storage/app/bot/images/' . '3_' . $name_foto;
           convert_foto2($request->foto_3, $url_foto_3);
       }

      }

        $db_draft_post = Draft_post::create([
            'name_post' => $name_post,
             'text_post' => $text_post,
              'id_user' => $id_user, 
              'user_name' => $user_name,
              'url_foto' => $url_foto,
               'url_foto_2' => $url_foto_2,
              'text_post_2' => $text_post_2,
              'url_foto_3' => $url_foto_3,
              'text_post_3' => $text_post_3,
            ]);
        // Storage::disk('local')->put('file.txt', 'Contents');
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
