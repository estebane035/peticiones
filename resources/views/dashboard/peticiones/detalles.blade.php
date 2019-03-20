@extends('layouts.dashboard', ['menu' => "Peticiones"])

@section('content')

<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/peticiones">Peticiones</a></li>
        <li class="breadcrumb-item active">Detalle de la peticion</li>
      </ol>
      <!-- END BREADCRUMB -->
    </div>
  </div>
</div>
<!-- END JUMBOTRON -->

<!-- START CONTAINER FLUID -->
<div class=" container-fluid   container-fixed-lg">
  <!-- START card -->
  <!--<div class="progress hidden" id="carga-dt">
      <div class="progress-bar-indeterminate"></div>
  </div>-->
  <div class="card card-transparent widget-loader-bar" id="carga-dt">
    <div class="card card-transparent">
      <div class="card-block no-padding">
        <div id="card-advance" class="card card-default">
          <div class="card-header  ">
            <div class="card-title">
              Detalle de la peticion # {{ $registro->id }}
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="card-block">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group form-group-default">
                  <label>Estatus</label>
                  <input type="text"  class="form-control" value="{{ $registro->estatus }}" readonly data-animation="false">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group form-group-default">
                  <label>Tipo</label>
                  <input type="text" class="form-control" value="{{ $registro->tipo }}" readonly data-animation="false">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group form-group-default">
                  <label>Comentarios</label>
                  <textarea  class="form-control no-resize" readonly>{{ $registro->comentarios }}</textarea>
                </div>
              </div>
              <input type="hidden" id="latitud" value="{{ $registro->latitud }}">
              <input type="hidden" id="longitud" value="{{ $registro->longitud }}">
            </div>

            <div class="m-t-20" id="map" style="height: 800px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <!-- END CONTAINER FLUID -->

@stop

@section('scripts')
  {!!Html::script('scripts/dashboard/detalle_peticion.js')!!}
  {!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyBVTKxPtGanYES6CZ9Y8g9MXJK3u-wKUvw')!!}
@stop
