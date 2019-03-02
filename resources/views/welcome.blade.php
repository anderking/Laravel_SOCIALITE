@extends ('admin.template.main')

@section('title','Laravel')
@section('body_class','laravel')
@section('main_class','laravel')

@section('style')
<style>
</style>
@endsection

@section('content')
<div class="jumbotron hidden-sm hidden-md hidden-lg">
  <div class="container">
    <h1>Aplicación de Laravel 5.1</h1>
    <p>LaravelSocialite es un sistema de blog/red social donde puedes rellenar tu perfil, publicar artículos de texto e imágenes, interactuar con los usuarios dándole like a sus artículos, comentarlos  entre otras cosas. Únete y prueba este blog social. <a href="{{ route('app') }}">Ver mas</a></p>
    <a href="{{ route('auth.login') }}" class="btn btn-default">Login</a>
    <a href="{{ route('auth.register') }}" class="btn btn-default">Register</a>
  </div>
</div>

<section id="slider" class="hidden-xs">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div id="carrusel-rds" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" >
						<div class="item active">
							<img
							class="img-responsive"
							src="{{asset('plugins/img/')}}/slider_1.png"
							title="Title"
							alt="Slider"
							/>
							<div class="carousel-caption">
								<h1>Aplicación de Laravel 5.1</h1>
								<h2>LaravelSocialite es un sistema de blog/red social donde puedes rellenar tu perfil, publicar artículos de texto e imágenes, interactuar con los usuarios dándole like a sus artículos, comentarlos  entre otras cosas. Únete y prueba este blog social.</h2>
								<a href="{{ route('app') }}" class="btn btn-default">Ver mas</a>
							</div>
						</div>
						<div class="item">
							<img
							class="img-responsive"
							src="{{asset('plugins/img/')}}/slider_2.png"
							title="Title"
							alt="Slider"
							/>
							<div class="carousel-caption">
								<h1>Aplicación de Laravel 5.1</h1>
								<h2>LaravelSocialite es un sistema de blog/red social donde puedes rellenar tu perfil, publicar artículos de texto e imágenes, interactuar con los usuarios dándole like a sus artículos, comentarlos  entre otras cosas. Únete y prueba este blog social.</h2>
								<a href="{{ route('app') }}" class="btn btn-default">Ver mas</a>
							</div>
						</div>
						<div class="item">
							<img
							class="img-responsive"
							src="{{asset('plugins/img/')}}/slider_3.png"
							title="Title"
							alt="Slider"
							/>
							<div class="carousel-caption">
								<h1>Aplicación de Laravel 5.1</h1>
								<h2>LaravelSocialite es un sistema de blog/red social donde puedes rellenar tu perfil, publicar artículos de texto e imágenes, interactuar con los usuarios dándole like a sus artículos, comentarlos  entre otras cosas. Únete y prueba este blog social.</h2>
								<a href="{{ route('app') }}" class="btn btn-default">Ver mas</a>
							</div>
						</div>
						<div class="item">
							<img
							class="img-responsive"
							src="{{asset('plugins/img/')}}/slider_4.png"
							title="Title"
							alt="Slider"
							/>
							<div class="carousel-caption">
								<h1>Aplicación de Laravel 5.1</h1>
								<h2>LaravelSocialite es un sistema de blog/red social donde puedes rellenar tu perfil, publicar artículos de texto e imágenes, interactuar con los usuarios dándole like a sus artículos, comentarlos  entre otras cosas. Únete y prueba este blog social.</h2>
								<a href="{{ route('app') }}" class="btn btn-default">Ver mas</a>
							</div>
						</div>
						<div class="item">
							<img
							class="img-responsive"
							src="{{asset('plugins/img/')}}/slider_5.png"
							title="Title"
							alt="Slider"
							/>
							<div class="carousel-caption">
								<h1>Aplicación de Laravel 5.1</h1>
								<h2>LaravelSocialite es un sistema de blog/red social donde puedes rellenar tu perfil, publicar artículos de texto e imágenes, interactuar con los usuarios dándole like a sus artículos, comentarlos  entre otras cosas. Únete y prueba este blog social.</h2>
								<a href="{{ route('app') }}" class="btn btn-default">Ver mas</a>
							</div>
						</div>
						<div class="item">
							<img
							class="img-responsive"
							src="{{asset('plugins/img/')}}/slider_6.png"
							title="Title"
							alt="Slider"
							/>
							<div class="carousel-caption">
								<h1>Aplicación de Laravel 5.1</h1>
								<h2>LaravelSocialite es un sistema de blog/red social donde puedes rellenar tu perfil, publicar artículos de texto e imágenes, interactuar con los usuarios dándole like a sus artículos, comentarlos  entre otras cosas. Únete y prueba este blog social.</h2>
								<a href="{{ route('app') }}" class="btn btn-default">Ver mas</a>
							</div>
						</div>
					</div>
					<a class="left carousel-control" href="#carrusel-rds" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span></span>
					</a>
					<a class="right carousel-control" href="#carrusel-rds" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection