@extends('layouts.modales.chico', ['nombreModal' => "eliminar"])

@section('content-modal')
      {!! Form::open(['route' => ['peticiones.destroy', $registro->id], 'method' => 'DELETE', 'id' => 'form-eliminar', 'class' => 'form-horizontal']) !!}
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5>Eliminar peticion</h5>
        </div>
        <div class="modal-body">
          <p class="p-b-10">¿Seguro que deseas eliminar la peticion  #<span class="bold">{{ $registro->id }}</span>?</p>
          <div class="row">
            <div class="col-md-12" style="height: 15px;">
              <div></div>
            </div>
          </div>
          <div class="progress hidden" id="carga-eliminar">
              <div class="progress-bar-indeterminate"></div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div id="div-notificacion"></div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-cons  pull-left inline">Aceptar</button>
          <button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">Cancelar</button>
        </div>
      {!! Form::close() !!}
@stop
