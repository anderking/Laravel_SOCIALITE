@extends ('member.template.main')

@section('title','Member-Tags')
@section('body_class','member_all_tags')
@section('main_class','member_all_tags')
@section('style')
<style>

</style>
@endsection

@section('content')

		<ol class="breadcrumb">

			@forelse($tag as $tags)
			<li><a href="{{ route('member.tag.search',$tags->name )}}">{{$tags->name}}</a></li>
			@empty
			<li><a href="#">No hay Tags</a></li>
			@endforelse
		</ol>

@endsection