<?php

namespace App\Http\Controllers\HP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalMobileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('hp.jadwal.jadwal');
    }

}
