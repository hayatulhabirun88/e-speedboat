<div>
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <input type="date" class="form-control" name="cari_jadwal" id="cari_jadwal"
                                aria-describedby="helpId" placeholder="Cari Jadwal" wire:model="cari_jadwal" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" wire:click.prevent="jadwal">Cari</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($tampilJadwal)
        <div class="container mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Speedboat</th>
                                <th>Perjalanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tampilJadwal as $key => $jdwl)
                                @php
                                    $penumpang = \App\Models\Booking::where('jadwal_id', $jdwl->id)
                                        ->where('tgl_keberangkatan', $cari_jadwal)
                                        ->count();
                                    $tersedia = $jdwl->speedboat->kapasitas_muatan - $penumpang;
                                @endphp
                                <tr>
                                    <td>{{ $jdwl->speedboat->nama }}<br> Tersedia {{ $tersedia }} /
                                        {{ $jdwl->speedboat->kapasitas_muatan }}<br>
                                        {{ $cari_jadwal }}
                                    </td>
                                    <td>{{ $jdwl->berangkat }} - {{ $jdwl->tiba }} <br> {{ $jdwl->jam_berangkat }}
                                        -{{ $jdwl->jam_tiba }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info"
                                            wire:click.prevent="pesanSpeedboat({{ $jdwl->id }})">
                                            @if (session()->get('jadwal_id') == $jdwl->id)
                                                Dipesan
                                            @else
                                                Pesan
                                            @endif
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" wire:click.prevent="simpan()">Proses
                            Pemesanan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
