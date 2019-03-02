@extends ('admin.template.main')

@section('title','Admin-Users-Edit')
@section('body_class','admin_users_edit')
@section('main_class','admin_users_edit')

@section('content')

<div class="text-center page-header">
	<h1 class="text-center">Actualización de usuarios</h1>
</div>

{!! Form::open(array('route' => ['admin.users.update',$user],'method' => 'PUT','class'=>'form-horizontal')) !!}

<div class="panel panel-primary box_flot">
	<div class="panel-heading">
		<h3 class="panel-title">Editar Usuario {{$user->name}}</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('name', 'Nombre:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::text('name',$user->name, ['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('email', 'E-Mail:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::email('email', $user->email, ['class'=>'form-control','placeholder'=>'example@company.com','required']) !!}
					</div>
				</div>
					
				@if(Auth::user()->superadmin())
				<div class="form-group">
					{!! Form::label('type', 'Tipo de Usuario:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::select('type',['member'=>'Miembro', 'admin' => 'Administrador'],$user->type,['class'=>'form-control','required']) !!}
					</div>
				</div>
				@endif


				<div class="form-group">
					{!! Form::label('password', 'Cambiar Contraseña:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::password('password', ['class'=>'form-control','placeholder'=>'Password']) !!}
					</div>
				</div>
				{{--<div class="form-group">
					{!! Form::label('type', 'Sexo:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						@if($user->sex=="Masculino")
						{!! Form::label('sex', 'Masculino',['class'=>'control-label']) !!}
						{!! Form::radio('sex', 'Masculino',true,['required']) !!}
						{!! Form::label('sex', 'Femenino',['class'=>'control-label']) !!}
						{!! Form::radio('sex', 'Femenino',false,['required']) !!}
						@elseif($user->sex=="Femenino")
						{!! Form::label('sex', 'Masculino',['class'=>'control-label']) !!}
						{!! Form::radio('sex', 'Masculino',false,['required']) !!}
						{!! Form::label('sex', 'Femenino',['class'=>'control-label']) !!}
						{!! Form::radio('sex', 'Femenino',true,['required']) !!}
						@else
						{!! Form::label('sex', 'Masculino',['class'=>'control-label']) !!}
						{!! Form::radio('sex', 'Masculino',false,['required']) !!}
						{!! Form::label('sex', 'Femenino',['class'=>'control-label']) !!}
						{!! Form::radio('sex', 'Femenino',false,['required']) !!}
						@endif
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('fecha', 'Fecha de nacimiento:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::date('fecha', $user->fecha, ['class'=>'form-control','required']) !!}
					</div>
				</div>--}}
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-10 col-md-offset-4 col-md-8">
				{!! Form::submit('Actualizar',['class'=>'btn btn-info']) !!}
				{!! Form::reset('Cancelar',['class'=>'btn btn-primary']) !!}
				<a href="{{ route('admin.users.index') }}" class="btn btn-default">Regresar</a>
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}

@endsection