@extends ('member.template.main')

@section('title','Member-Categories')
@section('body_class','member_all_categories')
@section('main_class','member_all_categories')
@section('style')
<style>

</style>
@endsection

@section('content')
<ol class="breadcrumb">

	@forelse($category as $categories)
	<li><a href="{{ route('member.categorie.search',$categories->name )}}">{{$categories->name}}</a></li>
	@empty
	<li><a href="#">No hay Categorías</a></li>
	@endforelse

</ol>
@endsection