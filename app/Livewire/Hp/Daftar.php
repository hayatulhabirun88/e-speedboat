<?php

namespace App\Livewire\Hp;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Daftar extends Component
{
    public $nama, $umur, $alamat, $email, $password, $level, $status;

    public function daftar()
    {
        $this->validate([
            'nama' => 'required',
            'umur' => 'required|numeric',
            'alamat' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'level' => 'required|in:pemilik,penumpang',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'alamat.required' => 'Alamat harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.unique' => 'Nomor HP sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Kata sandi minimal harus terdiri dari 6 karakter.',
        ]);

        User::create([
            'nama' => $this->nama,
            'umur' => $this->umur,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'level' => $this->level,
            'status' => $this->level == "pemilik" ? "Tidak Aktif" : "Aktif",
        ]);

        if ($this->level == "pemilik") {
            session()->flash('success', 'Pendaftaran Sukses, Data anda terlebih dahulum dilakukan pengecekan oleh admin!');
        } else {
            session()->flash('success', 'Pendaftaran Sukses, silahkan login!');
        }

        // Redirect to the login page
        return redirect()->route('hp.login');
    }
    public function render()
    {
        return view('livewire.hp.daftar');
    }
}
