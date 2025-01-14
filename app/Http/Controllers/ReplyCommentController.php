<?php

namespace App\Http\Controllers;

use App\Models\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReplyCommentController extends Controller
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
    public function create(Request $request)
    {
               info($request->all());
               $reply = $request->input('reply');
               $comment_id = $request->input('comment_id');
               $id_user = Auth::user()->name;
               $user_name = Auth::user()->user_name;

               $db_reply = ReplyComment::create(['reply' => $reply, 'comment_id' => $comment_id, 'id_user' => $id_user ,'user_name' => $user_name]);

        // file_put_contents('22.json', json_encode($request));
   

        // info($www->comment);
        return response()->json($db_reply, 200);
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
    public function show(ReplyComment $replyComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReplyComment $replyComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        info($request);
        $reply_id = $request->input('reply_id');
        $reply = $request->input('reply');


        DB::table('reply_comments')
            ->where('id', $reply_id)
            ->update(['reply' => $reply]);


            $db_reply = ReplyComment::where('id', $reply_id)->first();

            // info($db_comment);

        return response()->json($db_reply, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        info($request);
        ReplyComment::find($request->input('reply_id'))->delete();

        return response()->json('ok', 200);
    }
}
