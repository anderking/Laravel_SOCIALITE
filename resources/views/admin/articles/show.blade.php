<?php use App\Http\Controllers\MembersController; ?>
@extends ('admin.template.main')

@section('title','Admin-Articles-Show')

@section('body_class','admin_articles_show')
@section('main_class','admin_articles_show')
@section('content')

@section('style')

<style>

</style>
@endsection

<div class="page-header">
  <h1>Detalles del artículo </h1>
  <a href="{{ route('admin.articles.index') }}" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i>Regresar</a>
</div>

<div class="panel panel-primary box_flot">
	<div class="panel-heading">
		<h4>{{ $articles->title }}</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			@foreach($articles->images()->orderBy('created_at','DESC')->get() as $images)
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="box_flot">
					<div class="thumbnail">
						<a  href="#" data-toggle="modal" data-target="#modal-delete-articles-img-{{$images->id}}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
						<div class="img_container">
							<a href="#" data-toggle="modal" data-target="#modal-show-articles-img-{{$images->id}}">
								<img src="{{asset('plugins/img/articles/')}}/{{$images->name}}" class="img-responsive img_article" alt="{{ $images->name }}">
							</a>
						</div>
					</div>
					@include('member.template.partials.modal-articles-img-delete')
					@include('member.template.partials.modal-show-img-delete')
				</div>
			</div>
			@endforeach	
		</div>
		<h4><i class="fa fa-folder-open-o" aria-hidden="true"></i><b>Categoría: </b> <span class="badge badge-primary">{{ $articles->category->name }}</span></h4>
		<h4><i class="fa fa-tags" aria-hidden="true"></i><b>Tags: </b>
			@forelse($articles->tags as $tags)
			<span class="badge badge-primary">{{$tags->name}}</span>
			@empty
			<span class="badge badge-primary">No hay tags</span>
			@endforelse
		</h4>
		<h4>
			<i class="fa fa-user-o" aria-hidden="true"></i><b>Post by: <div class="box_img"><img src="{{asset('plugins/img/perfil/')}}/{{$articles->user->img_user}}" class="img-circle img_profiel" alt="{{ $articles->user->img_user }}"></div><span class="badge badge-primary"></b><a href="{{ route('admin.users.show',$articles->user->id) }}"><span class="badge badge-primary">{{ $articles->user->name }}</span></a>
		</h4>
		<h4><i class="fa fa-picture-o" aria-hidden="true"></i><b>Imagenes</b>: <span class="badge badge-primary">{{count($articles->images)}}</span></h4>
			<h4>
				<i class="fa fa-thumbs-o-up" aria-hidden="true"></i><b>Likes: </b>
				<span class="badge badge-primary">
					@if($articles->likes->count())
					<a href="#" data-toggle="modal" data-target="#likes-{{ $articles->id }}">{{ $articles->likes->count() }} <small class="hidden-xs"></small></a>
					@else
					{{ $articles->likes->count() }} <small class="hidden-xs"></small>
					@endif
				</span>
			</h4>
		@include('member.template.partials.modal-likes')
		<h4><i class="fa fa-comments" aria-hidden="true"></i><b>Comentarios:</b> <span class="badge badge-primary">{{$articles->coments()->count()}}</span></h4>
		<h4><i class="fa fa-share" aria-hidden="true"></i><b>Compartidos:</b> <span class="badge badge-primary">0</span></h4>
		<h4><i class="fa fa-eye" aria-hidden="true"></i><b>Vistas:</b> <span class="badge badge-primary">{{$articles->visitas}}</span></h4>
		{{-- 		<h4><i class="fa fa-ban" aria-hidden="true"></i><b>Denuncias:</b> <span class="badge badge-primary">10</span></h4> --}}
		<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i><a href="{{ route('admin.articles.edit',$articles->id) }}"><b>Editar</b></a></h4>
		<h4><i class="fa fa-trash-o" aria-hidden="true"></i><a href="#" data-toggle="modal" data-target="#modal-delete-articles-{{$articles->id}}"><b>Eliminar</b></a></h4>
		<h4><i class="fa fa-clock-o" aria-hidden="true"></i><b>Publicado {{$articles->created_at->diffForHumans()}}</b></h4>
		@if($articles->hasBeenUpdated())
		<h4><i class="fa fa-clock-o" aria-hidden="true"></i><b>Editado {{$articles->updated_at->diffForHumans()}}</b></h4>
		@endif
		<div class="bs-callout bs-callout-default">
			{!! $articles->content !!}
		</div>
		{{--<div class="bs-callout bs-callout-default">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<i class="fa fa-comments" aria-hidden="true"></i><small class="hidden-xs hidden-sm"><b>Comentarios</b></small> <span class="badge badge-primary">{{$articles->coments()->count()}}</span>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6">
					<a href="#"><i class="fa fa-share" aria-hidden="true"></i><small class="hidden-xs hidden-sm"><b>Compartir</b></small> </a><span class="badge badge-primary">4</span>
				</div>
			</div>
		</div>--}}

		<div id="coments">
			<div class="well">
				{!! Form::open(array('action' => ['MemberComentsController@store'],'method' => 'POST')) !!}
				<div class="from-group">
					<div class="row">
						<div class="col-md-12">
							{!! Form::text('coment', null, ['class'=>'form-control','required','placeholder'=>'Escribe un comentario...',]) !!}
						</div>
						{{-- <div class="col-md-2">
							{!! Form::submit('Comentar',['class'=>'btn btn-primary']) !!}
						</div> --}}
					</div>
				</div>
				<div class="form-group">
					{!! Form::hidden('user_id',Auth::user()->id) !!}
					{!! Form::hidden('article_id',$articles->id)!!}
				</div>
				{!! Form::close() !!}

				@forelse($articles->coments()->orderBy('coments.created_at','ASC')->get() as $coments)
				<div class="media bs-callout bs-callout-default">
					<div class="media-left">
						{{--@if(Auth::user()->id == $coments->user->id)
						<a href="{{ route('member.profiel.show',Auth::user()->id) }}">
							<img src="{{asset('plugins/img/perfil/')}}/{{ $coments->user->img_user }}" class="media-object" alt="{{ $articles->user->img_user }}">
						</a>
						@else
						<a href="{{ route('member.profielpublic',$coments->user->id) }}">
							<img src="{{asset('plugins/img/perfil/')}}/{{ $coments->user->img_user }}" class="media-object" alt="{{ $articles->user->img_user }}">
						</a>
						@endif--}}
						<a href="{{ route('admin.users.show',$coments->user->id) }}">
							<img src="{{asset('plugins/img/perfil/')}}/{{ $coments->user->img_user }}" class="media-object" alt="{{ $articles->user->img_user }}">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">
							<small>
								{{ $coments->created_at->diffForHumans() }} 
								@if ($coments->user->type=="superadmin" || $coments->user->type=="admin")
								<span class="hidden-xs badge badge-info">by {{ $coments->user->name }}</span>
								@else
								<span class="hidden-xs">by {{ $coments->user->name }}</span>
								@endif
							</small>

							@if(Auth::user()->superadmin())
							<small class="pull-right">
								<div class="dropdown">
									<a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="left" title="Editar o Eliminar">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</a>
									<ul class="dropdown-menu" aria-labelledby="dLabel">
										<li><a href="#" data-toggle="modal" data-target="#modal-delete-articles-coments-edit-{{$coments->id}}">Editar</a></li>
										<li><a href="#" data-toggle="modal" data-target="#modal-delete-articles-coments-delete-{{$coments->id}}">Eliminar</a></li>
									</ul>
								</div>
							</small>
							@else
								@if(Auth::user()->admin())
									@if(Auth::user()->id == $coments->user_id)
									<small class="pull-right">
										<div class="dropdown">
											<a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="left" title="Editar o Eliminar">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</a>
											<ul class="dropdown-menu" aria-labelledby="dLabel">
												<li><a href="#" data-toggle="modal" data-target="#modal-delete-articles-coments-edit-{{$coments->id}}">Editar</a></li>
												<li><a href="#" data-toggle="modal" data-target="#modal-delete-articles-coments-delete-{{$coments->id}}">Eliminar</a></li>
											</ul>
										</div>
									</small>
									@endif
								@endif
							@endif
						</h4>
						<p class="word-break">{{ $coments->coment }}</p>
						@if($coments->hasBeenUpdated())
						<small class="pull-right">Editado</small>
						@endif
					</div>
					@include('member.template.partials.modal-articles-coments-delete')
					@include('member.template.partials.modal-articles-coments-edit')
				</div>
				@empty
				<div class="text-center">
					<h1>No hay Comentarios</h1>
				</div>
				@endforelse
				@if (Auth::user()->superadmin() )
					@if(count($articles->coments)>0)
					<a href="#" data-toggle="modal" data-target="#modal-delete-coments-all" class="btn btn-danger">Eliminar todos los comentarios</a>
					@endif
				@endif
			</div>
		</div>
	</div>
</div>


</div>

@include('admin.template.partials.modal-delete-articles')
@include('admin.template.partials.modal-delete-coments-all')

@endsection