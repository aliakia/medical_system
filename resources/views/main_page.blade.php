@extends('layouts/LayoutMaster')

@section('title', 'Main Menu Page')

@section('vendor-style')
    <!-- vendor css files -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />


    @endsection
    @section('page-style')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    @endsection

    @section('content')
        <section id="main_page">

            <div class="row">

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

                    <div class="row" style="height: 100px;">
                        <div class="col-6" style="height: 100px;">
                            <a href="{{ route('new_trans', Session('data_clinic')->clinic_id) }}" id="btn_new_trans"
                                class="w-100 btn btn-outline-primary justify-center align-items-center"
                                style="height: 100px;">
                                {{-- <i class="ti ti-plus"></i> --}}
                                <span class="fw-bolder">
                                    New Transaction
                                </span>
                            </a>

                        </div>
                        <div class="col-6" style="height: 100px;">
                            <a href="{{ route('saved_trans', Session('data_clinic')->clinic_id) }}" id="btn_saved_trans"
                                class="w-100 btn btn-outline-primary" style="height: 100px;">
                                <span class="fw-bolder">
                                    Saved Transaction
                                </span>
                            </a>
                        </div>
                    </div>

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

                <div class="col-12 col-md-12 col-lg-12">

                    <div class="row">
                        <div class="col-12">
                            <div class="card p-2">
                                <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">TRANS NO.</th>
                                            <th scope="col" class="text-nowrap">NAME</th>
                                            <th scope="col" class="text-nowrap">STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                        {{-- @foreach ($data as $item)
                                        <tr>

                                            <td class="text-nowrap">{{ $item->trans_no }}</td>
                                            <td class="text-nowrap">
                                                {{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}
                                            </td>
                                            <td class="text-nowrap">
                                                @if ($item->is_lto_sent == '0')
                                                    <div class="badge badge-light-warning">Pending</div>
                                                @else
                                                    <div class="badge badge-light-success">Uploaded</div>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <input type="hidden" id="clinic_balance" name="clinic_balance" value="{{ $balance[0]->balance }}">

                <div class="modal fade" id="balance_" data-backdrop="static">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content bg-danger">
                            <div class="row p-3">
                                <img src="{{ asset('images/warning.png') }}" style="" class="mx-auto mb-2"
                                    alt="default.png" height="auto" width="30%" style="display:block" />
                                <div class="col-12">
                                    <h1 class="text-center text-light mb-3">INSUFFICIENT BALANCE!!!</h1>
                                </div>
                                <div class="col-12">
                                    <h3 class="text-danger text-center text-light">Current Balance: ₱
                                        {{ $balance[0]->balance }}</h3>
                                </div>
                                <div class="col-12">
                                    <p class="text-danger text-center text-light">NOTE: when this message close system will
                                        automatically signout</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </section>
    @endsection

    @section('vendor-script')
        <!-- vendor files -->
        {{-- <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script> --}}
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
    @endsection
    @section('page-script')
        <!-- Page js files -->
        <script src="{{ asset('js/scripts/main_page.js') }}"></script>
    @endsection
