@extends ('admin.template.main')

@section('title','Laravel-Register')
@section('body_class','laravel_register')
@section('main_class','laravel_register')
@section('content')
<div class="jumbotron">
  <div class="container">
    <h1 class="text-center">Registro de usuarios</h1>
    {!! Form::open(array('route' => 'auth.register','method' => 'POST','files' => true,'class'=>'form-horizontal')) !!}
				<div class="form-group">
					{!! Form::label('name', 'Nombre:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('email', 'E-Mail:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'example@company.com','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('password', 'Contraseña:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::password('password', ['class'=>'form-control','placeholder'=>'Password','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('password_confirmation', 'Confirmar Contraseña:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Password','required']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::hidden('type','member') !!}
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-offset-2 col-sm-10 col-md-offset-4 col-md-8">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						{!! Form::reset('Cancelar',['class'=>'btn btn-default']) !!}
						<a href="{{ route('auth.login') }}" class="btn btn-primary">Login</a>
					</div>
				</div>
				{!! Form::close() !!}
  </div>
</div>
@endsection