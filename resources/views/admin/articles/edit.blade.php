@extends ('admin.template.main')

@section('title','Admin-Articles-Edit')
@section('body_class','admin_articles_edit')
@section('main_class','admin_articles_edit')

@section('content')

<div class="text-center page-header">
	<h1 class="text-center">Actualización de artículos</h1>
</div>

{!! Form::open(array('route' => ['admin.articles.update',$article],'method' => 'PUT','files' => true)) !!}

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Editar Articulo {{ $article->title }}</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			{!! Form::label('title', 'Titulo:',['class'=>'control-label']) !!}
			{!! Form::text('title', $article->title, ['class'=>'form-control','placeholder'=>'Titulo','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('category_id', 'Categoría:',['class'=>'control-label']) !!}
			{!! Form::select('category_id', $category, $article->category->id, ['class'=>'form-control select_cat']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('content', 'Contenido:',['class'=>'control-label']) !!}
			{!! Form::textarea('content', $article->content, ['class'=>'form-control trumbowyg','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('tags', 'Tag (opcional):',['class'=>'control-label']) !!}
			{!! Form::select('tags[]',$tag, $my_tag, ['class'=>'form-control select_tag','multiple']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('img', 'Nueva imagen destacada (opcional):',['class'=>'control-label']) !!}
			{!! Form::file('img', ['class'=>'form-control','id'=>'img']) !!}
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
	<div class="panel-footer">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-10 col-md-offset-4 col-md-8">
				{!! Form::submit('Actualizar',['class'=>'btn btn-info']) !!}
				<a href="{{ route('admin.articles.edit',$article->id) }}" class="btn btn-primary">Cancelar</a>
				<a href="{{ route('admin.articles.index') }}" class="btn btn-default">Regresar</a>
			</div>
		</div>
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
