<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\BooleanAnd;

/*
|--------------------------------------------------------------------------
| LikeController
|--------------------------------------------------------------------------
|
| лайки, на посты
|
*/

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
        $post_id = $request->get('post_id');
        $id_user = $request->get('id_user');
        $likes = Like::where('post_id', $post_id)->where('id_user', $id_user)->first();

        info($likes);

        if (empty($likes)) {
            $www =  Like::create(['post_id' => $post_id, 'like' => 1, 'id_user' => $id_user]);
        } else {
            switch ($likes->like) {
                case 0:
                    $likes->update(['like' => 1]);
                    break;
                case 1:
                    $likes->update(['like' => 0]);
                    break;
            }

            $www = Like::where('post_id', $post_id)->where('id_user', $id_user)->first();

            info($www . 'rrr');
        }
        return $www->like ;

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


// if($likes == null) {
//     $www = Like::create(['post_id' => $post_id, 'like' => 1, 'id_user' => $id_user]);
// }else{
//     // dd($likes);
//     info($likes);

// // foreach($likes as $like){
// //     // dd($like);
//    if($likes->id_user !== $id_user ) {
//     $www = Like::create(['post_id' => $post_id, 'like' => 1, 'id_user' => $id_user]);

// // }