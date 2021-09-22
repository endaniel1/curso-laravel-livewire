<div class="card">
    <div class="card-header">
        <div class="text-right mb-4">  
            <a href="{{ route('admin.posts.create') }}" class="btn btn-secondary">
                Agregar Post <i class="fas fa-plus fa-fw"></i>
            </a>
            <a href="{{ route('admin.posts.trash') }}" class="btn btn-danger">
                Papelera
                <i class="fas fa-trash fa-fw"></i>
            </a>
        </div>

        <input wire:model="search" type="text" class="form-control" placeholder="Buscar por Nombre">
    </div>
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
                            <td>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
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

        <div class="card-footer">
            {{ $posts->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No se encuentra ningun registro..!!</strong>
        </div>
    @endif
</div>
