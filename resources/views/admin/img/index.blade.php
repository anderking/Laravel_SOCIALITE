@extends ('admin.template.main')

@section('title','Admin-Image')
@section('body_class','admin_img_index')
@section('main_class','admin_img_index')

@section('content')
@if(count($image)>0)
<div class="page-header">
  <h1 class="text-center">Images Posts</h1>
</div>
<div class="row">
	@foreach($image as $images)
		<div class="col-xs-12 col-sm-4 col-md-3">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="thumbnail box_flot">
						<div class="img_container">
							<img src="{{asset('plugins/img/articles/')}}/{{$images->name}}" class="img-responsive img_article" alt="{{ $images->name }}">
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="{{ route('admin.articles.show',$images->article->id) }}">{{ str_limit($images->article->title, $limit = 30, $end = '...') }}</a>
				</div>
			</div>
		</div>
	@endforeach		
</div>
<div class="text-center">
	{!! $image->render() !!}
</div>
@else
	<div class="jumbotron">
		<h1 class="text-center">No existen registros de Imagenes en nuestra Base de Datos</h1>
		<p>Cree un nuevo articulo para visualizar el catalogo de imagenes.</p>
		<h2><a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Nuevo Artículo</a></h2>
	</div>
	
@endif
@endsection