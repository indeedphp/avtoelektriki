<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

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
        info($request);
        file_put_contents('22.json', json_encode($request));
        $www = Comment::create($request->only(['comment', 'post_id', 'id_user', 'user_name']));

        // info($www->comment);
        return response()->json($www, 200);
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
        // info($request);
        // $www = Comment::create($request->only(['comment', 'post_id', 'id_user', 'user_name']));

        
        // return response()->json($www, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
