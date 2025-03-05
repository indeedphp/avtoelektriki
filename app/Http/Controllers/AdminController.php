<?php

namespace App\Http\Controllers;

use App\Models\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Site;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;  // подключаем фасад
use App\Notifications\ComplaintNotification;  // подключаем нотификацию

/*
|--------------------------------------------------------------------------
| AdminController
|--------------------------------------------------------------------------
|
| админка сайта
|
*/

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/index');
    }

    public function show_settings()
    {
        return view('admin/settings');
    }

    public function show_statistics()
    {
        $post = Post::all();
        $post_count = count($post);
        $comment = Comment::all();
        $comment_count = count($comment);
        $user = User::all();
        $user_count = count($user);
        $site = Site::all();
        $site_count = count($site);

        $addr = url('/');

        function get_dir_size($directory)
        {
            $size = 0;
            $files = glob($directory . '/*');
            $count_files = count($files);
            foreach ($files as $path) {
                is_file($path) && $size += filesize($path);
                is_dir($path)  && $size += get_dir_size($path);
            }
            return [$size, $count_files];
        }
        $size = get_dir_size('/var/www/avtoelektriki/storage/app/bot/images');
        // info(round($size/1024/1024, 2));
        $size_file = round($size[0] / 1024 / 1024, 2);
        $count_files =  $size[1];
        return view('admin/statistics', compact('post_count', 'comment_count', 'user_count', 'site_count', 'size_file', 'addr', 'count_files'));
    }

    public function show_users(Request $request)
    {
        // info($request);
        $count = 50;
        if (!empty($request->count)) $count = $request->count;
        $sort = 'desc';
        if ($request->sorting == 'date_cr_desc') {
            $users = User::orderBy('created_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_cr_asc') {
            $users = User::orderBy('created_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'date_up_desc') {
            $users = User::orderBy('updated_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_up_asc') {
            $users = User::orderBy('updated_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'activ_desc') {
            $users = User::orderBy('activ', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'activ_asc') {
            $users = User::orderBy('activ', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'id_desc') {
            $users = User::orderBy('id', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'id_asc') {
            $users = User::orderBy('id', 'asc')->paginate($count);
            $sort = 'desc';
        } else if (isset($request->id_search)) {
            $users = User::where('id', $request->id_search)->paginate($count);
        } else if (isset($request->date_cr_search)) {
            $date = Carbon::create($request->date_cr_search);
            $users = User::whereYear('created_at', $date->format('Y'))->whereMonth('created_at', $date->format('m'))->paginate($count);
        } else if (isset($request->date_up_search)) {
            $date = Carbon::create($request->date_up_search);
            $users = User::whereYear('updated_at', $date->format('Y'))->whereMonth('updated_at', $date->format('m'))->paginate($count);
        } else if (isset($request->name_search)) {
            $users = User::where('name', $request->name_search)->paginate($count);
        } else {
            // $users = User::orderBy('id', 'asc')->paginate($count);
            $users = User::paginate($count);
            // $users = User::orderBy('id', 'desc')->get();
        }

        $users->count = $count;
        // dump($users->currentPage());
        // $users->links('vendor.pagination.bootstrap-4', ['count' => $count]);

        // dd($users->count());

        // $users = User::all();
        return view('admin/users', compact('users', 'sort', 'count'));
    }

    public function show_posts(Request $request)
    {
        info($request);
        $count = 50;
        if (!empty($request->count)) $count = $request->count;
        $sort = 'desc';
        if ($request->sorting == 'date_cr_desc') {
            $posts = Post::orderBy('created_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_cr_asc') {
            $posts = Post::orderBy('created_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'date_up_desc') {
            $posts = Post::orderBy('updated_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_up_asc') {
            $posts = Post::orderBy('updated_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'activ_desc') {
            $posts = Post::orderBy('stuff', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'activ_asc') {
            $posts = Post::orderBy('stuff', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'id_user_desc') {
            $posts = Post::orderBy('id_user', 'asc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'id_user_asc') {
            $posts = Post::orderBy('id_user', 'desc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'id_desc') {
            $posts = Post::orderBy('id', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'id_asc') {
            $posts = Post::orderBy('id', 'asc')->paginate($count);
            $sort = 'desc';
        } else if (isset($request->id_search)) {
            $posts = Post::where('id', $request->id_search)->paginate($count);
        } else if (isset($request->id_user_search)) {
            $posts = Post::where('id_user', $request->id_user_search)->paginate($count);
        } else if (isset($request->date_cr_search)) {
            $date = Carbon::create($request->date_cr_search);
            $posts = Post::whereYear('created_at', $date->format('Y'))->whereMonth('created_at', $date->format('m'))->whereDay('created_at', $date->format('d'))->paginate($count);
        } else if (isset($request->date_up_search)) {
            $date = Carbon::create($request->date_up_search);
            $posts = Post::whereYear('updated_at', $date->format('Y'))->whereMonth('updated_at', $date->format('m'))->whereDay('updated_at', $date->format('d'))->paginate($count);
        } else if (isset($request->name_post_search)) {
            $posts = Post::where('name_post', $request->name_post_search)->paginate($count);
        } else {
            // $posts = Post::orderBy('id', 'asc')->paginate($count);
            $posts = Post::paginate($count);
            // $posts = Post::orderBy('id', 'desc')->get();
        }

        $posts->count = $count;
        info($posts);

        // $posts = Post::all();
        return view('admin/posts', compact('posts', 'sort', 'count'));
    }

    public function show_comments(Request $request)
    {
        info($request);
        $count = 50;
        if (!empty($request->count)) $count = $request->count;
        $sort = 'desc';
        if ($request->sorting == 'date_cr_desc') {
            $comments = Comment::orderBy('created_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_cr_asc') {
            $comments = Comment::orderBy('created_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'date_up_desc') {
            $comments = Comment::orderBy('updated_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_up_asc') {
            $comments = Comment::orderBy('updated_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'activ_desc') {
            $comments = Comment::orderBy('activ', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'user_id_desc') {
            $comments = Comment::orderBy('user_id', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'user_id_asc') {
            $comments = Comment::orderBy('user_id', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'post_id_desc') {
            $comments = Comment::orderBy('post_id', 'asc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'post_id_asc') {
            $comments = Comment::orderBy('post_id', 'desc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'activ_asc') {
            $comments = Comment::orderBy('activ', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'id_desc') {
            $comments = Comment::orderBy('id', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'id_asc') {
            $comments = Comment::orderBy('id', 'asc')->paginate($count);
            $sort = 'desc';
        } else if (isset($request->id_search)) {
            $comments = Comment::where('id', $request->id_search)->paginate($count);
        } else if (isset($request->user_id_search)) {
            $comments = Comment::where('user_id', $request->user_id_search)->paginate($count);
        } else if (isset($request->post_id_search)) {
            $comments = Comment::where('post_id', $request->post_id_search)->paginate($count);
        } else if (isset($request->date_cr_search)) {
            $date = Carbon::create($request->date_cr_search);
            $comments = Comment::whereYear('created_at', $date->format('Y'))->whereMonth('created_at', $date->format('m'))->whereDay('created_at', $date->format('d'))->paginate($count);
        } else if (isset($request->date_up_search)) {
            $date = Carbon::create($request->date_up_search);
            $comments = Comment::whereYear('updated_at', $date->format('Y'))->whereMonth('updated_at', $date->format('m'))->whereDay('updated_at', $date->format('d'))->paginate($count);
        } else if (isset($request->name_search)) {
            $comments = Comment::where('user_name', $request->name_search)->paginate($count);
        } else {
            // $comments = Comment::orderBy('id', 'asc')->paginate($count);
            $comments = Comment::paginate($count);
            // $comments = Comment::orderBy('id', 'desc')->get();
        }

        $comments->count = $count;  // для шаблона пвгинации
        info($comments);

        // $comments = Comment::all();
        return view('admin/comments', compact('comments', 'sort', 'count'));
    }


    public function show_replys(Request $request)
    {
        info($request);
        $count = 50;
        if (!empty($request->count)) $count = $request->count;
        $sort = 'desc';
        if ($request->sorting == 'date_cr_desc') {
            $replys = ReplyComment::orderBy('created_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_cr_asc') {
            $replys = ReplyComment::orderBy('created_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'date_up_desc') {
            $replys = ReplyComment::orderBy('updated_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_up_asc') {
            $replys = ReplyComment::orderBy('updated_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'activ_desc') {
            $replys = ReplyComment::orderBy('activ', 'asc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'activ_asc') {
            $replys = ReplyComment::orderBy('activ', 'desc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'user_id_desc') {
            $replys = ReplyComment::orderBy('user_id', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'user_id_asc') {
            $replys = ReplyComment::orderBy('user_id', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'comment_id_desc') {
            $replys = ReplyComment::orderBy('comment_id', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'comment_id_asc') {
            $replys = ReplyComment::orderBy('comment_id', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'id_desc') {
            $replys = ReplyComment::orderBy('id', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'id_asc') {
            $replys = ReplyComment::orderBy('id', 'asc')->paginate($count);
            $sort = 'desc';
        } else if (isset($request->id_search)) {
            $replys = ReplyComment::where('id', $request->id_search)->paginate($count);
        } else if (isset($request->user_id_search)) {
            $replys = ReplyComment::where('user_id', $request->user_id_search)->paginate($count);
        } else if (isset($request->comment_id_search)) {
            $replys = ReplyComment::where('comment_id', $request->comment_id_search)->paginate($count);
        } else if (isset($request->date_cr_search)) {
            $date = Carbon::create($request->date_cr_search);
            $replys = ReplyComment::whereYear('created_at', $date->format('Y'))->whereMonth('created_at', $date->format('m'))->whereDay('created_at', $date->format('d'))->paginate($count);
        } else if (isset($request->date_up_search)) {
            $date = Carbon::create($request->date_up_search);
            $replys = ReplyComment::whereYear('updated_at', $date->format('Y'))->whereMonth('updated_at', $date->format('m'))->whereDay('updated_at', $date->format('d'))->paginate($count);
        } else if (isset($request->name_search)) {
            $replys = ReplyComment::where('user_name', $request->name_search)->paginate($count);
        } else {
            // $replys = ReplyComment::orderBy('id', 'asc')->paginate($count);
            $replys = ReplyComment::paginate($count);
            // $replys = ReplyComment::orderBy('id', 'desc')->get();
        }

        $replys->count = $count;  // для шаблона пвгинации
        info($replys);

        // $replys = ReplyComment::all();
        return view('admin/replys', compact('replys', 'sort', 'count'));
    }

    public function show_sites(Request $request)
    {
        info($request);
        $count = 50;
        if (!empty($request->count)) $count = $request->count;
        $sort = 'desc';
        if ($request->sorting == 'date_cr_desc') {
            $sites = Site::orderBy('created_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_cr_asc') {
            $sites = Site::orderBy('created_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'date_up_desc') {
            $sites = Site::orderBy('updated_at', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'date_up_asc') {
            $sites = Site::orderBy('updated_at', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'activ_desc') {
            $sites = Site::orderBy('active', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'activ_asc') {
            $sites = Site::orderBy('active', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'id_desc') {
            $sites = Site::orderBy('id', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'id_asc') {
            $sites = Site::orderBy('id', 'asc')->paginate($count);
            $sort = 'desc';
        } else if ($request->sorting == 'id_user_desc') {
            $sites = Site::orderBy('id_user', 'desc')->paginate($count);
            $sort = 'asc';
        } else if ($request->sorting == 'id_user_asc') {
            $sites = Site::orderBy('id_user', 'asc')->paginate($count);
            $sort = 'desc';
        } else if (isset($request->id_search)) {
            $sites = Site::where('id', $request->id_search)->paginate($count);
        } else if (isset($request->id_user_search)) {
            $sites = Site::where('id_user', $request->id_user_search)->paginate($count);
        } else if (isset($request->date_cr_search)) {
            $date = Carbon::create($request->date_cr_search);
            $sites = Site::whereYear('created_at', $date->format('Y'))->whereMonth('created_at', $date->format('m'))->whereDay('created_at', $date->format('d'))->paginate($count);
        } else if (isset($request->date_up_search)) {
            $date = Carbon::create($request->date_up_search);
            $sites = Site::whereYear('updated_at', $date->format('Y'))->whereMonth('updated_at', $date->format('m'))->whereDay('updated_at', $date->format('d'))->paginate($count);
        } else if (isset($request->name_search)) {
            $sites = Site::where('heading', $request->name_search)->paginate($count);
        } else {
            // $sites = Site::orderBy('id', 'asc')->paginate($count);
            $sites = Site::paginate($count);
            // $sites = Site::orderBy('id', 'desc')->get();
        }

        $sites->count = $count;  // для шаблона пвгинации
        info($sites);

        // $sites = Site::all();
        return view('admin/sites', compact('sites', 'sort', 'count'));
    }


    public function update_user(Request $request, $id, $activ)
    {
        $id_user = Auth::user()->id;
        if ($id_user <= 10) {
            User::where('id', $id)
                ->update([
                    "activ" => $activ
                ]);
            // редиректим для показа заданного количества и конкретной страницы
            return redirect()->route('admin_users', ['page' => $request->page, 'count' => $request->count]);
        } else return redirect()->route('index');
    }

    public function update_post(Request $request, $id, $activ)
    {
        $id_user = Auth::user()->id;
        if ($id_user <= 10) {
            Post::where('id', $id)
                ->update([
                    "stuff" => $activ
                ]);
            // редиректим для показа заданного количества и конкретной страницы
            return redirect()->route('admin_posts', ['page' => $request->page, 'count' => $request->count]);
        } else return redirect()->route('index');
    }

    public function update_comment(Request $request, $id, $activ)
    {
        $id_user = Auth::user()->id;
        if ($id_user <= 10) {
            Comment::where('id', $id)
                ->update([
                    "activ" => $activ
                ]);
            // редиректим для показа заданного количества и конкретной страницы
            return redirect()->route('admin_comments', ['page' => $request->page, 'count' => $request->count]);
        } else return redirect()->route('index');
    }
    public function update_reply(Request $request, $id, $activ)
    {
        $id_user = Auth::user()->id;
        if ($id_user <= 10) {
            ReplyComment::where('id', $id)
                ->update([
                    "activ" => $activ
                ]);
            // редиректим для показа заданного количества и конкретной страницы
            return redirect()->route('admin_replys', ['page' => $request->page, 'count' => $request->count]);
        } else return redirect()->route('index');
    }
    public function update_site(Request $request, $id, $activ)
    {
        $id_user = Auth::user()->id;
        if ($id_user <= 10) {
            Site::where('id', $id)
                ->update([
                    "active" => $activ
                ]);
            // редиректим для показа заданного количества и конкретной страницы
            return redirect()->route('admin_sites', ['page' => $request->page, 'count' => $request->count]);
        } else return redirect()->route('index');
    }


// -------------------------------------------------------------------------------------
    public function create_complaint(Request $request) // создаем жалобу на посты комменты и ответы комментов для админки
    {
        info($request);

        // 'id' => '62',  // приходит айди либо поста либо коментария либо ответа на комментарий
        // 'essence' => '1',  // 1-пост, 2-комментарий , 3- ответ на комментарий
        // 'user_id' => '2',  // айди юзера отправившего жалобу
        // 'complaint' => 'tfytututuu',  // текст жалобы

        $validated = $request->validate([
            'complaint' => ['string', 'max:100'],
        ]);

        $user = User::find(2);
        Notification::send($user, new ComplaintNotification($validated['complaint']));  // используем ларавел нотмфикации ComplaintNotification

        return response()->json('ok', 200);
    }
}
