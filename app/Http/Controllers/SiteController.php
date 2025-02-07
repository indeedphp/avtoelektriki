<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| SiteController
|--------------------------------------------------------------------------
|
| Работа с индивидуальным сайтом пользователя
|
*/

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index($id)
    {
        $site = Site::where('id_user', $id)->first();

        return view('cabinet_site', compact('site'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function site_create(Request $request)
    {

        info($request);
        $id_user = Auth::user()->id;
        $user_name = Auth::user()->user_name;
        if(!empty(Site::where('id_user', $id_user)->first())) $site = Site::where('id_user', $id_user)->first();
        else $site = Site::where('id', 1)->first();

        // info($site = Site::where('id', 100)->first());

        $color_head = $request->input('color_head');
        $color_body = $request->input('color_body');
        $color_card = $request->input('color_card');
        $color_back = $request->input('color_back');
        $heading = $request->input('heading');
        $phone_1 = $request->input('phone_1');
        $top_text = $request->input('top_text');
        $text_1_a = $request->input('text_1_a');
        $text_1_b = $request->input('text_1_b');
        $text_2_a = $request->input('text_2_a');
        $text_2_b = $request->input('text_2_b');
        $text_3_a = $request->input('text_3_a');
        $text_3_b = $request->input('text_3_b');
        $text_4_a = $request->input('text_4_a');
        $text_4_b = $request->input('text_4_b');
        $text_5_a = $request->input('text_5_a');
        $text_5_b = $request->input('text_5_b');
        $bottom_text = $request->input('bottom_text');
        $meta_1 = $request->input('meta_1');

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

        $name_foto = $id_user . '-' . time() . '.jpg';
      
        if (!empty($request->foto_1)) {
            $foto_1 = 'storage/app/bot/images/' . '1_site_' . $name_foto;
            convert_foto($request->foto_1, $foto_1);
        }
        else $foto_1 = $site->foto_1;
       
        if (!empty($request->foto_2)) {
            $foto_2 = 'storage/app/bot/images/' . '2_site_' . $name_foto;
            convert_foto($request->foto_2, $foto_2);
        }
        else $foto_2 = $site->foto_2;

        if (!empty($request->foto_3)) {
            $foto_3 = 'storage/app/bot/images/' . '3_site_' . $name_foto;
            convert_foto($request->foto_3, $foto_3);
        }
        else $foto_3 = $site->foto_3;

        if (!empty($request->foto_4)) {
            $foto_4 = 'storage/app/bot/images/' . '4_site_' . $name_foto;
            convert_foto($request->foto_4, $foto_4);
        }
        else $foto_4 = $site->foto_4;
     
        if (!empty($request->foto_5)) {
            $foto_5 = 'storage/app/bot/images/' . '5_site_' . $name_foto;
            convert_foto($request->foto_5, $foto_5);
        }
        else $foto_5 = $site->foto_5;




if($site->id == 1){
        $db_site = Site::create([
            'id_user' => $id_user,
            'user_name' => $user_name,
            'color_head' => $color_head,
            'color_body' => $color_body,
            'color_card' => $color_card,
            'heading' => $heading,
            'phone_1' => $phone_1,
            'top_text' => $top_text,

            'text_1_a' => $text_1_a,
            'foto_1' => $foto_1,
            'text_1_b' => $text_1_b,

            'text_2_a' => $text_2_a,
            'foto_2' => $foto_2,
            'text_2_b' => $text_2_b,

            'text_3_a' => $text_3_a,
            'foto_3' => $foto_3,
            'text_3_b' => $text_3_b,

            'text_4_a' => $text_4_a,
            'foto_4' => $foto_4,
            'text_4_b' => $text_4_b,

            'text_5_a' => $text_5_a,
            'foto_5' => $foto_5,
            'text_5_b' => $text_5_b,
            'bottom_text' => $bottom_text,  //bottom_text
        ]);
}
else {
    DB::table('sites')
    ->where('id_user', $id_user)
    ->update([
        'id_user' => $id_user,
        'user_name' => $user_name,
        'color_head' => $color_head,
        'color_body' => $color_body,
        'color_card' => $color_card,
        'color_back' => $color_back,
        'heading' => $heading,
        'phone_1' => $phone_1,
        'top_text' => $top_text,

        'text_1_a' => $text_1_a,
        'foto_1' => $foto_1,
        'text_1_b' => $text_1_b,

        'text_2_a' => $text_2_a,
        'foto_2' => $foto_2,
        'text_2_b' => $text_2_b,

        'text_3_a' => $text_3_a,
        'foto_3' => $foto_3,
        'text_3_b' => $text_3_b,

        'text_4_a' => $text_4_a,
        'foto_4' => $foto_4,
        'text_4_b' => $text_4_b,

        'text_5_a' => $text_5_a,
        'foto_5' => $foto_5,
        'text_5_b' => $text_5_b,
        'bottom_text' => $bottom_text,
        'meta_1' => $meta_1,
    ]);


    // $site->id_user = $id_user;
    // $site->user_name = $user_name;
    // $site->color_head = $color_head;
    // $site->color_body = $color_body;

    // $site->save();


}

        return response()->json('ok', 200);
    }

    /**
     * Store a newly created resource in storage.phone_1
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $site = Site::where('id_user', $id)->first();

        return view('site', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        //
    }
}
