@extends ('admin.template.main')

@section('title','Admin-Users-Show')
@section('body_class','admin_users_show')
@section('main_class','admin_users_show')

@section('content')

<div class="text-center page-header">
	<h1 class="text-center">Detalles del usuario {{ ucwords($user->name) }}</h1>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">{{ ucwords($user->name) }}</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
				<ul class="list-group">
					<li class="list-group-item"><b>Photo Profiel: </b><div class="box_img"><img src="{{asset('plugins/img/perfil/')}}/{{$user->img_user}}" class="img-circle img_profiel" alt="{{ $user->img_user }}"></div></li>
					<li class="list-group-item"><b>ID: </b>{{ $user->id }}</li>
					<li class="list-group-item"><b>Tipo: </b>{{ $user->type }}</li>
					<li class="list-group-item"><b>Nombre: </b>{{ ucwords($user->name) }}</li>
					<li class="list-group-item">
						@if($user->sex=="Masculino")
						<b>Sexo: </b><i class="fa fa-male" aria-hidden="true"></i>
						@elseif($user->sex=="Femenino")
						<b>Sexo: </b><i class="fa fa-female" aria-hidden="true"></i>
						@else
						<b>Sexo: </b> Sin especificar.
						@endif
					</li>
					<li class="list-group-item"><b>Fecha de nacimiento: </b>{{ $user->fecha }}</li>
					<li class="list-group-item"><b>Edad: </b>{{ $edad }}</li>
					<li class="list-group-item"><b>Email: </b>{{ $user->email }}</li>
					<li class="list-group-item"><b>Creado: </b>{{ $user->created_at }}</li>
					<li class="list-group-item"><b>Actualizado: </b>{{ $user->updated_at }}</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<div class="text-center">
			<a href="{{ URL::previous() }}" class="btn btn-default btn-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i>Regresar</a>
		</div>
	</div>
</div>

@endsection