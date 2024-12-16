<?php

namespace App\Livewire\Hp;

use App\Models\Jadwal;
use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class PemesananTable extends Component
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

    public function simpan()
    {

        $booking = Booking::where('user_id', auth()->user()->id)->where('tgl_keberangkatan', Session::get('tgl_pemesanan'))->where('jadwal_id', Session::get('jadwal_id'))->first();
        if ($booking) {
            session()->flash('error', 'Data Pemesanan sudah ada, jika ingin membatalkan masuk ke menu transaksi.');
            return;
        }
        Booking::create([
            'user_id' => auth()->user()->id,
            'tgl_keberangkatan' => Session::get('tgl_pemesanan'),
            'jadwal_id' => Session::get('jadwal_id'),
            'status' => 'butuh konfirmasi',
        ]);

        $this->resetInputFields();

        session()->flash('success', 'Data Pemesanan berhasil diproses.');
        return redirect()->route('hp.transaksi.transaksi');

    }

    private function resetInputFields()
    {
        $this->cari_jadwal = '';
        $this->tampilJadwal = [];
        Session::forget('tgl_pemesanan');
        Session::forget('jadwal_id');
    }

    public function render()
    {
        return view('livewire.hp.pemesanan-table');
    }
}
