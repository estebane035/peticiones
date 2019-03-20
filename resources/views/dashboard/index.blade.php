@extends('layouts.dashboard', ['menu' => "Peticiones"])

@section('content')


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
                Peticiones no atendidas
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="card-block">
              <table class="table table-striped table-bordered table-hover" id="dt-peticiones">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Coordenadas</th>
                  <th>Tipo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <!-- END CONTAINER FLUID -->

@stop

@section('scripts')
  {!!Html::script('scripts/dashboard/dashboard.js')!!}
  {!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyBVTKxPtGanYES6CZ9Y8g9MXJK3u-wKUvw&callback=initMap')!!}
@stop
