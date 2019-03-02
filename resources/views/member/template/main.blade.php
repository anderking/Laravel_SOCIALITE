<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>@yield('title','index')</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	@include('admin.template.partials.styles')

</head>
@yield('style')
<body id="@yield('body_class')">

  <header>
    @include('admin.template.partials.nav')
  </header>

  <main class="@yield('main_class')">
    <div id="wrapper">
      @include('member.template.partials.sidebar')
      @yield('biography')
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              @include('admin.template.partials.flash')
              @include('admin.template.partials.errors')
              @yield('content')
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  @include('admin.template.partials.footer')
  @include('admin.template.partials.scripts')
  @include('admin.template.partials.alerts')
  @yield('js')

</body>
</html>