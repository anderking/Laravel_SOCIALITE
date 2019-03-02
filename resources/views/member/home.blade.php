
@extends ('member.template.main')

@section('title','Member-Home')
@section('body_class','member_home')
@section('main_class','member_home')
@section('style')
<style>

</style>
@endsection
@section('content')

@include('member.template.partials.aside_tags&categories')
	@if(Auth::user()->superadmin())
	<p><strong>Nota:</strong> Los artículos publicados por el usuario superadmin no se visualizan en el Home</p>
	@endif
@forelse($article as $articles)
@if($articles->user->type =="admin")
<div class="panel panel-info box_flot">
@else
<div class="panel panel-primary box_flot">
@endif
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
				<h4><i class="fa fa-tags" aria-hidden="true"></i><b>Tags: </b>

					@forelse($articles->tags as $tags)

					<span class="badge badge-primary">{{$tags->name}}</span>

					@empty
					<span class="badge badge-primary">No hay tags</span>
					
					@endforelse

				</h4>

				<h4>
					<i class="fa fa-user-o" aria-hidden="true"></i><b>Post by: </b>
					<div class="box_img">
						<img src="{{asset('plugins/img/perfil/')}}/{{$articles->user->img_user}}" class="img-circle img_profiel" alt="{{ $articles->user->img_user }}">
					</div>
					@if($articles->user->type =="admin")
					<span class="badge badge-info">
					@else
					<span class="badge badge-primary">
					@endif
					@if(Auth::user()->id == $articles->user->id)
					<a href="{{ route('member.profiel.show',Auth::user()->id) }}">{{ $articles->user->name }}</a>
					@else
					<a href="{{ route('member.profielpublic',$articles->user->id) }}">{{ $articles->user->name }}</a>
					@endif
					</span>
				</h4>
				<h4><i class="fa fa-picture-o" aria-hidden="true"></i><b>Imagenes: </b> <span class="badge badge-primary">{{count($articles->images)}}</span></h4>
				<h4><i class="fa fa-eye" aria-hidden="true"></i><b>Vistas: </b> <span class="badge badge-primary">{{$articles->visitas}}</span></h4>
				<h4><i class="fa fa-clock-o" aria-hidden="true"></i><b>{{$articles->created_at->diffForHumans()}}</b></h4>
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
						<i class="fa fa-share" aria-hidden="true"></i><span class="badge badge-primary">0 <small class="hidden-xs">veces compartido</small></span>
					</div>
				</div>
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
	<h1>No hay artículos publicados</h1>
	<h2><a href="{{ route('member.articles.create') }}">Se el primero en publicar un artículo</a></h2>

</div>

@endforelse

<div class="clearfix"></div>
	<div class="text-center">
		{!! $article->render() !!}
	</div>

@endsection