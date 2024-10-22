@extends('layouts/LayoutMaster')

@section('title', 'Admin Functions')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/pickers/pickadate/pickadate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

@endsection
{{-- @section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection --}}

@section('content')
<div class="card">
    <div class="card-datatable text-nowrap">
        <table class="datatables-ajax table" id="myTable">
            <thead>
                <tr>
                    <th>USER ID</th>
                    <th>NAME</th>
                    <th>USER  TYPE</th>
                    <th>STATUS</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="col-12  mt-4">
    <a href="{{ route('admin_page', Session('data_clinic')->clinic_id) }}" class="btn btn-outline-primary load">
        <i class="ti ti-corner-down-left" mr-1"></i>Go Back
    </a>
</div>
@endsection

@section('vendor-script')

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
{{-- <script src="{{ asset('vendors/js/digital/es6-shim.js') }}"></script>
  <script src="{{ asset('vendors/js/digital/websdk.client.bundle.min.js') }}" crossorigin="*"></script>
  <script src="{{ asset('vendors/js/digital/fingerprint.sdk.min.js') }}" crossorigin="*"></script> --}}

@endsection
@section('page-script')
<!-- Page js files -->
{{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script> --}}
<script src="{{ asset('js/scripts/admin_users_management.js') }}"></script>
{{-- <script src="{{ asset('js/scripts/app.js') }}"></script> --}}
@endsection
