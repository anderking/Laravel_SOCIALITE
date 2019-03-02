@extends ('member.template.main')

@section('title','Member-Profiel')
@section('body_class','member_profiel')
@section('main_class','member_profiel')

@section('style')

@if($images>0)
	<style>
		#page-content-wrapper{
			padding-top:0;
		}
	</style>
@else
<style>
	.member_profiel .profile-content{
		margin-bottom: 0 !important;
	}
	#page-content-wrapper{
			padding-bottom:0 !important;
			padding-top: 0 !important;
			margin-bottom: -1px !important;
		}
</style>
@endif


@endsection

@section('biography')
<div class="profile-content">
	<div class="profile-header text-center" style="background-image: url('{{asset('plugins/img/portada/')}}/{{$user->img_bio}}') !important;">
	  <div class="container-fluid">
	    <div class="container-inner">
	    	<div class="thumbnail">
	    		<div class="img_container">
	    			<img src="{{asset('plugins/img/perfil/')}}/{{$user->img_user}}" class="img-circle img_bio" alt="">
	    		</div>
	    	</div>
	      <h3 class="profile-header-user">{{ucwords(Auth::user()->name)}}</h3>
	      <p class="profile-header-bio">
	      	@if($user->bio_description=="")
	      	Sin descripción...
	      	@else
	      	{{ ucfirst($user->bio_description) }}
	      	@endif
	      </p>
	    </div>
	  </div>
	  <nav class="profile-header-nav">
	  	<ul class="nav-bio justify-content-center">
	  		<li class="nav-bio-inline">
	  			<a class="nav-bio-link" href="#" data-toggle="modal" data-target="#modal-photo-profiel">Foto de perfil</a>
	  		</li>
	  		<li class="nav-bio-inline">
	  			<a class="nav-bio-link" href="#" data-toggle="modal" data-target="#modal-photo-bio">Foto biografía</a>
	  		</li>
	  		<li class="nav-bio-inline">
	  			<a class="nav-bio-link" href="#" data-toggle="modal" data-target="#modal-bio-description">Descripción</a>
	  		</li>
	  	</ul>
	  </nav>
	</div>
</div>

@endsection

@section('content')

<div class="album">
	@foreach($user->articles()->orderBy('created_at','DESC')->get() as $articles)
	@foreach($articles->images()->orderBy('created_at','DESC')->get() as $images)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<div class="box_flot">
				<div class="thumbnail">
					<div class="img_container">
						<img src="{{asset('plugins/img/articles/')}}/{{$images->name}}" class="img-responsive img_album" alt="{{ $images->name }}">
					</div>
					<div class="caption">
						<a href="{{ route('member.article.showarticles',$articles->slug) }}">{{ str_limit($images->article->title, $limit = 20, $end = '...') }}</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	@endforeach	
</div>


{{--
<div class="row">
	<div class="col xs-12 col-sm-offset-2 col-sm-8 col-md-offset-0 col-md-4">
		<div class="panel panel-primary box_flot">
			<div class="panel-heading">
				<h4 class="panel-title text-center">Foto de perfil</h4>
			</div>
			<div class="panel-body">
				<div class="thumbnail">
					<div class="img_container">
						<img src="{{asset('plugins/img/perfil/')}}/{{$user->img_user}}" class="img-responsive img_article" alt="{{ $user->img_user }}">
					</div>
				</div>
			</div>
			<div class="panel-footer">
				{!! Form::open(array('route' => ['member.photo.update',$user],'method' => 'PUT','files' => true)) !!}
				<div class="text-center">
					{!! Form::file('img_user', ['class'=>'form-control ','id'=>'img','required']) !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col xs-12 col-sm-12 col-md-offset-0 col-md-8 ">
		<div class="panel panel-primary box_flot ">
			<div class="panel-heading">
				<h3 class="panel-title">Reportes estadisticos</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<ul class="list-group">
							<li class="list-group-item"><span class="badge badge-primary">{{$user->articles->count()}} </span><a href="#" data-toggle="modal" data-target="#articles-publics">Cantidad de artículos publicados</a></li>
							<li class="list-group-item"><span class="badge badge-primary"></span><a href="">Cantidad de likes recibidos de tus artículos</a></li>
							<li class="list-group-item"><span class="badge badge-primary">{{$user->likes->count()}} </span><a href="#" data-toggle="modal" data-target="#likes-articles">Artículos que te han gustado</a></li>
							<li class="list-group-item"><span class="badge badge-primary">Result </span><a href="">Cantidad de artículos sin comentarios</a></li>
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
					<a href="{{ route('member.config',Auth::user()->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar información</a>
				</div>
			</div>
		</div>
	</div>
</div>
--}}

{{-- <div class="jumbotron">
	<div class="container">
	</div>
</div> --}}

@include('member.template.partials.modal-photo-profiel')
@include('member.template.partials.modal-photo-bio')
@include('member.template.partials.modal-bio-description')

@endsection

@section('js')

<script>


  $("#img_user").fileinput({
		showUpload: true,
		showCaption: true,
		showRemove: false,
		uploadLabel: 'Enviar',
		uploadClass: 'btn btn-info',
		//browseLabel:'Cambiar foto'
   });

    $("#img_bio").fileinput({
		showUpload: true,
		showCaption: true,
		showRemove: false,
		uploadLabel: 'Enviar',
		uploadClass: 'btn btn-info',
		//browseLabel:'Cambiar foto'
   });

</script>

@endsection



