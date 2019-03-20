@extends('layouts.modales.grande', ['nombreModal' => "crear"])

@section('content-modal')

         <div class="progress hidden" id="carga-agregar">
             <div class="progress-bar-indeterminate"></div>
         </div>
         <div class="modal-header clearfix text-left">
           <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
           </button>
           <h5>Atender peticion</span></h5>
         </div>
         <div class="modal-body">
           {!! Form::open(['url' => "/peticiones/".$registro->id."/atenderPeticion", 'method' => 'PUT', 'id' => 'form-agregar', 'class' => 'form-horizontal']) !!}
          <div class="form-group-attached">

            <div class="row">
              <div class="col-md-12">
                <div class="form-group form-group-default">
                  <label>Tipo</label>
                  <input type="text" class="form-control" value="{{ $registro->tipo }}" data-animation="false" readonly>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="form-group form-group-default">
                  <label>Comentarios</label>
                  <textarea  class="form-control no-resize" readonly>{{ $registro->comentarios }}</textarea>
                </div>
              </div>
            </div>

            <div class="m-t-20" id="mapa" style="height: 400px;"></div>

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
              <button type="submit" class="btn btn-primary btn-block m-t-5" style="margin-top: 2px;">Atender</button>
            </div>
          </div>

          {!! Form::close() !!}

@stop
