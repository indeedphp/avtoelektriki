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
use App\Http\Controllers\DraftPostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
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
Route::get('/post/{id}', [ChannelController::class, 'index2'])->name('channel2');
Route::get('/api_post/{id}', [ChannelController::class, 'show2'])->name('channel_show');

Route::get('/cabinet_settings', [CabinetController::class, 'settings_show'])->name('cabinet_settings');
Route::get('/cabinet_statistic', [CabinetController::class, 'statistic_show'])->name('cabinet_statistic');
Route::get('/cabinet_all_post', [CabinetController::class, 'all_post_show'])->name('cabinet_all_post');
Route::get('/cabinet_edit_post', [CabinetController::class, 'edit_post_show'])->name('cabinet_edit_post');
Route::get('/cabinet_all_post_edit/{id}', [CabinetController::class, 'all_post_edit'])->name('cabinet_all_post_edit');
Route::get('/cabinet_new_post', [CabinetController::class, 'new_post_create'])->name('cabinet_new_post');
Route::delete('/cabinet_all_post_delete/{id}', [CabinetController::class, 'post_delete'])->name('cabinet_all_post_delete');
Route::post('/cabinet_edit_post', [CabinetController::class, 'edit_post'])->name('cabinet_edit_post2');
Route::post('/cabinet_new_post', [CabinetController::class, 'new_post'])->name('cabinet_new_post2');
Route::put('/cabinet_settings', [CabinetController::class, 'settings_edit'])->name('cabinet_settings_edit');

Route::get('/draft_post/{id}', [DraftPostController::class, 'index'])->name('draft_index');  // черновик поста покахываем
Route::post('/draft_post', [DraftPostController::class, 'draft_post_create'])->name('draft_post_create'); // создаем черновик поста
Route::get('/draft_post_in_post/{id}', [DraftPostController::class, 'draft_post_in_post'])->name('draft_post_in_post'); // 

Route::get('/cabinet_site/{id}', [SiteController::class, 'index'])->name('site_index');
Route::get('/site/{id}', [SiteController::class, 'show'])->name('site_show');
Route::post('/site', [SiteController::class, 'site_create'])->name('site_create'); // создаем 

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




// ==================================================================================================

Route::get('/admin_index', [AdminController::class, 'index'])->name('admin_index')->middleware('auth');
Route::get('/admin_users', [AdminController::class, 'show_users'])->name('admin_users')->middleware('auth');
Route::get('/admin_posts', [AdminController::class, 'show_posts'])->name('admin_posts')->middleware('auth');
Route::get('/admin_comments', [AdminController::class, 'show_comments'])->name('admin_comments')->middleware('auth');
Route::get('/admin_replys', [AdminController::class, 'show_replys'])->name('admin_replys')->middleware('auth');
Route::get('/admin_sites', [AdminController::class, 'show_sites'])->name('admin_sites')->middleware('auth');
Route::get('/admin_settings', [AdminController::class, 'show_settings'])->name('admin_settings')->middleware('auth');
Route::get('/admin_statistics', [AdminController::class, 'show_statistics'])->name('admin_statistics')->middleware('auth');
