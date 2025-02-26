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

    public function index()  // показываем страницу в кабинете 
    {
        $id_user = Auth::user()->id;
        if (!empty(Site::where('id_user', $id_user)->first())) $site = Site::where('id_user', $id_user)->first();
        else $site = Site::where('id', 1)->first();

        return view('cabinet_site', compact('site'));
    }


    public function show($id)  // показываем готовый сайт
    {
        // $site = Site::where('id_user', $id)->first();
        if (!empty(Site::where('id_user', $id)->first())) $site = Site::where('id_user', $id)->first();
        else $site = Site::where('id', 1)->first();
        return view('site', compact('site'));
    }
    public function reset_site(Request $request)  // показываем готовый сайт
    {
        $site = Site::where('id', 1)->first();
        Site::where('id', $request->site_id)
        ->update([
            'color_head' => $site->color_head,
            'color_body' => $site->color_body,
            'color_card' => $site->color_card,
            'color_back' => $site->color_back,
            'heading' => $site->heading,
            'phone_1' => $site->phone_1,
            'top_text' => $site->top_text,

            'text_1_a' => $site->text_1_a,
            'foto_1' => $site->foto_1,
            'text_1_b' => $site->text_1_b,

            'text_2_a' => $site->text_2_a,
            'foto_2' => $site->foto_2,
            'text_2_b' => $site->text_2_b,

            'text_3_a' => $site->text_3_a,
            'foto_3' => $site->foto_3,
            'text_3_b' => $site->text_3_b,

            'text_4_a' => $site->text_4_a,
            'foto_4' => $site->foto_4,
            'text_4_b' => $site->text_4_b,

            'text_5_a' => $site->text_5_a,
            'foto_5' => $site->foto_5,
            'text_5_b' => $site->text_5_b,
            'bottom_text' => $site->bottom_text,
            'meta_1' => $site->meta_1,
        ]);
        return redirect()->route('site_index');
    }



    public function site_create(Request $request)
    {
        info($request);
        $valid = $request->validate([  // валидация формы
            'site_id' => ['required', 'integer', 'max:100000'],
            'heading' => ['nullable', 'string', 'max:25'],
            'phone_1' => ['nullable', 'string', 'max:15'],
            'top_text' => ['nullable', 'string', 'max:500'],
            'color_head' => ['required', 'string', 'max:10'],
            'color_body' => ['required', 'string', 'max:10'],
            'color_card' => ['required', 'string', 'max:10'],
            'color_back' => ['required', 'string', 'max:10'],
            'text_1_a' => ['nullable', 'string', 'max:50'],
            'foto_1' => ['image', 'max:3072'], // фото максимум 3 мегабайта
            'text_1_b' => ['nullable', 'string', 'max:1000'], // текст можно пустой, максимум 1000 символов
            'text_2_a' => ['nullable', 'string', 'max:50'],
            'foto_2' => ['image', 'max:3072'],
            'text_2_b' => ['nullable', 'string', 'max:1000'],
            'text_3_a' => ['nullable', 'string', 'max:50'],
            'foto_3' => ['image', 'max:3072'],
            'text_3_b' => ['nullable', 'string', 'max:1000'],
            'text_4_a' => ['nullable', 'string', 'max:50'],
            'foto_4' => ['image', 'max:3072'],
            'text_4_b' => ['nullable', 'string', 'max:1000'],
            'text_5_a' => ['nullable', 'string', 'max:50'],
            'foto_5' => ['image', 'max:3072'],
            'text_5_b' => ['nullable', 'string', 'max:1000'],
            'bottom_text' => ['nullable', 'string', 'max:1000'],
            'meta_1' => ['nullable', 'string', 'max:50'],
        ]);

        $id_user = Auth::user()->id;
        $user_name = Auth::user()->user_name;
        if (!empty(Site::where('id_user', $id_user)->first())) $site = Site::where('id_user', $id_user)->first();
        else $site = Site::where('id', 1)->first();

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

        $name_foto = $id_user . '-' . time() . '.jpg';

        if (!empty($valid['foto_1'])) {
            $foto_1 = 'storage/app/bot/images/' . '1_site_' . $name_foto;
            convert_foto($valid['foto_1'], $foto_1);
        } else $foto_1 = $site->foto_1;

        if (!empty($valid['foto_2'])) {
            $foto_2 = 'storage/app/bot/images/' . '2_site_' . $name_foto;
            convert_foto($valid['foto_2'], $foto_2);
        } else $foto_2 = $site->foto_2;

        if (!empty($valid['foto_3'])) {
            $foto_3 = 'storage/app/bot/images/' . '3_site_' . $name_foto;
            convert_foto($valid['foto_3'], $foto_3);
        } else $foto_3 = $site->foto_3;

        if (!empty($valid['foto_4'])) {
            $foto_4 = 'storage/app/bot/images/' . '4_site_' . $name_foto;
            convert_foto($valid['foto_4'], $foto_4);
        } else $foto_4 = $site->foto_4;

        if (!empty($valid['foto_5'])) {
            $foto_5 = 'storage/app/bot/images/' . '5_site_' . $name_foto;
            convert_foto($valid['foto_5'], $foto_5);
        } else $foto_5 = $site->foto_5;

        if ($site->id == 1) {
            $db_site = Site::create([
                'id_user' => $id_user,
                'user_name' => $user_name,
                'color_head' => $valid['color_head'],
                'color_body' => $valid['color_body'],
                'color_card' => $valid['color_card'],
                'color_back' => $valid['color_back'],
                'heading' => $valid['heading'],
                'phone_1' => $valid['phone_1'],
                'top_text' => $valid['top_text'],

                'text_1_a' => $valid['text_1_a'],
                'foto_1' => $foto_1,
                'text_1_b' => $valid['text_1_b'],

                'text_2_a' => $valid['text_2_a'],
                'foto_2' => $foto_2,
                'text_2_b' => $valid['text_2_b'],

                'text_3_a' => $valid['text_3_a'],
                'foto_3' => $foto_3,
                'text_3_b' => $valid['text_3_b'],

                'text_4_a' => $valid['text_4_a'],
                'foto_4' => $foto_4,
                'text_4_b' => $valid['text_4_b'],

                'text_5_a' => $valid['text_5_a'],
                'foto_5' => $foto_5,
                'text_5_b' => $valid['text_5_b'],
                'bottom_text' => $valid['bottom_text'],
                'meta_1' => $valid['meta_1'],
            ]);
        } else {
            DB::table('sites')
                ->where('id_user', $id_user)
                ->update([
                    'id_user' => $id_user,
                    'user_name' => $user_name,
                    'color_head' => $valid['color_head'],
                    'color_body' => $valid['color_body'],
                    'color_card' => $valid['color_card'],
                    'color_back' => $valid['color_back'],
                    'heading' => $valid['heading'],
                    'phone_1' => $valid['phone_1'],
                    'top_text' => $valid['top_text'],

                    'text_1_a' => $valid['text_1_a'],
                    'foto_1' => $foto_1,
                    'text_1_b' => $valid['text_1_b'],

                    'text_2_a' => $valid['text_2_a'],
                    'foto_2' => $foto_2,
                    'text_2_b' => $valid['text_2_b'],

                    'text_3_a' => $valid['text_3_a'],
                    'foto_3' => $foto_3,
                    'text_3_b' => $valid['text_3_b'],

                    'text_4_a' => $valid['text_4_a'],
                    'foto_4' => $foto_4,
                    'text_4_b' => $valid['text_4_b'],

                    'text_5_a' => $valid['text_5_a'],
                    'foto_5' => $foto_5,
                    'text_5_b' => $valid['text_5_b'],
                    'bottom_text' => $valid['bottom_text'],
                    'meta_1' => $valid['meta_1'],
                ]);
        }
        return redirect()->route('site_index');
    }
}
