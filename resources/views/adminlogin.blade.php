@php
    $configData = Helper::appClasses();
@endphp
@extends('layouts/LayoutMaster2')

@section('title', 'Login Page')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
@endsection

@section('content')

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">

            <div class="d-none d-lg-flex col-lg-7 p-0">

                <div class="auth-cover-bg d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/systemadmin_1.jpg') }}" alt="auth-login-cover"
                        class="img-fluid my-5 auth-illustration">


                </div>
            </div>

            <!-- /Left Text-->
            <!-- Login-->
            <input type="hidden" name="ds_code" id="ds_code" value="{{ Session('data_clinic')->clinic_id }}">
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <h3 class=" mb-1 fw-bold text-primary">Welcome to {{ Session('data_clinic')->clinic_name }}</h3>
                    <p class="mb-4">Please sign-in to your Admin account.</p>

                    <form method="POST" action="{{ route('login_admin', Session('data_clinic')->clinic_id) }}"
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
                    <!-- <p class="text-center mt-2"></a>
                                                                                                                                                                                                        </div> -->
                </div>
            </div>
            <!-- /Login-->
        </div>
    </div>
    <div class="modal fade text-left" id="biometrics_modal" tabindex="-3" role="dialog" aria-labelledby="myModalLabel6"
        aria-hidden="true">
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_bio">Cancel</button>
                    <button type="button" class="btn btn-primary d-grid w-100" tabindex="3" id="verify">Sign
                        in</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
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
                toastr['info']('{{ session('info') }}', 'Success');
            });
        </script>
    @endif
    <script src="{{ asset('js/scripts/login.js') }}"></script>
@endsection
