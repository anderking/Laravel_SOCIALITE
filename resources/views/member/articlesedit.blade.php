@extends ('member.template.main')

@section('title','Member-Articles-Edit')
@section('body_class','member_articlesedit')
@section('main_class','member_articlesedit')

@section('content')
{!! Form::open(array('route' => ['member.articles.update',$article],'method' => 'PUT','files' => true)) !!}
<div class="panel panel-primary box_flot">
	<div class="panel-heading">
		<h3 class="panel-title">Editar Articulo {{ $article->title }}</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('title', 'Titulo:',['class'=>'control-label']) !!}
					{!! Form::text('title', $article->title, ['class'=>'form-control','placeholder'=>'Titulo','required']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('content', 'Contenido:',['class'=>'control-label']) !!}
					{!! Form::textarea('content', $article->content, ['class'=>'form-control trumbowyg','required']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('category_id', 'Categoría:',['class'=>'control-label']) !!}
					{!! Form::select('category_id', $category, $article->category->id, ['class'=>'form-control select_cat']) !!}
					<p><a href="{{ route('member.categories.create') }}">¿Nueva Categoría?</a></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('tags', 'Tag:',['class'=>'control-label']) !!}
					{!! Form::select('tags[]',$tag, $my_tag, ['class'=>'form-control select_tag','multiple']) !!}
					<p><a href="{{ route('member.tags.create') }}">¿Nuevo Tag?</a></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				{!! Form::label('img', 'Nueva imagen destacada (opcional):',['class'=>'control-label']) !!}
				{!! Form::file('img', ['class'=>'form-control','id'=>'img']) !!}
			</div>
		</div>
		<div class="row">
			<div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
				@if ($article->img_dest!="")
					<div class="thumbnail">
						<div class="img_container">
							<img src="{{asset('plugins/img/articles/')}}/{{$article->img_dest}}" class="img-responsive img_article" alt="{{ $article->img_dest }}">
						</div>
					</div>
					@else
					<div class="jumbotron">
						<h2 class="text-center">
							<b>No hay imagen destacada para mostrar</b>
						</h2>
					</div>
				@endif
			</div>
		</div>
	</div>
	<div class="panel-footer text-center">
		{!! Form::submit('Actualizar',['class'=>'btn btn-info']) !!}
		<a href="{{ route('member.articles.edit',$article->id) }}" class="btn btn-primary">Cancelar</a>
		<a href="{{ route('member.articles.show',Auth::user()->id) }}" class="btn btn-default">Regresar</a>
	</div>
</div>
{!! Form::close() !!}
@endsection

@section('js')
<script>

	$("#img").fileinput({
		showUpload: false,
   });

</script>

@endsection
