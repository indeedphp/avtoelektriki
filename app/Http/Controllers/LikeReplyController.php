<?php

namespace App\Http\Controllers;

use App\Models\LikeReply;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| LikeReplyController
|--------------------------------------------------------------------------
|
| лайки, поставленные на ответы к комментариям
|
*/

class LikeReplyController extends Controller
{
    // --------------------------------------------------------------------------------------------------------------
    public function create_dislike(Request $request)
    {
        $valid = $request->validate([
            'reply_id' => ['required', 'integer', 'max:10000000'],
            'id_user' => ['required', 'integer', 'max:10000000'],
        ]);

        $likes = LikeReply::where('reply_comment_id', $valid['reply_id'])->where('id_user', $valid['id_user'])->first();

        if (empty($likes)) {
            $www =  LikeReply::create(['reply_comment_id' => $valid['reply_id'], 'dislike' => 1, 'id_user' => $valid['id_user']]);
        } else {
            switch ($likes->dislike) {
                case 0:
                    $likes->update(['dislike' => 1]);
                    break;
                case 1:
                    $likes->update(['dislike' => 0]);
                    break;
            }
            $www = LikeReply::where('reply_comment_id', $valid['reply_id'])->where('id_user', $valid['id_user'])->first();
        }
        return $www->dislike;
    }
    // --------------------------------------------------------------------------------------------------------------
    public function create_like(Request $request)
    {
        $valid = $request->validate([
            'reply_id' => ['required', 'integer', 'max:10000000'],
            'id_user' => ['required', 'integer', 'max:10000000'],
        ]);
        $likes = LikeReply::where('reply_comment_id', $valid['reply_id'])->where('id_user', $valid['id_user'])->first();

        if (empty($likes)) {
            $www =  LikeReply::create(['reply_comment_id' => $valid['reply_id'], 'like' => 1, 'id_user' => $valid['id_user']]);
        } else {
            switch ($likes->like) {
                case 0:
                    $likes->update(['like' => 1]);
                    break;
                case 1:
                    $likes->update(['like' => 0]);
                    break;
            }
            $www = LikeReply::where('reply_comment_id', $valid['reply_id'])->where('id_user', $valid['id_user'])->first();
        }
        return $www->like;
    }
}
