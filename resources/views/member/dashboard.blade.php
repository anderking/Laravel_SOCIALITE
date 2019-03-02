@extends ('member.template.main')

@section('title','Member-Dashboard')
@section('body_class','member_dashboard')
@section('main_class','member_dashboard')

@section('style')
<style>

</style>
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary box_flot ">
			<div class="panel-heading">
				<h3 class="panel-title">Reportes estadisticos</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<ul class="list-group">
							<li class="list-group-item"><span class="badge badge-primary">{{$user->articles->count()}} </span><a href="#" data-toggle="modal" data-target="#articles-publics">Cantidad de artículos publicados</a></li>
							<li class="list-group-item"><span class="badge badge-primary">{{ $coments->count() }} </span>Cantidad de comentarios realizados</li>
							{{--<li class="list-group-item"><span class="badge badge-primary"></span><a href="">Cantidad de likes recibidos de tus artículos</a></li>--}}
							<li class="list-group-item"><span class="badge badge-primary">{{$user->likes->count()}} </span><a href="#" data-toggle="modal" data-target="#likes-articles">Artículos que te han gustado</a></li>
							<li class="list-group-item"><span class="badge badge-primary">{{ count($coments_articles) }} </span><a href="#" data-toggle="modal" data-target="#coments-articles">Artículos que has comentado</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary box_flot center-block">
			<div class="panel-heading">
				<h3 class="panel-title">Detalles del usuario {{ $user->name }}</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
						<ul class="list-group">
							<li class="list-group-item"><span class="badge badge-primary">{{ $user->type }}</span><i class="fa fa-user" aria-hidden="true"></i><b class="hidden-xs">Type User</b></li>
							<li class="list-group-item"><span class="badge badge-primary">
								@if($user->sex=="")
								Sin especificar
								@endif
								{{ $user->sex }}</span>

								@if($user->sex=="Masculino")
								<i class="fa fa-male" aria-hidden="true"></i>
								@elseif ($user->sex =="Femenino")
								<i class="fa fa-female" aria-hidden="true"></i>
								@else
								<i class="fa fa-meh-o" aria-hidden="true"></i>
								@endif
								<b class="hidden-xs">Sexo</b>
							</li>
							<li class="list-group-item"><span class="badge badge-primary">{{$user->fecha}}</span> <i class="fa fa-calendar" aria-hidden="true"></i><b class="hidden-xs">Birth date</b></li>
							<li class="list-group-item"><span class="badge badge-primary">{{ $edad }}</span><i class="fa fa-birthday-cake" aria-hidden="true"></i><b class="hidden-xs">Edad</b></li>
							<li class="list-group-item"><span class="badge badge-primary">
								@if($user->address=="")
								Sin especificar
								@endif
								{{ $user->address }}</span> <i class="fa fa-address-card-o" aria-hidden="true"></i><b class="hidden-xs">Address</b>
							</li>
							<li class="list-group-item"><span class="badge badge-primary">
								@if($user->work=="")
								Sin especificar
								@endif
								{{ $user->work }}</span>
								<i class="fa fa-black-tie" aria-hidden="true"></i><b class="hidden-xs">Work</b>
							</li>
							<li class="list-group-item"><span class="badge badge-primary">{{ $user->email }}</span><i class="fa fa-at" aria-hidden="true"></i><b class="hidden-xs">Email</b></li>
							<li class="list-group-item"><span class="badge badge-primary">
								@if($user->phone=="")
								Sin especificar
								@endif
								{{ $user->phone }}</span> <i class="fa fa-phone-square" aria-hidden="true"></i><b class="hidden-xs">Phone</b>
							</li>
							<li class="list-group-item"><span class="badge badge-primary">
								@if($user->facebook=="")
								Sin especificar
								@endif
								<a href="https://www.facebook.com/{{ $user->facebook }}">{{$user->facebook}}</a></span> <i class="fa fa-facebook-square" aria-hidden="true"></i><b class="hidden-xs">Facebook</b>
							</li>
							<li class="list-group-item"><span class="badge badge-primary">
								@if($user->twitter=="")
								Sin especificar
								@endif
								<a href="https://www.twitter.com/{{ $user->twitter }}">{{ $user->twitter }}</a></span> <i class="fa fa-twitter-square" aria-hidden="true"></i><b class="hidden-xs">Twitter</b>
							</li>
							<li class="list-group-item"><span class="badge badge-primary">
								@if($user->instagram=="")
								Sin especificar
								@endif
								<a href="https://www.instagram.com/{{ $user->instagram }}">{{$user->instagram}}</a></span> <i class="fa fa-instagram" aria-hidden="true"></i><b class="hidden-xs">Instagram</b>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="text-center">
					<a href="{{ route('member.config',Auth::user()->id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar información</a>
				</div>
			</div>
		</div>
	</div>
</div>



@include('member.template.partials.modal-articles-publics')
@include('member.template.partials.modal-likes-articles')
@include('member.template.partials.modal-coments-articles')
@endsection