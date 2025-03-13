<?php

namespace App\Http\Controllers;

use App\Models\LikeComment;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| LikeCommentController
|--------------------------------------------------------------------------
|
| лайки, дизлаки на комментарии
|
*/

class LikeCommentController extends Controller
{
    // --------------------------------------------------------------------------------------------------------------
    public function create_dislike(Request $request) // создание, снятие дизлайка
    {
        $valid = $request->validate([
            'comment_id' => ['required', 'integer', 'max:10000000'],
            'id_user' => ['required', 'integer', 'max:10000000'],
        ]);

        $likes = LikeComment::where('comment_id', $valid['comment_id'])->where('id_user', $valid['id_user'])->first();

        if (empty($likes)) {
            $www =  LikeComment::create(['comment_id' => $valid['comment_id'], 'dislike' => 1, 'id_user' => $valid['id_user']]);
        } else {
            switch ($likes->dislike) {
                case 0:
                    $likes->update(['dislike' => 1]);
                    break;
                case 1:
                    $likes->update(['dislike' => 0]);
                    break;
            }

            $www = LikeComment::where('comment_id', $valid['comment_id'])->where('id_user', $valid['id_user'])->first();

        }
        return $www->dislike ;
    }
    // --------------------------------------------------------------------------------------------------------------
    public function create_like(Request $request) // создание, снятие лайка
    {
        $valid = $request->validate([
            'comment_id' => ['required', 'integer', 'max:10000000'],
            'id_user' => ['required', 'integer', 'max:10000000'],
        ]);

        $likes = LikeComment::where('comment_id', $valid['comment_id'])->where('id_user', $valid['id_user'])->first();

        if (empty($likes)) {
            $www =  LikeComment::create(['comment_id' => $valid['comment_id'], 'like' => 1, 'id_user' => $valid['id_user']]);
        } else {
            switch ($likes->like) {
                case 0:
                    $likes->update(['like' => 1]);
                    break;
                case 1:
                    $likes->update(['like' => 0]);
                    break;
            }

            $www = LikeComment::where('comment_id', $valid['comment_id'])->where('id_user', $valid['id_user'])->first();

        }
        return $www->like ;
    }

}
