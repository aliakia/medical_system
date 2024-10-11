@extends('layouts/contentLayoutMaster')

@section('title', 'New Transaction')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection

@section('content')
<section id="registration">
  <div class="row">
    <div class="col-12 mx-auto">
      <div class="card px-2 pt-2">
        <div class="card-header">
          <h4 class="card-title">Course Details</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical" id="reg_form" method="POST" action="create_user">
            @csrf
            <div class="row">
              <div class="col-5">
                <div class="form-group">
                  <label for="branch">Issuing Branch</label>
                  <select name="branch" id="branch" class="select2 form-contol hide-search">
                    <option value="DS001">MAIN BRANCH</option>
                    <option value="DS002">NEXT BRANCH</option>
                  </select>
                </div>
              </div>

              <div class="col-5">
                <div class="form-group">
                  <label for="course_name">Course Name</label>
                  <input
                    type="text"
                    id="course_name"
                    class="form-control"
                    name="course_name"
                    placeholder="Course Name"
                    oninput="this.value = this.value.toUpperCase()"
                    value="PRACTICAL DRIVING COURSE"
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="date_started">Date Started</label>
                  <input
                    type="text"
                    id="date_started"
                    class="form-control"
                    name="date_started"
                    placeholder="Date Started"
                    oninput="this.value = this.value.toUpperCase()"
                  />
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="date_completed">Date Completed</label>
                  <input
                    type="text"
                    id="date_completed"
                    class="form-control"
                    name="date_completed"
                    placeholder="Date Completed"
                    oninput="this.value = this.value.toUpperCase()"
                  />
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="no_of_hours">Total Number of Hours</label>
                  <input
                    type="number"
                    id="no_of_hours"
                    class="form-control"
                    name="no_of_hours"
                    placeholder="Total Number of Hours"
                    oninput="this.value = this.value.toUpperCase()"
                  />
                </div>
              </div>
            </div>

            <div class="row m-2">
              <div class="col-3">
                ASSESSMENT:
              </div>
              <div class="custom-control custom-radio col-2">
                <input type="radio" id="assessment_passed" name="assessment" class="custom-control-input"/>
                <label class="custom-control-label" for="assessment_passed">PASSED</label>
              </div>
              <div class="custom-control custom-radio col-2">
                <input type="radio" id="assessment_failed" name="assessment" class="custom-control-input"/>
                <label class="custom-control-label" for="assessment_failed">FAILED</label>
              </div>
            </div>

            <div class="row m-2">
              <div class="col-3">
                OVERALL RATING:
              </div>
              <div class="custom-control custom-radio col-2">
                <input type="radio" id="everall_passed" name="overall" class="custom-control-input"/>
                <label class="custom-control-label" for="everall_passed">PASSED</label>
              </div>
              <div class="custom-control custom-radio col-2">
                <input type="radio" id="overall_failed" name="overall" class="custom-control-input"/>
                <label class="custom-control-label" for="overall_failed">FAILED</label>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="additional_remarks">Additional Comments</label>
                  <textarea
                    class="form-control"
                    id="additional_remarks"
                    rows="3"
                    placeholder="Additional Remarks"
                  ></textarea>
                </div>
              </div>
            </div>
            <div class="col-12 mt-1 px-0">
              <a href="javascript:history.back()" type="button" class="btn btn-outline-primary px-2 ml-md-1 mb-25 col-12 col-md-2" id="next"><i data-feather="arrow-left" class="ml-25"></i> Previous</a>
              <a href="{{route('new_trans_preview')}}" type="button" class="btn btn-primary px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="next">Next <i data-feather="arrow-right" class="ml-25"></i></a>
              <a href="/" type="button" class="btn btn-success px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="save">Save <i data-feather="save" class="ml-25"></i></a>
              <a href="{{route('main_page')}}" type="button" class="btn btn-danger px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="cancel">Cancel <i data-feather="x" class="ml-25"></i></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
</section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
  <script src="{{ asset('js/scripts/course_details.js') }}"></script>
@endsection
