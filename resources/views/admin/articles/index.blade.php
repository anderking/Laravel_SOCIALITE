@extends ('admin.template.main')

@section('title','Admin-Articles')
@section('body_class','admin_articles_index')
@section('main_class','admin_articles_index')
@section('content')

<h1 class="text-center">Lista de Articulos</h1>

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 text-center">
		@if(count($article)>0)
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 text-center">
				<a href="#" data-toggle="modal" data-target="#modal-delete-articles-all" class="btn btn-danger">Eliminar todo</a>
				@include('admin.template.partials.modal-delete-articles-all')
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 text-center">
				<a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Nuevo Articulo</a>
			</div>
		</div>
		@else
		<a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Nuevo Articulo</a>
		@endif
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 text-center">
		{!! Form::open(array('route' => 'admin.articles.index','method' => 'GET','class'=>'navbar-form')) !!}
		<div class="input-group">
			{!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Buscar...','aria-describedby'=>'search','required']) !!}
			<span class="input-group-btn" >
				<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
			</span>
		</div>
		{!! Form::close() !!}
	</div>
</div>

@if(count($article)>0)
<div class="table-responsive">
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Titulo</th>
				<th>Usuario</th>
				<th>Categoría</th>
				<th>Tags</th>
				<th>Imagenes</th>
				<th>Comentarios</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($article as $articles)
			<tr>
				<td><a href="{{ route('admin.article.showslug',$articles->slug) }}">{{ str_limit($articles->title, $limit = 50, $end = '...') }}</a></td>
				<td><a href="{{ route('admin.users.show',$articles->user_id) }}">{{ ucwords($articles->user->name) }}</a></td>
				<td><a href="{{ route('admin.categories.show',$articles->category_id) }}">{{ $articles->category->name }}</a></td>
				<td><span class="badge badge-primary">{{ count($articles->tags) }}</span></td>
				<td><span class="badge badge-primary">{{ count($articles->images) }}</span></td>
				<td><span class="badge badge-primary">{{ count($articles->coments) }}</span></td>
				<td>
					<a class="btn btn-info" href="{{ route('admin.articles.edit',$articles->id)}}">Editar</a>
					<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-articles-{{$articles->id}}"><b>Eliminar</b>
				</td>
			</tr>
			@include('admin.template.partials.modal-delete-articles')
			@endforeach
		</tbody>
	</table>
</div>
@else
	<div class="jumbotron">
		<h1 class="text-center">No existen registros de Articulos en nuestra Base de Datos</h1>
	</div>
@endif
<div class="text-center">
	{!! $article->render() !!}
</div>

@endsection