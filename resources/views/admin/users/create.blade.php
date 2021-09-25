@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregando Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @include('admin.users.form')
            </form>
        </div>
    </div>
@stop