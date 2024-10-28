@php
    $configData = Helper::appClasses();
@endphp
@extends('layouts/LayoutMaster')

@section('title', 'Login Page')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
@endsection
@section('page-style')
    <!-- Page css files -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/plugins/forms/form-validation.css')) }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">

            <div class="d-none d-lg-flex col-lg-7 p-0">
                <h3 class="position-absolute fw-bold text-center text-primary p-3 me-2">
                    {{ Session('data_clinic')->clinic_name }}
                </h3>
                <div class="auth-cover-bg d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/bg1.jpg') }}" alt="auth-login-cover"
                        class="img-fluid my-5 auth-illustration">


                </div>
            </div>

            <!-- /Left Text-->
            <!-- Login-->
            <input type="hidden" name="ds_code" id="ds_code" value="{{ Session('data_clinic')->clinic_id }}">
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <h3 class=" mb-1 fw-bold text-primary">Welcome to {{ Session('data_clinic')->clinic_name }}</h3>
                    <p class="mb-4">Please sign-in to your account.</p>

                    <form method="POST" action="{{ route('login_user', Session('data_clinic')->clinic_id) }}"
                        id="login_form">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id"
                                placeholder="Enter your User ID" aria-describedby="user_id" tabindex="1" autofocus />
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="password">Password</label> --}}
                        {{-- @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                  <small>Forgot Password?</small>
                </a>
                @endif --}}
                        {{-- </div> --}}
                        {{-- <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="password"
                                    name="password" tabindex="2" placeholder="Enter your Password"
                                    aria-describedby="password" />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div> --}}
                        {{-- </div> --}}
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                {{-- <a href="{{ url('auth/forgot-password-cover') }}">
                                    <small>Forgot Password?</small>
                                </a> --}}
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary d-grid w-100 " tabindex="3" id="login">Sign
                            in</button>
                    </form>

                    {{-- <!-- <a class="btn btn-outline-primary text-left px-auto py-1 my-1 w-100 text-center" href="{{ route('bio_login_form', Session('data_clinic')->clinic_id) }}">
                                                      BIOMETRICS LOGIN
                                              </a> --> --}}

                    {{-- <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="remember-me" name="remember-me" tabindex="3" {{ old('remember-me') ? 'checked' : '' }} />
                <label class="custom-control-label" for="remember-me"> Remember Me </label>
              </div>
            </div> --}}
                    {{-- <button type="button" class="btn btn-primary btn-block" tabindex="3" id="login">Sign in</button> --}}
                    <!-- <button type="button" class="btn btn-outline-primary btn-block" tabindex="3" id="login_bio">Biometrics Login</button> -->
                    <!-- <p class="text-center mt-2">
                                                                                                                                                                            <span>New on our platform?</span>
                                                                                                                                                                            <a href="{{ url('auth/register-v2') }}"><span>&nbsp;Create an account</span></a>
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


@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    {{-- <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script> --}}
    <script src="{{ asset('js/scripts/login.js') }}"></script>
    @if (session('fail'))
        <script>
            $(document).ready(function() {
                toastr['error']('{{ session('fail') }}', 'Error');
            });
        </script>
    @endif
    @if (session('info'))
        <script>
            $(document).ready(function() {
                toastr['error']('{{ session('info') }}', 'Success');
            });
        </script>
    @endif

@endsection
