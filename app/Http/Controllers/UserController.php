<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function plogin(Request $request)
    {
        // dd($request);
        if (Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }
        return redirect('login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
}
