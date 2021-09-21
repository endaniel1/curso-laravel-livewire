<div class="form-group">
	<label for="name" class="">Nombre</label>
	<input type="text" name="name" id="name" value="{{ old('name', $tag->name) }}" class="form-control" placeholder="Nombre de la Categoria">

	@error('name')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<div class="form-group">
	<label for="name" class="">Slug</label>
	<input type="text" name="slug" id="slug" value="{{ old('slug', $tag->slug) }}" class="form-control" placeholder="Slug de la Categoria" readonly="readonly">

	@error('slug')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<div class="form-group">
	<label for="">Color</label>
	<select name="color" id="color" class="form-control">
		<option value="">Selecione un Color</option>
		<option value="red" {{ old('color', $tag->color) == 'red' ? 'selected="selected"': '' }}>Color Rojo</option>
		<option value="green" {{ old('color', $tag->color) == 'green' ? 'selected="selected"': '' }}>Color Verde</option>
		<option value="blue" {{ old('color', $tag->color) == 'blue' ? 'selected="selected"': '' }}>Color Azul</option>
		<option value="pink" {{ old('color', $tag->color) == 'pink' ? 'selected="selected"': '' }}>Color Rosado</option>
		<option value="indigo" {{ old('color', $tag->color) == 'indigo' ? 'selected="selected"': '' }}>Color Indigo</option>
		<option value="yellow" {{ old('color', $tag->color) == 'yellow' ? 'selected="selected"': '' }}>Color Amarillo</option>
		<option value="purple" {{ old('color', $tag->color) == 'purple' ? 'selected="selected"': '' }}>Color Morado</option>
		<option value="gray" {{ old('color', $tag->color) == 'gray' ? 'selected="selected"': '' }}>Color Gris</option>
	</select>

	@error('color')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<button class="btn btn-primary" type="submit">{{ $tag->name ? 'Actualizar': 'Agregar' }}</button>


@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script>
        $(document).ready( function() {
          $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
          });
        });
    </script>   
@stop