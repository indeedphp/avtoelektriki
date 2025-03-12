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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_dislike(Request $request)
    {
        // info($request . 'dislike');
        $comment_id = $request->get('comment_id');
        $id_user = $request->get('id_user');
        $likes = LikeComment::where('comment_id', $comment_id)->where('id_user', $id_user)->first();

        info($likes);

        if (empty($likes)) {
            $www =  LikeComment::create(['comment_id' => $comment_id, 'dislike' => 1, 'id_user' => $id_user]);
        } else {
            switch ($likes->dislike) {
                case 0:
                    $likes->update(['dislike' => 1]);
                    break;
                case 1:
                    $likes->update(['dislike' => 0]);
                    break;
            }

            $www = LikeComment::where('comment_id', $comment_id)->where('id_user', $id_user)->first();

            info($www . 'dislike');
        }
        return $www->dislike ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_like(Request $request)
    {
        info($request . 'like');
        $comment_id = $request->get('comment_id');
        $id_user = $request->get('id_user');
        $likes = LikeComment::where('comment_id', $comment_id)->where('id_user', $id_user)->first();

        info($likes);

        if (empty($likes)) {
            $www =  LikeComment::create(['comment_id' => $comment_id, 'like' => 1, 'id_user' => $id_user]);
        } else {
            switch ($likes->like) {
                case 0:
                    $likes->update(['like' => 1]);
                    break;
                case 1:
                    $likes->update(['like' => 0]);
                    break;
            }

            $www = LikeComment::where('comment_id', $comment_id)->where('id_user', $id_user)->first();

            // info($www . 'like');
        }
        return $www->like ;
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeComment $likeComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeComment $likeComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LikeComment $likeComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeComment $likeComment)
    {
        //
    }
}
