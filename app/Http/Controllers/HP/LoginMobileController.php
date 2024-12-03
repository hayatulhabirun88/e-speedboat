<?php

namespace App\Http\Controllers\HP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginMobileController extends Controller
{

    public function login()
    {
        return view('hp.login');
    }

    public function daftar()
    {
        return view('hp.daftar');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('hp.login');
    }
}
