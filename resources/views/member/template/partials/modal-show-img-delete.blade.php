<div id="modal-show-articles-img-{{$images->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-content-show">
      <div class="modal-body modal-body-show">
        <img src="{{asset('plugins/img/articles/')}}/{{$images->name}}" class="img-responsive img_article_show" alt="{{ $images->name }}">
      </div>
    </div>
  </div>
</div>