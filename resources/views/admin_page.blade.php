@extends('layouts/layoutMaster2')

@section('title', 'Admin Menu Page')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
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
@endsection

@section('page-script')
    @if (session('fail'))
        <script>
            $(document).ready(function() {
                toastr['error']('{{ session('fail') }}', 'Error');
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            $(document).ready(function() {
                toastr['info']('{{ session('info') }}', 'Success');
            });
        </script>
    @endif
    <script>
        var active_year = "{{ Session('active_year') }}";
        var yearlyTrans = "{{ $yearly_trans }}";
        var select_date = "{{ Session('select_date') }}";
    </script>
    <script src="{{ asset('js/scripts/admin_dashboard.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/charts-apex.js') }}"></script> --}}
@endsection

@section('content')
    <h4 class="fw-semi-bold py-3 mb-4">
        <span class="text-muted fw-bold">Admin Page | </span>
    </h4>

    <div class="row">
        <div class="col-md-6 col-lg-4 col-12 mb-3">
            <a class="text-left btn btn-outline-primary w-100 h-100"
                href="{{ route('admin_users_management', Session('data_clinic')->clinic_id) }}" id="btn_new_trans">
                <div class="d-flex justify-content-start w-100">
                    <div class="flex-1 me-2">
                        <div class="avatar me-2 avatar-lg">
                            <span class="avatar-initial rounded-circle bg-label-primary"><i
                                    class="ti-lg ti ti-users"></i></span>
                        </div>
                    </div>
                    <div class="flex-2 py-1">
                        <h5 class="my-3">SYSTEM USERS</h5>
                    </div>
                </div>
            </a>
        </div>


        <!-- <div class="col-md-6 col-lg-4 col-12 mb-3">
                                                                                                                                                        <a class="text-left btn btn-outline-primary w-100 h-100" href="{{ route('admin_certificate_list', Session('data_clinic')->clinic_id) }}" id="btn_new_trans">
                                                                                                                                                          <div class="d-flex justify-content-start w-100">
                                                                                                                                                            <div class="flex-1 me-2">
                                                                                                                                                              <div class="avatar me-2 avatar-lg">
                                                                                                                                                                <div class="avatar-content">
                                                                                                                                                                  <i data-feather="award" class="font-large-1"></i>
                                                                                                                                                                </div>
                                                                                                                                                              </div>
                                                                                                                                                            </div>
                                                                                                                                                            <div class="flex-2 py-1">
                                                                                                                                                              <span class="font-weight-bolder h5">CERTIFICATES</span>
                                                                                                                                                            </div>
                                                                                                                                                          </div>
                                                                                                                                                        </a>
                                                                                                                                                      </div> -->


        <div class="col-md-6 col-lg-4 col-12 mb-3">
            <a class="text-left btn btn-outline-primary w-100 h-100"
                href="{{ route('admin_summary_reports', Session('data_clinic')->clinic_id) }}" id="btn_new_trans">
                <div class="d-flex justify-content-start w-100">
                    <div class="flex-1 me-2">
                        <div class="avatar me-2 avatar-lg">
                            <span class="avatar-initial rounded-circle bg-label-primary"><i
                                    class="ti-lg ti ti-activity"></i></span>
                        </div>
                    </div>
                    <div class="flex-2 py-1">
                        <h5 class="my-3">TRANSACTION REPORTS</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4 col-12 mb-3">
            <a class="text-left btn btn-outline-primary w-100 h-100"
                href="{{ route('admin_generate_logs', Session('data_clinic')->clinic_id) }}" id="btn_new_trans">
                <div class="d-flex justify-content-start w-100">
                    <div class="flex-1 me-2">
                        <div class="avatar me-2 avatar-lg">
                            <span class="avatar-initial rounded-circle bg-label-primary"><i
                                    class="ti-lg ti ti-file-text"></i></span>
                        </div>
                    </div>
                    <div class="flex-2 py-1">
                        <h5 class="my-3">USER LOGS</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Bar Chart -->
        <div class="col-lg-8 col-sm-12 mb-4">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                    <div class="header-left">
                        <h5 class="h3">{{ $yearly_total }} Uploads</h5>
                        <p class="card-subtitle text-muted mt-25">Yearly Total</p>
                    </div>
                    <div class="select w-50">
                        <!-- <label for="select_year" class="form-label">Select Active Year</label> -->
                        <select name="select_year" class="hide-search form-control select2" id="select_year">
                            <option selected disabled value="">Select Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="card-body">
                    <div id="barChart"></div>
                </div>
            </div>
        </div>
        <!-- /Bar Chart -->
        <div class="col-lg-4">
            <div class="col-12 mb-4">
                <div class="card">

                    <div
                        class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                        <h4 class="card-title mb-25">Upload Summary</h4>


                        <div class="d-flex align-items-center mt-md-0 mt-1 w-100">
                            <i class="font-medium-2" data-feather="calendar"></i>
                            <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" name="select_date" id="select_date" />
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="row mb-1">
                            <div class="col-12 text-left">Total Uploads :</div>
                            <div class="col-6">{{ $uploaded_transaction_total }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-12 text-left">Total Pending Transactions :</div>
                            <div class="col-6">{{ $pending_transaction_total }}</div>
                        </div>

                    </div>


                </div>

            </div>

            <div class=" col-12">
                <div class="card">

                    <div
                        class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                        <h4 class="card-title mb-25">Account Status</h4>
                    </div>

                    <div class="card-body">

                        <div class="row mb-1">
                            <div class="col-12 text-left">Max Credit :</div>
                            <div class="col-6">₱ {{ $balance[0]->max_credit }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-12 text-left">Current Balance :</div>
                            <div class="col-6">₱ {{ $balance[0]->balance }}</div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
