<div>
    <!-- Modal Tambah-->
    <div class="modal" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel1" aria-hidden="true"
        style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tambahModalLabel1">
                        <h4>{{ $selectedId ? 'Ubah' : 'Tambah' }} Kapasitas
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
                                    <label for="namaSpeedboat"><strong>Nama Speedboat</strong> </label>
                                    <input type="text" class="form-control" wire:model="namaSpeedboat"
                                        placeholder="Masukan Nama Speedboat ">
                                    @error('namaSpeedboat')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kapasitas"><strong>Kapasitas</strong> </label>
                                    <input type="text" class="form-control" wire:model="kapasitas"
                                        placeholder="Masukan Nama Kapasitas ">
                                    @error('kapasitas')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="user"><strong>Pemilik</strong> </label>
                                    <select name="user" id="user" class="form-control" wire:model="user">
                                        <option value="">Pilih Pemilik</option>
                                        @foreach ($pemilik as $pem)
                                            <option value="{{ $pem->id }}">{{ $pem->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('user')
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
                                <th>Nama Speedboat</th>
                                <th>Kapasitas</th>
                                <th>Pemilik</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($speedboat as $key => $speed)
                                <tr>
                                    <td>{{ $key + $speedboat->firstItem() }}</td>
                                    <td>{{ $speed->nama }}</td>
                                    <td width="200">{{ $speed->kapasitas_muatan }}</td>
                                    <td width="200">{{ @$speed->user->nama }}</td>
                                    <td width="200">
                                        <button data-bs-toggle="modal" data-bs-target="#tambahModal"
                                            class="btn btn-warning" wire:click.prevent="edit('{{ $speed->id }}')">
                                            Edit </button>
                                        <button data-bs-toggle="modal" data-bs-target="#hapusModal-{{ $speed->id }}"
                                            class="btn btn-danger">
                                            Hapus</button>
                                    </td>
                                </tr>

                                <div id="hapusModal-{{ $speed->id }}" class="modal fade" tabindex="-1"
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
                                                    wire:click.prevent="hapus('{{ $speed->id }}')">
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
                    {{ $speedboat->links() }}
                </div>
            </div> <!-- /.card -->
        </div>
    </div>


</div>
