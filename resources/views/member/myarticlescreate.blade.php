@extends ('member.template.main')

@section('title','Member-My-Articles-Create')
@section('body_class','member_myarticlescreate')
@section('main_class','member_myarticlescreate')

@section('content')
@if(count($category_all)>0)

{!! Form::open(array('route' => 'member.articles.store','method' => 'POST','files' => true)) !!}
<div class="panel panel-primary box_flot">
	<div class="panel-heading">
		<h4>Publica un nuevo artículo</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('title', 'Titulo:',['class'=>'control-label']) !!}
					{!! Form::text('title', null, ['class'=>'form-control','placeholder'=>'Titulo','required']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('content', 'Contenido:',['class'=>'control-label']) !!}
					{!! Form::textarea('content', null, ['class'=>'form-control trumbowyg','required']) !!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('category_id', 'Categoría:',['class'=>'control-label']) !!}
					{!! Form::select('category_id', $category, null, ['class'=>'form-control select_cat']) !!}
					<p>
						<a href="{{ route('member.categories.create') }}">¿Nueva Categoría?</a>
					</p>
				</div>
				<div class="form-group">
					{!! Form::label('tags', 'Tag (opcional):',['class'=>'control-label']) !!}
					{!! Form::select('tags[]',$tag, null, ['class'=>'form-control select_tag','multiple']) !!}
					<p>
						<a href="{{ route('member.tags.create') }}">¿Nuevo Tag?</a>
					</p>
				</div>
				<div class="form-group">
					{!! Form::label('img', 'Imagen destacada (opcional):',['class'=>'control-label']) !!}
					{!! Form::file('img', ['class'=>'form-control','id'=>'img']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('user_id',Auth::user()->id) !!}
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer text-center">
		{!! Form::submit('Publicar',['class'=>'btn btn-info']) !!}
		<a href="{{ route('member.articles.create') }}" class="btn btn-primary">Cancelar</a>
		<a href="{{ route('member.articles.show',Auth::user()->id) }}" class="btn btn-default">Regresar</a>
	</div>
</div>
{!! Form::close() !!}

@else
	<div class="jumbotron">
		<h1>No existen categorías registradas</h1>
		<p>No puede publicar articulos sin categorías, por favor cree una nueva categoría.</p>
		<h2><a href="{{ route('member.categories.create') }}" class="btn btn-primary">Nueva Categoría</a></h2>
	</div>
@endif

@endsection

@section('js')

<script>

  $("#img").fileinput({
		showUpload: false,
  });
</script>

@endsection