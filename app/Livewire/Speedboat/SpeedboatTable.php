<?php

namespace App\Livewire\Speedboat;

use App\Models\User;
use Livewire\Component;
use App\Models\Speedboat;
use Livewire\WithPagination;

class SpeedboatTable extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $namaSpeedboat, $kapasitas, $selectedId, $user;

    public $isOpen = false;

    public function tambah()
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->selectedId = null;
    }

    private function resetInputFields()
    {
        $this->namaSpeedboat = '';
        $this->kapasitas = '';
    }

    public function simpan()
    {

        $this->validate([
            'namaSpeedboat' => 'required',
            'kapasitas' => 'required|numeric',
            'user' => 'required|numeric',
        ]);

        if ($this->selectedId) {
            $speedboat = Speedboat::find($this->selectedId);
            $speedboat->nama = $this->namaSpeedboat;
            $speedboat->kapasitas_muatan = $this->kapasitas;
            $speedboat->user_id = $this->user;
            $speedboat->save();
            session()->flash('success', 'Data Speedboat Berhasil Diubah.');
        } else {
            Speedboat::create([
                'nama' => $this->namaSpeedboat,
                'kapasitas_muatan' => $this->kapasitas,
                'user_id' => $this->user,
            ]);
            $this->resetInputFields();
            session()->flash('success', 'Data Speedboat Berhasil Disimpan.');
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
        Speedboat::find($id)->delete();
        session()->flash('success', 'Data Speedboat Berhasil Dihapus.');
        $this->isOpen = false;
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->isOpen = true;

        $this->selectedId = $id;
        $speedboat = Speedboat::findOrFail($id);
        $this->namaSpeedboat = $speedboat->nama;
        $this->kapasitas = $speedboat->kapasitas_muatan;
        $this->user = $speedboat->user_id;


    }

    public function render()
    {
        $speedboat = Speedboat::paginate(10);
        $pemilik = User::where('level', 'pemilik')->get();
        return view('livewire.speedboat.speedboat-table', compact(['speedboat', 'pemilik']));
    }
}
