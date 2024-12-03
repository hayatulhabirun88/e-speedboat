<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpeedboatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('speedboat.speedboat');
    }
}
