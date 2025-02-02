<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LikeCommentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyCommentController;
use App\Http\Controllers\LikeReplyController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CabinetController;
use Illuminate\Support\Facades\DB;
use App\Models\Create_post;
use App\Models\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {

    return view('index');
});

Route::get('/1', function () {
    $create_post = Create_post::where('id_user', '7124124425')->first();
    DB::table('create_posts')
        ->where('id_user', '7124124425')
        ->update(['step' => $create_post->step + 1]);
    // echo $test->id;
    // return view('index');
});

Route::get('/5', function () {

    return view('welcome');
});


Route::get('/api_index', [PostController::class, 'show'])->name('show');

Route::get('/channel/{id}', [ChannelController::class, 'index'])->name('channel');
Route::get('/api_channel/{id}', [ChannelController::class, 'show'])->name('channel_show');
Route::get('/post/{id}', [ChannelController::class, 'index2'])->name('channel');
Route::get('/api_post/{id}', [ChannelController::class, 'show2'])->name('channel_show');

Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet_index');
Route::get('/cabinet_edit_post', [CabinetController::class, 'cabinet_edit_post'])->name('cabinet_edit_post');
Route::post('/cabinet_edit_post', [CabinetController::class, 'edit_post'])->name('cabinet_edit_post2');

Route::get('/likes', [LikeController::class, 'create'])->name('create');

Route::post('/comments', [CommentController::class, 'create'])->name('comments');
Route::put('/comments', [CommentController::class, 'update'])->name('update');
Route::delete('/comments', [CommentController::class, 'delete'])->name('delete');

Route::get('/dislike_comment', [LikeCommentController::class, 'create_dislike'])->name('create_dislike');
Route::get('/like_comment', [LikeCommentController::class, 'create_like'])->name('create_like');

Route::get('/dislike_reply', [LikeReplyController::class, 'create_dislike'])->name('create_dislike_reply');
Route::get('/like_reply', [LikeReplyController::class, 'create_like'])->name('create_like_reply');

Route::post('/reply_comment', [ReplyCommentController::class, 'create'])->name('reply_comment');
Route::put('/reply_comment', [ReplyCommentController::class, 'update'])->name('reply_comment_update');
Route::delete('/reply_comment', [ReplyCommentController::class, 'delete'])->name('reply_comment_delete');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'authentication'])->name('authentication');
Route::post('/register', [LoginController::class, 'registerCreate'])->name('registerCreate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');