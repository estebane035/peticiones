@extends('layouts.dashboard', ['menu' => "Peticiones"])

@section('content')

<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Historial de peticiones <i onclick="agregar()" style="margin-right: 10px;" class="fa fa-plus fa-lg col-xs-4 text-center pointer" title="Agregar"></i></li>
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
              Peticiones
            </div>
            <div class="pull-right">
              <div class="col-xs-12">
                <button class="btn btn-primary" onclick="agregar()">Agregar Peticion manualmente</button>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="card-block">
            <table class="table table-striped table-bordered table-hover" id="dt-datos">
            <thead>
              <tr>
                <th>Id</th>
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
  {!!Html::script('scripts/dashboard/peticiones.js')!!}
@stop
