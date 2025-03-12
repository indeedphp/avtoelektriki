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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Notification;  // подключаем фасад Notification
use App\Notifications\ComplaintNotification;  // подключаем нотификацию для жалоб
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

// Route::get('/', function () {
//     return view('index');
// })->name('index');

// Route::get('/1', function () {
//     // auth()->loginUsingId(5);
//     $qq =   Str::ulid();
//     info($qq);

//     $ww = Hash::make($qq);
//     info($ww);
//     return view('index');
// });



Route::get('/55', function () {
   dd(storage_path('app')); 
    return view('welcome');
});

Route::get('/5', function () {
    $user = User::find(2);
Notification::send($user, new ComplaintNotification('privet user2'));
  
});
Route::get('/7', function () {
    $user = User::find(2);
    
    print_r($user->unreadNotifications);
    
});


// Route::get('/7', function () {
//     info(url('/'));
//     // dump(Hash::check('01JM9XCK17FN37NJ8R08QJ49NT', '$2y$12$sKNr1/X3Buqb9i8bw1bFm.QcsH/ihLH/PjSY1nVQWafx4fxdYxrPK'));
//     //    dump(password_verify('123', '123'));


//     // return redirect('/');
// });


Route::get('/555', [LoginController::class, 'registerCreate'])->name('registerCreate');
Route::get('/3', [LoginController::class, 'create_token'])->name('create_token');
Route::get('/login_token', [LoginController::class, 'login_token'])->name('login_token');

Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/api_index', [PostController::class, 'show'])->name('show');

Route::get('/channel/{id}', [ChannelController::class, 'index'])->name('channel');
Route::get('/api_channel/{id}', [ChannelController::class, 'show'])->name('channel_show');
Route::get('/post/{id}', [ChannelController::class, 'index2'])->name('channel2');
Route::get('/api_post/{id}', [ChannelController::class, 'show2'])->name('channel_show');

Route::get('/cabinet_settings', [CabinetController::class, 'settings_show'])->name('cabinet_settings')->middleware('auth');
Route::get('/cabinet_statistic', [CabinetController::class, 'statistic_show'])->name('cabinet_statistic')->middleware('auth');
Route::get('/cabinet_all_post', [CabinetController::class, 'all_post_show'])->name('cabinet_all_post')->middleware('auth');
Route::get('/cabinet_edit_post/{id_post?}', [CabinetController::class, 'edit_post_show'])->name('cabinet_edit_post')->middleware('auth');
Route::get('/cabinet_all_post_edit/{id}', [CabinetController::class, 'all_post_edit'])->name('cabinet_all_post_edit')->middleware('auth');
Route::get('/cabinet_new_post', [CabinetController::class, 'new_post_show'])->name('cabinet_new_post')->middleware('auth');
Route::delete('/cabinet_all_post_delete/{id}', [CabinetController::class, 'post_delete'])->name('cabinet_all_post_delete');
Route::post('/cabinet_edit_post', [CabinetController::class, 'edit_post'])->name('cabinet_edit_post2');
Route::post('/cabinet_new_post', [CabinetController::class, 'new_post'])->name('cabinet_new_post2');
Route::put('/cabinet_settings', [CabinetController::class, 'edit_name'])->name('cabinet_settings_edit_name');
Route::put('/cabinet_settings_2', [CabinetController::class, 'edit_login'])->name('cabinet_settings_edit_login');
Route::put('/cabinet_settings_3', [CabinetController::class, 'edit_password'])->name('cabinet_settings_edit_password');
Route::put('/cabinet_settings_4', [CabinetController::class, 'edit_color_channel'])->name('cabinet_settings_edit_color_channel');
Route::put('/cabinet_settings_5', [CabinetController::class, 'edit_definition_channel'])->name('cabinet_settings_edit_definition_channel');
Route::put('/cabinet_settings_6', [CabinetController::class, 'edit_name_channel'])->name('cabinet_settings_edit_name_channel');
Route::put('/cabinet_settings_7', [CabinetController::class, 'edit_sity'])->name('cabinet_settings_edit_sity');

Route::get('/cabinet_site', [SiteController::class, 'index'])->name('site_index')->middleware('auth');
Route::get('/site/{id}', [SiteController::class, 'show'])->name('site_show');
Route::post('/site', [SiteController::class, 'site_create'])->name('site_create'); // создаем 
Route::put('/cabinet_site', [SiteController::class, 'reset_site'])->name('reset_site'); // создаем 



Route::get('/draft_post/{id}', [DraftPostController::class, 'index'])->name('draft_index');  // черновик поста показываем
Route::get('/draft_post_bot/{id}', [DraftPostController::class, 'show_post_bot'])->name('draft_post_bot');  // черновик поста бота показываем
Route::post('/draft_post', [DraftPostController::class, 'draft_post_create'])->name('draft_post_create'); // создаем черновик поста
Route::get('/draft_post_in_post/{id}', [DraftPostController::class, 'draft_post_in_post'])->name('draft_post_in_post'); // из черновика делаем пост
Route::get('/draft_post_clear/{id}', [DraftPostController::class, 'clear_draft_post'])->name('draft_post_clear'); // чистим черновик


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
// Route::post('/register', [LoginController::class, 'registerCreate'])->name('registerCreate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');




// ==================================================================================================

Route::get('/admin_index', [AdminController::class, 'index'])->name('admin_index')->middleware('auth');
Route::get('/admin_complaints', [AdminController::class, 'show_complaints'])->name('admin_complaints')->middleware('auth');
Route::get('/admin_users', [AdminController::class, 'show_users'])->name('admin_users')->middleware('auth');
Route::get('/admin_posts', [AdminController::class, 'show_posts'])->name('admin_posts')->middleware('auth');
Route::get('/admin_comments', [AdminController::class, 'show_comments'])->name('admin_comments')->middleware('auth');
Route::get('/admin_replys', [AdminController::class, 'show_replys'])->name('admin_replys')->middleware('auth');
Route::get('/admin_sites', [AdminController::class, 'show_sites'])->name('admin_sites')->middleware('auth');
Route::get('/admin_settings', [AdminController::class, 'show_settings'])->name('admin_settings')->middleware('auth');
Route::get('/admin_statistics', [AdminController::class, 'show_statistics'])->name('admin_statistics')->middleware('auth');

Route::get('/admin_user_update/{id}/{activ}', [AdminController::class, 'update_user'])->name('admin_user_update')->middleware('auth');
Route::get('/admin_post_update/{id}/{activ}', [AdminController::class, 'update_post'])->name('admin_post_update')->middleware('auth');
Route::get('/admin_comment_update/{id}/{activ}', [AdminController::class, 'update_comment'])->name('admin_comment_update')->middleware('auth');
Route::get('/admin_reply_update/{id}/{activ}', [AdminController::class, 'update_reply'])->name('admin_reply_update')->middleware('auth');
Route::get('/admin_site_update/{id}/{activ}', [AdminController::class, 'update_site'])->name('admin_site_update')->middleware('auth');
Route::post('/admin_create_complaint', [AdminController::class, 'create_complaint'])->name('admin_complaint_create');