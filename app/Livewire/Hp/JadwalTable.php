<?php

namespace App\Livewire\Hp;

use App\Models\Jadwal;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class JadwalTable extends Component
{

    public $cari_jadwal;
    public $tampilJadwal = [];
    public function jadwal()
    {
        $this->tampilJadwal = [];
        Session::forget('tgl_pemesanan');
        Session::forget('jadwal_id');

        $this->validate([
            'cari_jadwal' => 'required',
        ]);

        $this->tampilJadwal = Jadwal::all();
    }
    public function render()
    {
        return view('livewire.hp.jadwal-table');
    }
}
