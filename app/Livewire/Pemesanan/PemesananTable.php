<?php

namespace App\Livewire\Pemesanan;

use livewire;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PemesananTable extends Component
{

    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $nama, $umur, $alamat, $email, $password, $level, $selectedId, $cari_jadwal;

    public $tampilJadwal = [];

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
        $this->cari_jadwal = '';
        $this->tampilJadwal = [];
        Session::forget('tgl_pemesanan');
        Session::forget('jadwal_id');
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

            $user->level = 'penumpang';
            $user->save();

            Booking::created([
                'user_id' => $user->id,
                'tgl_keberangkatan' => Session::get('tgl_pemesanan'),
                'jadwal_id' => Session::get('jadwal_id'),
                'status' => 'butuh konfirmasi',
            ]);

            session()->flash('success', 'Data Penumpang berhasil diubah.');
        } else {
            $user = User::create([
                'nama' => $this->nama,
                'umur' => $this->umur,
                'alamat' => $this->alamat,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'level' => 'penumpang',
            ]);

            Booking::create([
                'user_id' => $user->id,
                'tgl_keberangkatan' => Session::get('tgl_pemesanan'),
                'jadwal_id' => Session::get('jadwal_id'),
                'status' => 'butuh konfirmasi',
            ]);

            $this->resetInputFields();


            session()->flash('success', 'Data Pemesanan berhasil disimpan.');
        }


    }

    public function resetData()
    {
        $this->resetInputFields();
        $this->isOpen = false;
        $this->selectedId = null;
        Session::forget('tgl_pemesanan');
        Session::forget('jadwal_id');
        $this->tampilJadwal = [];
    }

    public function hapus($id)
    {

        $pemesanan = Booking::findOrFail($id);

        if ($pemesanan->user_id !== null) {
            // Hapus pengguna terkait jika ada
            User::find($pemesanan->user_id)?->delete(); // Menggunakan null-safe operator untuk mencegah error jika user tidak ditemukan
        }

        // Hapus pemesanan
        $pemesanan->delete();

        // Set pesan sukses
        session()->flash('success', 'Data Pemesanan Berhasil Dihapus.');
        $this->isOpen = false;
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->isOpen = true;

        $this->selectedId = $id;
        $booking = Booking::findOrFail($id);
        $this->nama = $booking->user->nama;
        $this->umur = $booking->user->umur;
        $this->alamat = $booking->user->alamat;
        $this->email = $booking->user->email;


    }

    public function pesanSpeedboat($id)
    {
        $pemesanan = Booking::where('jadwal_id', $id)->where('tgl_keberangkatan', $this->cari_jadwal)->count();
        $jadwal = Jadwal::find($id);
        $kapasitas = $jadwal ? $jadwal->speedboat->kapasitas_muatan : 0;
        if ($pemesanan < $kapasitas) {
            # code...
            Session::put('tgl_pemesanan', $this->cari_jadwal);
            Session::put('jadwal_id', $id);
        } else {
            session()->flash('info', 'Melebihi Kapasitas Penumpang. silahkan cari jadwal lain');
        }

    }

    public function tolak($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'tolak';
        $booking->save();
        session()->flash('success', 'Pemesanan berhasil ditolak.');
        $this->resetData();
    }
    public function terima($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'terima';
        $booking->save();
        session()->flash('success', 'Pemesanan berhasil diterima.');
        $this->resetData();
    }

    public function jadwal()
    {
        $this->validate([
            'cari_jadwal' => 'required',
        ]);

        $this->tampilJadwal = Jadwal::all();
    }
    public function render()
    {
        $pemesanan = Booking::latest()->paginate(10);
        return view('livewire.pemesanan.pemesanan-table', compact(['pemesanan']));
    }
}
