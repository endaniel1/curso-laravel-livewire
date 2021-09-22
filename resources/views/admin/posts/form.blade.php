<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

<div class="form-group">
	<label for="name" class="">Nombre</label>
	<input type="text" name="name" id="name" value="{{ old('name', $post->name) }}" class="form-control" placeholder="Nombre del Post" autocomplete="off">

	@error('name')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="form-group">
	<label for="slug" class="">Slug</label>
	<input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" class="form-control" placeholder="Slug del Post" readonly="readonly">

	@error('slug')
		<small class="text-danger">{{ $message }}</small>
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
	@error('category_id')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="form-group">
	<p class="font-weight-bold">Etiquetas</p>
		@foreach($tags as $tag)
		<label for="" class="mr-2">
			<input type="checkbox" name="tags[]" value="{{ $tag->id }}">
			{{ $tag->name }}
		</label>
		@endforeach

		@error('tags')
			<br>
			<small class="text-danger">{{ $message }}</small>
		@enderror
</div>

<div class="form-group">	
	<p class="font-weight-bold">Estado</p>
	<label for="status-borrador" class="mr-2">
		<input type="radio" name="status" value="1" class="" {{ ($post->status == 1) ? 'checked="checkbox"': '' }} id="status-borrador">
		Borrador
	</label>

	<label for="status-publicado">
		<input type="radio" name="status" value="2" class="" {{ ($post->status == 2) ? 'checked="checkbox"': '' }} id="status-publicado">
		Publicado
	</label>

	@error('status')
		<br>
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="row">
	<div class="col">
		<div class="image-wrapper mb-3">					
			<img src="https://cdn.pixabay.com/photo/2021/09/15/21/29/lake-6627781_960_720.jpg" alt="" class="" id="picture">
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label for="file">Imagen a mostrar en el post</label>
			<input type="file" name="file" class="form-control-file" id="file" accept="image/*">

			@error('file')
				<span class="text-danger">{{ $message }}</span>
			@enderror

			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi aut autem dignissimos aspernatur nesciunt, magnam alias quae placeat incidunt dicta ipsam id deserunt exercitationem voluptate fugiat eaque modi. Debitis, consectetur.</p>
		</div>
	</div>
</div>

<div class="form-group">
	<label for="">Extrator</label>
	<textarea name="extract" class="form-control" id="extract">
		{{ $post->extract }}
	</textarea>

	@error('extract')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="form-group">
	<label for="">Cuerpo del Post</label>
	<textarea name="body" class="form-control" id="body">
		{{ $post->body }}
	</textarea>

	@error('body')
		<small class="text-danger">{{ $message }}</small>
	@enderror
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

    <style type="text/css">
    	.image-wrapper{
    		position: relative;
    		padding-bottom: 56.25%;
    	}
    	.image-wrapper img {
    		position: absolute;
    		object-fit: cover;
    		width: 100%;
    		height: 100%;
    	}
    </style>
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

        //cambiar Image
				document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>   
@stop