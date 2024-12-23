<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;  
use App\Models\User;  
use Illuminate\Http\Request;

class LoginController extends Controller
{

public function register(Request $request){
return view('register');
}

public function login(Request $request){
return view('login');
}

public function registerCreate(Request $request)
{
    $validated = $request->validate([
        'email' => ['min:5'],
        'password' => ['min:5'],
        'name' => ['min:3'],
        ]);
// dd($validated);
User::create($validated);
return redirect('login');
}

public function authentication(Request $request)
{
    $validated = $request->validate([
        'email' => ['min:5'],
        'password' => ['min:5'],
        ]);
Auth::attempt($validated);
return redirect('/');
}

public function logout(Request $request){
Auth::logout();
return redirect('/');
}

}
