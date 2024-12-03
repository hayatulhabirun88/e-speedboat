@extends('template.index')

@section('title', 'Penumpang Speedboat')

@section('content')
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @livewire('penumpang.penumpang-table')
        </div>
    </div>
@endsection
