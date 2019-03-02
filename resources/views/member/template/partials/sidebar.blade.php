<div id="sidebar-wrapper">
	<ul class="sidebar-nav">
		<li class="sidebar-brand">
			<a href="#"></a>
		</li>
		<li class="{{ active(['member.index','member.categorie.search','member.categories.index','member.tag.search','member.tags.index']) }}" >
			<a  href="{{ route('member.index') }}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
		</li>
		<li class="{{ active('member.profiel.show') }}">
			<a href="{{ route('member.profiel.show',Auth::user()->id) }}"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs">Profiel</span> <small class="hidden-sm hidden-md hidden-lg">{{ Auth::user()->name }}</small></a>
		</li>
		<li class="{{ active('member.dashboard') }}">
			<a href="{{ route('member.dashboard',Auth::user()->id) }}"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a>
		</li>
		<li class="{{ active(['member.articles.*','member.article.showarticles']) }}">
			<a href="{{ route('member.articles.show',Auth::user()->id) }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i>Articles</a>
		</li>
		<li class="{{ active('member.categories.create') }}">
			<a href="{{ route('member.categories.create') }}"><i class="fa fa-folder-open-o" aria-hidden="true"></i>Create Categories</a>
		</li>
		<li class="{{ active('member.tags.create') }}">
			<a href="{{ route('member.tags.create') }}"><i class="fa fa-tags" aria-hidden="true"></i>Create Tags</a>
		</li>
		<li class="{{ active('member.config') }}">
			<a href="{{ route('member.config',Auth::user()->id) }}"><i class="fa fa-cog" aria-hidden="true"></i> Configuración</a>
		</li>
		<li>
			<a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
		</li>
	</ul>
</div>