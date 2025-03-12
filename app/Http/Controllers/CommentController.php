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

    public function create(Request $request)
    {

        $comment = $request->input('comment');
        $post_id = $request->input('post_id');
        // info();
        $id_user = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;

        $post = Post::where('id', $post_id)->first();
        $user = User::find($post->id_user);
        Notification::send($user, new ComplaintNotification(['message' => $comment, 'post_id' => $post_id, 'type' => 'Коментарий на ваш пост:']));
        $db_comment = Comment::create(['comment' => $comment, 'post_id' => $post_id, 'user_id' => $user_id, 'id_user' => $id_user, 'user_name' => $user_name]);

        return response()->json($db_comment, 200);
    }

    public function update(Request $request)
    {
        info($request);
        $comment = $request->input('comment');
        $comment_id = $request->input('comment_id');
        $text_comment = $request->input('text_comment');

        DB::table('comments')
            ->where('id', $comment_id)
            ->update(['comment' => $text_comment]);

            $db_comment = Comment::where('id', $comment_id)->first();

        return response()->json($db_comment, 200);
    }


    public function delete(Request $request)
    {
        $comment_id = $request->input('comment_id');

        ReplyComment::where('comment_id', '=', $comment_id)->delete();
        Comment::find($request->input('comment_id'))->delete();

        return response()->json('ok', 200);
    }
}
