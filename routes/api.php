<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/', function () { // простешее апи из массива
//     return ['user' => 'bob'];
//     });

    Route::get('/', function () {  // апи, из базы берем все
        return App\Models\Test::orderBy('id', 'desc')->cursorPaginate(5);


        });