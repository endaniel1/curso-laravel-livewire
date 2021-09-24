@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Post</h1>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @method('PUT')
                
                @include('admin.posts.form')
            </form>
        </div>
    </div>
@stop