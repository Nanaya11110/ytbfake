<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
class LoginController extends Controller
{
    public function show()
    {
        //dd(Hash::make('123'));
        return view('Login.login');
    }

    public function authenticate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' =>'required|email',
        'password' => 'required|max:255',
         ])->validate();
    if (Auth::attempt(request()->only(['email','password'])))
    {
        // Authentication passed...
        return redirect()->route('home');
    } else {
        // Authentication failed...
        return redirect()->route('login')->with("error", "Wrong Input");
    }
}
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
