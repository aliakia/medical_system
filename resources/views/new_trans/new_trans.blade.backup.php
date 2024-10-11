@extends('layouts/contentLayoutMaster')

@section('title', 'New Transaction')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('content')
<section id="registration">
  <div class="bs-stepper horizontal-wizard-example p-1">
    <div class="bs-stepper-header hidden">
      <div class="step" data-target="#student_info">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">1</span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Student Info</span>
            {{-- <span class="bs-stepper-subtitle">Setup Account Details</span> --}}
          </span>
        </button>
      </div>
      <div class="line">
        <i data-feather="chevron-right" class="font-medium-2"></i>
      </div>
      @if (Session('program_type') != "THEORETICAL DRIVING COURSE")
        <div class="step" data-target="#dl_class">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">2</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">DL Class</span>
              {{-- <span class="bs-stepper-subtitle">Add Personal Info</span> --}}
            </span>
          </button>
        </div>
        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
      @endif
      <div class="step" data-target="#course_details">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">3</span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Course Details</span>
            {{-- <span class="bs-stepper-subtitle">Add Address</span> --}}
          </span>
        </button>
      </div>
      <div class="line">
        <i data-feather="chevron-right" class="font-medium-2"></i>
      </div>
      <div class="step" data-target="#data_preview">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">4</span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Preview</span>
            {{-- <span class="bs-stepper-subtitle">Add Social Links</span> --}}
          </span>
        </button>
      </div>
    </div>

    <input type="hidden" name="user_id" id="user_id" value="{{Session('LoggedUser')->user_id}}">
    <input type="hidden" name="ds_code" id="ds_code" value="{{Session('data_ds')->ds_code}}">
    <input type="hidden" name="api_url" id="api_url" value="{{Session('api_url')}}">

    <div class="bs-stepper-content">
      <div id="student_info" class="content">
        <div class="content-header">
          <h3 class="mb-2 ">Student Driver Information</h3>
        </div>
        <form class="form form-vertical" id="new_trans_form" method="POST" action="">
          @csrf
          <div class="row mb-25">
            <div class="col-12 col-md-2">
                <div class="embed-responsive-1by1">
                  <img
                    src="{{asset('images/default.png')}}"
                    id="picture_1"
                    class="bg-secondary"
                    alt="default.png"
                    height="100%"
                    width="100%"
                  />
                </div>
                <label id="select" class="btn btn-primary my-25 w-100" data-toggle="modal" data-target="#camera">Open Camera</label>
                  {{-- <input type="file" name="file" id="file" hidden accept="image/png, image/jpeg, image/jpg" /> --}}
                {{-- <button id="reset" type="reset" class="btn btn-outline-secondary col-12 mb-2">Reset</button> --}}
                <input id="base_64" type="hidden" name="base_64" value=""/>
            </div>
          </div>
          <div class="row">
            {{-- <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="program_type">Program Type</label>
                <select name="program_type" id="program_type" class="select2 form-contol hide-search">
                  <option selected disabled>Select Program Type</option>
                  <option value="TDC">Theoretical Driving Course</option>
                  <option value="PDC">Practical Driving Course</option>
                </select>
              </div>
            </div> --}}
            <input type="hidden" name="program_type" id="program_type" value="{{Session('program_code')}}">

            <div class="col-12 col-md-4">
              <div class="form-group align-bottom">
                <label for="training_code">Training Purpose</label>
                <select name="training_code" id="training_code" class="select2 form-contol hide-search">
                  
                </select>
              </div>
            </div>

            <input type="hidden" name="training_purpose" id="training_purpose" value="{{Session('program_code')}}">

            @if (Session('program_type')!="THEORETICAL DRIVING COURSE")
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="license_no">License Number</label>
                <input
                  type="text"
                  id="license_no"
                  class="form-control"
                  name="license_no"
                  placeholder="License Number"
                  oninput="this.value = this.value.toUpperCase()"
                />
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="license_type">License Type</label>
                <select name="license_type" id="license_type" class="select2 form-contol hide-search">
                  <option selected disabled>Select License Type</option>
                  <option value="SP">Student Permit</option>
                  <option value="NP">Non-Professional</option>
                  <option value="P">Professional</option>
                </select>
              </div>
            </div>
            @endif
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="learning_modality">Learning Modality</label>
                <select name="learning_modality" id="learning_modality" class="select2 form-contol hide-search">
                  <option selected disabled>Select Learning Modality</option>
                  <option value="FACE-TO-FACE">Face to Face</option>
                  <option value="ONLINE">Online</option>
                </select>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input
                  type="text"
                  id="first_name"
                  class="form-control"
                  name="first_name"
                  placeholder="First Name"
                  oninput="this.value = this.value.toUpperCase()"
                />
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input
                  type="text"
                  id="middle_name"
                  class="form-control"
                  name="middle_name"
                  placeholder="Middle Name"
                  oninput="this.value = this.value.toUpperCase()"
                />
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input
                  type="text"
                  id="last_name"
                  class="form-control"
                  name="last_name"
                  placeholder="Last Name"
                  oninput="this.value = this.value.toUpperCase()"
                />
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="select2 form-contol hide-search">
                  <option selected disabled>Select Gender</option>
                  <option value="MALE">Male</option>
                  <option value="FEMALE">Female</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label class="form-label" for="birthday">Birthday</label>
                <input
                  type="date"
                  class="form-control flatpickr-basic"
                  id="birthday"
                  placeholder="YYYY-MM-DD"
                  name="birthday"
                  aria-describedby="birthday"
                  value=""
                />
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="age">Age</label>
                <input
                  type="number"
                  id="age"
                  class="form-control"
                  name="age"
                  placeholder="Age"
                  readonly
                />
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="nationality">Nationality</label>
                <input
                  type="text"
                  id="nationality"
                  class="form-control"
                  name="nationality"
                  placeholder="Nationality"
                  oninput="this.value = this.value.toUpperCase()"
                />
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="marital_status">Marital Status</label>
                <select name="marital_status" id="marital_status" class="select2 form-contol hide-search">
                  <option selected disabled>Select Marital Status</option>
                  <option value="SINGLE">Single</option>
                  <option value="MARRIED">Married</option>
                  <option value="WIDOWED">Widowed</option>
                  <option value="DIVORCED">Divorced</option>
                  <option value="SEPARATED">Separated</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="house_name">House/Building Name</label>
                <input
                  type="text"
                  id="house_name"
                  class="form-control"
                  name="house_name"
                  placeholder="House/Building Name"
                  oninput="this.value = this.value.toUpperCase()"
                />
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="street_name">Street Name</label>
                <input
                  type="text"
                  id="street_name"
                  class="form-control"
                  name="street_name"
                  placeholder="Street Name"
                  oninput="this.value = this.value.toUpperCase()"
                />
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="region">Region</label>
                <select name="region" id="region" class="select2 form-contol hide-search">
                  
                </select>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="province">Province</label>
                <select name="province" id="province" class="select2 form-contol hide-search">
                  
                </select>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="town_city">Town/City</label>
                <select name="town_city" id="town_city" class="select2 form-contol hide-search">
                  
                </select>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="barangay">Barangay</label>
                <input
                  type="text"
                  id="barangay"
                  class="form-control"
                  name="barangay"
                  placeholder="Barangay"
                  oninput="this.value = this.value.toUpperCase()"
                />
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="zip_code">Zip Code</label>
                <input
                  type="number"
                  id="zip_code"
                  class="form-control"
                  name="zip_code"
                  placeholder="Zip Code"
                />
              </div>
            </div>
          </div>
            {{-- <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="user_group">User Group</label>
                <select name="user_group" id="user_group" class="select2 form-contol hide-search">
                  <option selected disabled>Select User Group</option>
                  <option value="USER">User</option>
                  <option value="ADMINISTRATOR">Administrator</option>
                </select>
              </div>
            </div> --}}
            
        </form>
        <div class="col-12 mt-1">
          <button class="mr-1 btn btn-outline-secondary btn-prev" disabled>
            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-primary float-right" id="next_1">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
          </button>
          <button class="mr-1 btn btn-success float-right" id="save_1">
            <span class="align-middle d-sm-inline-block d-none">Save</span>
            <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
          </button>
          <button class="mr-1 btn btn-danger float-right" id="cancel_1">
            <span class="align-middle d-sm-inline-block d-none">Cancel</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
          </button>
        </div>
      </div>

      @if (Session('program_type') != "THEORETICAL DRIVING COURSE")
      <div id="dl_class" class="content">
        <div class="content-header">
          <h3 class="mb-2 ">Driver's License Classification</h3>
        </div>
        <form>
          <div class="row">
            <div class="col-8"></div>
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-3 text-left font-weight-bolder m-0 p-0">NON-PRO</div>
                <div class="col-3 text-left font-weight-bolder m-0 p-0">PRO</div>
                <div class="col-3 text-left font-weight-bolder m-0 p-0">AT</div>
                <div class="col-3 text-left font-weight-bolder m-0 p-0">MT</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="A" name="A" value="A"/>
                <label class="custom-control-label font-weight-bolder" for="A" id="A_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_A"></div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="A1" name="A1" value="A1"/>
                <label class="custom-control-label font-weight-bolder" for="A1" id="A1_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_A1"></div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="B" name="B" value="B"/>
                <label class="custom-control-label font-weight-bolder" for="B" id="B_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_B"></div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="B1" name="B1" value="B1"/>
                <label class="custom-control-label font-weight-bolder" for="B1" id="B1_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_B1"></div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="B2" name="B2" value="B2"/>
                <label class="custom-control-label font-weight-bolder" for="B2" id="B2_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_B2"></div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="C" name="C" value="C"/>
                <label class="custom-control-label font-weight-bolder" for="C" id="C_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_C"></div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="D" name="D" value="D"/>
                <label class="custom-control-label font-weight-bolder" for="D" id="D_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_D"></div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="BE" name="BE" value="BE"/>
                <label class="custom-control-label font-weight-bolder" for="BE" id="BE_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_BE"></div>

          <div class="row">
            <div class="form-group col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input dl-codes" id="CE" name="CE" value="CE"/>
                <label class="custom-control-label font-weight-bolder" for="CE" id="CE_label">
                </label>
              </div>
            </div>
          </div>
          <div id="div_CE"></div>

        </form>
        <div class="col-12 mt-1">
          <button class="mr-1 btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-primary float-right" id="next_2">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
          </button>
          <button class="mr-1 btn btn-success float-right" id="save_2">
            <span class="align-middle d-sm-inline-block d-none">Save</span>
            <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
          </button>
          <button class="mr-1 btn btn-danger float-right" id="cancel_2">
            <span class="align-middle d-sm-inline-block d-none">Cancel</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
          </button>
        </div>
      </div>
      @endif

      <div id="course_details" class="content">
        <div class="content-header">
          <h3 class="mb-2 ">Course Details</h3>
        </div>
        <form class="form form-vertical" id="course_details_form" method="POST" action="">
          @csrf
          {{-- <input type="hidden" name="trans_no" id="trans_no" value="">
          <input type="hidden" name="student_id" id="student_id" value=""> --}}
          <div class="row">
            <div class="col-5">
              <div class="form-group">
                <label for="branch">Branch Name</label>
                <input
                  type="text"
                  id="branch"
                  class="form-control"
                  name="branch"
                  placeholder="Course Name"
                  oninput="this.value = this.value.toUpperCase()"
                  value="{{Session('data_ds')->ds_name}}"
                  readonly
                />
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
                  value="{{Session('program_type')}}"
                  readonly
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label class="form-label" for="date_started">Date Started</label>
                <input
                  type="date"
                  class="form-control flatpickr-basic"
                  id="date_started"
                  placeholder="YYYY-MM-DD"
                  name="date_started"
                  aria-describedby="date_started"
                  value=""
                />
              </div>
            </div>

            <div class="col-12 col-md-4">
              <div class="form-group">
                <label class="form-label" for="date_completed">Date Completed</label>
                <input
                  type="date"
                  class="form-control flatpickr-basic"
                  id="date_completed"
                  placeholder="YYYY-MM-DD"
                  name="date_completed"
                  aria-describedby="date_completed"
                  value=""
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
                />
              </div>
            </div>
          </div>

          <div class="row m-2">
            <div class="col-3">
              ASSESSMENT:
            </div>
            <div class="custom-control custom-radio col-2">
              <input type="radio" id="assessment_passed" name="assessment" class="custom-control-input" value="1"/>
              <label class="custom-control-label" for="assessment_passed">PASSED</label>
            </div>
            <div class="custom-control custom-radio col-2">
              <input type="radio" id="assessment_failed" name="assessment" class="custom-control-input" value="0"/>
              <label class="custom-control-label" for="assessment_failed">FAILED</label>
            </div>
          </div>

          <div class="row m-2">
            <div class="col-3">
              OVERALL RATING:
            </div>
            <div class="custom-control custom-radio col-2">
              <input type="radio" id="overall_passed" name="overall" class="custom-control-input" value="1"/>
              <label class="custom-control-label" for="overall_passed">PASSED</label>
            </div>
            <div class="custom-control custom-radio col-2">
              <input type="radio" id="overall_failed" name="overall" class="custom-control-input" value="0"/>
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
        </form>
        <div class="col-12 mt-1">
          <button class="mr-1 btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-primary float-right" id="next_3">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
          </button>
          <button class="mr-1 btn btn-success float-right" id="save_3">
            <span class="align-middle d-sm-inline-block d-none">Save</span>
            <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
          </button>
          <button class="mr-1 btn btn-danger float-right" id="cancel_3">
            <span class="align-middle d-sm-inline-block d-none">Cancel</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
          </button>
        </div>
      </div>

      <div id="data_preview" class="content">
        <div class="content-header">
          <h2 class="mb-2 ">Preview</h2>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="col-12 col-md-3 float-right mb-1">
              <div class="embed-responsive-1by1">
                <img
                  src="{{asset('images/default.png')}}"
                  id="picture_2"
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
                <div class="my-25 col-6 col-md-8" id="disp_fname"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">MIDDLE NAME :</div>
                <div class="my-25 col-6 col-md-8" id="disp_mname"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">LAST NAME :</div>
                <div class="my-25 col-6 col-md-8" id="disp_lname"></div>
                <div class="my-25 col-6 col-md-4 font-weight-bolder">LICENSE NO:</div>
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
              <div class="my-25 col-6 col-md-8" id="disp_branch"></div>
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
        <div class="col-12 mt-1">
          <button class="mr-1 btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-primary float-right" id="upload" data-toggle="modal" data-target="#biometrics_modal">
            <span class="align-middle d-sm-inline-block d-none">Upload</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
          </button>
          {{-- <button class="mr-1 btn btn-success float-right" id="save_4">
            <span class="align-middle d-sm-inline-block d-none">Save</span>
            <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
          </button> --}}
          <button class="mr-1 btn btn-danger float-right" id="cancel_4">
            <span class="align-middle d-sm-inline-block d-none">Cancel</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left" id="camera" tabindex="-2" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel1">Capture Image</h4>
          <button type="button" class="close" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
              <div class="mx-auto" id="video" style="height:auto; width:auto;">
                {{-- <iframe width="100%" frameborder="0" src="https://www.youtube-nocookie.com/embed/FdV_akxUnEM?controls=0&disablekb=1&modestbranding=1&rel=0&amp;showinfo=0&autoplay=1&loop=1" encrypted-media allowfullscreen></iframe> --}}
                {{-- <div id="video"></div> --}}
              </div>
              
              {{-- <image id="canvas" style="width:100%; height:auto;" class="hidden"></div> --}}
              <div class="mx-auto h-auto" style="width:640px;">
                <button id="capture" type="button" class="btn btn-primary w-100 mt-1"><i data-feather="camera" class="font-medium-4"></i></button>
                <img
                    src="{{asset('images/default.png')}}"
                    id="canvas"
                    class="bg-secondary hidden mt-1"
                    alt="default.png"
                    height="auto"
                    width="auto"
                  />
                <button id="saveImg" type="button" class="btn btn-success w-100 mt-1 hidden" data-dismiss="modal" aria-label="Close">Save</button>
              </div>
              
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left" id="biometrics_modal" tabindex="-3" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel2">Biometrics Verification</h4>
          <button type="button" class="close" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
              <div class="row">
                <h4 class="text-center mb-1">Are you sure you want to UPLOAD this transaction ?</h4>
                <img id="finger_print_logo" class="mx-auto mb-1" src="{{asset('images/fingerprint.gif')}}" alt="finger print logo" width="75%" height="auto">
                <h4 class="text-center mb-1">If YES please verify the Fingerprint of Instructor using the Scanner.</h4>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset('vendors/js/webcam.min.js') }}"></script>

@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/new_trans.js') }}"></script>
@endsection
