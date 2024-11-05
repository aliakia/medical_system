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
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
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
        <div class="col-lg-6 col-xl-4 col-12 mb-3">
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


        <div class="col-lg-6 col-xl-4 col-12 mb-3">
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

        <div class="col-lg-6 col-xl-4 col-12 mb-3">
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
        <div class="col-xl-8 col-12 mb-4">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                    <div class="header-left">
                        <h5 class="h3">{{ $yearly_total }} Uploads</h5>
                        <p class="card-subtitle text-muted mt-25">Yearly Total</p>
                    </div>
                    <div class="header-right select w-20">
                        <label for="select_year" class="form-label">Select Active Year</label>
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
        <div class="col-xl-4 col-md-12">
            <div class="col-12 mb-4">
                <div class="card">

                    <div
                        class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                        <h4 class="card-title mb-25">Upload Summary</h4>


                        <div class="header-right text-end d-flex justify-content-end align-items-center mt-md-0 mt-1">

                            <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" name="select_date" id="select_date" />
                            <div class="badge bg-label-secondary rounded p-2"> <i class="font-medium-2 ti ti-calendar"></i>
                            </div>
                        </div>


                    </div>

                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                                <div class="badge bg-label-success rounded p-2"><i class="ti ti-upload ti-sm"></i></div>
                                <div class="d-flex justify-content-between w-100 flex-wrap">
                                    <h6 class="mb-0 ms-3">Total Uploads</h6>
                                    <div class="d-flex">
                                        <p class="mb-0 fw-semibold">{{ $uploaded_transaction_total }}</p>
                                        {{-- <p class="ms-3 text-success mb-0">0.3%</p> --}}
                                    </div>
                                </div>
                            </li>
                            <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                                <div class="badge bg-label-danger rounded p-2"><i class="ti ti-access-point ti-sm"></i>
                                </div>
                                <div class="d-flex justify-content-between w-100 flex-wrap">
                                    <h6 class="mb-0 ms-3">Total Pending Transactions</h6>
                                    <div class="d-flex">
                                        <p class="mb-0 fw-semibold">{{ $pending_transaction_total }}</p>
                                        {{-- <p class="ms-3 text-success mb-0">2.1%</p> --}}
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>

            </div>

            <div class="col-12">
                <div class="card">

                    <div
                        class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                        <h4 class="card-title mb-25">Account Status</h4>
                    </div>

                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="badge rounded bg-label-warning p-2 me-3"><i class="ti ti-cash ti-sm"></i></div>
                            <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                                        <h6 class="mb-0 ">Current Balance: </h6>
                                        <p class="mb-0 text-success">₱ {{ $balance[0]->balance }}</p>
                                        {{-- <p class="mb-0 text-danger">-139.34</p> --}}
                                    </div>
                                </div>
                                <div class="me-2">
                                    <h6 class="mb-0">₱ {{ $balance[0]->max_credit }}</h6>
                                    <small class="text-warning">Max Credits</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
