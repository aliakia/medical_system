@extends('layouts/layoutMaster')

@section('title', 'Account settings - Account')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

<style>
    /* Add the CSS here */
    ul.list-unstyled li:nth-child(odd) {
        background-color: #f8f9fa;
        /* Light gray color for odd rows */
    }

    ul.list-unstyled li:nth-child(even) {
        background-color: #ffffff;
        /* White color for even rows */
    }

    ul.list-unstyled li {
        padding: 10px 0;
    }
</style>


@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <h5 class="card-header">APPLICANT INFORMATION</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ asset('assets/img/avatars/14.png') }}" alt="user-avatar"
                            class="d-block w-px-200 h-auto rounded" id="uploadedAvatar" />
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xl-12">
                                    <ul class="list-unstyled">
                                        {{-- <li class="row">
                                        <strong class="col-xl-5 col-6">Rec No:</strong>
                                        <span class="col-xl-7 col-6"
                                            id="preview-recno">recno }}</span>
                                    </li> --}}
                                        <li class="row">
                                            <strong class="col-6">FIRST NAME:</strong>
                                            <span class="col-6" id="preview-user_id">Ali</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">MIDDLE NAME:</strong>
                                            <span class="col-6" id="preview-employee_id">Capospos</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">LAST NAME:</strong>
                                            <span class="col-6" id="preview-ds_code">Aguilar</span>
                                        </li>

                                        <li class="row">
                                            <strong class="col-6">BIRTHDAY:</strong>
                                            <span class="col-6" id="preview-certificate_tesda">JULY 29, 2001</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">ADDRESS:</strong>
                                            <span class="col-6" id="preview-certificate_tesda_expiration">BLK 7 LOT 34
                                                BAYABAS ST. SM HOMES</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">GENDER:</strong>
                                            <span class="col-6" id="preview-user_expiration">Female</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">NATIONALITY:</strong>
                                            <span class="col-6" id="preview-is_active">Filipino</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">CIVIL STATUS:</strong>
                                            <span class="col-6" id="preview-is_active">Single</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">OCCUPATION:</strong>
                                            <span class="col-6" id="preview-is_active">Software Developer</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">LICENSE NO:</strong>
                                            <span class="col-6" id="preview-is_active"></span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-6">PURPOSE:</strong>
                                            <span class="col-6" id="preview-is_active">New Student Permit</span>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /Account -->
            </div>
            <div class="card mb-4">
                <hr class="my-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <h5 class="card-header mb-4 p-0">PHYSICAL EXAMINTATION</h5>
                            <div class="row">
                                <div class="col-xl-12">
                                    <ul class="list-unstyled">
                                        {{-- <li class="row">
                                        <strong class="col-xl-5 col-6">Rec No:</strong>
                                        <span class="col-xl-7 col-6"
                                            id="preview-recno">recno }}</span>
                                    </li> --}}
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">HEIGHT:</strong>
                                            <span class="col-xl-7 col-6" id="preview-user_id">153</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">WEIGHT:</strong>
                                            <span class="col-xl-7 col-6" id="preview-employee_id">50</span>
                                        </li>


                                        <li class="row">
                                            <strong class="col-xl-5 col-6">BLOOD PRESSURE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-ds_code">
                                                100/130
                                            </span>
                                        </li>

                                        <li class="row">
                                            <strong class="col-xl-5 col-6">BLOOD TYPE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-certificate_tesda">O+</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">PULSE RATE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-certificate_tesda_expiration">80
                                                BPM</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">BODY TEMPERATURE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-user_expiration">36 C</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">RESPIRATORY RATE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">90</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">GENERAL PHYSIQUE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">SAMPLE DISABILITY</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">CONTAGIOUS DISEASE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">NONE</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">UPPER EXTREMITIES RIGHT:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">NORMAL</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">UPPER EXTREMITIES LEFT:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">NORMAL</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">LOWER EXTREMITIES RIGHT:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">NORMAL</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">LOWER EXTREMITIES LEFT:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">NORMAL</span>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                            <h5 class="card-header mb-4 p-0">METABOLIC TEST</h5>
                            <div class="row">
                                <div class="col-xl-12 ">
                                    <ul class="list-unstyled">
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">EPILEPSY:</strong>
                                            <span class="col-xl-5 col-6" id="preview-first_name">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">EPILEPSY TREATMENT:</strong>
                                            <span class="col-xl-5 col-6" id="preview-middle_name"></span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">LAST SEIZURE</strong>
                                            <span class="col-xl-5 col-6" id="preview-last_name"></span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">DIABETES</strong>
                                            <span class="col-xl-5 col-6" id="preview-gender">YES</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">DIABETES TREATMENT</strong>
                                            <span class="col-xl-5 col-6" id="preview-gender">YES</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">SLEEP APNEA:</strong>
                                            <span class="col-xl-5 col-6" id="preview-description">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">SLEEP APNEA TREATMENT:</strong>
                                            <span class="col-xl-5 col-6" id="preview-description"></span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">AGGRESIVE, MANIC OR DEPRESSIVE ORDER:</strong>
                                            <span class="col-xl-5 col-6" id="preview-description">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">MENTAL TREATMENT:</strong>
                                            <span class="col-xl-5 col-6" id="preview-description">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">OTHER MEDICAL CONDITION:</strong>
                                            <span class="col-xl-5 col-6" id="preview-description">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">WHAT MEDICAL CONDITION:</strong>
                                            <span class="col-xl-5 col-6" id="preview-description">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">OTHER MEDICAL CONDITION TREATMENT:</strong>
                                            <span class="col-xl-5 col-6" id="preview-description">NO</span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <h5 class="card-header mb-4 p-0">VISUAL TEST</h5>
                            <div class="row">
                                <div class="col-xl-12">
                                    <ul class="list-unstyled">
                                        {{-- <li class="row">
                                        <strong class="col-xl-5 col-6">Rec No:</strong>
                                        <span class="col-xl-7 col-6"
                                            id="preview-recno">recno }}</span>
                                    </li> --}}
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">EYE Color:</strong>
                                            <span class="col-xl-7 col-6" id="preview-user_id">BLACK</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">LEFT EYE: SNELLEN/BAILEY-LOVIE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-employee_id">1.0</span>
                                        </li>


                                        <li class="row">
                                            <strong class="col-xl-5 col-6">RIGHT EYE: SNELLEN/BAILEY-LOVIE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-ds_code">1.9</span> </span>
                                        </li>

                                        <li class="row">
                                            <strong class="col-xl-5 col-6">WITH CORRECTIVE LENS (LEFT):</strong>
                                            <span class="col-xl-7 col-6" id="preview-certificate_tesda">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">WITH CORRECTIVE LENS (RIGHT):</strong>
                                            <span class="col-xl-7 col-6"
                                                id="preview-certificate_tesda_expiration">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">COLOR BLIND (LEFT):</strong>
                                            <span class="col-xl-7 col-6" id="preview-user_expiration">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">COLOR BLIND (RIGHT):</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">GLARE/CONTRAST SENSITVITY FUNCTION:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active"></span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">WITHOUT LENSES RIGHT EYE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">2.9</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">WITHOUT LENSES LEFT EYE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">2.9</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">WITHOUT CORRECTIVE OR CONTRAST LENSES RIGHT
                                                EYE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">2.9</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">WITHOUT CORRECTIVE OR CONTRAST LENSES LEFT
                                                EYE:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">2.9</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">COLOR BLIND TEST:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">6/6</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">ANY EYE INJURY OR DISEASE (SPECIFY):</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">NO</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-5 col-6">IS FURTHER EYE EXAMINATION SUGGESTED:</strong>
                                            <span class="col-xl-7 col-6" id="preview-is_active">NO</span>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                            <h5 class="card-header mb-4 p-0">AUDITORY TEST</h5>
                            <div class="row">
                                <div class="col-xl-12">
                                    <ul class="list-unstyled">
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">RIGHT EAR:</strong>
                                            <span class="col-xl-5 col-6" id="preview-first_name">NORMAL</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">LEFT EAR:</strong>
                                            <span class="col-xl-5 col-6" id="preview-middle_name">NORMAL</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5 class="card-header mb-4 p-0">ASSESSMENT AND CONDITION</h5>
                            <div class="row">
                                <div class="col-xl-12">
                                    <ul class="list-unstyled">
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">ASSESSMENT:</strong>
                                            <span class="col-xl-5 col-6" id="preview-first_name">FIT TO DRIVE</span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">ASSESSMENT STATUS:</strong>
                                            <span class="col-xl-5 col-6" id="preview-first_name"></span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">CONDITIONS:</strong>
                                            <span class="col-xl-5 col-6" id="preview-middle_name"></span>
                                        </li>
                                        <li class="row">
                                            <strong class="col-xl-7 col-6">REMARKS:</strong>
                                            <span class="col-xl-5 col-6" id="preview-middle_name"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
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
                <!-- /Account -->
            </div>

        </div>
    </div>

@endsection
