@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v2">
  <div class="auth-inner row m-0">
      <!-- Brand logo-->
      <!-- <a class="brand-logo" href="javascript:void(0);">
        {{-- <img src="{{asset('images\Medical Raw.jpg')}}"  height="40" width="40" alt=""> --}}
        {{-- <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28"><defs><lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%"><stop stop-color="#000000" offset="0%"></stop><stop stop-color="#FFFFFF" offset="100%"></stop></lineargradient><lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%"><stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop><stop stop-color="#FFFFFF" offset="100%"></stop></lineargradient></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Artboard" transform="translate(-400.000000, -178.000000)"><g id="Group" transform="translate(400.000000, 178.000000)"><path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path><path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path><polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon><polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon><polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon></g></g></g></svg> --}}
        <h2 class="brand-text text-primary ml-1">{{Session('data_clinic')->clinic_name}}</h2>
      </a> -->
      <!-- /Brand logo-->
      <!-- Left Text-->
      <div class="d-none d-lg-flex col-lg-8 align-items-center">
        <div class="w-100 d-lg-flex align-items-center justify-content-center">
          @if($configData['theme'] === 'dark')
          <img class="img-fluid w-75" src="{{asset('images/ds_icon.png')}}" alt="Login V2" />
          @else
          <img class="img-fluid w-80" src="{{asset('images/systemadmin_1.jpg')}}" alt="Login V2" />
          @endif
        </div>
      </div>
      <!-- /Left Text-->
      <!-- Login-->
      <input type="hidden" name="ds_code" id="ds_code" value="{{Session('data_clinic')->clinic_id}}">
      <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
          <h2 class="card-title font-weight-bold mb-1">Welcome ! &#x1F44B;</h2>
          <p class="card-text mb-2">Please sign-in to your Admin Account</p>
          <form class="auth-login-form mt-2" method="POST" action="{{ route('login_admin',Session('data_clinic')->clinic_id) }}" id="login_form">
            @csrf
            <div class="form-group">
              <label for="user_id" class="form-label">User ID</label>
              <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter your User ID" aria-describedby="user_id" tabindex="1" autofocus value="{{ old('user_id') }}" />
              @error('user_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
  
            <div class="form-group">
              <div class="d-flex justify-content-between">
                <label for="password">Password</label>
                {{-- @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                  <small>Forgot Password?</small>
                </a>
                @endif --}}
              </div>
              <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="password" name="password" tabindex="2" placeholder="Enter your Password" aria-describedby="password" />
                <div class="input-group-append">
                  <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
              </div>
            </div>
            {{-- <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="remember-me" name="remember-me" tabindex="3" {{ old('remember-me') ? 'checked' : '' }} />
                <label class="custom-control-label" for="remember-me"> Remember Me </label>
              </div>
            </div> --}}
            <button type="button" class="btn btn-primary btn-block" tabindex="3" id="login">Sign in</button>
            <!-- <button type="button" class="btn btn-outline-primary btn-block" tabindex="3" id="login_bio">Biometrics Login</button> -->
          <!-- <p class="text-center mt-2">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-v2')}}"><span>&nbsp;Create an account</span></a>
          </p>
          <div class="divider my-2">
            <div class="divider-text">or</div>
          </div>
          <div class="auth-footer-btn d-flex justify-content-center">
            <a class="btn btn-facebook" href="javascript:void(0)">
              <i data-feather="facebook"></i>
            </a>
            <a class="btn btn-twitter white" href="javascript:void(0)">
              <i data-feather="twitter"></i>
            </a>
            <a class="btn btn-google" href="javascript:void(0)">
              <i data-feather="mail"></i>
            </a>
            <a class="btn btn-github" href="javascript:void(0)">
              <i data-feather="github"></i>
            </a>
          </div> -->
      </div>
    </div>
    <!-- /Login-->
  </div>
</div>
<div class="modal fade text-left" id="biometrics_modal" tabindex="-3" role="dialog" aria-labelledby="myModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel6">Biometrics Registration</h4>
          {{-- <button type="button" class="close" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body" id="bio_modal_body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_bio" >Cancel</button>
          <button type="button" class="btn btn-success" id="verify" >Login</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script> --}}
  <script src="{{ asset('js/scripts/login.js') }}"></script>
@endsection
