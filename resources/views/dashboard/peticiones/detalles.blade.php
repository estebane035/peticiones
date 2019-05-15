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

  <div class="card card-transparent ">
  	<ul class="nav nav-tabs nav-tabs-fillup hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
  		<li class="nav-item">
  			<a href="#" class="active" data-toggle="tab" data-target="#tab-fillup1" aria-expanded="true"><span>Informacion general</span></a>
  		</li>
  		<li class="nav-item">
  			<a href="#" data-toggle="tab" data-target="#tab-fillup2" class="" aria-expanded="false"><span>Comentarios</span></a>
  		</li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">

  		<div class="tab-pane active" id="tab-fillup1" aria-expanded="true">

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

  		<div class="tab-pane" id="tab-fillup2" aria-expanded="false">
  			<div class="row">
	            <div class="col-lg-12">
	            	<button class="btn btn-primary pull-right" onclick="agregarComentario({{ $registro->id }})">Agregar Comentario</button>
	            </div>
  			</div>
  			<div class="timeline-container top-circle">
              <section class="timeline">
              @foreach($registro->Comentarios as $comentario)
                <!-- timeline-block -->
                <div class="timeline-block">
                  <div class="timeline-point warning bounce-in">
                    <i class="pg-social"></i>
                  </div>
                  <!-- timeline-point -->
                  <div class="timeline-content bounce-in">
                    <div class="card social-card share full-width ">
                      <div class="card-description">
                        <h5 class="hint-text no-margin">{{ nl2br($comentario->comentarios) }}</h5>
                      </div>
                    </div>
                    <div class="event-date">
                      <h6 class="font-montserrat all-caps hint-text m-t-0">{{ $comentario->User->fullName() }}</h6>
                      <small class="fs-12 hint-text">{{\Carbon\Carbon::parse($comentario->created_at)->diffForHumans()  }}</small>
                    </div>
                  </div>
                  <!-- timeline-content -->
                </div>
                <!-- timeline-block -->
              @endforeach

              </section>
              <!-- timeline -->
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
