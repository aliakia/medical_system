@extends('layouts/LayoutMaster2')

@section('title', 'Transactions Summary Report')

@section('vendor-style')
    <!-- vendor css files -->
    {{-- <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}"> --}}
    <link rel="stylesheet" href="{{ asset('vendors/css/previewclientinfo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

@endsection
{{-- @section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection --}}

@section('content')
    <div class="row m-2">

        <div class="col-12 col-md-12 col-lg-4 card p-3">

            <h5 class="card-title">Summary Report</h5>
            <div class="card-body border-top">
                <div class="row">

                    <div class="mt-1 col-6 font-weight-bolder"> Total Upload Transaction: </div>
                    <div class="mt-1 col" id="transaction_upload"> {{ $transaction_upload }} </div>
                    <div class="mt-1 col-6 font-weight-bolder"> Total Pending Transaction: </div>
                    <div class="mt-1 col" id="transaction_pending"> {{ $transaction_pending }} </div>

                </div>
            </div>

        </div>

        <div class="col-12 col-md-12 col-lg-8">
            <div class="row">

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="form-group">
                        <label class="form-label" for="date_from">Date Started</label>
                        <input type="text" class="form-control flatpickr-basic" id="date_from" placeholder="MM-DD-YYYY"
                            name="date_from" aria-describedby="date_from" value="{{ $current_date_from }}" />
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="form-group">
                        <label class="form-label" for="date_to">Date Completed</label>
                        <input type="text" class="form-control flatpickr-basic" id="date_to" placeholder="MM-DD-YYYY"
                            name="date_to" aria-describedby="date_to" value="{{ $current_date_to }}" />
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="form-group">
                        <div class="select">
                            <label for="status" class="form-label">Transaction Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="2">All</option>
                                <option value="1">Uploaded</option>
                                <option value="0">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12 py-2">
                    <button type="button" class="btn btn-primary" value="" id="btn_search">
                        <i class="ti ti-filter"></i>Filter
                    </button>
                    <button type="button" class="btn btn-success" value="" id="btn_export">
                        <i class="ti ti-external-link"></i>Export
                    </button>
                </div>


            </div>
        </div>

        <div class="col-12 col-md-12 p-0 mt-4">
            <div class="card p-2">
                <table class="table table-bordered table-hover" id="myTable"
                    data-url="{{ route('fetch_admin_summary_reportsby_date', [Session('data_clinic')->clinic_id, $current_date_from, $current_date_to, $status]) }}">
                    <thead>
                        <tr>
                            <th class="text-nowrap">TRANS NO.</th>
                            <th class="text-nowrap">NAME</th>
                            <th class="text-nowrap">TRANSACTION TYPE</th>
                            <th class="text-nowrap">PHYSICIAN NAME</th>
                            <th class="text-nowrap">DATE UPLOADED</th>
                            <th class="text-nowrap">STATUS</th>
                            <th class="text-nowrap">ACTION</th>
                            <!-- <th scope="col" class="text-nowrap">ACTION</th>   -->
                        </tr>
                    </thead>
                    {{-- <tbody id="table_body">
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-nowrap">{{ $item->trans_no }}</td>
                                    <td class="text-nowrap">
                                        {{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}</td>
                                    <td class="text-nowrap">
                                        @if ($item->purpose == '1')
                                            New Non-Pro Driver´s License
                                        @elseif($item->purpose == '2')
                                            New Pro Driver´s License
                                        @elseif($item->purpose == '3')
                                            Renewal of Non-Pro Driver´s License
                                        @elseif($item->purpose == '4')
                                            Renewal of Pro Driver´s License
                                        @elseif($item->purpose == '5')
                                            Renewal of Conductor´s License
                                        @elseif($item->purpose == '6')
                                            Conversion from Non-Pro to Pro DL
                                        @elseif($item->purpose == '7')
                                            New Non-Pro Driver´s License (with Foreign License)
                                        @elseif($item->purpose == '8')
                                            New Pro Driver´s License (with Foreign License)
                                        @elseif($item->purpose == '9')
                                            New Conductor´s License
                                        @elseif($item->purpose == '10')
                                            New Student Permit
                                        @elseif($item->purpose == '11')
                                            Conversion from Pro to Non-Pro DL
                                        @elseif($item->purpose == '12')
                                            Add Restriction for Non-Pro Driver´s License
                                        @elseif($item->purpose == '13')
                                            Add Restriction for Pro Driver´s License
                                        @endif
                                    </td>
                                    <td class="text-nowrap">{{ $item->physician_name }}</td>
                                    <td class="text-nowrap">{{ $item->date_uploaded }}</td>
                                    <td class="text-nowrap">
                                        @if ($item->is_lto_sent == '0')
                                            <div class="badge badge-light-warning">Pending</div>
                                        @else
                                            <div class="badge badge-light-success">Uploaded</div>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        <button type="button" class="btn btn-sm btn-primary mr-25 view"
                                            value="{{ $item->trans_no }}">
                                            <i data-feather="file-text" class="mr-25"></i>View</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                </table>
            </div>
        </div>

        <div class="col-12 mt-4 text-end">
            <a href="{{ route('admin_page', Session('data_clinic')->clinic_id) }}" class="btn btn-outline-primary load">
                <i class="ti ti-corner-down-left mr-1"></i>Go Back
            </a>
        </div>


    </div>

    <div class="modal fade text-left" id="view_details" data-backdrop="static" tabindex="-3" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row modal-body">
                    <div class="col-md-12">

                        <style>
                            .alternating-rows li:nth-child(odd) {
                                background-color: #f8f9fa;
                                /* Light gray for odd rows */
                                padding: 8px;
                            }

                            .alternating-rows li:nth-child(even) {
                                background-color: #ffffff;
                                /* White for even rows */
                                padding: 8px;
                            }
                        </style>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <h5 class="card-header mb-3">APPLICANT INFORMATION</h5>
                                    <ul class="list-unstyled alternating-rows">
                                        <li class="row">
                                            <strong class="col-6">FIRST NAME:</strong>
                                            <span class="col-6" id="pv_firstname">Ali</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">MIDDLE NAME:</strong>
                                            <span class="col-6" id="pv_middlname">Capospos</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">LAST NAME:</strong>
                                            <span class="col-6" id="pv_surname">Aguilar</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">BIRTHDAY:</strong>
                                            <span class="col-6" id="pv_bday">JULY 29,
                                                2001</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">ADDRESS:</strong>
                                            <span class="col-6" id="pv_address">BLK 7 LOT 34 BAYABAS
                                                ST. SM HOMES</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">GENDER:</strong>
                                            <span class="col-6" id="pv_gender">Female</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">NATIONALITY:</strong>
                                            <span class="col-6" id="pv_nationality">Filipino</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">CIVIL STATUS:</strong>
                                            <span class="col-6" id="pv_civil_status">Single</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">OCCUPATION:</strong>
                                            <span class="col-6" id="pv_occupation">Software
                                                Developer</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">LICENSE NO:</strong>
                                            <span class="col-6" id="pv_license_no">123456</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">PURPOSE:</strong>
                                            <span class="col-6" id="pv_purpose">New Student
                                                Permit</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Image Section -->
                                <!-- Image Section -->
                                <div class="col-12 col-lg-4 d-flex align-items-start justify-content-center">
                                    <img src="{{ asset('assets/img/avatars/14.png') }}" alt="user-avatar"
                                        class="img-fluid rounded shadow w-100 border" id="picture_2" />
                                </div>


                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <h5 class="card-header mb-3">PHYSICAL EXAMINTATION</h5>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <ul class="list-unstyled alternating-rows">

                                                <li class="row">
                                                    <strong class="col-6">HEIGHT:</strong>
                                                    <span class="col-6" id="pv_height">153</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">WEIGHT:</strong>
                                                    <span class="col-6" id="pv_weight">50</span>
                                                </li>


                                                <li class="row">
                                                    <strong class="col-6">BLOOD PRESSURE:</strong>
                                                    <span class="col-6" id="pv_bloodpressure">
                                                        100/130
                                                    </span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">BLOOD TYPE:</strong>
                                                    <span class="col-6" id="pv_bloodtype">O+</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">PULSE RATE:</strong>
                                                    <span class="col-6" id="pv_pulserate">80
                                                        BPM</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">BODY TEMPERATURE:</strong>
                                                    <span class="col-6" id="pv_bodytemperature">36
                                                        C</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">RESPIRATORY RATE:</strong>
                                                    <span class="col-6" id="pv_respiratory_rate">90</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">GENERAL PHYSIQUE:</strong>
                                                    <span class="col-6" id="pv_generalphysique">SAMPLE
                                                        DISABILITY</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">CONTAGIOUS DISEASE:</strong>
                                                    <span class="col-6" id="pv_contagiousdisease">NONE</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">UPPER EXTREMITIES
                                                        RIGHT:</strong>
                                                    <span class="col-6" id="pv_upperextremities_right">NORMAL</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">UPPER EXTREMITIES
                                                        LEFT:</strong>
                                                    <span class="col-6" id="pv_upperextremities_left">NORMAL</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">LOWER EXTREMITIES
                                                        RIGHT:</strong>
                                                    <span class="col-6" id="pv_lowerextremities_right">NORMAL</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">LOWER EXTREMITIES
                                                        LEFT:</strong>
                                                    <span class="col-6" id="pv_lowerextremities_left">NORMAL</span>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">

                                    <h5 class="card-header mb-3">METABOLIC TEST</h5>
                                    <div class="row">
                                        <div class="col-xl-12 ">
                                            <ul class="list-unstyled alternating-rows">
                                                <li class="row">
                                                    <strong class="col-6">EPILEPSY:</strong>
                                                    <span class="col-6" id="pv_epilepsy">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">EPILEPSY TREATMENT:</strong>
                                                    <span class="col-6" id="pv_epilepsytreatment"></span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">LAST SEIZURE</strong>
                                                    <span class="col-6" id="pv_lastseizure"></span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">DIABETES</strong>
                                                    <span class="col-6" id="pv_diabetes">YES</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">DIABETES TREATMENT</strong>
                                                    <span class="col-6" id="pv_diabetestreatment">YES</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">SLEEP APNEA:</strong>
                                                    <span class="col-6" id="pv_sleep_apnea">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">SLEEP APNEA
                                                        TREATMENT:</strong>
                                                    <span class="col-6" id="pv_sleep_apneatreatment"></span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">AGGRESIVE, MANIC OR
                                                        DEPRESSIVE ORDER:</strong>
                                                    <span class="col-6" id="pv_aggressive_manic">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">MENTAL TREATMENT:</strong>
                                                    <span class="col-6" id="pv_mentaltreatment">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">OTHER MEDICAL
                                                        CONDITION:</strong>
                                                    <span class="col-6" id="pv_others">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">WHAT MEDICAL
                                                        CONDITION:</strong>
                                                    <span class="col-6" id="pv_other_medical_condition">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">OTHER MEDICAL CONDITION
                                                        TREATMENT:</strong>
                                                    <span class="col-6" id="pv_other_treatment">NO</span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <h5 class="card-header mb-3">VISUAL TEST</h5>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <ul class="list-unstyled alternating-rows">
                                                {{-- <li class="row">
                                              <strong class="col-6">Rec No:</strong>
                                              <span class="col-6"
                                                  id="pv_recno">recno }}</span>
                                          </li> --}}
                                                <li class="row">
                                                    <strong class="col-6">EYE COLOR:</strong>
                                                    <span class="col-6" id="pv_eyecolor">BLACK</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">LEFT EYE:
                                                        SNELLEN/BAILEY-LOVIE:</strong>
                                                    <span class="col-6" id="pv_snellen_bailey_lovie_left">1.0</span>
                                                </li>


                                                <li class="row">
                                                    <strong class="col-6">RIGHT EYE:
                                                        SNELLEN/BAILEY-LOVIE:</strong>
                                                    <span class="col-6" id="pv_snellen_bailey_lovie_right">1.9</span>
                                                    </span>
                                                </li>

                                                <li class="row">
                                                    <strong class="col-6">WITH CORRECTIVE LENS
                                                        (LEFT):</strong>
                                                    <span class="col-6" id="pv_snellen_with_correct_left">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">WITH CORRECTIVE LENS
                                                        (RIGHT):</strong>
                                                    <span class="col-6" id="pv_snellen_with_correct_right">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">COLOR BLIND (LEFT):</strong>
                                                    <span class="col-6" id="pv_color_blind_left">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">COLOR BLIND
                                                        (RIGHT):</strong>
                                                    <span class="col-6" id="pv_color_blind_right">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">GLARE/CONTRAST SENSITVITY
                                                        FUNCTION:</strong>
                                                    <span class="col-6" id=""></span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">WITHOUT LENSES RIGHT
                                                        EYE:</strong>
                                                    <span class="col-6"
                                                        id="pv_glare_contrast_sensitivity_without_lense_right">2.9</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">WITHOUT LENSES LEFT
                                                        EYE:</strong>
                                                    <span class="col-6"
                                                        id="pv_glare_contrast_sensitivity_without_lense_left">2.9</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">WITHOUT CORRECTIVE OR
                                                        CONTRAST LENSES RIGHT
                                                        EYE:</strong>
                                                    <span class="col-6"
                                                        id="pv_glare_contrast_sensitivity_with_corrective_right">2.9</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">WITHOUT CORRECTIVE OR
                                                        CONTRAST LENSES LEFT
                                                        EYE:</strong>
                                                    <span class="col-6"
                                                        id="pv_glare_contrast_sensitivity_with_corrective_left">2.9</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">COLOR BLIND TEST:</strong>
                                                    <span class="col-6" id="pv_color_blind_test">6/6</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">ANY EYE INJURY OR DISEASE
                                                        (SPECIFY):</strong>
                                                    <span class="col-6" id="pv_eye_injury">NO</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">IS FURTHER EYE EXAMINATION
                                                        SUGGESTED:</strong>
                                                    <span class="col-6" id="pv_examination_suggested">NO</span>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <h5 class="card-header mb-3">AUDITORY TEST</h5>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <ul class="list-unstyled alternating-rows">
                                                <li class="row">
                                                    <strong class="col-6">RIGHT EAR:</strong>
                                                    <span class="col-6" id="pv_hearing_right">NORMAL</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">LEFT EAR:</strong>
                                                    <span class="col-6" id="pv_hearing_left">NORMAL</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <h5 class="card-header mb-3">ASSESSMENT AND CONDITION</h5>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <ul class="list-unstyled alternating-rows">
                                                <li class="row">
                                                    <strong class="col-6">ASSESSMENT:</strong>
                                                    <span class="col-6" id="pv_exam_assessment">FIT
                                                        TO DRIVE</span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">ASSESSMENT STATUS:</strong>
                                                    <span class="col-6" id="pv_assessment_status"></span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">CONDITIONS:</strong>
                                                    <span class="col-6" id="pv_exam_conditions"></span>
                                                </li>
                                                <li class="row">
                                                    <strong class="col-6">REMARKS:</strong>
                                                    <span class="col-6" id="pv_remarks"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection
@section('page-script')
    <script src="{{ asset('js/scripts/transaction_reports.js') }}"></script>
    <script>
        var e = {{ $status }};
        if (e == 0) {
            document.getElementById("status").options[2].selected = 'selected';
        } else if (e == 1) {
            document.getElementById("status").options[1].selected = 'selected';
        } else if (e == 2) {
            document.getElementById("status").options[0].selected = 'selected';
        }
    </script>
@endsection
