<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />

    <link rel="icon" type="image/x-icon" href="{{{ asset('favicon.ico') }}}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    {!!Html::style('plugins/pace/pace-theme-flash.css')!!}
    {!!Html::style('plugins/bootstrap/css/bootstrap.css')!!}
    {!!Html::style('plugins/font-awesome/css/font-awesome.css')!!}
    {!!Html::style('plugins/jquery-scrollbar/jquery.scrollbar.css')!!}
    {!!Html::style('plugins/select2/css/select2.min.css')!!}
    {!!Html::style('plugins/switchery/css/switchery.min.css')!!}
    {!!Html::style('plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css')!!}
    {!!Html::style('plugins/datatables-responsive/css/datatables.responsive.css')!!}
    {!!Html::style('plugins/jasny-image-uploader/jasny-bootstrap.css')!!}
    {!!Html::style('plugins/dropzone/css/dropzone.css')!!}
    {!!Html::style('plugins/bootstrap-datepicker/css/datepicker.css')!!}
    {!!Html::style('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')!!}
    {!!Html::style('plugins/summernote/css/summernote.css')!!}
    {!!Html::style('css/custom.css')!!}
    {!!Html::style('css/animate.css')!!}
    {!!Html::style('css/pages-icons.css')!!}
    {!!Html::style('css/pages.css')!!}
    {!!Html::style('css/dashboard.css')!!}
    {!!Html::style('plugins/owlcarousel2/assets/owl.theme.default.min.css')!!}
    {!!Html::style('plugins/owlcarousel2/assets/owl.carousel.min.css')!!}
    {!!Html::style('plugins/codrops-dialogFx/dialog.css')!!}
    {!!Html::style('plugins/codrops-dialogFx/dialog-sandra.css')!!}
      </head>
  <body class="fixed-header">
    <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
      <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
      <!-- BEGIN SIDEBAR MENU HEADER-->
      <div class="sidebar-header">
      </div>
      <!-- END SIDEBAR MENU HEADER-->
      <!-- START SIDEBAR MENU -->
      <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">

          <li class="m-t-30 {{ $menu == "Dashboard"?"active":"" }}">
            <a href="/dashboard" class="detailed">
              <span class="title">Dashboard</span>
            </a>
            <span class="icon-thumbnail"><i class="pg-home"></i></span>
          </li>

          <li class="{{ $menu == "Finanzas"?"active":"" }}">
            <a href="/peticiones" class="detailed">
              <span class="title">Peticiones</span>
            </a>
            <span class="icon-thumbnail"><i class="fa fa-exclamation-triangle"></i></span>
          </li>

          <li class="{{ $menu == "Finanzas"?"active":"" }}">
            <a href="/reportes" class="detailed">
              <span class="title">Reportes</span>
            </a>
            <span class="icon-thumbnail"><i class="fa fa-map"></i></span>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <!-- END SIDEBAR MENU -->
    </nav>
    <!-- END SIDEBAR -->
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
      <!-- START HEADER -->
      <div class="header ">
        <!-- START MOBILE SIDEBAR TOGGLE -->
        <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu" data-toggle="sidebar">
        </a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="">
          <div class="brand inline   ">
          </div>
        </div>
        <div class="d-flex align-items-center">
          <!-- START NOTIFICATION LIST -->
          <!-- START User Info-->
          <div class="pull-left p-r-10 fs-14 font-heading hidden-md-down">

            <span class="bold">{{ Auth::User()->FullName() }}</span>
            <span class="semi-bold">({{ Auth::user()->tipo }})</span>
          </div>

          <div class="dropdown pull-right hidden-md-down">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline">
              <img src="/img/users/no-avatar.png" width="32" height="32" avatar>
              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="clearfix bg-master-lighter dropdown-item">
                <span class="pull-left">{{ __('Logout') }}</span>
                <span class="pull-right"><i class="pg-power"></i></span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>

          {{-- <div style="border-left: thick solid #e2e2e2;border-width: 1px;margin-left: 10px;">&nbsp;</div>
          <a href="" onclick="activarItem('liChat')" class="header-icon pg pg-comment btn-link m-l-10 sm-no-margin d-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
            @php $chat_number = Comun::obtenerNumeroChats() @endphp
            <span id="circulo_number" class="bubble topRight @php echo (($chat_number==0)?'hidden':'') @endphp">
              <div id="chat_number" class="bubbleNumbers ">{{ $chat_number }}</div>
            </span>
          </a>
          <a href="" onclick="activarItem('liNotificaciones')" class="header-icon pg pg-world btn-link m-l-10 sm-no-margin d-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
            @php $notifications_number = Comun::obtenerNumeroNotificaciones() @endphp
            <span id="circulo2_number" class="bubble topRight2 @php echo (($notifications_number==0)?'hidden':'') @endphp">
              <div id="notifications_number" class="bubbleNumbers">{{ $notifications_number }}</div>
            </span>
          </a> --}}
        </div>
      </div>
      <!-- END HEADER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content">
          @yield('content')
          <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid  container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
              <span class="hint-text">&copy; 2019 COPYRIGHT.</span>
            </p>
            <p class="small no-margin pull-right sm-pull-reset">
              VERSION
            </p>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>

    <!-- START OVERLAY -->
    <div id="modal_1"></div>
    <div id="modal_2"></div>
    <div id="modal_3"></div>
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">


    <div class="modal fade fill-in" id="modal-error" tabindex="-1" role="dialog" aria-hidden="true">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="pg-close"></i>
      </button>
      <div class="modal-dialog ">
        <div class="modal-content" id="modal-error-contenido">
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END OVERLAY -->
    <!-- BEGIN VENDOR JS -->
    {!!Html::script('plugins/pace/pace.min.js')!!}
    {!!Html::script('plugins/jquery/jquery-1.11.1.min.js')!!}
    {!!Html::script('plugins/modernizr.custom.js')!!}
    {!!Html::script('plugins/jquery-ui/jquery-ui.min.js')!!}
    {!!Html::script('plugins/tether/js/tether.min.js')!!}
    {!!Html::script('plugins/bootstrap/js/bootstrap.min.js')!!}
    {!!Html::script('plugins/jquery/jquery-easy.js')!!}
    {!!Html::script('plugins/jquery-unveil/jquery.unveil.min.js')!!}
    {!!Html::script('plugins/jquery-actual/jquery.actual.min.js')!!}
    {!!Html::script('plugins/jquery-scrollbar/jquery.scrollbar.min.js')!!}
    {!!Html::script('plugins/select2/js/select2.full.min.js')!!}
    {!!Html::script('plugins/select2/js/i18n/es.js')!!}
    {!!Html::script('plugins/classie/classie.js')!!}
    {!!Html::script('plugins/switchery/js/switchery.min.js')!!}
    {!!Html::script('plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js')!!}
    {!!Html::script('plugins/dropzone/dropzone.min.js')!!}
    {!!Html::script('plugins/bootstrap-tag/bootstrap-tagsinput.min.js')!!}
    {!!Html::script('plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js')!!}
    {!!Html::script('plugins/datapicker/moment.js')!!}
    {!!Html::script('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/jquery-validation/js/jquery.validate.min.js')!!}
    {!!Html::script('plugins/jquery-validation/js/localization/messages_es.js')!!}
    {!!Html::script('plugins/jquery-datatable/media/js/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/jquery-datatable/media/js/dataTables.bootstrap.js')!!}
    {!!Html::script('plugins/ajax-forms/jquery.form.js')!!}
    {!!Html::script('plugins/bootstrap-typehead/typeahead.bundle.min.js')!!}
    {!!Html::script('plugins/bootstrap-typehead/typeahead.jquery.min.js')!!}
    {!!Html::script('plugins/handlebars/handlebars-v4.0.5.js')!!}
    {!!Html::script('plugins/jasny-image-uploader/jasny-bootstrap.js')!!}
    {!!Html::script('plugins/jquery-sparkline/jquery.sparkline.js')!!}
    {!!Html::script('plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')!!}
    {!!Html::script('plugins/pusher/pusher.min.js')!!}
    {!!Html::script('plugins/summernote/js/summernote.min.js')!!}
    {!!Html::script('plugins/owlcarousel2/owl.carousel.min.js')!!}
    {!!Html::script('assets/plugins/interactjs/interact.min.js')!!}
    {!!Html::script('assets/plugins/moment/moment-with-locales.min.js')!!}
    {!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js')!!}
    <!-- ChartJS-->
    {!!Html::script('plugins/chartJs/Chart.min.js')!!}
    <!-- Notifications -->
    {!!Html::script('js/notifications.js')!!}
    <!-- DialogFx -->
    {!!Html::script('plugins/codrops-dialogFx/dialogFx.js')!!}
    <!-- END VENDOR JS -->
    {!!Html::script('js/pages.js')!!}
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    {!!Html::script('js/scripts.js')!!}
    <!-- END PAGE LEVEL JS -->
    <!--Calendar-->
    {!!Html::script('pages/js/pages.calendar.js')!!}
    <!-- CUSTOM JS -->
    {!!Html::script('scripts/dashboard/comun.js?version=1.1')!!}
    @yield('scripts')
  </body>
</html>
