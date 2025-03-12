<?php

namespace App\Http\Controllers;

use App\Models\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| ReplyCommentController
|--------------------------------------------------------------------------
|
| Работа с ответами на комментарии
|
*/


class ReplyCommentController extends Controller
{

    public function create(Request $request)
    {
        info($request);
        $reply = $request->input('reply');
        $comment_id = $request->input('comment_id');
        $id_user = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        if (!empty($request->input('reply_id'))) $reply_id = $request->input('reply_id');
        else $reply_id = 0;
        if (!empty($request->input('name_opponent'))) $name_opponent = $request->input('name_opponent');
        else $name_opponent = 0;

        $db_reply = ReplyComment::create(['reply' => $reply, 'comment_id' => $comment_id, 'user_id' => $user_id, 'id_user' => $id_user,'user_name' => $user_name, 'num' => $reply_id, 'stuff' => $name_opponent]);

        return response()->json($db_reply, 200);
    }


    public function update(Request $request)
    {
        info($request);
        $reply_id = $request->input('reply_id');
        $reply = $request->input('reply');


        DB::table('reply_comments')
            ->where('id', $reply_id)
            ->update(['reply' => $reply]);


        $db_reply = ReplyComment::where('id', $reply_id)->first();

        return response()->json($db_reply, 200);
    }


    public function delete(Request $request)
    {

        $reply_id = $request->input('reply_id');

        ReplyComment::where('num', '=', $reply_id)->delete();
        
        if(ReplyComment::where('id', $reply_id)->exists())ReplyComment::where('id', $reply_id)->delete();

        return response()->json('ok', 200);
    }
}
