@extends('layouts.login')

@section('content')
  <div class="register-container full-height sm-p-t-30">
      <div class="d-flex justify-content-center flex-column full-height ">
        <!--img src="images/logos/logo.png" alt="logo" data-src="images/logos/logo.png" data-src-retina="images/logos/logo.png" width="50" height="50"-->
        <h3>Peticiones</h3>
        <p>Crea una cuenta en peticiones</p>
        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" id="form-register">
        @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group form-group-default">
                <label>{{ __('Nombre') }}</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required autofocus class="form-control  {{ $errors->has('nombre') ? ' is-invalid' : '' }}">

                @if ($errors->has('nombre'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
                @endif

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-default">
                <label>{{ __('Apellidos') }}</label>
                <input type="text" name="apellidos" class="form-control {{ $errors->has('apellidos') ? ' is-invalid' : '' }}" value="{{ old('apellidos') }}" required>

                @if ($errors->has('apellidos'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('apellidos') }}</strong>
                  </span>
                @endif

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-default">
                <label>{{ __('Username') }}</label>
                <input type="text" name="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" required>

                @if ($errors->has('username'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                  </span>
                @endif

              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-12">
              <div class="form-group form-group-default">
                <label>{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-md-12">
              <div class="form-group form-group-default">
                <label>{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>

          </div>
          <div class="row m-t-10">
            <div class="col-lg-6">
              <p><small>Estoy de acuerdo con los <a href="#" class="text-info">Términos</a> y <a href="#" class="text-info">Política de privacidad</a>.</small></p>
            </div>
            <div class="col-lg-6 text-right">
              <a href="#" class="text-info small">¿Necesitas ayuda? Contacto de Soporte</a>
            </div>
          </div>
          <button class="btn btn-primary btn-cons m-t-10" type="submit">{{ __('Registrarse') }}</button>
        </form>
      </div>
    </div>
    <!--<div class=" full-width">
      <div class="register-container m-b-10 clearfix">
        <div class="m-b-30 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix d-flex-md-up">
          <div class="col-md-2 no-padding d-flex align-items-center">
            <img src="images/logos/logo.png" alt="" class="" data-src="images/logos/logo.png" data-src-retina="images/logos/logo.png" width="50" height="50">
          </div>
          <div class="col-md-9 no-padding d-flex align-items-center">
            <p class="hinted-text small inline sm-p-t-10">No part of this website or any of its contents may be reproduced, copied, modified or adapted, without the prior written consent of the author, unless otherwise indicated for stand-alone materials.</p>
          </div>
        </div>
      </div>
    </div>-->

@stop

@section('scripts')

@stop
