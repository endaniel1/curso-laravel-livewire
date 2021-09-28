@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                
                @include('admin.roles.form')
            </form>
        </div>
    </div>
@stop