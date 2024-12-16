<div>
    <!-- Modal Tambah-->
    <div class="modal" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel1" aria-hidden="true"
        style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tambahModalLabel1">
                        <h4>{{ $selectedId ? 'Ubah' : 'Tambah' }} Pemilik
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
                                <div class="mb-3">
                                    <label for="status"><strong>Status</strong> </label>
                                    <select wire:model="status" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                    @error('status')
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
                    <h3 class="card-title">Daftar Pemilik Speedboat</h3>
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
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemilik as $key => $pem)
                                <tr>
                                    <td>{{ $key + $pemilik->firstItem() }}</td>
                                    <td>{{ $pem->nama }}</td>
                                    <td>{{ $pem->umur }}</td>
                                    <td>{{ $pem->alamat }}</td>
                                    <td>{{ $pem->email }}</td>
                                    <td>{{ $pem->status }}</td>
                                    <td width="200">
                                        <button data-bs-toggle="modal" data-bs-target="#tambahModal"
                                            class="btn btn-warning" wire:click.prevent="edit('{{ $pem->id }}')">
                                            Edit </button>
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#hapusModal-{{ $pem->id }}" class="btn btn-danger">
                                            Hapus</button>
                                    </td>
                                </tr>

                                <div id="hapusModal-{{ $pem->id }}" class="modal fade" tabindex="-1"
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
                                                    wire:click.prevent="hapus('{{ $pem->id }}')">
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
                    {{ $pemilik->links() }}
                </div>
            </div> <!-- /.card -->
        </div>
    </div>


</div>
