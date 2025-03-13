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
    public function create(Request $request)
    {
        // info($request);
        $valid = $request->validate([
            'post_id' => ['required', 'integer', 'max:10000000'],
            'id_user' => ['required', 'integer', 'max:10000000'],
        ]);

        $likes = Like::where('post_id', $valid['post_id'])->where('id_user', $valid['id_user'])->first();

        if (empty($likes)) {
            $www =  Like::create(['post_id' => $valid['post_id'], 'like' => 1, 'id_user' => $valid['id_user']]);
        } else {
            switch ($likes->like) {
                case 0:
                    $likes->update(['like' => 1]);
                    break;
                case 1:
                    $likes->update(['like' => 0]);
                    break;
            }
            $www = Like::where('post_id', $valid['post_id'])->where('id_user', $valid['id_user'])->first();

            info($www . 'rrr');
        }
        return $www->like ;
    }
}
// 'post_id' => '82',
// 'id_user' => 'Ламперсольд Тигуан',