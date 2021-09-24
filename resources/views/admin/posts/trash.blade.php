@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Papelera de Post</h1>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        @if($posts->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th colspan="2">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->name }}</td>
                                <td width="10px">
                                    <a href="{{ route('admin.posts.restore', $post->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-undo fa-fw"></i>
                                    </a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST">
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
                {{ $posts->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No se encuentra ningun registro..!!</strong>
            </div>
        @endif
    </div>
@stop