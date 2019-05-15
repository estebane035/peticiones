@extends('layouts.dashboard', ['menu' => "Dashboard"])

@section('content')


  <!-- START CONTAINER FLUID -->
  <div class=" container-fluid   container-fixed-lg m-t-20">
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
                Historial de peticiones
	          </div>
	          <div class="pull-right">
		          <div class="col-xs-12">
		          	<button class="btn btn-primary" onclick="agregar()">Crear nueva peticion</button>
		          </div>
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
                  <th>Estatus</th>
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
  {!!Html::script('scripts/dashboard/dashboardUser.js')!!}
  {!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyBVTKxPtGanYES6CZ9Y8g9MXJK3u-wKUvw&callback=initMap')!!}
@stop
