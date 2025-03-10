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
use App\Models\UserData;
/*
|--------------------------------------------------------------------------
| CabinetController
|--------------------------------------------------------------------------
|
*/

class CabinetController extends Controller
{
    // ======================================================================================================
    public function settings_show()  // страница настроек в кабинете -views/cabinet_settings
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        
        if (empty(UserData::where('user_id', $id)->first())){
            UserData::create(['user_id' => $user->id])->first();
            $user_data = UserData::where('user_id', 1)->first();

        } else $user_data = UserData::where('user_id', $id)->first();
        // dd($user_data);
        return view('cabinet_settings', ['user' => $user, 'user_data' => $user_data]);
    }
    // ======================================================================================================
    public function new_post_show()  // страница создания поста в кабинете  -views/cabinet_new_post
    {
        $user_name = Auth::user()->user_name;
        $id_user = Auth::user()->id;

        if (empty(Draft_post::where('id_user', $id_user)->first())) $draft_post = Draft_post::create(['user_name' => $user_name, 'id_user' => $id_user]);
        else $draft_post = Draft_post::where('id_user', $id_user)->first();

        return view('cabinet_new_post', compact('draft_post'));
    }
    // ======================================================================================================
    public function all_post_show()  // страница всех постов юзера в кабинете, с пагинацией  -views/cabinet_all_post
    {
        $id_user = Auth::user()->id;
        $posts = Post::orderBy('id', 'desc')->where('id_user', $id_user)->paginate(20);
        $count = $posts->total();

        return view('cabinet_all_post', compact('posts', 'count'));
    }
    // =======================================================================================================
    public function edit_post_show($id_post = null)  // страница поста юзера для правки в кабинете  -views/cabinet_edit
    {
        $id_user = Auth::user()->id;
        info($id_post);
        if ($id_post == null) $post = DB::table('posts')->where('id_user',  $id_user)->orderBy('id', 'desc')->first();
        else $post =  DB::table('posts')->where('id', $id_post)->first();

        return view('cabinet_edit_post', compact('post'));
    }
    // ======================================================================================================     
    // МЕТОД СТРАНИЦА САЙТА В КАБИНЕТЕ НАХОДИТСЯ В SiteController
    // ======================================================================================================  
    public function statistic_show()  // страница статистики в кабинете   -views/cabinet_statistic
    {
        $id_user = Auth::user()->id;
        $posts = Post::where('id_user', $id_user)->get();
        $post_count = count($posts);
        $comments = Comment::where('user_id', $id_user)->get();
        $comments_count = count($comments);
        $like_comments = LikeComment::where('id_user', $id_user)->get();
        $like_comments_count = count($like_comments);
        $last_post =  DB::table('posts')->where('id_user',  $id_user)->orderBy('id', 'desc')->first();
        if ((array)$last_post == null) $last_post['created_at'] = 0;
        else $last_post = (array)$last_post;
        $last_comments =  DB::table('comments')->where('user_id',  $id_user)->orderBy('id', 'desc')->first();
        if ((array)$last_comments == null)  $last_comments['created_at'] = 0;
        else $last_comments = (array)$last_comments;
     
        return view('cabinet_statistic', compact('post_count', 'comments_count', 'last_post', 'last_comments'));
    }

    // =======================================================================================================
 
    public function edit_name(Request $request)  // правим имя юзера из кабинета  
    {
        $id = Auth::user()->id;

        $validated = $request->validate([
            'new_name' => ['required', 'min:4', 'max:20', 'unique:users,name'],
        ]);

        User::where('id', $id)
            ->update([
                "name" => $validated['new_name']
            ]);

        return redirect()->route('cabinet_settings');
    }
    // ----------------------------------------------------------------------------
    public function edit_login(Request $request)  // правим логин из кабинета
    {
        $id = Auth::user()->id;

        $validated = $request->validate([
            'new_login' => ['required', 'min:8', 'max:20', 'unique:users,email'],
        ]);

        User::where('id', $id)
            ->update([
                "email" => $validated['new_login']
            ]);

        return redirect()->route('cabinet_settings');
    }
    // ---------------------------------------------------------------------------------
    public function edit_password(Request $request) // правим пароль из кабинета
    {
        $id = Auth::user()->id;

        $validated = $request->validate([
            'new_password' => ['required', 'min:8', 'max:20'],
        ]);

        $password_hash = Hash::make($validated['new_password']);

        User::where('id', $id)
            ->update([
                "password" => $password_hash
            ]);

        return redirect()->route('cabinet_settings');
    }
    // ----------------------------------------------------------------------------
    public function edit_color_channel(Request $request) // правим цвет полосы канала из кабинета
    {
        info($request);
        $id = Auth::user()->id;
        UserData::where('user_id', $id)
            ->update([
                "color_channel" => $request->color_channel,
                "stuff" => $request->color_text,
            ]);
        return redirect()->route('cabinet_settings');
    }
        // ---------------------------------------------------------------------------------
        public function edit_definition_channel(Request $request) // правим описание канала из кабинета
        {
            $id = Auth::user()->id;
            $validated = $request->validate([
                'definition_channel' => ['nullable', 'string', 'max:100'],
            ]);
            UserData::where('user_id', $id)
                ->update([
                    "definition_channel" => $validated['definition_channel']
                ]);
    
            return redirect()->route('cabinet_settings');
        }
        // ---------------------------------------------------------------------------------
        public function edit_name_channel(Request $request) // правим название канала из кабинета
        {
            $id = Auth::user()->id;
            $validated = $request->validate([
                'name_channel' => ['nullable', 'string', 'max:40'],
            ]);
            UserData::where('user_id', $id)
                ->update([
                    "name_channel" => $validated['name_channel']
                ]);
    
            return redirect()->route('cabinet_settings');
        }
    // ----------------------------------------------------------------------------
    public function edit_sity(Request $request)  // правим логин из кабинета
    {
        $id = Auth::user()->id;

        $validated = $request->validate([
            'new_sity' => ['required', 'string', 'min:2', 'max:30'],
        ]);

        UserData::where('user_id', $id)
            ->update([
                "sity" => $validated['new_sity']
            ]);

        return redirect()->route('cabinet_settings');
    }



        
    // =======================================================================================================

    public function edit_post(Request $request)  // редактируем пост в черновике
    {
        info($request);
        $valid = $request->validate([  // валидация формы
            'post_id' => ['required', 'integer'],
            'name_post' => ['nullable', 'string', 'max:250'],
            'foto_1' => ['image', 'max:3072'],  // фото максимум 3 мегабайта
            'text_post_1' => ['nullable', 'string', 'max:5000'],  // текст можно пустой, максимум 5000 символов
            'foto_2' => ['image', 'max:3072'],
            'text_post_2' => ['nullable', 'string', 'max:5000'],
            'foto_3' => ['image', 'max:3072'],
            'text_post_3' => ['nullable', 'string', 'max:5000'],
            'foto_4' => ['image', 'max:3072'],
            'text_post_4' => ['nullable', 'string', 'max:5000'],
            'foto_5' => ['image', 'max:3072'],
            'text_post_5' => ['nullable', 'string', 'max:5000'],
        ]);

        $post = Post::where('id', $valid['post_id'])->first(); // из базы получаем старые данные
        $name_post = $post->name_post;
        $url_foto = $post->url_foto;
        $text_post = $post->text_post_2;
        $url_foto_2 = $post->url_foto_2;
        $text_post_2 = $post->text_post_2;
        $url_foto_3 = $post->url_foto_3;
        $text_post_3 = $post->text_post_3;
        $url_foto_4 = $post->url_foto_4;
        $text_post_4 = $post->text_post_4;
        $url_foto_5 = $post->url_foto_5;
        $text_post_5 = $post->text_post_5;

        $id_user = Auth::user()->id;
        $user_name = Auth::user()->name;

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
            imagejpeg($new_img, Storage::path('bot/images') . $outputFile, 50);
            imagedestroy($img);
            imagedestroy($new_img);
        }

        $name_foto = $id_user . '-' . time() . '.jpg';  // создаем имя для фото
        $name_post = $valid['name_post'];
        $text_post = $request->input('text_post_1');

        if (!empty($valid['foto_1'])) {
            $url_foto = 'storage/app/bot/images/' . '1_' . $name_foto;
            convert_foto($valid['foto_1'], '/1_' . $name_foto);
        }

        if (!empty($request->input('checkbox_1'))) {  // если стоит чекбокс в форме
            $text_post_2 = $valid['text_post_2']; // меняем текст
            if (!empty($valid['foto_2'])) {  // если пришло с формы фото
                $url_foto_2 = 'storage/app/bot/images/' . '2_' . $name_foto; // составляем путь с именем для фото
                convert_foto($valid['foto_2'], '/2_' . $name_foto);  // вызываем функцию и передаем фото и путь
            }
        } else {  // если чекбокс убран то обнуляем фото и текст
            $text_post_2 = null;
            $url_foto_2  = null;
        }

        if (!empty($request->input('checkbox_2'))) {
            $text_post_3 = $valid['text_post_3'];
            if (!empty($valid['foto_3'])) {
                $url_foto_3 = 'storage/app/bot/images/' . '3_' . $name_foto;
                convert_foto($request->foto_3, '/3_' . $name_foto);
            }
        } else {
            $text_post_3 = null;
            $url_foto_3  = null;
        }

        if (!empty($request->input('checkbox_3'))) {
            $text_post_4 = $valid['text_post_4'];
            if (!empty($valid['foto_4'])) {
                $url_foto_4 = 'storage/app/bot/images/' . '4_' . $name_foto;
                convert_foto($request->foto_4, '/4_' . $name_foto);
            }
        } else {
            $text_post_4 = null;
            $url_foto_4  = null;
        }

        if (!empty($request->input('checkbox_4'))) {
            $text_post_5 = $valid['text_post_5'];
            if (!empty($valid['foto_5'])) {
                $url_foto_5 = 'storage/app/bot/images/' . '5_' . $name_foto;
                convert_foto($request->foto_5, '/5_' . $name_foto);
            }
        } else {
            $text_post_5 = null;
            $url_foto_5  = null;
        }

        Post::where('id', $valid['post_id'])
            ->update([
                'name_post' => $name_post,
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
            ]);

        return redirect()->route('cabinet_edit_post', $valid['post_id']);
    }

    // ======================================================================================================
    public function post_delete($id)  // удаляем пост со страницы все посты в кабинете
    {
        Post::where('id', $id)->delete();
        return redirect()->route('cabinet_all_post');
    }
}
