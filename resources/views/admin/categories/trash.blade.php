@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Papelera de Categorias</h1>
@stop

@section('content')

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Name
                        </th>
                        <th colspan="2">
                            Opciones
                        </th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="10px">
                                <a href="{{ route('admin.categories.restore', $category->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-undo fa-fw"></i>
                                </a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST">
                                    @csrf

                                    @method('patch')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-times fa-fw"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>               
            </table>
        </div>
    </div>
@stop

@stop