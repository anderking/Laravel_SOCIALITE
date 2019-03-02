<div id="likes-{{ $articles->id }}" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h2 class="text-center modal-title"> {{$articles->likes->count()}} Likes</h2>
			</div>
			<div class="modal-body">
				@forelse($articles->likes()->orderBy('likes.created_at','DESC')->get() as $likes)
				<div class="media">
					<div class="pull-left">
						<div class="box_img">
							<img src="{{asset('plugins/img/perfil/')}}/{{$likes->img_user}}" class="img-circle img_profiel" alt="{{ $likes->img_user }}">
						</div>
					</div>
					<div class="media-body">
						@if(Auth::user()->id == $likes->id)
							<h4>A <span class="badge badge-primary">Tí</span> te gusta este artículo </h4>
						@else
							<h4> A 
								<span class="badge badge-primary">
									@if(Auth::user()->admin() || Auth::user()->superadmin())
									<a href="{{ route('admin.users.show',$likes->id) }}">{{ $likes->name }}</a>
									@else
									<a href="{{ route('member.profielpublic',$likes->id) }}">{{ $likes->name }}</a>
									@endif
								</span>
							</h4>
						@endif
					</div>
				</div>
				@empty
					<h3>
						<a href="{{ route('member.article.showarticles',$articles->slug) }}"> Echa un vistazo y se el primero en darle like</a>
					</h3>
				@endforelse
			</div>
		</div>
	</div>
</div>