<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Booking;
use App\Models\Speedboat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jadwalspeedboat = Jadwal::count();
        $pemesanan = Booking::count();
        $pemilik = \App\Models\User::where('level', 'pemilik')->count();
        $jumlahspeedboat = Speedboat::count();
        return view('home.home', compact(['jadwalspeedboat', 'pemesanan', 'pemilik', 'jumlahspeedboat']));
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
