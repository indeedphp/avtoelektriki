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
        return view('cabinet_statistic', compact('post_count', 'comments_count'));
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
        if(empty(Draft_post::where('id_user', $id_user)->first())) $draft_post = Draft_post::create(['user_name'=>$user_name, 'id_user'=>$id_user]);
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
                'url_foto_3' => $url_foto_3
            ]);

        return response()->json('eee', 200);
    }



    public function post_delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('cabinet_all_post'); 
    }



}
