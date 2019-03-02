@extends ('admin.template.main')

@section('title','Admin-Users-Articles')
@section('body_class','admin_users_articles')
@section('main_class','admin_users_articles')
@section('content')

<div class="page-header">
  <h1 >Articulos de {{ $user->name }} </h1>
  <a href="{{ route('admin.users.index') }}" class=" btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i>Regresar</a>
  <a href="#" data-toggle="modal" data-target="#modal-delete-users-articles-all" class="btn btn-danger">Eliminar todo</a>
	@include('admin.template.partials.modal-delete-users-articles-all')
</div>

@forelse($article as $articles)

<div class="panel panel-primary box_flot">
	<div class="panel-heading">
		<h4><a href="{{ route('admin.article.showslug',$articles->slug) }}">{{ $articles->title }}</a></h4>
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

				@endforelse	--}}

				@if ($articles->img_dest!="")
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
				<h4><i class="fa fa-tags" aria-hidden="true"></i><b>Tags: </b><span class="badge badge-primary">{{count($articles->tags)}}</span></h4>
				<h4><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><b>Likes: </b><span class="badge badge-primary"><a href="#" data-toggle="modal" data-target="#likes-{{ $articles->id }}">{{ $articles->likes->count() }}</a></span></h4>
				@include('member.template.partials.modal-likes')
				<h4><i class="fa fa-comments" aria-hidden="true"></i><b>Comentarios: </b><a href="#"><span class="badge badge-primary">{{$articles->coments()->count()}}</span></a></h4>
				<h4><i class="fa fa-share" aria-hidden="true"></i><b>Compartidos:</b> <span class="badge badge-primary">0</span></h4>
				<h4><i class="fa fa-eye" aria-hidden="true"></i><b>Vistas:</b> <span class="badge badge-primary">{{$articles->visitas}}</span></h4>

				<h4><i class="fa fa-picture-o" aria-hidden="true"></i><b>Imagenes</b>: <span class="badge badge-primary">{{count($articles->images)}}</span></h4>
				<h4><i class="fa fa-clock-o" aria-hidden="true"></i><b>{{$articles->created_at->diffForHumans()}}</b></h4>
				@if($articles->hasBeenUpdated())
				<h4><i class="fa fa-clock-o" aria-hidden="true"></i><b>Editado {{$articles->updated_at->diffForHumans()}}</b></h4>
				@endif
			</div>
		</div>
{{-- 		<div class="bs-callout bs-callout-default">
			<p>{{ $articles->content }}</p>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-2">
					<a href=""><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Likes </a><b><span class="badge badge-primary">10</span></b>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-2">
					<a href=""><i class="fa fa-comment-o" aria-hidden="true"></i><b>Comentar </a><b><span class="badge badge-primary">6</span></b>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-2">
					<a href=""><i class="fa fa-ban" aria-hidden="true"></i><b>Denunciar </a><b><span class="badge badge-primary">9</span></b>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-2">
					<a href=""><i class="fa fa-share" aria-hidden="true"></i><b>Compartir </a><b><span class="badge badge-primary">4</span></b>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-2">
					<i class="fa fa-eye" aria-hidden="true"></i><b>Vistas <b><span class="badge badge-primary">{{$articles->visitas}}</span></b>
				</div>
			</div>
		</div> --}}
	</div>
</div>

@empty
<div class="jumbotron">
	<h1>Este usuario no tiene articulos</h1>
</div>
@endforelse

<div class="text-centee">
	{!! $article->render() !!}
</div>

@endsection

