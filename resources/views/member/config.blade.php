@extends ('member.template.main')

@section('title','Member-Config')
@section('body_class','member_config')
@section('main_class','member_config')

@section('content')

<div class="text-center page-header">
	<h1 class="text-center">Editar información</h1>
</div>

{!! Form::open(array('route' => ['member.profiel.update',$user],'method' => 'PUT','class'=>'form-horizontal')) !!}

<div class="panel panel-primary box_flot">
	<div class="panel-heading">
		<h3 class="panel-title">Editar información {{$user->name}}</h3>
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
				<div class="form-group">
					{!! Form::label('password', 'Cambiar Contraseña:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::password('password', ['class'=>'form-control','placeholder'=>'Password']) !!}
					</div>
				</div>
				<div class="form-group">
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
				</div>
				<div class="form-group">
					{!! Form::label('address', 'Dirección:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::text('address',$user->address, ['class'=>'form-control','placeholder'=>'Nombre']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('work', 'Trabajo:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::text('work',$user->work, ['class'=>'form-control','placeholder'=>'Nombre']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('phone', 'Teléfono:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						{!! Form::text('phone',$user->phone, ['class'=>'form-control input-medium bfh-phone','data-format'=>'+58 (ddd) ddd-dddd']) !!}
						<div>Ejemplo: +58 (ddd) ddd-dddd</div>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('facebook', 'Facebook:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						@if($user->facebook=="")
						{!! Form::text('facebook',null, ['class'=>'form-control','placeholder'=>'Colocar solo el Usename']) !!}
						<div class=""><b>Ejemplo:</b> https://www.facebook.com/<span class="badge badge-primary">username</span></div>
						@else
						{!! Form::text('facebook',$user->facebook, ['class'=>'form-control','placeholder'=>'Colocar solo el Usename']) !!}
						<div class=""><b>Ejemplo:</b> https://www.facebook.com/<span class="badge badge-primary">username</span></div>
						@endif
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('twitter', 'Twitter:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						@if($user->twitter=="")
						{!! Form::text('twitter',null, ['class'=>'form-control','placeholder'=>'Colocar solo el Usename']) !!}
						<div class=""><b>Ejemplo:</b> https://www.twitter.com/<span class="badge badge-primary">username</span></div>
						@else
						{!! Form::text('twitter',$user->twitter, ['class'=>'form-control','placeholder'=>'Colocar solo el Usename']) !!}
						<div class=""><b>Ejemplo:</b> https://www.twitter.com/<span class="badge badge-primary">username</span></div>
						@endif
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('instagram', 'Instagram:',['class'=>'col-xs-12 col-sm-2 col-md-4 control-label']) !!}
					<div class="col-xs-12 col-sm-10 col-md-5">
						@if($user->instagram=="")
						{!! Form::text('instagram',null, ['class'=>'form-control','placeholder'=>'Colocar solo el Usename']) !!}
						<div class=""><b>Ejemplo:</b> https://www.instagram.com/<span class="badge badge-primary">username</span></div>
						@else
						{!! Form::text('instagram',$user->instagram, ['class'=>'form-control','placeholder'=>'Colocar solo el Usename']) !!}
						<div class=""><b>Ejemplo:</b> https://www.instagram.com/<span class="badge badge-primary">username</span></div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-10 col-md-offset-4 col-md-8">
				{!! Form::submit('Editar',['class'=>'btn btn-info']) !!}
				{!! Form::reset('Cancelar',['class'=>'btn btn-primary']) !!}
				<a href="{{ route('member.dashboard',Auth::user()->id) }}" class="btn btn-default">Regresar</a>
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}

@endsection