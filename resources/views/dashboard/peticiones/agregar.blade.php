@extends('layouts.modales.grande', ['nombreModal' => "crear"])

@section('content-modal')

         <div class="progress hidden" id="carga-agregar">
             <div class="progress-bar-indeterminate"></div>
         </div>
         <div class="modal-header clearfix text-left">
           <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
           </button>
           <h5>{{ $registro=='[]' ? 'Nuevo reporte de peticion' : 'Editando la peticion #' }} <span class="semi-bold">{{ $registro->id }}</span></h5>
           <p class="p-b-10">Ingrese los necesarios</p>
         </div>
         <div class="modal-body">
          @if ($registro=='[]')
             {!! Form::open(['route' => ['peticiones.store'], 'method' => 'POST', 'id' => 'form-agregar', 'class' => 'form-horizontal']) !!}
          @else
             {!! Form::open(['route' => ['peticiones.update', $registro->id], 'method' => 'PUT', 'id' => 'form-agregar', 'class' => 'form-horizontal']) !!}
          @endif

          <div class="form-group-attached">

            <div class="form-group form-group-default form-group-default-select2 ">
              <label>Tipo</label>
              <select class="full-width " id="tipo" name="tipo" required="">
                <option {{ $registro->tipo == 'Seguridad Publica'?'selected':''}} value="Seguridad Publica">Seguridad Publica</option>
                <option {{ $registro->tipo == 'Asistencia Medica'?'selected':''}} value="Asistencia Medica">Asistencia Medica</option>
                <option {{ $registro->tipo == 'Proteccion Civil'?'selected':''}} value="Proteccion Civil">Proteccion Civil</option>
              </select>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>Latitud</label>
                  <input type="text" id="latitud" name="latitud" class="form-control" value="{{ $registro->latitud }}" required data-animation="false">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>Longitud</label>
                  <input type="text" id="longitud" name="longitud" class="form-control" value="{{ $registro->longitud }}" required data-animation="false">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group form-group-default">
                  <label>Comentarios</label>
                  <textarea name="comentarios" class="form-control no-resize">{{ $registro->comentarios }}</textarea>
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

          {!! Form::close() !!}

@stop
