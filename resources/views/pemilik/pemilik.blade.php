@extends('template.index')

@section('title', 'Pemilik Speedboat')

@section('content')
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @livewire('pemilik.pemilik-table')
        </div>
    </div>
@endsection
