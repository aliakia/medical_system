@extends('layouts/contentLayoutMaster')

@section('title', 'New Transaction')

@section('vendor-style')
  <!-- vendor css files -->
  {{-- <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}"> --}}
@endsection
@section('page-style')
  <!-- Page css files -->
  {{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}"> --}}
@endsection

@section('content')
<section id="registration">
  <div class="row">
    <div class="col-12 mx-auto">
      <div class="card px-2 pt-1">
        {{-- <div class="card-header">
          <h1 class="card-title">Preview</h1>
        </div> --}}
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="col-12 col-md-3 float-right mb-1">
                <div class="embed-responsive-1by1">
                  <img
                    src="{{asset('images/default.png')}}"
                    id="picture"
                    class="bg-secondary"
                    alt="default.png"
                    height="100%"
                    width="100%"
                  />
                </div>
              </div>
              <div class="col-12 col-md-9">
                <div class="row">
                  <div class="mb-1 col-12 font-weight-bolder h2 text-white">Student Driver Information</div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">FIRST NAME :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_fname">MICHAEL</div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">MIDDLE NAME :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_mname">COLLADO</div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">LAST NAME :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_lname">SAMSON</div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">LICENSE :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_license_no"></div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">GENDER :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_gender"></div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">BIRTHDAY :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_birthday"></div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">AGE :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_age"></div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">NATIONALITY :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_nationality"></div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">MARITAL STATUS :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_marital_status"></div>
                  <div class="my-25 col-6 col-md-4 font-weight-bolder">ADDRESS :</div>
                  <div class="my-25 col-6 col-md-8" id="disp_address"></div>
                </div>
              </div>
            </div>
            
            <div class="col-12">
              <hr>
            </div>

            <div class="col-12 ml-1 mb-1">
              <div class="row">
                <div class="mb-1 col-12 font-weight-bolder h2 text-white">Course Details</div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">BRANCH :</div>
                <div class="my-25 col-6 col-md-8" id="disp_branch">Lorem ipsum dolor sit amet.</div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">COURSE NAME :</div>
                <div class="my-25 col-6 col-md-8" id="disp_course_name"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">TRAINING PURPOSE :</div>
                <div class="my-25 col-6 col-md-8" id="disp_training_purpose"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">DL CLASSIFICATION :</div>
                <div class="my-25 col-6 col-md-8" id="disp_dl_class"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">DATE STARTED :</div>
                <div class="my-25 col-6 col-md-8" id="disp_date_started"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">DATE COMPLETED :</div>
                <div class="my-25 col-6 col-md-8" id="disp_date_completed"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">TOTAL NUMBER OF HOURS :</div>
                <div class="my-25 col-6 col-md-8" id="disp_total_no_hours"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">ASSESSMENT :</div>
                <div class="my-25 col-6 col-md-8" id="disp_assessment"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">OVERALL :</div>
                <div class="my-25 col-6 col-md-8" id="disp_overall"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">ADDITIONAL COMMENTS :</div>
                <div class="my-25 col-6 col-md-8" id="disp_additional_comments"></div>
              </div>
            </div>
          </div>

          <div class="col-12 mt-1 px-0">
            <a href="javascript:history.back()" type="button" class="btn btn-outline-primary px-2 mb-25 col-12 col-md-2" id="next"><i data-feather="arrow-left" class="ml-25"></i> Previous</a>
            <a href="{{route('main_page')}}" type="button" class="btn btn-success px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="next">Upload <i data-feather="upload" class="ml-25"></i></a>
            <a href="/" type="button" class="btn btn-success px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="save">Save <i data-feather="save" class="ml-25"></i></a>
            <a href="{{route('main_page')}}" type="button" class="btn btn-danger px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="cancel">Cancel <i data-feather="x" class="ml-25"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  {{-- <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script> --}}
@endsection
@section('page-script')
  <!-- Page js files -->
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script> --}}
  {{-- <script src="{{ asset('js/scripts/course_details.js') }}"></script> --}}
@endsection
