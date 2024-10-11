@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Main')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
@endsection

@section('page-script')
    <script>
        // if (navigator.mediaDevices.getUserMedia) {
        //     navigator.mediaDevices
        //         .getUserMedia({
        //             video: true
        //         })
        //         .then(function(stream) {
        //             video.srcObject = stream;
        //         })
        //         .catch(function(err0r) {
        //             alert('Something went wrong!');
        //         });
        // }
        const basicPickr = $('.flatpickr-date')
        select2 = $('.select2')
        if (basicPickr.length) {
            console.log('dfd');

            basicPickr.each(function() {
                $(this).flatpickr({
                    monthSelectorType: 'static',
                    dateFormat: 'Y-m-d'
                });
            });
        }
        if (select2.length) {
            select2.each(function() {
                $(this)
                    .wrap('<div class="position-relative"></div>')
                    .select2({
                        placeholder: 'Select value',
                        dropdownParent: $(this).parent(),
                        minimumResultsForSearch: Infinity,
                    });
            });
        }
    </script>
    {{-- <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/form-wizard-validation.js') }}"></script> --}}

    <script src="{{ asset('js/home.js') }}"></script>
@endsection

@section('content')
    <div class="col-12 mb-4">
        <h3 class="text-light fw-semibold">Saved Transaction</h3>
        <div id="wizard-validation" class="bs-stepper mt-2">
            <div class="bs-stepper-header">
                <div class="step" data-target="#account-details-validation">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">Applicant Details</span>
                            <span class="bs-stepper-subtitle">Setup Applicant Details</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#personal-info-validation">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Physical Exam</span>
                            <span class="bs-stepper-subtitle">Add Physical Exam info</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#social-links-validation">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Visual and Audio Test</span>
                            <span class="bs-stepper-subtitle">Visual and Audio Test</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#mnd-test">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Metabolic and Neurological Test</span>
                            <span class="bs-stepper-subtitle">Metabolic and Neurological Test</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#assessment-condition">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Assessment and Condition</span>
                            <span class="bs-stepper-subtitle">Final Assessment and Condition</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <div class="progress w-100" style="height: 20px; margin: 0 50px;"> <!-- Add margin here -->
                    <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>


            <div class="bs-stepper-content">
                <form id="wizard-validation-form" onSubmit="return false">
                    <!-- Account Details -->
                    <div id="account-details-validation" class="content">
                        <div class="content-header">
                            <h6 class="mb-0">Applicant Information</h6>
                            <small>Enter Your Applicant Information.</small>
                        </div>
                        <div class="col-sm-3">

                            <div class="embed-responsive embed-responsive-4by3 bg-black">
                                <video width="100%" height="auto" autoplay="true" id="video"></video>
                            </div>
                            <button id="capture" type="button" class="btn btn-primary w-100 my-1">
                                <i class="ti ti-camera" class="font-medium-4"></i>
                            </button>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-xl-4">
                                <label class="form-label" for="formValidationFirstName">First Name</label>
                                <input type="text" id="formValidationFirstName" name="formValidationFirstName"
                                    class="form-control" placeholder="First Name" />
                            </div>
                            <div class="col-sm-12 col-xl-4">
                                <label class="form-label" for="formValidationMiddleName">Middle Name</label>
                                <input type="text" id="formValidationMiddleName" name="formValidationMiddleName"
                                    class="form-control" placeholder="Middle Name" />
                            </div>
                            <div class="col-sm-12 col-xl-4">
                                <label class="form-label" for="formValidationLastName">Last Name</label>
                                <input type="text" id="formValidationLastName" name="formValidationLastName"
                                    class="form-control" placeholder="Last Name" />
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="formValidationAddress">Address</label>
                                <input type="text" id="formValidationAddress" name="formValidationAddress"
                                    class="form-control" placeholder="Address" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label for="formValidationBirthday" class="form-label">Birthday</label>
                                <input type="text" class="flatpickr-date form-control" placeholder="YYYY-MM-DD"
                                    id="formValidationBirthday" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationAge">Age</label>
                                <input type="number" id="formValidationAge" name="formValidationAge"
                                    class="form-control" placeholder="Age" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationNationality">Nationality</label>
                                <input type="text" id="formValidationNationality" name="formValidationNationality"
                                    class="form-control" placeholder="Nationality" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationGender">Gender</label>
                                <input type="text" id="formValidationGender" name="formValidationGender"
                                    class="form-control" placeholder="Gender" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationCivilStatus">Civil Status</label>
                                <input type="text" id="formValidationCivilStatus" name="formValidationCivilStatus"
                                    class="form-control" placeholder="Civil Status" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationOccupation">Occupation</label>
                                <input type="text" id="formValidationOccupation" name="formValidationOccupation"
                                    class="form-control" placeholder="Occupation" />
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label class="form-label" for="formValidationPurpose">Purpose</label>
                                <input type="text" id="formValidationPurpose" name="formValidationPurpose"
                                    class="form-control" placeholder="Purpose" />
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label class="form-label" for="formValidationLicenseNo">License No.</label>
                                <input type="text" id="formValidationLicenseNo" name="formValidationLicenseNo"
                                    class="form-control" placeholder="License No." />
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label class="form-label" for="formValidationLTOClientId">LTO Client ID</label>
                                <input type="text" id="formValidationLTOClientId" name="formValidationLTOClientId"
                                    class="form-control" placeholder="LTO Client ID" />
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-label-secondary btn-prev" disabled> <i
                                        class="ti ti-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <div class="">

                                    <button class="btn btn-success btn-next btn-danger">Cancel</button>
                                    <button class="btn btn-success btn-next btn-success">Save</button>
                                    <button class="btn btn-primary btn-next"> <span
                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i
                                            class="ti ti-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Personal Info -->
                    <div id="personal-info-validation" class="content">
                        <div class="content-header">
                            <h6 class="mb-0">Physical Exam</h6>
                            <small>Enter Physical Exam Information.</small>
                        </div>
                        <div class="row g-3">
                            {{-- <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationFirstName">Height (cm)</label>
                                <input type="text" id="formValidationFirstName" name="formValidationFirstName"
                                    class="form-control" placeholder="John" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationLastName">Weight (KG)</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Doe" />
                            </div> --}}
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationLastName">Height (CM)</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Height (CM)" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationLastName">Weight (KG)</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Weight (KG)" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="formValidationLastName">Body Mass Index (BMI)</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder=">Body Mass Index (BMI)" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <div class="row">
                                    <div class="col-sm-12 col-xl-7">
                                        <label class="form-label" for="">Blood Pressure (mmHg)</label>
                                        <input type="text" id="" name="" class="form-control"
                                            placeholder="Blood Pressure (mmHg)" />
                                    </div>
                                    <div class="col-sm-12 col-xl-5">
                                        <label class="form-label" for=""></label>
                                        <input type="text" id="" name="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-12 col-xl-1">
                                <label class="form-label" for=""></label>
                                <input type="text" id="" name="" class="form-control" />
                            </div> --}}
                            <div class="col-sm-12 col-xl-3">
                                <div class="row">
                                    <div class="col-sm-12 col-xl-7">
                                        <label class="form-label" for="">Body Temperature</label>
                                        <input type="text" id="" name="" class="form-control"
                                            placeholder="Body Temperature">
                                    </div>
                                    <div class="col-sm-12 col-xl-5">
                                        <label class="form-label" for="">Scale of Temperature</label>
                                        <input type="text" id="" name="" class="form-control"
                                            placeholder="Scale of Temperature">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Pulse Rate</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Pulse Rate">
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Respiratory Rate</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Respiratory Rate">
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Blood Type</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Blood Type">
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Upper Extremities Left</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Upper Extremities Left">
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Upper Extremities Right</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Upper Extremities Right">
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Lower Extremities Left</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Lower Extremities Left">
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Lower Extremities Right</label>
                                <input type="text" id="" name="" class="form-control"
                                    placeholder="Lower Extremities Right">
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label for="form-label">General Physique</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Normal
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        With Disabilty (Please Specify):
                                    </label>
                                    <input type="text" id="" name="" class="form-control"
                                        placeholder="If with disabilty (Please Specify):">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label for="form-label">Contagious Disease</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        None
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        With Disease (Please Specify):
                                    </label>
                                    <input type="text" id="" name="" class="form-control"
                                        placeholder="If with disease (Please Specify):">
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-label-secondary btn-prev"> <i
                                        class="ti ti-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <div class="">

                                    <button class="btn btn-success btn-next btn-danger">Cancel</button>
                                    <button class="btn btn-success btn-next btn-success">Save</button>
                                    <button class="btn btn-primary btn-next"> <span
                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i
                                            class="ti ti-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Social Links -->
                    <div id="social-links-validation" class="content">
                        <div class="row">
                            <h5 class="m-0">Visual Tests</h5>
                            <h6 class="fw-normal mb-1">Ishihara Test Result: -/6</h6>
                            <div class="col-sm-2 mb-3">
                                <button id="capture" type="button" class="btn btn-primary w-90 my-1">
                                    <i class="ti ti-eye me-2 font-medium-4"></i> Take Ishihara Test
                                </button>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label" for="gender">Eye Color</label>
                                <select id="gender" name="gender" class="form-select select2"
                                    aria-label="Default select example">
                                    <option selected disabled>Select Eye Color</option>
                                    <option value="black">Black
                                    </option>
                                    <option value="brown">Brown
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label" for="">Left Eye:Snellen/Bailey-Love</label>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label" for="">Right Eye:Snellen/Bailey-Love+</label>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="" />
                            </div>

                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">With Corrective Lens (Left)</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">With Corrective Lens (Right)</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Color Blind (Left)</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Color Blind (Right)</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <label class="form-label" for="">Right Eye: Without Lenses</label>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <label class="form-label" for="">Left Eye: Without Lenses</label>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <label class="form-label" for="">Right Eye: With Corrective or Contact
                                    Lenses</label>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <label class="form-label" for="">Left Eye: With Corrective or Contact
                                    Lenses</label>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="" />
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label" for="">Color Blind Test</label>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label" for="">Any Eye Injury/Disease (Please Specify)</label>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="" />
                            </div>

                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Is Further Eye Examinition Suggested?</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <h5 class="mb-0">Hearing Test</h5>
                                <h6 class="fw-normal mb-1">Hearing Test Result: -/3</h6>
                                <div class="col-sm-2">
                                    <button id="capture" type="button" class="btn btn-primary w-90 my-1">
                                        <i class="ti ti-ear me-2 font-medium-4"></i> Take Hearing Test
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label" for="">Left Ear Hearing</label>
                                <select id="gender" name="gender" class="form-select select2"
                                    aria-label="Default select example">
                                    <option value="black">Normal
                                    </option>
                                    <option value="brown">Not Normal
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="form-label" for="">Right Ear Hearing</label>
                                <select id="gender" name="gender" class="form-select select2"
                                    aria-label="Default select example">
                                    <option value="black">Normal
                                    </option>
                                    <option value="brown">Not Normal
                                    </option>
                                </select>
                            </div>


                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-label-secondary btn-prev"> <i
                                        class="ti ti-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <div class="">

                                    <button class="btn btn-success btn-next btn-danger">Cancel</button>
                                    <button class="btn btn-success btn-next btn-success">Save</button>
                                    <button class="btn btn-primary btn-next"> <span
                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i
                                            class="ti ti-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="mnd-test" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Metabolic and Neurological Test</h6>
                            <small>Enter Metabolic and Neurological Test Information.</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Epilepsy</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">With Corrective Lens (Right)</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Epilepsy Treatment</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-3">
                                <label for="" class="form-label">Last Seizure</label>
                                <input type="text" class="flatpickr-date form-control" placeholder="YYYY-MM-DD"
                                    id="" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Diabetes</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Diabetes Treatment</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Sleep Apnea</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="form-label">Sleep Apnea Treatment</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-6">
                                <label for="form-label">Other Medical Condition</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes (Please Specify):
                                    </label>
                                    <input type="text" id="" name="" class="form-control"
                                        placeholder="If with medical condition (Please Specify):">
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>

                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label for="form-label">Is it under proper treatment or medication</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Yes (Please Specify)
                                    </label>
                                    <input type="text" id="" name="" class="form-control"
                                        placeholder="If is under proper treatment or medication (Please Specify):">
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-label-secondary btn-prev"> <i
                                        class="ti ti-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>

                                <div class="">

                                    <button class="btn btn-success btn-next btn-danger">Cancel</button>
                                    <button class="btn btn-success btn-next btn-success">Save</button>
                                    <button class="btn btn-primary btn-next"> <span
                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i
                                            class="ti ti-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="assessment-condition" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Assessment and Condition</h6>
                            <small>Final Assessment and Condtion</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="form-label">Assessment</label>
                                <div class="form-check">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1">
                                        Fit to drive
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2">
                                        Unfit to drive
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="form-label">Condition</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                    <label class="form-check-label" for="defaultCheck1">
                                        None
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2"
                                        checked />
                                    <label class="form-check-label" for="defaultCheck2">
                                        Drive only with corrective lens
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck3"
                                        checked />
                                    <label class="form-check-label" for="defaultCheck3">
                                        Drive only with special equipment for upper limbs
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="disabledCheck1" />
                                    <label class="form-check-label" for="disabledCheck1">
                                        Drive only with special equipment for lower limbs
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="disabledCheck2"
                                        checked />
                                    <label class="form-check-label" for="disabledCheck2">
                                        Drive only during daylight
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="disabledCheck2"
                                        checked />
                                    <label class="form-check-label" for="disabledCheck2">
                                        Drive only with hearing aid
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <h4 for="" class="">Remarks</h4>
                                <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-label-secondary btn-prev"> <i
                                        class="ti ti-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <div class="">

                                    <button class="btn btn-success btn-next btn-danger">Cancel</button>
                                    <button class="btn btn-success btn-next btn-primary">Save</button>
                                    <button class="btn btn-success btn-next btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
