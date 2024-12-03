<?php

use App\Http\Controllers\HP\HomeMobileController;
use App\Http\Controllers\HP\JadwalMobileController;
use App\Http\Controllers\HP\LoginMobileController;
use App\Http\Controllers\HP\PemesananMobileController;
use App\Http\Controllers\HP\TransaksiMobileController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PenumpangController;
use App\Http\Controllers\SpeedboatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/daftar', [LoginController::class, 'registrasi'])->name('auth.daftar');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');
Route::get('/speedboat', [SpeedboatController::class, 'index'])->name('speedboat.index');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
Route::get('/penumpang', [PenumpangController::class, 'index'])->name('penumpang.index');
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
Route::get('/keluar', [HomeController::class, 'logout'])->name('logout');

Route::get('/hp/login', [LoginMobileController::class, 'login'])->name('hp.login');
Route::get('/hp/daftar', [LoginMobileController::class, 'daftar'])->name('hp.daftar');
Route::get('/hp/logout', [LoginMobileController::class, 'logout'])->name('hp.logout');
Route::get('/hp/dashboard', [HomeMobileController::class, 'index'])->name('hp.dashboard');
Route::get('/hp/pemesanan', [PemesananMobileController::class, 'index'])->name('hp.pemesanan.pemesanan');
Route::get('/hp/jadwal', [JadwalMobileController::class, 'index'])->name('hp.jadwal.jadwal');
Route::get('/hp/transaksi', [TransaksiMobileController::class, 'index'])->name('hp.transaksi.transaksi');



