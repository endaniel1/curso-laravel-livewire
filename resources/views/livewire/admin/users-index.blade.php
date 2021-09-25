<div class="card">
    <div class="card-header">
        <div class="text-right mb-4">  
            <a href="{{ route('admin.users.create') }}" class="btn btn-secondary">
                Agregar Usuario <i class="fas fa-plus fa-fw"></i>
            </a>
            <a href="{{ route('admin.users.trash') }}" class="btn btn-danger">
                Papelera
                <i class="fas fa-trash fa-fw"></i>
            </a>
        </div>

        <input wire:model="search" type="text" class="form-control" placeholder="Ingrese Nombre o Correo">
    </div>

    @if($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                            </td>
                            <td>                                
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
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
            {{ $users->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No se encuentra ningun registro..!!</strong>
        </div>
    @endif
</div> 
