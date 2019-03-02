@extends ('member.template.main')

@section('title','Member-My-Articles')
@section('body_class','member_myarticles')
@section('main_class','member_myarticles')

@section('content')

<div class="page-header">
	<h1>My articles <a href="{{ route('member.articles.create') }}" class="btn btn-primary pull-right hidden-xs">Nuevo artículo</a></h1>
	<a href="{{ route('member.articles.create') }}" class="btn btn-primary hidden-sm hidden-md hidden-lg">Nuevo artículo</a>
</div>
@forelse($user->articles()->orderBy('updated_at','DESC')->get() as $articles)
<div class="panel panel-primary box_flot">
	<div class="panel-heading">
		<h4><a href="{{ route('member.article.showarticles',$articles->slug) }}">{{ $articles->title }}</a></h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-3">

				{{-- @forelse($articles->images->slice(0, 1) as $images)

				<div class="thumbnail">
					<div class="img_container">
						<img src="{{asset('plugins/img/articles/')}}/{{$images->name}}" class="img-responsive img_article" alt="{{ $images->name }}">
					</div>
				</div>

				@empty

				<div class="jumbotron">
					<h2 class="text-center">
						<b>No hay imagen para mostrar</b>
					</h2>
				</div>

				@endforelse --}}
				@if ($articles->img_dest!=null)
					<div class="thumbnail">
						<div class="img_container">
							<img src="{{asset('plugins/img/articles/')}}/{{$articles->img_dest}}" class="img-responsive img_article" alt="{{ $articles->img_dest }}">
						</div>
					</div>
					@else
					<div class="jumbotron">
						<h2 class="text-center">
							<b>No hay imagen para mostrar</b>
						</h2>
					</div>
				@endif


			</div>
			<div class="col-xs-12 col-sm-12 col-md-9">
				<h4><i class="fa fa-folder-open-o" aria-hidden="true"></i><b>Categoría: </b> <span class="badge badge-primary">{{ $articles->category->name }}</span></h4>
				<h4><i class="fa fa-tags" aria-hidden="true"></i><b>Tags: </b>

					@forelse($articles->tags as $tags)

					<span class="badge badge-primary">{{$tags->name}}</span>

					@empty
					<span class="badge badge-primary">No hay tags</span>
					
					@endforelse

				</h4>
				<h4><i class="fa fa-picture-o" aria-hidden="true"></i><b>Imagenes</b>: <span class="badge badge-primary">{{count($articles->images)}}</span></h4>
				<h4><i class="fa fa-eye" aria-hidden="true"></i><b>Vistas</b> <span class="badge badge-primary">{{$articles->visitas}}</span></h4>
				<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i><a href="{{ route('member.articles.edit',$articles->id) }}"><b>Editar</b></a></h4>
				<h4><i class="fa fa-trash-o" aria-hidden="true"></i><a href="#" data-toggle="modal" data-target="#modal-delete-article-{{$articles->id}}"><b>Eliminar</b></a></h4>
				<h4><i class="fa fa-clock-o" aria-hidden="true"></i><b>Publicado {{$articles->created_at->diffForHumans()}}</b></h4>
				@if($articles->hasBeenUpdated())
				<h4><i class="fa fa-clock-o" aria-hidden="true"></i><b>Editado {{$articles->updated_at->diffForHumans()}}</b></h4>
				@endif
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-4">
						<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
						<span class="badge badge-primary">
							@if($articles->likes->count())
							<a href="#" data-toggle="modal" data-target="#likes-{{ $articles->id }}">{{ $articles->likes->count() }} <small class="hidden-xs">Likes</small></a>
							@else
							{{ $articles->likes->count() }} <small class="hidden-xs">Likes</small>
							@endif
						</span>
						@include('member.template.partials.modal-likes')
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<i class="fa fa-comments" aria-hidden="true"></i><span class="badge badge-primary"><a href="{{ route('member.article.showarticles',$articles->slug) }}">{{ $articles->coments->count() }} <small class="hidden-xs">Comentarios</small></a></span>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<i class="fa fa-share" aria-hidden="true"></i><span class="badge badge-primary"><a href="#">0 <small class="hidden-xs">veces compartido</small></a></span>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="bs-callout bs-callout-default">
			<p>{{ $articles->content }}</p>
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-3">
					<a href=""><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><b>Likes</b> </a><span class="badge badge-primary">10</span>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3">
					<a href=""><i class="fa fa-comment-o" aria-hidden="true"></i><b>Comentar</b> </a><span class="badge badge-primary">6</span>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3">
					<a href=""><i class="fa fa-share" aria-hidden="true"></i><b>Compartir</b> </a><span class="badge badge-primary">4</span>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3">
					<i class="fa fa-eye" aria-hidden="true"></i><b>Vistas</b> <span class="badge badge-primary">{{$articles->visitas}}</span>
				</div>
			</div>
		</div> --}}
	</div>
</div>

@include('member.template.partials.modal-delete')

@empty

<div class="jumbotron">
	<div class="container">
		<h1 class="text-center">No hay artículos <i class="fa fa-frown-o" aria-hidden="true"></i></h1>
		<a href="{{ route('member.articles.create') }}"><h1 class="text-center">Publica tu primer artículo</h1></a>
	</div>
</div>

@endforelse


@endsection




