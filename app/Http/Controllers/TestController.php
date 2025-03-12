<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\View\View;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| TestController
|--------------------------------------------------------------------------
|
| тесты не из ларавел и пр.
|
*/

class TestController extends Controller
{
    public function index(): View
    {
        return view('user.index', [
            'users' => Test::table('users')->paginate(5)
        ]);
    }
}
