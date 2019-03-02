@extends ('admin.template.main')

@section('title','Laravel')
@section('body_class','laravel_app')
@section('main_class','laravel_app')

@section('style')
<style>

</style>
@endsection

@section('content')

<div class="jumbotron">
  <div class="container">
    <h1>Información de la Aplicación</h1>
    <p><strong>LaravelSocialite</strong> es un sistema de blog/red social donde puedes rellenar tu perfil, publicar artículos de texto e imágenes, interactuar con los demás usuarios dándole likes a sus artículos, comentarlos entre otras cosas. Surgió en base a la idea de desarrollar una pequeña Red Social haciendo uso de los lenguajes como HTML5, CSS3, JAVSCRIPT y PHP con ayuda de los Frameworks como Bootstrap 3 y Laravel 5.1 y el uso de librerías como jQuery entre otras. Donde se llevaron a cabo los principios de la programación orientada a objetos, así como el manejo de una base de datos MySQL.</p>
    <p><strong>LaravelSocialite no tiene la infraestructura de las redes sociales actuales como Facebook, Twitter, Instagram, etc. Es solo una App básica para su exibición y manipulación por parte de los espectadores.</strong></p>
    <hr>
    <h2>Infraestructura de la aplicación</h2>
    <h3>1. Tres niveles de acceso y usuarios:</h3>
    <ul class=" nav nav-tabs" role="tablist">
    	<li class="box_efect_tab active" role="presentation">
    		<a href="#member" aria-controls="member" role="tab" data-toggle="tab">
    		<div class="box_img">
    			<img src="{{asset('plugins/img/perfil/')}}/member.jpg" class="img-circle img_profiel" alt="">
				</div>
				<div class="label label-info">Miembros</div>
				</a>
			</li>
			<li class="box_efect_tab">
				<a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">
					<div class="box_img">
						<img src="{{asset('plugins/img/perfil/')}}/admin.jpg" class="img-circle img_profiel" alt="">
					</div>
					<div class="label label-primary">Administradores</div>
				</a>
			</li>
    	<li class="box_efect_tab">
    		<a href="#superadmin" aria-controls="superadmin" role="tab" data-toggle="tab">
	    		<div class="box_img">
	    			<img src="{{asset('plugins/img/perfil/')}}/super_admin.jpg" class="img-circle img_profiel" alt="">
					</div>
	    		<div class="label label-success">SuperAdmin</div>
	    	</a>
    	</li>
    </ul>
    <div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="member">
	    	<p><strong>Miembros:</strong> Son aquellas personas que han creado sus cuentas mediante un correo y una contraseña en la página de inicio. Estos usuarios podrán acceder a la sección para usuarios miembros a contenidos especiales, ver, publicar, editar, eliminar artículos, subir fotos, comentar, dar likes, editar información general, crear tags y categorías, etc.</p>
	    	<a href="{{ route('auth.register') }} " class="btn btn-primary">Registrate</a>

	    </div>
	    <div role="tabpanel" class="tab-pane" id="admin">
	    	<p><strong>Administradores</strong>: Son los usuarios creados por el SuperAdmin que podrán acceder a la sección para usuarios administradores donde pueden ver, manipular, supervisar, editar toda la información respectiva de los usuarios miembros y sus artículos, dar de alta o baja a usuarios, etc.</p>
	    	<h3>Inicia sesión con estos datos</h3>
	    	<p><strong>Usuario:</strong> admin@gmail.com</p>
	    	<p><strong>Contraseña:</strong> admin</p>
	    	<a href="{{ route('auth.login') }} " class="btn btn-primary">Login</a>
	    </div>
	    <div role="tabpanel" class="tab-pane" id="superadmin">
	    	<p><strong>SuperAdmin</strong>: Existe un único usuario de este tipo que podrá acceder a la sección tanto para usuarios administradores como para miembros, el cual tiene potestad absoluta sobre el resto de usuarios, tiene todas las funcionalidades del usuario administrador sin restricciones, es el único que puede crear nuevos usuarios administradores, tiene acceso a la base de datos física de la aplicación y a los archivos internos de la misma.</p>
	    	<h3>Inicia sesión con estos datos</h3>
	    	<p><strong>Usuario:</strong> superadmin@gmail.com</p>
	    	<p><strong>Contraseña:</strong> superadmin</p>
	    	<a href="{{ route('auth.login') }} " class="btn btn-primary">Login</a>
	    </div>
  	</div>
  	<hr>
  	<h3>2. Módulos</h3>
  	<p><strong>Usuarios:</strong> Se pueden registrar para acceder a sus cuentas.</p>
  	<p><strong>Artículos:</strong> Cada usuario puede publicar sus artículos y lo visualizara en el muro de artículos.</p>
  	<p><strong>Perfiles:</strong> Los usuarios pueden rellenar su perfil, escribir sobre ellos, agregar descripción, etc.</p>
  	<p><strong>Likes:</strong> Los usuarios pueden darle likes a las publicaciones de los demás.</p>
  	<p><strong>Comentarios:</strong> Los usuarios pueden escribir comentarios en las publicaciones de los demás.</p>
  	<p><strong>Imágenes:</strong> Los usuarios pueden subir imágenes, cambiar imagen de perfil, de biografía, publicaciones, etc.</p>
  	<p><strong>Categorías:</strong> Los usuarios pueden crear categorías para asociarlas a los artículos</p>
  	<p><strong>Tags:</strong> Los usuarios pueden crear tags para asociarlas a los artículos</p>
  </div>
  <div>


</div>
</div>
@endsection