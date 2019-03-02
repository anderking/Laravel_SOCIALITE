<div id="coments-articles" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h2 class="text-center modal-title"> Artículos que has comentado</h2>
			</div>
			<div class="modal-body">
				@forelse($coments_articles as $articles_coments)
				<div class="media">
					<div class="pull-left">
						@if ($articles_coments->img_dest!="")
						<div class="box_img">
							<img src="{{asset('plugins/img/articles/')}}/{{$articles_coments->img_dest}}" class="img-circle img_profiel" alt="{{$articles_coments->img_dest}}">
						</div>
						@else
						<div class="box_img">
							<img src="{{asset('plugins/img/')}}/sin-imagen.jpg" class="img-circle img_profiel" alt="sin-imagen.jpg">
						</div>
						@endif
					</div>
					<div class="media-body">
						<h4><a href="{{ route('member.article.showarticles',$articles_coments->slug) }}">{{ $articles_coments->title }}</a></h4>
					</div>
				</div>
				@empty
					<h3>No hay artículos</h3>
				@endforelse
			</div>
		</div>
	</div>
</div>