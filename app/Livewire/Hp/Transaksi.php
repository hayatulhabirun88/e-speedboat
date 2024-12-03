<?php

namespace App\Livewire\Hp;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Transaksi extends Component
{
    public function batal($id)
    {
        Booking::findOrFail($id)?->delete();
        session()->flash('success', 'Pemesanan berhasil dibatalkan');
    }

    public function tolak($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'tolak';
        $booking->save();
        session()->flash('success', 'Pemesanan berhasil ditolak.');
    }
    public function terima($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'terima';
        $booking->save();
        session()->flash('success', 'Pemesanan berhasil diterima.');
    }


    public function render()
    {
        if (auth()->user()->level == 'pemilik') {
            $query = Booking::with(['jadwal'])
                ->whereHas('jadwal', function ($query) {
                    $query->whereHas('speedboat', function ($query) {
                        $query->where('user_id', auth()->user()->id);
                    });
                });
        } elseif (auth()->user()->level == 'penumpang') {
            $query = Booking::where('user_id', auth()->user()->id);
        }

        $pemesanan = $query->latest()->paginate(10);
        return view('livewire.hp.transaksi', compact(['pemesanan']));
    }
}
