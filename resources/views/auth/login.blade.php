@extends ('admin.template.main')

@section('title','Laravel-Login')
@section('body_class','laravel_login')
@section('main_class','laravel_login')
@section('content')
<div class="jumbotron">
  <div class="container">
    <h1 class="text-center">Iniciar Sesión</h1>
    {!! Form::open(array('route' => 'auth.login','method' => 'POST','class'=>'form-horizontal')) !!}
				<div class="form-group">
					{!! Form::label('email', 'E-mail:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'example@company.com','required']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('password', 'Contraseña:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::password('password', ['class'=>'form-control','placeholder'=>'Password','required']) !!}
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-offset-2 col-sm-10 col-md-offset-4 col-md-8">
						{!! Form::submit('Login',['class'=>'btn btn-primary']) !!}
						{!! Form::reset('Cancelar',['class'=>'btn btn-default']) !!}
						<a href="{{ route('auth.register') }}" class="btn btn-primary">Registrarse</a>
					</div>
				</div>
				{!! Form::close() !!}
  </div>
</div>
@endsection