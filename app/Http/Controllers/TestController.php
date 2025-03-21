<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;

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
    public function index()
    {
//         list($microseconds, $seconds) = explode(' ', microtime());
// $milliseconds = str_replace('0.', '', $microseconds);
// echo date('Y-m-d H:i:s') . '.' . $milliseconds;
// DB::table('tests')->insert( ['user_name' => 1] );
// Statistic::create(['index' => 5])->first();










// $lastActionTime = Test::where('id', $userId)->first()->last_action_at;
// $currentDate = Carbon::now();

// if ($currentDate->isAfter(Carbon::parse($lastActionTime)->endOfDay())) {
//     // Сделать что-то, если наступили новые сутки
// }



    }
}
