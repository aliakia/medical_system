@extends('layouts/LayoutMaster')

@section('title', 'Saved Transactions')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

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
    <section id="basic-datatable">

        <div class="d-flex align-bottom align-items-end w-100 mb-3">
            <div class="form-group me-2">
                <label class="form-label" for="date_from">Date Started</label>
                <input type="text" class="form-control flatpickr-basic" id="date_from" placeholder="MM-DD-YYYY"
                    name="date_from" aria-describedby="date_from" value="{{ $date_from }}" />
            </div>
            <div class="form-group me-2">
                <label class="form-label" for="date_to">Date Completed</label>
                <input type="text" class="form-control flatpickr-basic" id="date_to" placeholder="MM-DD-YYYY"
                    name="date_to" aria-describedby="date_to" value="{{ $date_to }}" />
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" style="height: 38px;" value="" id="btn_search">
                    <i class="ti ti-filter me-25"></i>Filter
                </button>
            </div>
        </div>



        <div class="row">

            <div class="col-12 mb-3">
                <div class="card p-2">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-nowrap">TRANS NO.</th>
                                <th class="text-nowrap">NAME</th>
                                <th class="text-nowrap">STATUS</th>
                                <th class="text-nowrap">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            {{-- @forelse ($data as $item)
                                <tr>
                                    <td class="text-nowrap">{{ $item->trans_no }}</td>
                                    <td class="text-nowrap">
                                        {{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}</td>
                                    <td class="text-nowrap">
                                        @if ($item->is_ltms_uploaded == '0')
                                            <div class="badge badge-light-warning">Pending</div>
                                        @else
                                            <div class="badge badge-light-success">Uploaded</div>
                                        @endif

                                        @if ($item->is_printed == '0')
                                            <!-- <div class="badge badge-light-success">Uploaded</div> -->
                                        @else
                                            <div class="badge badge-light-info">Certificate Printed</div>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        <button type="button" class="btn btn-sm btn-primary mr-25 view"
                                            value="{{ $item->trans_no }}">
                                            <i data-feather="file-text" class="mr-25"></i>View
                                        </button>
                                        @if ($item->is_ltms_uploaded == '0')
                                            <a href="{{ route('continue_saved_data', [
                                                Session('data_clinic')->clinic_id,
                                                $item->trans_no .
                                                '=' .
                                                $item->test_physical_completed .
                                                '=' .
                                                $item->test_visual_actuity_completed .
                                                '=' .
                                                $item->test_hearing_auditory_completed .
                                                '=' .
                                                $item->test_metabolic_neurological_completed .
                                                '=' .
                                                $item->test_health_history_completed .
                                                '=' .
                                                $item->is_final .
                                                '=' .
                                                $item->is_ltms_uploaded,
                                            ]) }}"
                                                class="btn btn-sm btn-warning mr-25 load" value="">
                                                Continue<i data-feather="arrow-right" class="mr-25"></i>
                                            </a>
                                        @else
                                            @if ($item->is_printed == '0')
                                                <button type="button" class="btn btn-sm btn-success mr-25 print"
                                                    value="{{ $item->trans_no }}">
                                                    <i data-feather="printer" class="mr-25"></i>Print
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-info mr-25 reprint"
                                                    value="{{ $item->trans_no }}">
                                                    <i data-feather="printer" class="mr-25"></i>Reprint
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse --}}

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12">
                <a href="{{ route('main_page', Session('data_clinic')->clinic_id) }}" class="btn btn-outline-primary load">
                    <i class="ti ti-corner-down-left" mr-1"></i>Go Back
                </a>
            </div>

        </div>



        <input type="hidden" id="clinic_balance" name="clinic_balance" value="{{ $balance[0]->balance }}">

        <div class="modal fade" id="balance_" data-backdrop="static">
            <div class="modal-dialog modal-md">
                <div class="modal-content bg-danger">
                    <div class="row p-3">
                        <img src="{{ asset('images/warning.png') }}" style="" class="mx-auto mb-2" alt="default.png"
                            height="auto" width="30%" style="display:block" />
                        <div class="col-12">
                            <h1 class="text-center text-light mb-3">INSUFFICIENT BALANCE!!!</h1>
                        </div>
                        <div class="col-12">
                            <h3 class="text-danger text-center text-light">Current Balance: ₱ {{ $balance[0]->balance }}
                            </h3>
                        </div>
                        <div class="col-12">
                            <p class="text-danger text-center text-light">NOTE: when this message close system will
                                automatically signout</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade text-left" id="view_details" data-backdrop="static" tabindex="-3" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background:#ffffff">
                        <button type="button" class="close bg-danger" data-dismiss="modal" id="close_cam"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-25">

                            <div class="col-12 col-md-12 col-lg-12 px-5">
                                <div class="row" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

                                    <div class="col-12 col-md-12 col-lg-6 m-1">
                                        <div class="row">

                                            <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                                                <h3>Applicant Information</h3>
                                            </div>

                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="row">

                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <h5>FIRST NAME :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <p id="pv_firstname" name="pv_firstname"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">MIDDLE NAME :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_middlname" name="pv_middlname">
                                                        </p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <h5 class="m-0 py-1 pr-1">SURNAME :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_surname" name="pv_surname"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">BIRTHDAY :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_bday" name="pv_bday"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <h5 class="m-0 py-1 pr-1">ADDRESS :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text" style="">
                                                        <p class="m-0 py-1 pr-1" id="pv_address" name="pv_address"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">GENDER :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_gender" name="pv_gender"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <h5 class="m-0 py-1 pr-1">NATIONALITY :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_nationality"
                                                            name="pv_nationality"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1"> CIVIL STATUS :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_civil_status"
                                                            name="pv_civil_status"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <h5 class="m-0 py-1 pr-1"> OCCUPATION :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_occupation" name="pv_occupation">
                                                        </p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1"> LICENSE NO :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_license_no" name="pv_license_no">
                                                        </p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <h5 class="m-0 py-1 pr-1"> PURPOSE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_purpose" name="pv_purpose"></p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-5 m-1">
                                        <div class="row">

                                            <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                                                <h3>Applicant Picture</h3>
                                            </div>

                                            <div class="col-12 col-md-12 col-lg-12 px-5">
                                                <div class="row">

                                                    <div class="col embed-responsive-1by1 p-1"
                                                        style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                                                        <img src="{{ asset('images/default.png') }}" id="picture_2"
                                                            class="bg-secondary" alt="default.png" width="100%" />
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 m-1">
                                        <div class="row">

                                            <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                                                <h3>Physical Examination</h3>
                                            </div>

                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="row">

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="pr-1">HEIGHT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="pr-1" id="pv_height" name="pv_height"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">WEIGHT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_weight" name="pv_weight"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">BLOOD PRESSURE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_bloodpressure"
                                                            name="pv_bloodpressure"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">BLOOD TYPE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_bloodtype" name="pv_bloodtype">
                                                        </p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">PULSE RATE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_pulserate" name="pv_pulserate">
                                                        </p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">BODY TEMPERATURE:</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1"id="pv_bodytemperature"
                                                            name="pv_bodytemperature"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">RESPIRATORY RATE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_respiratory_rate"
                                                            name="pv_respiratory_rate"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">GENERAL PHYSIQUE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_generalphysique"
                                                            name="pv_generalphysiquee"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">CONTAGIOUS DISEASE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_contagiousdisease"
                                                            name="pv_contagiousdisease"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">UPPER EXTREMITIES RIGHT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_upperextremities_right"
                                                            name="pv_upperextremities_right"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">UPPER EXTREMITIES LEFT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_upperextremities_left"
                                                            name="pv_upperextremities_left"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">LOWER EXTREMITIES RIGHT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_lowerextremities_right"
                                                            name="pv_lowerextremities_right"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">LOWER EXTREMITIES LEFT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_lowerextremities_left"
                                                            name="pv_lowerextremities_left"></p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-5 m-1">
                                        <div class="row">

                                            <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                                                <h3>Metabolic Test</h3>
                                            </div>

                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="row">

                                                    <div class="col-md-6 col-lg-8 container-text">
                                                        <h5>EPILEPSY :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text">
                                                        <p id="pv_epilepsy" name="pv_epilepsy"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">EPILEPSY TREATMENT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_epilepsytreatment"
                                                            name="pv_epilepsytreatment"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text">
                                                        <h5 class="m-0 py-1 pr-1">LAST SEIZURE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_lastseizure"
                                                            name="pv_lastseizure"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">DIABETES :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_diabetes" name="pv_diabetes"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text">
                                                        <h5 class="m-0 py-1 pr-1">DIABETES TREATMENT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_diabetestreatment"
                                                            name="pv_diabetestreatment"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">SLEEP APNEA :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_sleep_apnea"
                                                            name="pv_sleep_apnea"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text">
                                                        <h5 class="m-0 py-1 pr-1">SLEEP APNEA TREATMENT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_sleep_apneatreatment"
                                                            name="pv_sleep_apneatreatment"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">AGGRESSIVE, MANIC OR DEPRESSIVE ORDER :
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_aggressive_manic"
                                                            name="pv_aggressive_manic"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text">
                                                        <h5 class="m-0 py-1 pr-1">MENTAL TREATMENT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_mentaltreatment"
                                                            name="pv_epilepsytreatment"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">OTHER MEDICAL CONDITION :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_others" name="pv_others"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text">
                                                        <h5 class="m-0 py-1 pr-1">WHAT MEDICAL CONDITION :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_other_medical_condition"
                                                            name="pv_other_medical_condition"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-8 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">OTHER MEDICAL CONDITION TREATMENT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_other_treatment"
                                                            name="pv_other_treatment"></p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-6 m-1">
                                        <div class="row">

                                            <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                                                <h3>Visual Test</h3>
                                            </div>

                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="row">

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5>EYE COLOR :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p id="pv_eyecolor" name="pv_eyecolor"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">LEFT EYE: SNELLEN/BAILEY-LOVIE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_snellen_bailey_lovie_left"
                                                            name="pv_snellen_bailey_lovie_left"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">RIGHT EYE: SNELLEN/BAILEY-LOVIE :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_snellen_bailey_lovie_right"
                                                            name="pv_snellen_bailey_lovie_right"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">WITH CORRECTIVE LENS-LEFT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_snellen_with_correct_left"
                                                            name="pv_snellen_with_correct_left"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">WITH CORRECTIVE LENS-RIGHT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_snellen_with_correct_right"
                                                            name="pv_snellen_with_correct_right"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">COLOR BLIND-LEFT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_color_blind_left"
                                                            name="pv_color_blind_left"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">COLOR BLIND-RIGHT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_color_blind_right"
                                                            name="pv_color_blind_right"></p>
                                                    </div>

                                                    <div class="col-md-12 col-lg-12 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">Glare/Contrast Sensitivity Function</h5>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">Without Lenses Right Eye:</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1"
                                                            id="pv_glare_contrast_sensitivity_without_lense_right"
                                                            name="pv_glare_contrast_sensitivity_without_lense_right"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">Without Lenses Left Eye:</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1"
                                                            id="pv_glare_contrast_sensitivity_without_lense_left"
                                                            name="pv_glare_contrast_sensitivity_without_lense_left"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">Without Corrective or Contact Lenses
                                                            Right Eye:</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1"
                                                            id="pv_glare_contrast_sensitivity_with_corrective_right"
                                                            name="pv_glare_contrast_sensitivity_with_corrective_right"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text">
                                                        <h5 class="m-0 py-1 pr-1">Without Corrective or Contact Lenses Left
                                                            Eye:</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text">
                                                        <p class="m-0 py-1 pr-1"
                                                            id="pv_glare_contrast_sensitivity_with_corrective_left"
                                                            name="pv_glare_contrast_sensitivity_with_corrective_left"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">Color Blind Test :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_color_blind_test"
                                                            name="pv_color_blind_test"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text ">
                                                        <h5 class="m-0 py-1 pr-1">Any Eye Injury or Disease?(Specify) :
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text ">
                                                        <p class="m-0 py-1 pr-1" id="pv_eye_injury" name="pv_eye_injury">
                                                        </p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-10 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">Is Further eye examination suggested:
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-2 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_examination_suggested"
                                                            name="pv_examination_suggested"></p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-5 m-1">
                                        <div class="row">

                                            <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                                                <h3>Auditory Test</h3>
                                            </div>

                                            <div class="col-md-6 col-lg-10 container-text">
                                                <h5 class="m-0 py-1 pr-1">RIGHT EAR :</h5>
                                            </div>
                                            <div class="col-md-6 col-lg-2 container-text">
                                                <p class="m-0 py-1 pr-1" id="pv_hearing_right" name="pv_hearing_right">
                                                </p>
                                            </div>

                                            <div class="col-md-6 col-lg-10 container-text bggrey">
                                                <h5 class="m-0 py-1 pr-1">LEFT EAR :</h5>
                                            </div>
                                            <div class="col-md-6 col-lg-2 container-text bggrey">
                                                <p class="m-0 py-1 pr-1" id="pv_hearing_left" name="pv_hearing_left"></p>
                                            </div>

                                            <div class="content-header col-12 p-1 m-0 my-1 container-header">
                                                <h3>Assesment and Condition</h3>
                                            </div>

                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">

                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <h5>ASSESSMENT :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <p id="pv_exam_assessment" name="pv_exam_assessment"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1">ASSESSMENT STATUS :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_assessment_status"
                                                            name="pv_assessment_status"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <h5 class="m-0 py-1 pr-1">CONDITIONS :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text">
                                                        <p class="m-0 py-1 pr-1" id="pv_exam_conditions"
                                                            name="pv_exam_conditions"></p>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <h5 class="m-0 py-1 pr-1" class="text-uppercase">REMARKS :</h5>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 container-text bggrey">
                                                        <p class="m-0 py-1 pr-1" id="pv_remarks" name="pv_remarks"></p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> --}}
                    </div>
                </div>
            </div>
        @endsection

        @section('vendor-script')
            <!-- vendor files -->
            <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

            <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>

            <script src="{{ asset('vendors/js/webcam.min.js') }}"></script>
        @endsection
        @section('page-script')
        <script>
          var clinicId = "{{ Session::get('data_clinic')->clinic_id }}";
      </script>

            {{-- <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script> --}}
            <script src="{{ asset('js/saved_trans.js') }}"></script>
        @endsection
