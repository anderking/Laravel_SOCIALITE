@extends ('admin.template.main')

@section('title','Admin-Articles-Create')
@section('body_class','admin_articles_create')
@section('main_class','admin_articles_create')

@section('content')

<div class="text-center page-header">
	<h1 class="text-center">Registro de artículos</h1>
</div>
@if(count($category_all)>0)


{!! Form::open(array('route' => 'admin.articles.store','method' => 'POST','files' => true)) !!}
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Registrar Artículo</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			{!! Form::label('title', 'Titulo:',['class'=>'control-label']) !!}
			{!! Form::text('title', null, ['class'=>'form-control','placeholder'=>'Titulo','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('content', 'Contenido:',['class'=>'control-label']) !!}
			{!! Form::textarea('content', null, ['class'=>'form-control trumbowyg','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('category_id', 'Categoría:',['class'=>'control-label']) !!}
			{!! Form::select('category_id', $category, null, ['class'=>'form-control select_cat']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('tags', 'Tag (opcional):',['class'=>'control-label']) !!}
			{!! Form::select('tags[]',$tag, null, ['class'=>'form-control select_tag','multiple']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('img', 'Imagen destacada (opcional):',['class'=>'control-label']) !!}
			{!! Form::file('img', ['class'=>'form-control','id'=>'img']) !!}
		</div>
		<div class="form-group">
			{!! Form::hidden('user_id',Auth::user()->id) !!}
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-10 col-md-offset-4 col-md-8">
				{!! Form::submit('Registrar',['class'=>'btn btn-info']) !!}
				<a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Cancelar</a>
				<a href="{{ route('admin.articles.index') }}" class="btn btn-default">Regresar</a>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@else
	<div class="jumbotron">
		<h1>No existen categorías registradas</h1>
		<p>No puede publicar articulos sin categorías, Por favor cree una nueva categoría.</p>
		<h2><a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Nueva Categoría</a></h2>
	</div>
@endif
@endsection

@section('js')
<script>

	$("#img").fileinput({
		showUpload: false,
   });

</script>

@endsection
