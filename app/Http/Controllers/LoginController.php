<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function register(Request $request)
    {
        return view('register');
    }

    public function login(Request $request)
    {
        return view('login');
    }

    public function registerCreate(Request $request)
    {
        $vali = ['email' => Str::password(9), 'password' => Str::password(9), 'name' => Str::password(9)];
        info($vali);

        // $validated = $request->validate([
        //     'email' => ['min:5'],
        //     'password' => ['min:5'],
        //     'name' => ['min:3'],
        // ]);
        // dd($validated);
        User::create($vali);
        return redirect('/');
    }

    public function authentication(Request $request)
    {
        $validated = $request->validate([
            'email' => ['min:5'],
            'password' => ['min:5'],
        ]);
        info($validated);
        Auth::attempt($validated);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function create_token(Request $request)
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

    public function login_token(Request $request) // вход по токену
    {
        $email = $request->input('email');
        $token = $request->input('token');

        $user_data = User::where('email', $email)->first();
        // info($user_data->token);
        if (Hash::check($token, $user_data->token)) Auth::loginUsingId($user_data->id);
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
