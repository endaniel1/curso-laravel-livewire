<div class="form-group">
	<label for="name" class="">Nombre</label>
	<input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Nombre de Usuario" autocomplete="off">

	@error('name')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="form-group">
	<label for="email" class="">Email</label>
	<input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Correo de Usuario" autocomplete="off">

	@error('email')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="form-group">
	<label for="password" class="">Contraseña</label>
	<input type="password" name="password" id="password" class="form-control" placeholder="Contraseña de Usuario" autocomplete="off">

	@error('password')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="form-group">
	<label for="password_confirmation" class="">Confirmar Contraseña</label>
	<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Contraseña de Usuario Nuevamente" autocomplete="off">

	@error('password_confirmation')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="form-group">
	<p class="font-weight-bold">Roles</p>
		@foreach($roles as $role)
		<label for="" class="mr-1">
			<input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked="checkbox"' : '' }}>
			{{ $role->name }}
		</label>
		@endforeach

		@error('roles')
			<br>
			<small class="text-danger">{{ $message }}</small>
		@enderror
</div>


<button class="btn btn-primary" type="submit">{{ $user->name ? 'Actualizar': 'Agregar' }}</button>