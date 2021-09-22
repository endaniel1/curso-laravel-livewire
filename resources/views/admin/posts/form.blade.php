<div class="form-group">
	<label for="name" class="">Nombre</label>
	<input type="text" name="name" id="name" value="{{ old('name', $post->name) }}" class="form-control" placeholder="Nombre del Post" autocomplete="off">

	@error('name')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<div class="form-group">
	<label for="slug" class="">Slug</label>
	<input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" class="form-control" placeholder="Slug de la Categoria" readonly="readonly">

	@error('slug')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<div class="form-group">
	<label for="categories" class="">Categorias</label>
	<select name="category_id" id="categories" class="form-control">
		<option>Selecione un categoria</option>
		@foreach($categories as $category)
			<option value="{{ $category->id }}"  {{ old('category_id', $post->category_id) == $category->id ? 'selected="selected"': '' }}>{{ $category->name }}</option>
		@endforeach
	</select>
</div>

<div class="form-group">
	<p class="font-weight-bold">Etiquetas</p>
		@foreach($tags as $tag)
		<label for="" class="mr-2">
			<input type="checkbox" name="tags[]" value="{{ $tag->id }}">
			{{ $tag->name }}
		</label>
		@endforeach
</div>

<div class="form-group">	
	<p class="font-weight-bold">Estado</p>
	<label for="status-borrador" class="mr-2">
		<input type="radio" name="status" value="1" class="" id="status-borrador">
		Borrador
	</label>

	<label for="status-publicado">
		<input type="radio" name="status" value="2" class="" id="status-publicado">
		Publicado
	</label>
</div>

<div class="form-group">
	<label for="">Extrator</label>
	<textarea name="extract" class="form-control" id="extract">
		{{ $post->extract }}
	</textarea>
</div>

<div class="form-group">
	<label for="">Cuerpo del Post</label>
	<textarea name="body" class="form-control" id="body">
		{{ $post->body }}
	</textarea>
</div>

<button class="btn btn-primary" type="submit">{{ $post->name ? 'Actualizar': 'Agregar' }}</button>

@section('css')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>    	
      tinymce.init({
        selector: '#extract'
      });

      tinymce.init({
        selector: '#body'
      });
    </script>
@stop

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