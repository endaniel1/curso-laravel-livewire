@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Papelera de Usuario</h1>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        @if($users->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th colspan="2">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td width="10px">
                                    <a href="{{ route('admin.users.restore', $user->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-undo fa-fw"></i>
                                    </a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
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

            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No se encuentra ningun registro..!!</strong>
            </div>
        @endif
    </div>
@stop