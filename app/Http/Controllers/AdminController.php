<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/index');
    }

        public function show_all_users(Request $request)
    {
        info($request);
        $count = 50;
        if (!empty($request->count))$count = $request->count;
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
            $users = User::where('id', $request->id_search)->get();
        } else if (isset($request->date_cr_search)) {
            $date = Carbon::create($request->date_cr_search);
            $users = User::whereYear('created_at', $date->format('Y'))->whereMonth('created_at', $date->format('m'))->get();
        } else if (isset($request->date_up_search)) {
            $date = Carbon::create($request->date_up_search);
            $users = User::whereYear('updated_at', $date->format('Y'))->whereMonth('updated_at', $date->format('m'))->get();
        } else if (isset($request->name_search)) {
            $users = User::where('name', $request->name_search)->get();
        } else {
            $users = User::orderBy('id', 'desc')->paginate($count);
            
            // $users = User::orderBy('id', 'desc')->get();
        }


// info($users);

        // $users = User::all();
        return view('admin/all_users', compact('users', 'sort', 'count'));
    }
}
// $users = User::whereMonth('created_at', $startDate->format('m'))
// ->whereDay('created_at', '>=', $startDate->format('d'))
// ->whereDay('created_at', '<=', $endDate->format('d'))
// ->get();