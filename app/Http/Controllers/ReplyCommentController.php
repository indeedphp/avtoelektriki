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
    // ----------------------------------------------------------------------------------------------------------
    public function create(Request $request) // создаем ответ на коментарий
    {
        $valid = $request->validate([
            'reply' => ['required', 'string', 'max:2000'],
            'comment_id' => ['required', 'integer', 'max:1000000'],
            'reply_id' => ['nullable', 'integer', 'max:1000000'],
            'name_opponent' => ['nullable', 'string', 'max:100'],
        ]);

        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        if (!empty($valid['reply_id'])) $reply_id = $valid['reply_id'];
        else $reply_id = 0;
        if (!empty($valid['name_opponent'])) $name_opponent = $valid['name_opponent'];
        else $name_opponent = 0;

        $reply_comment = ReplyComment::create([
            'reply' => $valid['reply'],
            'comment_id' => $valid['comment_id'],
            'user_id' => $user_id,
            'user_name' => $user_name,
            'num' => $reply_id,
            'stuff' => $name_opponent
        ]);

        return response()->json($reply_comment, 200);
    }
    // ----------------------------------------------------------------------------------------------------------
    public function update(Request $request) // обновляем ответ на коментарий
    {
        $valid = $request->validate([
            'reply' => ['required', 'string', 'max:2000'],
            'reply_id' => ['required', 'integer', 'max:10000000'],
        ]);

        DB::table('reply_comments')
            ->where('id', $valid['reply_id'])
            ->update(['reply' => $valid['reply']]);

        $db_reply = ReplyComment::where('id', $valid['reply_id'])->first();

        return response()->json($db_reply, 200);
    }
    // ----------------------------------------------------------------------------------------------------------
    public function delete(Request $request) // удаляем ответ на коментарий
    {
        $valid = $request->validate([
            'reply_id' => ['required', 'integer', 'max:10000000'],
        ]);
        ReplyComment::where('num', '=', $valid['reply_id'])->delete();
        if (ReplyComment::where('id', $valid['reply_id'])->exists()) ReplyComment::where('id', $valid['reply_id'])->delete();

        return response()->json('ok', 200);
    }
}
