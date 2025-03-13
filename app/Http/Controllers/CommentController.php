<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ReplyComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Notification;  // подключаем фасад Notification
use App\Notifications\ComplaintNotification;  // подключаем нотификацию для жалоб
/*
|--------------------------------------------------------------------------
| CommentController
|--------------------------------------------------------------------------
|
| коментарии на посты 
|
*/

class CommentController extends Controller
{
    // ----------------------------------------------------------------------------------------------------------
    public function create(Request $request)  // создаем комментарий на пост
    {

        $valid = $request->validate([
            'comment' => ['required', 'string', 'max:2000'],
            'post_id' => ['required', 'integer', 'max:1000000'],
        ]);

        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;

        $post = Post::where('id', $valid['post_id'])->first();
        $user = User::find($post->id_user);
        Notification::send($user, new ComplaintNotification([
            'message' => $valid['comment'],
            'post_id' => $valid['post_id'],
            'type' => 'Коментарий на ваш пост:'
        ]));
        $comment = Comment::create([
            'comment' => $valid['comment'],
            'post_id' => $valid['post_id'],
            'user_id' => $user_id,
            'user_name' => $user_name
        ]);

        return response()->json($comment, 200);
    }
    // ----------------------------------------------------------------------------------------------------------
    public function update(Request $request)  // обновляем комментарий на пост
    {
        $valid = $request->validate([
            'text_comment' => ['required', 'string', 'max:2000'],
            'comment_id' => ['required', 'integer', 'max:10000000'],
        ]);

        DB::table('comments')
            ->where('id', $valid['comment_id'])
            ->update(['comment' => $valid['text_comment']]);

        $db_comment = Comment::where('id', $valid['comment_id'])->first();

        return response()->json($db_comment, 200);
    }
    // ----------------------------------------------------------------------------------------------------------
    public function delete(Request $request)  // удаляем комментарий
    {
        $valid = $request->validate([
            'comment_id' => ['required', 'integer', 'max:10000000'],
        ]);
        ReplyComment::where('comment_id', '=', $valid['comment_id'])->delete();  // так же удаляем все ответы на комментарий
        Comment::find($valid['comment_id'])->delete();

        return response()->json('ok', 200);
    }
}
