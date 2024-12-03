@extends('template.index')

@section('title', 'Jadwal')

@section('content')
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @livewire('jadwal.jadwal-table')
        </div>
    </div>
@endsection
