@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection
{{--
@section('page-script')
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
@endsection --}}

@section('content')
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <h3 class="position-absolute fw-bold text-center text-primary p-3 me-2">
                    RBR Medical Clinic
                </h3>
                <div class="auth-cover-bg d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/bg1.jpg') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration">


                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <h3 class=" mb-1 fw-bold text-primary">Welcome to RBR Medical Clinic.</h3>
                    <p class="mb-4">Please sign-in to your account.</p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('main') }}">
                        <div class="mb-3">
                            <label for="email" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter your username" autofocus>
                        </div>
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
                        <button class="btn btn-primary d-grid w-100">
                            Sign in
                        </button>
                    </form>


                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
@endsection
