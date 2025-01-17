<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ReplyComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**$likes->update($request->only(['like','dislike']));
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // info($request->all());
        // file_put_contents('22.json', json_encode($request));
        $comment = $request->input('comment');
        $post_id = $request->input('post_id');
        $id_user = Auth::user()->name;
        $user_name = Auth::user()->user_name;

        $db_comment = Comment::create(['comment' => $comment, 'post_id' => $post_id, 'id_user' => $id_user, 'user_name' => $user_name]);


        // $db_comment = Comment::create($request->only(['comment', 'post_id', 'id_user', 'user_name']));

        // info($www->comment);
        return response()->json($db_comment, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        info($request);
        $comment = $request->input('comment');
        $comment_id = $request->input('comment_id');
        $text_comment = $request->input('text_comment');

        // $comment = Comment::find($comment_id);
        // $comment->comment = $comment;  // в колонке титле меняем запись на новую
        // $comment->save();  // сохраняем



        DB::table('comments')
            ->where('id', $comment_id)
            ->update(['comment' => $text_comment]);


            $db_comment = Comment::where('id', $comment_id)->first();

            // info($db_comment);

        return response()->json($db_comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $comment_id = $request->input('comment_id');

        ReplyComment::where('comment_id', '=', $comment_id)->delete();
        Comment::find($request->input('comment_id'))->delete();

        return response()->json('ok', 200);
    }
}
