<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| LoginController
|--------------------------------------------------------------------------
|
| вход, выход с сайта
|
*/

class LoginController extends Controller
{


    // ============================ ОТКЛЮЧИТЬ ПРИ ДЕПЛОЕ =================================================================================================
    public function registerCreate(Request $request) // метод для тестов создания юзера работает с адресом /555
    {
        $vali = ['email' => Str::password(9), 'password' => Str::password(9), 'name' => Str::password(9)];
        info($vali);

        // $validated = $request->validate([
        //     'email' => ['min:5'],
        //     'password' => ['min:5'],
        //     'name' => ['min:3'],
        // ]);
        dump($vali);
       $user = User::create($vali);
       info($user->id);
        // return redirect('/');
    }
    // ---------------------------------------------------
    public function create_token(Request $request)  // метод для тестов  создания токена работает с адресом /3
    {
        $email = 'cQbGUTvvX1';

        $user_data = User::where('email', $email)->first();
        $token = Str::ulid();
        // info($qq);
        $token_hash = Hash::make($token);
        // info($ww);

        User::where('id', $user_data->id)
            ->update([
                "token" => $token_hash
            ]);

        dd(url('/') . '/login_token?email=' . $email . '&token=' . $token);

        return redirect('/');
    }

    // ====================================================================================================================================

    public function register(Request $request)
    {
        return view('register');
    }

    public function login(Request $request)
    {
        return view('login');
    }

    public function authentication(Request $request)  // метод для входа на сайт через страницу логин
    {
        $validated = $request->validate([
            'email' => ['required', 'min:8', 'max:20'],
            'password' => ['required', 'min:8', 'max:20'],
        ]);
        info($validated);
        Auth::attempt($validated, true);
        return redirect('/');
    }

    public function logout(Request $request)  // выход с сайта кнопка на странице кабинет настройки
    {
        Auth::logout();
        return redirect('/');
    }



    public function login_token(Request $request) // вход по одноразовой ссылке с токеном
    {
        $login = $request->input('login');
        $token = $request->input('token');

        $user_data = User::where('email', $login)->first();
        // info($user_data->token);
        if (Hash::check($token, $user_data->token)) Auth::loginUsingId($user_data->id, true);
        else return redirect('/');
        //-------------перезаписываем токен блокируя повторный вход----------------------
        $token = Str::ulid();
        $token_hash = Hash::make($token);
        User::where('id', $user_data->id)
            ->update([
                "token" => $token_hash
            ]);
        return redirect('/');
    }
}
