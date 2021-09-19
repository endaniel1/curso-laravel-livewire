<div class="form-group">
	<label for="name" class="">Nombre</label>
	<input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control" placeholder="Nombre de la Categoria">

	@error('name')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<div class="form-group">
	<label for="name" class="">Slug</label>
	<input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" class="form-control" placeholder="Slug de la Categoria" readonly="readonly">

	@error('slug')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<button class="btn btn-primary" type="submit">{{ $category->name ? 'Actualizar': 'Agregar' }}</button>


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