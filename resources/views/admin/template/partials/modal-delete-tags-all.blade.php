<div id="modal-delete-tags-all" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::open(array('action'=> 'TagsController@destroyall','method' => 'get')) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="text-center modal-title">Confirme eliminación</h3>
      </div>
      <div class="modal-body">
        <p class="text-center">Se eliminaran todos los tags, sus articulos relacionados y no se podra recuperar la información, estas seguro?</p>
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