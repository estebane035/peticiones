@extends('layouts.dashboard', ['menu' => "Peticiones"])

@section('content')

<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Reportes de peticiones</li>
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
              Reportes de peticiones
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="card-block">
            <div class="row">

              <div class="col-md-4">
                <div class="form-group form-group-default required">
                  <label>Latitud</label>
                  <input type="number" id="latitud" class="form-control" required="">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group form-group-default required">
                  <label>Longitud</label>
                  <input type="number" id="longitud" class="form-control" required="">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group form-group-default required">
                  <label>Rango (MI)</label>
                  <input type="number" id="rango" class="form-control" required="" value="10">
                </div>
              </div>

              <div class="col-md-2 p-t-10">
                <button class="btn btn-primary full-width" onclick="buscar();">Buscar</button>
              </div>

            </div>
            <div id="map" style="height: 800px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <!-- END CONTAINER FLUID -->

@stop

@section('scripts')
  {!!Html::script('scripts/dashboard/reportes.js')!!}')
  {!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyBVTKxPtGanYES6CZ9Y8g9MXJK3u-wKUvw&callback=initMap')!!}
@stop
