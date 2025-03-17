<?php

namespace App\Http\Controllers;

use App\Models\Draft_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Create_post;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| DraftPostController
|--------------------------------------------------------------------------
|
| черновики постов созданных в кабинете
|
*/

class DraftPostController extends Controller
{
// ---------------------------------------------------------------------------------------------------------

    public function index($id)  // показываем страницу с черновиком поста сделанным в кабинете на странице новый пост
    {
        $post = Draft_post::where('id', $id)->first();

        return view('draft_post', compact('post'));
    }
// ---------------------------------------------------------------------------------------------------------

    public function show_post_bot($id)  // показываем страницу с черновиком поста сделанным из бота
    {
        $post = Create_post::where('id', $id)->first();

        return view('draft_post_bot', compact('post'));
    }
// ---------------------------------------------------------------------------------------------------------

    public function draft_post_in_post($id)  // из черновика делаем пост в ленту
    {
        $draft_post = Draft_post::where('id', $id)->first();
      info($draft_post->url_foto);
      
        if($draft_post->name_post != null && $draft_post->text_post != null && $draft_post->url_foto != null){
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
                'url_foto_4' => $draft_post->url_foto_4,
                'text_post_4' => $draft_post->text_post_4,
                'url_foto_5' => $draft_post->url_foto_5,
                'text_post_5' => $draft_post->text_post_5,
                'stuff' => $draft_post->stuff,  // временно для ид ютуб видео
                'date' => $draft_post->date,  // временно для текста под видео
            ]);
            return response()->json('ok', 200);
        }
       else return response()->json('no_ok', 200);
    }
// ---------------------------------------------------------------------------------------------------------
    public function clear_draft_post($id)  // очищаем базу со страницы новый пост в кабинете
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
                'stuff' => null,  // временно для ид ютуб видео
                'date' => null,  // временно для текста под видео
            ]);
        return response()->json('ok', 200);
    }

// ---------------------------------------------------------------------------------------------------------

    public function draft_post_create(Request $request)  // создаем пост в черновике
    {
        info($request);
        $valid = $request->validate([  // валидация формы
            'draft_post_id' => ['required', 'integer'],
            'name_post' => ['nullable', 'string', 'max:250'],
            'foto_1' => ['image', 'max:3072'],  // фото максимум 3 мегабайта
            'text_post_1' => ['nullable', 'string', 'max:2000'],  // текст можно пустой, максимум 5000 символов
            'foto_2' => ['image', 'max:3072'],
            'text_post_2' => ['nullable', 'string', 'max:2000'],
            'foto_3' => ['image', 'max:3072'],
            'text_post_3' => ['nullable', 'string', 'max:2000'],
            'foto_4' => ['image', 'max:3072'],
            'text_post_4' => ['nullable', 'string', 'max:2000'],
            'foto_5' => ['image', 'max:3072'],
            'text_post_5' => ['nullable', 'string', 'max:2000'],
            'checkbox_1' => ['nullable', 'string', 'max:3'],
            'checkbox_2' => ['nullable', 'string', 'max:3'],
            'checkbox_3' => ['nullable', 'string', 'max:3'],
            'checkbox_4' => ['nullable', 'string', 'max:3'],
            'checkbox_5' => ['nullable', 'string', 'max:3'],
            'video_url' => ['nullable', 'starts_with:https://youtu.be,https://www.youtube', 'string', 'max:100'],
            'text_post_6' => ['nullable', 'string', 'max:2000'],

        ]);



        $draft_post = Draft_post::where('id', $valid['draft_post_id'])->first();  // из базы получаем старые данные
        $url_foto = $draft_post->url_foto;
        $text_post = $draft_post->text_post_2;
        $url_foto_2 = $draft_post->url_foto_2;
        $text_post_2 = $draft_post->text_post_2;
        $url_foto_3 = $draft_post->url_foto_3;
        $text_post_3 = $draft_post->text_post_3;
        $url_foto_4 = $draft_post->url_foto_4;
        $text_post_4 = $draft_post->text_post_4;
        $url_foto_5 = $draft_post->url_foto_5;
        $text_post_5 = $draft_post->text_post_5;
        $video_id_youtube = $draft_post->stuff;
        $text_post_6 = $draft_post->date;
        $id_user = Auth::user()->id;
        $user_name = Auth::user()->name;

  


        
             
        if (!empty($valid['checkbox_5'])) {
            if(!empty($valid['video_url'])){  // извлекаем ютуб айди видео 
                $pattern = '#(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/[^\/]+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})#';
                preg_match($pattern, $valid['video_url'], $matches);
                $video_id_youtube = isset($matches[1]) ? $matches[1] : null;  
                } 
            if(!empty($valid['text_post_6'])) $text_post_6 = $valid['text_post_6'];  // текст под видео
        } else {
            $video_id_youtube = null;
            $text_post_6  = null;
        }

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
            imagejpeg($new_img, Storage::path('bot/images').$outputFile, 50);
            imagedestroy($img);
            imagedestroy($new_img);
        }

        $name_foto = $id_user . '-' . time() . '.jpg';  // создаем имя для фото
        $text_post = $valid['text_post_1'];

        if (!empty($valid['foto_1'])) {  
            $url_foto = 'storage/app/bot/images/' . '1_' . $name_foto;
            convert_foto($valid['foto_1'], '/1_' . $name_foto);
        }

        if (!empty($valid['checkbox_1'])) {  // если стоит чекбокс в форме
            $text_post_2 = $valid['text_post_2']; // меняем текст
            if (!empty($valid['foto_2'])) {  // если пришло с формы фото
                $url_foto_2 = 'storage/app/bot/images/' . '2_' . $name_foto; // составляем путь с именем для фото
                convert_foto($valid['foto_2'], '/2_' . $name_foto);  // вызываем функцию и передаем фото и путь
            }
        } else {  // если чекбокс убран то обнуляем фото и текст
            $text_post_2 = null;
            $url_foto_2  = null;
        }

        if (!empty($valid['checkbox_2'])) {
            $text_post_3 = $valid['text_post_3'];
            if (!empty($valid['foto_3'])) {
                $url_foto_3 = 'storage/app/bot/images/' . '3_' . $name_foto;
                convert_foto($valid['foto_3'], '/3_' . $name_foto);
            }
        } else {
            $text_post_3 = null;
            $url_foto_3  = null;
        }

        if (!empty($valid['checkbox_3'])) {
            $text_post_4 = $valid['text_post_4'];
            if (!empty($valid['foto_4'])) {
                $url_foto_4 = 'storage/app/bot/images/' . '4_' . $name_foto;
                convert_foto($valid['foto_4'], '/4_' . $name_foto);
            }
        } else {
            $text_post_4 = null;
            $url_foto_4  = null;
        }

        if (!empty($valid['checkbox_4'])) {
            $text_post_5 = $valid['text_post_5'];
            if (!empty($valid['foto_5'])) {
                $url_foto_5 = 'storage/app/bot/images/' . '5_' . $name_foto;
                convert_foto($valid['foto_5'], '/5_' . $name_foto);
            }
        } else {
            $text_post_5 = null;
            $url_foto_5  = null;
        }

        Draft_post::where('id', $valid['draft_post_id'])
            ->update([
                'name_post' => $valid['name_post'],
                'id_user' => $id_user,
                'user_name' => $user_name,
                'text_post' => $text_post,
                'url_foto' => $url_foto,
                'url_foto_2' => $url_foto_2,
                'text_post_2' => $text_post_2,
                'url_foto_3' => $url_foto_3,
                'text_post_3' => $text_post_3,
                'url_foto_4' => $url_foto_4,
                'text_post_4' => $text_post_4,
                'url_foto_5' => $url_foto_5,
                'text_post_5' => $text_post_5,
                'stuff' => $video_id_youtube,
                'date' => $text_post_6,
            ]);

        return redirect()->route('cabinet_new_post');
    }
}

