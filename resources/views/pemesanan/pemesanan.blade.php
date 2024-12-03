@extends('template.index')

@section('title', 'Pemesanan Speedboat')

@section('content')
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @livewire('pemesanan.pemesanan-table')
        </div>
    </div>
@endsection
