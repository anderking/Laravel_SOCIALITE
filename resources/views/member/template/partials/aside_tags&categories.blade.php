<div class="row">
	<div class="col-md-6">
		<h1><small class="small">Categories</small></h1>

		<ol class="breadcrumb">
			@forelse($category->slice(0, 20) as $categories)
			<li><a href="{{ route('member.categorie.search',$categories->name )}}">{{$categories->name}}</a></li>
			@empty
			<li>No hay Categorías</li>
			@endforelse
		@if($category->count()>20)
			<li><a href="{{ route('member.categories.index')}}">Ver mas</a></li>
		@endif

		</ol>
	</div>
	<div class="col-md-6">
		<h1><small class="small">Tags</small></h1>
		<ol class="breadcrumb">

			@forelse($tag->slice(0, 20) as $tags)
			<li><a href="{{ route('member.tag.search',$tags->name )}}">{{$tags->name}}</a></li>
			@empty
			<li>No hay Tags</li>
			@endforelse
			@if($tag->count()>20)
			<li><a href="{{ route('member.tags.index')}}">Ver mas</a></li>
			@endif
		</ol>
	</div>
</div>