@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregando Post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @include('admin.posts.form')
            </form>
        </div>
    </div>
@stop