<div>
    <!-- Modal Tambah-->
    <div class="modal" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel1" aria-hidden="true"
        style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tambahModalLabel1">
                        <h4>{{ $selectedId ? 'Ubah' : 'Tambah' }} Jadwal
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
                                    <label for="speedboat_id"><strong>Nama Speedboat</strong> </label>
                                    <select class="form-control" name="speedboat_id" wire:model="speedboat_id"
                                        id="">
                                        <option value="">Pilih Nama Speedboat</option>
                                        @foreach ($speedboat as $speed)
                                            <option value="{{ $speed->id }}"> {{ $speed->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('speedboat_id')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="berangkat"><strong>Berangkat</strong> </label>
                                    <select class="form-control" name="berangkat" wire:model="berangkat" id="">
                                        <option value="">Pilih Keberangkatan</option>
                                        <option value="Baubau">Baubau</option>
                                        <option value="Wamengkoli">Wamengkoli</option>
                                    </select>
                                    @error('berangkat')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jam_berangkat"><strong>Jam Berangkat</strong> </label>
                                    <input type="time" class="form-control" wire:model="jam_berangkat"
                                        placeholder="Masukan Jam Berangkat ">
                                    @error('jam_berangkat')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tiba"><strong>Tujuan</strong> </label>
                                    <select class="form-control" name="tiba" wire:model="tiba" id="">
                                        <option value="">Pilih Tujuan</option>
                                        <option value="Baubau">Baubau</option>
                                        <option value="Wamengkoli">Wamengkoli</option>
                                    </select>
                                    @error('tiba')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jam_tiba"><strong>Jam Tiba</strong> </label>
                                    <input type="time" class="form-control" wire:model="jam_tiba"
                                        placeholder="Masukan Jam Tiba ">
                                    @error('jam_tiba')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"
                        wire:click.prevent="simpan()">{{ $selectedId ? 'Ubah' : 'Simpan' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jadwal</h3>
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
                                <th>Nama Speedboat</th>
                                <th>Berangkat</th>
                                <th>Jam Berangkat</th>
                                <th>Tiba</th>
                                <th>Jam Tiba</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $key => $jdw)
                                <tr>
                                    <td>{{ $key + $jadwal->firstItem() }}</td>
                                    <td>{{ $jdw->speedboat->nama }}</td>
                                    <td width="200">{{ $jdw->berangkat }}</td>
                                    <td width="200">{{ $jdw->jam_berangkat }}</td>
                                    <td width="200">{{ $jdw->tiba }}</td>
                                    <td width="200">{{ $jdw->jam_tiba }}</td>
                                    <td width="200">
                                        <button data-bs-toggle="modal" data-bs-target="#tambahModal"
                                            class="btn btn-warning" wire:click.prevent="edit('{{ $jdw->id }}')">
                                            Edit </button>
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#hapusModal-{{ $jdw->id }}" class="btn btn-danger">
                                            Hapus</button>
                                    </td>
                                </tr>

                                <div id="hapusModal-{{ $jdw->id }}" class="modal fade" tabindex="-1"
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
                                                    wire:click.prevent="hapus('{{ $jdw->id }}')">
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
                    {{ $jadwal->links() }}
                </div>
            </div> <!-- /.card -->
        </div>
    </div>

</div>
