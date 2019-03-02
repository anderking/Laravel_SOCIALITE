<div id="modal-delete-article-{{$articles->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::open(array('action' => ['MemberArticlesController@destroy',$articles->id],'method' => 'delete')) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="text-center modal-title">Confirme eliminación</h3>
      </div>
      <div class="modal-body">
        <p class="text-center">Estas seguro de eliminar este Articulo?</p>
      </div>
      <div class="modal-footer">
        <div class="text-center">
          <button type="submit" class="btn btn-danger" data-dissmis="modal">Confirmar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>