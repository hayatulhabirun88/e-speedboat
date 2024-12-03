<?php

namespace App\Livewire\Jadwal;

use App\Models\Jadwal;
use Livewire\Component;
use App\Models\Speedboat;
use Livewire\WithPagination;

class JadwalTable extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $berangkat, $jam_berangkat, $tiba, $jam_tiba, $speedboat_id, $selectedId;

    public $isOpen = false;

    public function tambah()
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->selectedId = null;
    }

    private function resetInputFields()
    {
        $this->berangkat = '';
        $this->jam_berangkat = '';
        $this->tiba = '';
        $this->jam_tiba = '';
        $this->speedboat_id = '';
    }

    public function simpan()
    {

        $this->validate([
            'speedboat_id' => 'required|numeric',
            'berangkat' => 'required',
            'jam_berangkat' => 'required',
            'tiba' => 'required',
            'jam_tiba' => 'required',
        ]);

        if ($this->selectedId) {
            $jadwal = Jadwal::find($this->selectedId);
            $jadwal->berangkat = $this->berangkat;
            $jadwal->jam_berangkat = $this->jam_berangkat;
            $jadwal->tiba = $this->tiba;
            $jadwal->jam_tiba = $this->jam_tiba;
            $jadwal->speedboats_id = $this->speedboat_id;
            $jadwal->save();
            session()->flash('success', 'Data Jadwal Berhasil Diubah.');
        } else {
            Jadwal::create([
                'berangkat' => $this->berangkat,
                'jam_berangkat' => $this->jam_berangkat,
                'tiba' => $this->tiba,
                'jam_tiba' => $this->jam_tiba,
                'speedboats_id' => $this->speedboat_id,
            ]);
            $this->resetInputFields();
            session()->flash('success', 'Data Jadwal Berhasil Disimpan.');
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
        Jadwal::find($id)->delete();
        session()->flash('success', 'Data Jadwal Berhasil Dihapus.');
        $this->isOpen = false;
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->isOpen = true;

        $this->selectedId = $id;
        $jadwal = Jadwal::findOrFail($id);
        $this->berangkat = $jadwal->berangkat;
        $this->jam_berangkat = $jadwal->jam_berangkat;
        $this->tiba = $jadwal->tiba;
        $this->jam_tiba = $jadwal->jam_tiba;
        $this->speedboat_id = $jadwal->speedboats_id;

    }

    public function render()
    {
        $jadwal = Jadwal::paginate(10);
        $speedboat = Speedboat::all();
        return view('livewire.jadwal.jadwal-table', compact(['jadwal', 'speedboat']));
    }
}
