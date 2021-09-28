<div class="form-group">
	<label for="name" class="">Nombre</label>
	<input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control" placeholder="Nombre del Rol">

	@error('name')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<h2 class="h3">Lista de Permisos</h2>

@foreach($permissions as $permission)
	<div class="row">
		<label for="">			
			<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked="checkbox"' : '' }}>
			{{ $permission->description }}
		</label>
	</div>
@endforeach

<button class="btn btn-primary" type="submit">{{ $role->name ? 'Actualizar': 'Agregar' }}</button>