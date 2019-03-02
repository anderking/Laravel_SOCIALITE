@if(Auth::user())

@if(Auth::user()->type=="admin" || Auth::user()->type=="superadmin")

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-left" >
        <li class="{{ active('admin.home') }}"><a href="{{ route('admin.home') }}"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
        <li class="{{ active('admin.users.*') }}"><a href="{{ route('admin.users.index') }}"><i class="fa fa-user" aria-hidden="true"></i>Users</a></li>
        <li class="{{ active('admin.categories.*') }}"><a href="{{ route('admin.categories.index') }}"><i class="fa fa-folder-open-o" aria-hidden="true"></i>Category</a></li>
        <li class="{{ active(['admin.articles.*','admin.article.showslug']) }}"><a href="{{ route('admin.articles.index') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i>Articles</a></li>
        <li class="{{ active('admin.tags.*') }}"><a href="{{ route('admin.tags.index') }}"><i class="fa fa-tags" aria-hidden="true"></i>Tags</a></li>
        <li class="{{ active('admin.img.*') }}"><a href="{{ route('admin.img.index') }}"><i class="fa fa-picture-o" aria-hidden="true"></i>Images</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="hidden-xs"><a href="{{ route('admin.home') }}">{{Auth::user()->name}}</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle img_dropdown" data-toggle="dropdown">
            <div class="navbar-header hidden-xs">
              <div class="box_img">
                <img src="{{asset('plugins/img/perfil/')}}/{{Auth::user()->img_user}}" class="img-circle img_profiel" alt="{{ Auth::user()->img_user }}">
              </div>
            </div>
            <div class="hidden-sm hidden-md hidden-lg">
              <i class="fa fa-user-circle-o" aria-hidden="true"></i>{{Auth::user()->name}} <b class="caret"></b>
            </div>
          </a>
          <ul class="dropdown-menu .logout">
            <li><a href="{{ route('auth.logout') }}">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

@elseif(Auth::user()->type=="member")

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#menu-toggle" id="menu-toggle">Menu</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right" >
          <li class="navbar-header">
            <div class="box_img"><a href="{{ route('member.profiel.show',Auth::user()->id) }}" class="navbar-brand"><img src="{{asset('plugins/img/perfil/')}}/{{Auth::user()->img_user}}" class="img-circle img_profiel" alt="{{ Auth::user()->img_user }}"></a></div><a href="{{ route('member.profiel.show',Auth::user()->id) }}" class="navbar-brand">{{Auth::user()->name}}</a>
          </li>
      </ul>
    </div>
  </div>
</nav>

@endif

@else

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand navbar-brand-laravel" href="{{ url('/') }}">LaravelSocialite</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right" >
        <li class="{{ active('app') }}"><a href="{{ route('app') }}" >App</a></li>
        <li class="{{ active('auth.login') }}"><a href="{{ route('auth.login') }}" >Login</a></li>
        <li class="{{ active('auth.register') }}"><a href="{{ route('auth.register') }}">Register</a></li>
      </ul>
    </div>
  </div>
</nav>

@endif