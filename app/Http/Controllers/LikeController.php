<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
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
        $id_post = $request->get('id_post');
        $id_user = $request->get('id_user');
        $likes = Like::where('id_post', $id_post)->first();
        info($request);
        if (empty($likes)) {
            $www = Like::create(['id_post' => $id_post, 'like' => 1, 'id_user' => $id_user]);
            $www = $www->like;
        } else {
            switch ($likes->like) {
                case 0:
                    $likes->update(['like' => 1]);
                    break;
                case 1:
                    $likes->update(['like' => 0]);
                    break;
            }

            $www = Like::where('id_post', $id_post)->first();
            $www = $www->like;
            info($www . 'rrr');
        }
        return $www;

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
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}

