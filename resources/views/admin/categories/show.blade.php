@extends ('admin.template.main')

@section('title','Admin-Categories-Show')
@section('body_class','admin_categories_show')
@section('main_class','admin_categories_show')

@section('content')

<div class="text-center page-header">
	<h1 class="text-center">Detalles de la Categoría {{ $category->name }}</h1>
</div>

<div class="panel panel-primary box_flo">
	<div class="panel-heading">
		<h3 class="panel-title">{{ $category->name }}</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
				<ul class="list-group">
					<li class="list-group-item"><b>ID: </b>{{ $category->id }}</li>
					<li class="list-group-item"><b>Nombre: </b>{{ $category->name }}</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<div class="text-center">
			<a href="{{ URL::previous() }}" class="btn btn-default btn-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i>Regresar</a>
		</div>
	</div>
</div>

@endsection