<div id="modal-delete-articles-coments-edit-{{$coments->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::open(array('action' => ['MemberComentsController@update',$coments],'method' => 'PUT')) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="text-center modal-title">Confirme Actualización</h3>
      </div>
      <div class="modal-body">
        {!! Form::textarea('coment', $coments->coment, ['class'=>'form-control','required','placeholder'=>'Escribe un comentario...',]) !!}
      </div>
      <div class="modal-footer">
        <div class="text-center">
          <button type="submit" class="btn btn-info" data-dissmis="modal">Enviar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>