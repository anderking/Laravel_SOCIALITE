<div id="modal-photo-bio" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::open(array('route' => ['member.photobio.update',$user],'method' => 'PUT','files' => true)) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="text-center modal-title">Cambiar foto biografía</h3>
      </div>
      <div class="modal-body">
            {!! Form::file('img_bio', ['class'=>'form-control','id'=>'img_bio','required']) !!}
      </div>
{{--       <div class="modal-footer">
        <div class="text-center">
          <button type="submit" class="btn btn-info" data-dissmis="modal">Enviar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
      </div> --}}
      {!! Form::close() !!}
    </div>
  </div>
</div>