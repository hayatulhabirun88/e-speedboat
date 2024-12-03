<div>
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Speedboat</th>
                                <th>Berangkat</th>
                                <th>Tiba</th>
                                <th>Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanan as $key => $item)
                                <tr>
                                    <td>{{ $key + $pemesanan->firstItem() }}</td>
                                    <td>{{ $item->jadwal->speedboat->nama }}<br>
                                        {{ $item->tgl_keberangkatan }}

                                    </td>
                                    <td>{{ $item->jadwal->berangkat }}<br>
                                        {{ $item->jadwal->jam_berangkat }}
                                    </td>
                                    <td>{{ $item->jadwal->tiba }}<br>
                                        {{ $item->jadwal->jam_tiba }}
                                    </td>
                                    <td>
                                        @if (auth()->user()->level == 'penumpang')
                                            @if ($item->status == 'terima')
                                                <span class="btn btn-sm btn-success">{{ $item->status }}</span>
                                            @elseif ($item->status == 'tolak')
                                                <span class="btn btn-sm btn-danger">{{ $item->status }}</span>
                                            @else
                                                <span class="btn btn-sm btn-warning">{{ $item->status }}</span>
                                            @endif
                                            @if ($item->status !== 'terima')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    wire:click.prevent="batal({{ $item->id }})">Batal</button>
                                            @endif
                                        @else
                                            @if ($item->status == 'terima')
                                                <button class="btn btn-sm btn-success"
                                                    wire:click.prevent="tolak({{ $item->id }})"> Status
                                                    Diterima</button>
                                            @elseif($item->status == 'tolak')
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click.prevent="terima({{ $item->id }})"> Status
                                                    Ditolak</button>
                                            @else
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click.prevent="tolak({{ $item->id }})">Tolak</button>
                                                <button class="btn btn-sm btn-primary"
                                                    wire:click.prevent="terima({{ $item->id }})">Terima</button>
                                            @endif
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pemesanan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
