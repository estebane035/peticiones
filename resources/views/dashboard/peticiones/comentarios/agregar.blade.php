@extends('layouts.modales.grande', ['nombreModal' => "crear"])

@section('content-modal')

         <div class="progress hidden" id="carga-agregar">
             <div class="progress-bar-indeterminate"></div>
         </div>
         <div class="modal-header clearfix text-left">
           <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
           </button>
           <h5>Crear <span class="semi-bold">comentario</span></h5>
         </div>
         <div class="modal-body">
         {!! Form::open(['url' => "/comentarios", 'method' => 'POST', 'id' => 'form-agregar', 'class' => 'form-horizontal']) !!}

          <div class="form-group-attached">

            <div class="row">
              <div class="col-md-12">
                <div class="form-group form-group-default">
                  <label>Contenido</label>
                  <textarea style="min-height: 100px;" name="comentarios" class="form-control no-resize">{{ $registro->comentarios }}</textarea>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-12" style="height: 15px;">
              <div></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-8">
              <div id="div-notificacion"></div>
            </div>
            <div class="col-md-4 m-t-10 sm-m-t-10" style="margin: 0px;">
              <button type="submit" class="btn btn-primary btn-block m-t-5" style="margin-top: 2px;">Guardar</button>
            </div>
          </div>
          <input type="hidden" name="peticion_id" id="peticion_id" value="{{ $peticion_id }}">
          {!! Form::close() !!}

@stop
