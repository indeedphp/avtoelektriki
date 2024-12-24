<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
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
Route::get('/', [PostController::class, 'show'])->name('show');


Route::get('/1', function () {
    // DB::table('create_posts')
    // ->where('id_post', "660")
    // ->delete(); 

info('eeee');

// $id = DB::table('posts')->insertGetId([
//     'user_name' => 'create_pos',
//     'name_post' => 'create_post',
//     'id_user' => '3453',
//     'id_post' => '43',
// ]);

$test = Post::create([
    'user_name' => 'create_pos',
    'name_post' => 'create_post',
    'id_user' => '3453',
    'id_post' => '43',
])->first();
var_dump($test);
// echo $test->id;
    // return view('index');
}); 

        // $id = $this->message->toArray();

        // file_put_contents('1.json', json_encode($id));


        // Create_post::create(['user_name' => $user_name, 'name_post' => $text, 'id_user' => $id_user, 'id_post' => $id_post, 'date' => $date]);

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::post('/login', [LoginController::class, 'authentication'])->name('authentication');
Route::post('/register', [LoginController::class, 'registerCreate'])->name('registerCreate');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');