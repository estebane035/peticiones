@extends('layouts.login')

@section('content')
  <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="img/fondos/background_1.jpg" data-src="img/fondos/background_1.jpg" data-src-retina="img/fondos/background_1.jpg" alt="" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <h2 class="semi-bold text-white">Descripcion grande</h2>
          <p class="small">Descripcion corta</p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
          <img src="images/logos/logo.png" alt="logo" data-src="images/logos/logo.png" data-src-retina="images/logos/logo.png" width="50" height="50"> Dental App
          <p class="p-t-35">Inicia sesión</p>
          <!-- START Login Form -->
          <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>{{ __('Username') }}</label>
              <div class="controls">
                <input type="text" name="username" id="username" placeholder="Username" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif

              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>{{ __('Contraseña') }}</label>
              <div class="controls">
                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Contraseña" required>

                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif

              </div>
            </div>
            <!-- START Form Control-->
            <div class="row">
              <div class="col-md-6 no-padding sm-p-l-10">
                <div class="checkbox ">
                  <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label for="remember">{{ __('Recuérdame') }}</label>
                </div>
              </div>
              <!--<div class="col-md-6 d-flex align-items-center justify-content-end">
                <a href="{{ route('password.request') }}" class="text-info small">{{ __('Forgot Your Password?') }}</a>
              </div>-->
            </div>
            <!-- END Form Control-->
            <button class="btn btn-primary btn-cons m-t-10" type="submit">{{ __('Login') }}</button>
          </form>
          <!--END Login Form-->
          <!--<div class="pull-bottom sm-pull-bottom">
            <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
              <div class="col-sm-3 col-md-2 no-padding">
                <img alt="" class="m-t-5" data-src="assets/img/demo/pages_icon.png" data-src-retina="assets/img/demo/pages_icon_2x.png" height="60" src="assets/img/demo/pages_icon.png" width="60">
              </div>
              <div class="col-sm-9 no-padding m-t-10">
                <p>
                  <small>
									Create a pages account. If you have a facebook account, log into it for this
									process. Sign in with <a href="#" class="text-info">Facebook</a> or <a href="#"
									                                                                       class="text-info">Google</a>
								</small>
                </p>
              </div>
            </div>
          </div>-->
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>
@stop

@section('scripts')

@stop
