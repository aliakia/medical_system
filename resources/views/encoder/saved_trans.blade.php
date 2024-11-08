@extends('layouts/LayoutMaster')

@section('title', 'Main Page')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            var clinic_id = "{{ Session('data_clinic')->clinic_id }}";
            var dataUrl = "{{ route('fetch_user_data', ':clinic_id') }}".replace(':clinic_id',
                "{{ Session('data_clinic')->clinic_id }}");

            $('#myTable').data('fetch_user_data', dataUrl);

        });
    </script>


    {{-- <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script> --}}
    <script src="{{ asset('js/saved_trans.js') }}"></script>
@endsection
@section('content')

    <div class="col-12 col-md-12 col-lg-12 mb-4">
        {{-- <div class="row mb-5" style="height: 100px;"> --}}
        {{-- <div class="col-6 col-md-6 col-lg-6 mb-2" style="height: 100px;">
              <a class="w-100 btn btn-outline-primary load"
                  href="{{ route('new_trans', Session('data_clinic')->clinic_id) }}" id="btn_new_trans">
                  <div class="row">
                      <div class="col-3 mx-0">
                          <div class="avatar bg-light-primary p-1 mr-50">
                              <div class="avatar-content">
                                  <i class="ti ti-plus"></i>
                              </div>
                          </div>
                      </div>
                      <div class="col-8 py-1" style="height: 100px;">
                          <span class="font-weight-bolder h5">NEW TRANSACTION</span>
                      </div>
                  </div>
              </a>
          </div> --}}

        {{-- <div class="d-flex justify-content-end"> --}}
        {{-- <div class="col-3" style="height: 50px;">
            <a href="{{ route('new_trans', Session('data_clinic')->clinic_id) }}" id="btn_new_trans"
                class="w-100 btn btn-outline-primary justify-center align-items-center" style="height: 50px;">
                <i class="ti ti-plus me-2 fw-bolder"></i>
                <span class="fw-bolder">
                    New Transaction
                </span>
            </a>
        </div> --}}
        {{-- </div> --}}

        {{-- <div class="col-6 visually-hidden" style="height: 100px;">
                <a href="{{ route('saved_trans', Session('data_clinic')->clinic_id) }}" id="btn_saved_trans"
                    class="w-100 btn btn-outline-primary" style="height: 100px;">
                    <span class="fw-bolder">
                        Saved Transaction
                    </span>
                </a>
            </div> --}}
        {{-- <div class="col-6 col-md-6 col-lg-6 mb-2">
              <a class="w-100 btn btn-outline-primary load"
                  href="{{ route('saved_trans', Session('data_clinic')->clinic_id) }}" id="btn_saved_trans">
                  <div class="row">
                      <div class="col-3 mx-0">
                          <div class="avatar bg-light-primary p-1 mr-50">
                              <div class="avatar-content">
                                  <i data-feather="save" class="font-large-1"></i>
                              </div>
                          </div>
                      </div>
                      <div class="col-8 py-1">
                          <span class="font-weight-bolder h5">SAVED TRANSACTION</span>
                      </div>
                  </div>
              </a>
          </div> --}}
        {{-- </div> --}}
    </div>

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
            <button class="btn btn-primary" style="height: 38px;" id="btn_search">
                <i class="ti ti-filter me-25"></i>Filter
            </button>
        </div>
    </div>



    <div class="row">

        <div class="col-12 mb-3">
            <div class="card p-2">
                <div class="d-flex justify-content-end py-2">
                    <div class="col-2" style="height: 50px;">
                        <a href="{{ route('new_trans', Session('data_clinic')->clinic_id) }}" id="btn_new_trans"
                            class="w-100 btn btn-primary justify-center align-items-center" style="height: 50px;">
                            <span class="fw-bolder">
                                Create New Transaction
                            </span>
                            <i class="ti ti-arrow-right ms-2 fw-bolder"></i>
                        </a>
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="myTable"
                    data-url="{{ route('fetch_by_date', [Session('data_clinic')->clinic_id, $date_from, $date_to]) }}">
                    <thead class="bg-light">
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

        {{-- <div class="col-12 mt-4 text-end">
            <a href="{{ route('main_page', Session('data_clinic')->clinic_id) }}" class="btn btn-outline-primary load">
                <i class="ti ti-corner-down-left mr-1"></i>Go Back
            </a>
        </div> --}}

    </div>




    <input type="hidden" id="clinic_balance" name="clinic_balance" value="{{ $balance[0]->balance }}">

    <div class="modal fade" id="balance_" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content bg-danger">
                <div class="row p-3">
                    <img src="{{ asset('images/warning.png') }}" style="" class="mx-auto" alt="default.png"
                        height="auto" width="30%" style="display:block" />
                    <div class="col-12">
                        <h1 class="text-center text-light mb-3">INSUFFICIENT BALANCE!!!</h1>
                    </div>
                    <div class="col-12">
                        <h3 class="text-danger text-center text-light">Current Balance: ₱ {{ $balance[0]->balance }}
                        </h3>
                    </div>
                    <div class="col-12">
                        <p class="text-danger text-center text-light">NOTE: when this message close, system will
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
                                <!-- Image Section (appears above on small screens) -->
                                <div class="row">

                                    <div
                                        class="col-12 col-lg-4 d-flex align-items-start justify-content-center order-1 order-lg-2 mb-3 mb-lg-0">
                                        <img src="{{ asset('images/default.png') }}" alt="User Image"
                                            class="img-fluid rounded shadow w-100 border" id="picture_2" />
                                    </div>

                                    <!-- Applicant Information (appears below on small screens) -->
                                    <div class="col-12 col-lg-8 order-2 order-lg-1">
                                        <h5 class="card-header mb-3">APPLICANT INFORMATION</h5>
                                        <ul class="list-unstyled alternating-rows">
                                            <li class="row">
                                                <strong class="col-6">FIRST NAME:</strong>
                                                <span class="col-6" id="pv_firstname"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">MIDDLE NAME:</strong>
                                                <span class="col-6" id="pv_middlname"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">LAST NAME:</strong>
                                                <span class="col-6" id="pv_surname"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">BIRTHDAY:</strong>
                                                <span class="col-6" id="pv_bday"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">ADDRESS:</strong>
                                                <span class="col-6" id="pv_address"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">GENDER:</strong>
                                                <span class="col-6" id="pv_gender"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">NATIONALITY:</strong>
                                                <span class="col-6" id="pv_nationality"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">CIVIL STATUS:</strong>
                                                <span class="col-6" id="pv_civil_status"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">OCCUPATION:</strong>
                                                <span class="col-6" id="pv_occupation"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">LICENSE NO:</strong>
                                                <span class="col-6" id="pv_license_no"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">PURPOSE:</strong>
                                                <span class="col-6" id="pv_purpose"></span>
                                            </li>
                                        </ul>
                                        <hr>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12">
                                        <h5 class="card-header mb-3">PHYSICAL EXAMINTATION</h5>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <ul class="list-unstyled alternating-rows">

                                                    <li class="row">
                                                        <strong class="col-6">HEIGHT:</strong>
                                                        <span class="col-6" id="pv_height"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">WEIGHT:</strong>
                                                        <span class="col-6" id="pv_weight"></span>
                                                    </li>


                                                    <li class="row">
                                                        <strong class="col-6">BLOOD PRESSURE:</strong>
                                                        <span class="col-6" id="pv_bloodpressure"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">BLOOD TYPE:</strong>
                                                        <span class="col-6" id="pv_bloodtype"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">PULSE RATE:</strong>
                                                        <span class="col-6" id="pv_pulserate"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">BODY TEMPERATURE:</strong>
                                                        <span class="col-6" id="pv_bodytemperature"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">RESPIRATORY RATE:</strong>
                                                        <span class="col-6" id="pv_respiratory_rate"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">GENERAL PHYSIQUE:</strong>
                                                        <span class="col-6" id="pv_generalphysique"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">CONTAGIOUS DISEASE:</strong>
                                                        <span class="col-6" id="pv_contagiousdisease"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">UPPER EXTREMITIES
                                                            RIGHT:</strong>
                                                        <span class="col-6" id="pv_upperextremities_right"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">UPPER EXTREMITIES
                                                            LEFT:</strong>
                                                        <span class="col-6" id="pv_upperextremities_left"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">LOWER EXTREMITIES
                                                            RIGHT:</strong>
                                                        <span class="col-6" id="pv_lowerextremities_right"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">LOWER EXTREMITIES
                                                            LEFT:</strong>
                                                        <span class="col-6" id="pv_lowerextremities_left"></span>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="col-12">
                                        <h5 class="card-header mb-3">METABOLIC TEST</h5>
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <ul class="list-unstyled alternating-rows">
                                                    <li class="row">
                                                        <strong class="col-6">EPILEPSY:</strong>
                                                        <span class="col-6" id="pv_epilepsy"></span>
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
                                                        <span class="col-6" id="pv_diabetes"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">DIABETES TREATMENT</strong>
                                                        <span class="col-6" id="pv_diabetestreatment"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">SLEEP APNEA:</strong>
                                                        <span class="col-6" id="pv_sleep_apnea"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">SLEEP APNEA
                                                            TREATMENT:</strong>
                                                        <span class="col-6" id="pv_sleep_apneatreatment"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">AGGRESIVE, MANIC OR
                                                            DEPRESSIVE ORDER:</strong>
                                                        <span class="col-6" id="pv_aggressive_manic"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">MENTAL TREATMENT:</strong>
                                                        <span class="col-6" id="pv_mentaltreatment"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">OTHER MEDICAL
                                                            CONDITION:</strong>
                                                        <span class="col-6" id="pv_others"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">WHAT MEDICAL
                                                            CONDITION:</strong>
                                                        <span class="col-6" id="pv_other_medical_condition"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">OTHER MEDICAL CONDITION
                                                            TREATMENT:</strong>
                                                        <span class="col-6" id="pv_other_treatment"></span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

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
                                                        <span class="col-6" id="pv_eyecolor"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">LEFT EYE:
                                                            SNELLEN/BAILEY-LOVIE:</strong>
                                                        <span class="col-6" id="pv_snellen_bailey_lovie_left"></span>
                                                    </li>


                                                    <li class="row">
                                                        <strong class="col-6">RIGHT EYE:
                                                            SNELLEN/BAILEY-LOVIE:</strong>
                                                        <span class="col-6" id="pv_snellen_bailey_lovie_right"></span>
                                                        </span>
                                                    </li>

                                                    <li class="row">
                                                        <strong class="col-6">WITH CORRECTIVE LENS
                                                            (LEFT):</strong>
                                                        <span class="col-6" id="pv_snellen_with_correct_left"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">WITH CORRECTIVE LENS
                                                            (RIGHT):</strong>
                                                        <span class="col-6" id="pv_snellen_with_correct_right"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">COLOR BLIND (LEFT):</strong>
                                                        <span class="col-6" id="pv_color_blind_left"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">COLOR BLIND
                                                            (RIGHT):</strong>
                                                        <span class="col-6" id="pv_color_blind_right"></span>
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
                                                            id="pv_glare_contrast_sensitivity_without_lense_right"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">WITHOUT LENSES LEFT
                                                            EYE:</strong>
                                                        <span class="col-6"
                                                            id="pv_glare_contrast_sensitivity_without_lense_left"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">WITHOUT CORRECTIVE OR
                                                            CONTRAST LENSES RIGHT
                                                            EYE:</strong>
                                                        <span class="col-6"
                                                            id="pv_glare_contrast_sensitivity_with_corrective_right"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">WITHOUT CORRECTIVE OR
                                                            CONTRAST LENSES LEFT
                                                            EYE:</strong>
                                                        <span class="col-6"
                                                            id="pv_glare_contrast_sensitivity_with_corrective_left"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">COLOR BLIND TEST:</strong>
                                                        <span class="col-6" id="pv_color_blind_test"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">ANY EYE INJURY OR DISEASE
                                                            (SPECIFY):</strong>
                                                        <span class="col-6" id="pv_eye_injury"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">IS FURTHER EYE EXAMINATION
                                                            SUGGESTED:</strong>
                                                        <span class="col-6" id="pv_examination_suggested"></span>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="col-12">
                                        <h5 class="card-header mb-3">AUDITORY TEST</h5>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <ul class="list-unstyled alternating-rows">
                                                    <li class="row">
                                                        <strong class="col-6">RIGHT EAR:</strong>
                                                        <span class="col-6" id="pv_hearing_right"></span>
                                                    </li>
                                                    <li class="row">
                                                        <strong class="col-6">LEFT EAR:</strong>
                                                        <span class="col-6" id="pv_hearing_left"></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="col-12">
                                        <h5 class="card-header mb-3">ASSESSMENT AND CONDITION</h5>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <ul class="list-unstyled alternating-rows">
                                                    <li class="row">
                                                        <strong class="col-6">ASSESSMENT:</strong>
                                                        <span class="col-6" id="pv_exam_assessment"></span>
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
