@extends ('admin.template.main')

@section('title','Admin-Users')
@section('body_class','admin_users_index')
@section('main_class','admin_users_index')
@section('content')

<h1 class="text-center">Lista de Usuarios</h1>

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-6 text-center">
		@if(count($user)>0)
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 text-center">
				<a href="#" data-toggle="modal" data-target="#modal-delete-users-all" class="btn btn-danger">Eliminar todo</a>
				@include('admin.template.partials.modal-delete-users-all')
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 text-center">
				<a href="{{ route('admin.users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
			</div>
		</div>
		@else
		<a href="{{ route('admin.users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
		@endif
  </div>
  <div class="col-xs-12 col-sm-6 col-md-6 text-center">
  	{!! Form::open(array('route' => 'admin.users.index','method' => 'get','class'=>'navbar-form')) !!}
    <div class="input-group">
      {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Buscar...','aria-describedby'=>'search','required']) !!}
      <span class="input-group-btn" >
        <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </span>
    </div>
    {!! Form::close() !!}
  </div>
</div>

@if(count($user)>0)
{!! Form::open(array('action' => ['UsersController@destroyselect'],'method' => 'delete')) !!}
<div class="table-responsive">
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Selecionar</th>
				<th>Nombre</th>
				<th>Articulos Publicados</th>
				<th>Tipo</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($user as $users)
			
			<tr>
				<td>{!! Form::checkbox('users[]', $users->id,false); !!}</td>
				<td><a href="{{ route('admin.users.show',$users->id) }}">{{ ucwords($users->name) }}</a></td>
				<td><a href="{{ route('admin.users.articles',$users->id) }}"><span class="badge badge-primary">{{ count($users->articles) }}</span></a></td>
				<td>
					@if($users->type=='admin')
					<span class="label label-primary">{{ $users->type }}</span>
					@elseif($users->type=='superadmin')
					<span class="label label-success">{{ $users->type }}</span>
					@else
					<span class="label label-info">{{ $users->type }}</span>
					@endif
				</td>
				<td>
					<a class="btn btn-info" href="{{ route('admin.users.edit',$users->id)}}">Editar</a>
					{{-- <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-users-{{$users->id}}"><b>Eliminar</b> --}}
				</td>
			</tr>
			@include('admin.template.partials.modal-delete-users')
			@endforeach
		</tbody>
	</table>
</div>
{!! Form::submit('Eliminar Seleccionado(s)',['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
@else
	<div class="jumbotron">
		<h1 class="text-center">No existen registro de Usuarios en nuestra Base de Datos</h1>
	</div>
@endif

<div class="text-center">
	{!! $user->render() !!}
</div>

@endsection