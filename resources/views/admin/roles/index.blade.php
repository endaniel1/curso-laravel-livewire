@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="">
        <i class="fab fa-buffer"></i> Roles
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
            <a href="{{ route('admin.roles.create') }}" class="btn btn-secondary">
                Agregar Rol <i class="fas fa-plus fa-fw"></i>
            </a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>
                            ID
                        </td>
                        <td>
                            Roles
                        </td>
                        <td colspan="2">
                            
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td width="15px">                                
                                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm">
                                   <i class="fas fa-edit fa-fw"></i>
                                </a>
                            </td>
                            <td width="15px">                                
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash fa-fw"></i>
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