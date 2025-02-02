<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class CabinetController extends Controller
{
    public function index()
    {
        return view('cabinet');
    }

    public function cabinet_edit_post()
    {

        $post = Post::where('id', '=', '7')->first();

        // dump($post);
        return view('cabinet_edit_post', compact('post'));
    }


    public function edit_post(Request $request)
    {
        info($request);
        $reply_id = '7';
        // $reply_id = $request->input('reply_id');
        $name_post = $request->input('name_post');



        DB::table('posts')
            ->where('id', $reply_id)
            ->update([
                'name_post' => $name_post,
                'text_post' => $name_post,
                'text_post_2' => $name_post,
                'text_post_3' => $name_post
            ]);



        return response()->json('eee', 200);
    }
}
