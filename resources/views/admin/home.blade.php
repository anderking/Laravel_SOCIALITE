@extends ('admin.template.main')

@section('title','Admin-Home')
@section('body_class','admin_home')
@section('main_class','admin_home')


@section('content')
<div class="page-header">
  <h1 class="text-center">Bienvenido {{ucwords(Auth::user()->name)}}</h1>
</div>
<div class="jumbotron">
	<div class="container">
		<h1 class="text-center">Reportes Estadisticos</h1>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6">
				<ul class="list-group">
				  <li class="list-group-item"><span class="badge badge-primary">{{ count($user) }}</span><a href="{{ route('admin.users.index') }}">Cantidad de usuarios registrados</a></li>
				  <li class="list-group-item"><span class="badge badge-primary">{{ count($article) }}</span><a href="{{ route('admin.articles.index') }}">Cantidad de articulos publicados</a></li>
				  <li class="list-group-item"><span class="badge badge-primary">{{ count($category) }}</span><a href="{{ route('admin.categories.index') }}">Cantidad de categorías registradas</a></li>
				  <li class="list-group-item"><span class="badge badge-primary">{{ count($tag) }}</span><a href="{{ route('admin.tags.index') }}">Cantidad de tags registrados</a></li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<ul class="list-group">
				  <li class="list-group-item"><span class="badge badge-primary">{{ count($img) }}</span><a href="{{ route('admin.img.index') }}">Cantidad de imagenes publicadas</a></li>
					<li class="list-group-item"><span class="badge badge-primary">{{ round($porc_admin,2) }} %</span>Porcentaje de usuarios administradores</li>
					<li class="list-group-item"><span class="badge badge-primary">{{ round($porc_member,2) }} %</span>Porcentaje de usuarios miembros</li>
				</ul>
			</div>
		</div>
	</div>
</div>

	@if(Auth::user()->admin())
	<p><strong>Nota:</strong> Los usuarios Administradores no tiene acceso a la sección de miembros</p>
	@endif

@if(Auth::user()->superadmin())
<div class="text-center">
	<a href="{{ route('member.index') }}" class="btn btn-default btn-lg">Ir al timeline</a>
</div>
@endif

@endsection