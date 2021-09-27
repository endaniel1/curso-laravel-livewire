@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="">
        <i class="far fa-fw fa-bookmark"></i> Etiquetas
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
            @can('admin.tags.create')
            <a href="{{ route('admin.tags.create') }}" class="btn btn-secondary">
                Agregar Etiqueta <i class="far fa-bookmark fa-fw"></i>
            </a>
            @endcan
            @can('admin.tags.trash')
            <a href="{{ route('admin.tags.trash') }}" class="btn btn-danger">
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
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>                            
                            <td width="15px">                                
                                @can('admin.tags.edit')
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                @endcan
                            </td>
                            <td width="15px">
                                @can('admin.tags.destroy')
                                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
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