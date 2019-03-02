@extends ('admin.template.main')

@section('title','Admin-Categories')
@section('body_class','admin_categories_index')
@section('main_class','admin_categories_index')
@section('content')

<h1 class="text-center">Lista de Categorías</h1>

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-6 text-center">
		@if(count($category)>0)
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 text-center">
				<a href="#" data-toggle="modal" data-target="#modal-delete-categories-all" class="btn btn-danger">Eliminar todo</a>
				@include('admin.template.partials.modal-delete-categories-all')
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 text-center">
				<a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Nueva Categoría</a>
			</div>
		</div>
		@else
		<a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Nueva Categoría</a>
		@endif
  </div>
  <div class="col-xs-12 col-sm-6 col-md-6 text-center">
  	{!! Form::open(array('route' => 'admin.categories.index','method' => 'GET','class'=>'navbar-form')) !!}
    <div class="input-group">
      {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Buscar...','aria-describedby'=>'search','required']) !!}
      <span class="input-group-btn" >
        <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </span>
    </div>
    {!! Form::close() !!}
  </div>
</div>

@if (count($category)>0)
<div class="table-responsive">
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Cantidad de Articulos</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($category as $categories)
			<tr>
				<td><a href="{{ route('admin.categories.show',$categories->id) }}">{{ $categories->name }}</a></td>
				<td><span class="badge badge-primary">{{ count($categories->articles) }}</span></td>
				<td>
					<a class="btn btn-info" href="{{ route('admin.categories.edit',$categories->id)}}">Editar</a>
					<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-categories-{{$categories->id}}"><b>Eliminar</b>
				</td>
			</tr>
			@include('admin.template.partials.modal-delete-categories')
			@endforeach
		</tbody>
	</table>
</div>
@else
	<div class="jumbotron">
		<h1 class="text-center">No existen registros de Categorías en nuestra Base de Datos</h1>
	</div>
@endif
<div class="text-center">
	{!! $category->render() !!}
</div>

@endsection