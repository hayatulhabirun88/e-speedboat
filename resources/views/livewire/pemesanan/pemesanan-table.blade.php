<div>
    <!-- Modal Tambah-->
    <div class="modal" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel1" aria-hidden="true"
        style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tambahModalLabel1">
                        <h4>{{ $selectedId ? 'Ubah' : 'Tambah' }} Pemesanan
                        </h4>
                    </h4>
                    <button wire:click.prevent="resetData()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"></span></button>

                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            @if (session()->has('success'))
                                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama"><strong>Nama </strong> </label>
                                    <input type="text" class="form-control" wire:model="nama"
                                        placeholder="Masukan Nama Lengkap ">
                                    @error('nama')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email"><strong>Email</strong> </label>
                                    <input type="email" class="form-control" wire:model="email"
                                        placeholder="Masukan email ">
                                    @error('email')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password"><strong>Password</strong> </label>
                                    <input type="password" class="form-control" wire:model="password"
                                        placeholder="Masukan Password ">
                                    @error('password')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="umur"><strong>Umur</strong> </label>
                                    <input type="text" class="form-control" wire:model="umur"
                                        placeholder="Masukan Umur ">
                                    @error('umur')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat"><strong>Alamat</strong> </label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" wire:model="alamat"
                                        placeholder="Masukan Alamat"></textarea>
                                    @error('alamat')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cari_jadwal"><strong>Cari Jadwal </strong> </label>
                                    <input type="date" class="form-control" wire:model="cari_jadwal"
                                        placeholder="Cari Jadwal ">
                                    @error('cari_jadwal')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button wire:click.prevent="jadwal()" class="btn btn-sm btn-primary mt-4">Cari</button>
                            </div>
                            @if (session()->has('info'))
                                <div class="alert alert-info bg-danger text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{ session('info') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <table table="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama Speedboat</th>
                                        <th>Tanggal</th>
                                        <th>Berangkat</th>
                                        <th>Jam Berangkat</th>
                                        <th>Tiba</th>
                                        <th>Jam Tiba</th>
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
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $jdwl->speedboat->nama }}<br> Tersedia {{ $tersedia }} /
                                                {{ $jdwl->speedboat->kapasitas_muatan }}</td>
                                            <td>{{ $cari_jadwal }}</td>
                                            <td>{{ $jdwl->berangkat }}</td>
                                            <td>{{ $jdwl->jam_berangkat }}</td>
                                            <td>{{ $jdwl->tiba }}</td>
                                            <td>{{ $jdwl->jam_tiba }}</td>
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
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" wire:click.prevent="simpan()">Proses
                        Pemesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Daftar Speedboat</h3>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahModal" wire:click.prevent="tambah">
                            Tambah
                        </button>
                    </div>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Speedboat</th>
                                <th>Berangkat</th>
                                <th>Tiba</th>
                                <th>Konfirmasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanan as $key => $pesanan)
                                <tr>
                                    <td>{{ $key + $pemesanan->firstItem() }}</td>
                                    <td>{{ @$pesanan->user->nama }}</td>
                                    <td>{{ @$pesanan->user->umur }}</td>
                                    <td>{{ @$pesanan->jadwal->speedboat->nama }} <br>
                                        {{ $pesanan->tgl_keberangkatan }}
                                    </td>
                                    <td>{{ @$pesanan->jadwal->berangkat }}<br>
                                        {{ @$pesanan->jadwal->jam_berangkat }}</>
                                    <td>{{ @$pesanan->jadwal->tiba }}<br>
                                        {{ @$pesanan->jadwal->jam_tiba }}</td>
                                    <td>
                                        @if ($pesanan->status == 'terima')
                                            <button class="btn btn-sm btn-success"
                                                wire:click.prevent="tolak({{ $pesanan->id }})"> Status
                                                Diterima</button>
                                        @elseif($pesanan->status == 'tolak')
                                            <button class="btn btn-sm btn-danger"
                                                wire:click.prevent="terima({{ $pesanan->id }})"> Status
                                                Ditolak</button>
                                        @else
                                            <button class="btn btn-sm btn-danger"
                                                wire:click.prevent="tolak({{ $pesanan->id }})">Tolak</button> <button
                                                class="btn btn-sm btn-primary"
                                                wire:click.prevent="terima({{ $pesanan->id }})">Terima</button>
                                        @endif


                                    </td>
                                    <td width="180">
                                        <button data-bs-toggle="modal" data-bs-target="#tambahModal"
                                            class="btn btn-sm btn-warning"
                                            wire:click.prevent="edit('{{ $pesanan->id }}')">
                                            <i class="bi bi-pencil-square"></i> </button>
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#hapusModal-{{ $pesanan->id }}"
                                            class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i></button>
                                        {{-- <a href="" class="btn btn-sm btn-info">Cetak Tiket</a> --}}
                                    </td>
                                </tr>

                                <div id="hapusModal-{{ $pesanan->id }}" class="modal fade" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Hapus Data
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin akan menghapus data ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button wire:click.prevent="resetData()" type="button"
                                                    class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button data-bs-dismiss="modal" type="button" class="btn btn-danger"
                                                    wire:click.prevent="hapus('{{ $pesanan->id }}')">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $pemesanan->links() }}
                </div>
            </div> <!-- /.card -->
        </div>
    </div>


</div>
