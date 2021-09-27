@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="">
        <i class="fab fa-buffer"></i> Categorias
    </h1>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        
        <div class="card-header text-right">
            @can('admin.categories.create')
                <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary">
                    Agregar Categoria <i class="fas fa-plus fa-fw"></i>
                </a>
            @endcan

            @can('admin.categories.trash')
            <a href="{{ route('admin.categories.trash') }}" class="btn btn-danger">
                Papelera
                <i class="fas fa-trash fa-fw"></i>
            </a>
            @endcan
        </div>

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
                        <th colspan="2" align="center">
                            
                        </th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="15px">
                                @can('admin.categories.edit')
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                @endcan
                            </td>
                            <td width="15px">
                                @can('admin.categories.destroy')
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash fa-fw"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>               
            </table>
        </div>
    </div>
@stop
