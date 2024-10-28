@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Biometrics Login')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection

@section('content')
<section id="bio_login">

  <div class="col-12 p-50" style="background:#355f91;">
    <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand d-flex" href="{{route('bio_login_form',Session('data_clinic')->clinic_id)}}">
              <img src="{{asset('images\Medical Raw.jpg')}}" height="40" width="40" alt="" class="align-self-center flex-1">
            <h2 class="brand-text ml-1 mb-0 text-white align-self-center">Medicus</h2>
          </a>
        </li>
      </ul>
  </div>

  <div class="row" style ="background :#ffff">

      <div class="col-7 mt-50 d-none d-lg-flex" style = "background :#ffff">
        <div class="row">

          <div class="col-12">
            <a class="brand-logo" href="javascript:void(0);">
              <h2 class="brand-text text-primary ml-1">{{Session('data_clinic')->clinic_name}}</h2>
            </a>
          </div>

          <div class="col-12">
            <img class="mx-auto d-block" src="{{asset('images/bg1.jpg')}}" alt="Login V2" width="80%" />
          </div>

        </div>
      </div>

      <div class="col-8 col-lg-3 col-md-8 col-xl-3 mx-auto mt-5 p-1">
        <div class="row">
          <div class="col-12" style="background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:5px">
            <form action="" method="POST" id="bio_login_form" class="mt-1">

                <div class="form-group" id="username_bio">

                  <div class="col-12 my-1">
                    <img
                      src="{{asset('images/fingerprint.gif')}}"
                      id="bio_picture"
                      class="bg-secondary"
                      alt="default.png"
                      width="100%"
                    />
                  </div>

                  <h4>Physician Name:</h4>

                  <div class="form-group">
                    <select name="physician_user_id" id="physician_user_id" class="select2 form-contol hide-search">
                      @foreach ($data as $item)
                      <option value="{{$item->full_name}}">{{$item->full_name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <button type="button" class="btn btn-success col-md-12 col-12" id="login_bio_btn" name="login_bio_btn">Scan Biometrics</button>
                </div>

            </form>

          </div>
      </div>


  </div>



</section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/biometrics_login.js') }}"></script>
@endsection
