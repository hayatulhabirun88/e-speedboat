<?php

namespace App\Livewire\Hp;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginIndex extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Kata sandi harus diisi.',
        'password.min' => 'Kata sandi harus minimal 6 karakter.',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            if (Auth::user()->level === 'admin') { //
                Auth::logout();
                session()->flash('error', 'Login tidak diizinkan untuk akun admin.');
                return redirect()->route('hp.login');
            }

            // Periksa jika status pengguna tidak aktif
            if (Auth::user()->status !== 'Aktif') {
                Auth::logout();
                session()->flash('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
                return redirect()->route('hp.login');
            }

            session()->regenerate();
            return redirect()->intended('/hp/dashboard');
        }

        session()->flash('error', 'Email atau kata sandi salah.');
    }
    public function render()
    {
        return view('livewire.hp.login-index');
    }
}
