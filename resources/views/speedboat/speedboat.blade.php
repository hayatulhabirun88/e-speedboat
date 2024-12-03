@extends('template.index')

@section('title', 'Speadboat')

@section('content')
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @livewire('speedboat.speedboat-table')
        </div>
    </div>
@endsection
