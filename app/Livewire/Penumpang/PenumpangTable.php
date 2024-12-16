<?php

namespace App\Livewire\Penumpang;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class PenumpangTable extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $nama, $umur, $alamat, $email, $password, $level, $selectedId;

    public $isOpen = false;

    public function tambah()
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->selectedId = null;
    }

    private function resetInputFields()
    {
        $this->nama = '';
        $this->umur = '';
        $this->alamat = '';
        $this->email = '';
        $this->password = '';
        $this->level = 'pemilik';
    }

    public function simpan()
    {

        $this->validate([
            'nama' => 'required|string|max:100',
            'umur' => 'required|integer|min:1|max:120',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->selectedId,
            'password' => $this->selectedId ? 'nullable|min:8' : 'required|min:8',
        ], [
            // Pesan validasi dalam Bahasa Indonesia
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 100 karakter.',

            'umur.required' => 'Umur wajib diisi.',
            'umur.integer' => 'Umur harus berupa angka.',
            'umur.min' => 'Umur minimal adalah 1 tahun.',
            'umur.max' => 'Umur maksimal adalah 120 tahun.',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        if ($this->selectedId) {
            $user = User::find($this->selectedId);
            $user->nama = $this->nama;
            $user->umur = $this->umur;
            $user->alamat = $this->alamat;
            $user->email = $this->email;

            if ($this->password) {
                $user->password = Hash::make($this->password);
            }

            $user->level = 'pemilik';
            $user->save();

            session()->flash('success', 'Data pemilik berhasil diubah.');
        } else {
            User::create([
                'nama' => $this->nama,
                'umur' => $this->umur,
                'alamat' => $this->alamat,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'level' => 'pemilik',
            ]);

            $this->resetInputFields();
            session()->flash('success', 'Data pemilik berhasil disimpan.');
        }


    }

    public function resetData()
    {
        $this->resetInputFields();
        $this->isOpen = false;
        $this->selectedId = null;
    }

    public function hapus($id)
    {
        User::find($id)->delete();
        session()->flash('success', 'Data pemilik Berhasil Dihapus.');
        $this->isOpen = false;
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->isOpen = true;

        $this->selectedId = $id;
        $user = User::findOrFail($id);
        $this->nama = $user->nama;
        $this->umur = $user->umur;
        $this->alamat = $user->alamat;
        $this->email = $user->email;


    }
    public function render()
    {
        $penumpang = User::where('level', 'penumpang')->latest()->paginate(10);
        return view('livewire.penumpang.penumpang-table', compact(['penumpang']));
    }
}
