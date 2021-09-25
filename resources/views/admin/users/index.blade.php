@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="">
        <i class="fas fa-fw fa-users"></i> Usuarios
    </h1>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    @livewire('admin.users-index')
@stop