@extends ('member.template.main')

@section('title','Member-Profiel-Public')
@section('body_class','member_profielpublic')
@section('main_class','member_profielpublic')

@section('style')
<style>

.rp {
	position: relative;
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-orient: vertical;
	-webkit-box-direction: normal;
	-ms-flex-direction: column;
	flex-direction: column;
	background-color: #fff;
	border: 1px solid rgba(0, 0, 0, 0.125);
	border-radius: 0.25rem;

}
.bqq .rv {
	min-height: 45vh;
	background-size: cover;
}
.rv:first-child {
	border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.rv {
	padding: 0.75rem 1.25rem;
	margin-bottom: 0;
	background-color: #f7f7f9;
	border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.awx {
	text-align: center !important;
}
.rq {
	-webkit-box-flex: 1;
	-ms-flex: 1 1 auto;
	flex: 1 1 auto;
	padding: 1.25rem;
}
.bqr {
	max-width: 100px;
	margin-top: -70px;
	margin-bottom: 5px;
	border: 3px solid #fff;
	border-radius: 100%;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
.bqq .rr {
	margin-bottom: 5px;
}
.bqs {
	list-style: none;
	padding: 0;
}
.bqt {
	display: inline-block;
	padding: 0 10px;
	border-right: 1px solid #d4dbe0;
}
.bqt:last-child {
	border-right: 0;
}
#about .list-group-item{
	margin: 0 !important;
	padding: .5em !important;
}
.bqt h3 a{
	color: #3e3f3a
}
.bqt h3 a:hover{
	color: #325d88
}
</style>

@endsection

@section('content')
		<div class="rp bqq agk box_flot">
			<div class="rv" style="background-image: url('{{asset('plugins/img/portada/')}}/{{$user->img_bio}}') !important;"></div>
			<div class="rq awx">
				<img src="{{asset('plugins/img/perfil/')}}/{{$user->img_user}}" class="bqr" alt="">

				<h2 class="rr">
					{{ $user->name }}
				</h2>
				<p class="agk">{{ $user->bio_description }}</p>
				<ul class="bqs">
					{{--<li class="bqt">
						Friends
						<h3 class="afl">12</h3>
					</li>--}}
					<li class="bqt">
						Posts
						<h3 class="afl">{{$user->articles->count()}}</h3>
					</li>
					@if($user->facebook!="")
					<li class="bqt">
						Facebook
						<h3>
							<a href="https://www.facebook.com/{{ $user->facebook }}"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
						</h3>
					</li>
					@endif
					@if($user->twitter!="")
					<li class="bqt">
						Twitter
						<h3>
							<a href="https://www.twitter.com/{{ $user->twitter }}"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
						</h3>
					</li>
					@endif
					@if($user->instagram!="")
					<li class="bqt">
						Instagram
						<h3>
							<a href="https://www.instagram.com/{{ $user->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
						</h3>
					</li>
					@endif
				</ul>
			</div>
		</div>
@endsection