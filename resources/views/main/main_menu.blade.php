@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Main')


@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Flat Picker -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/tables-datatables-advanced.js') }}"></script> --}}
    <script src="{{ asset('js/main_menu.js') }}"></script>
@endsection

<style>
    .datatables-ajax thead th {
        background-color: #5079a742;
        color: #ffffff;
        font-weight: bold;
        /* text-align: center;
        padding: 10px; */
    }
</style>




@section('content')
    <div class="col-12 mb-4">
        <h3 class="text-light fw-semibold">Main Menu</h3>

        <div class="row" style="height: 100px;">
            <div class="col-6" style="height: 100px;">
                <button class="w-100 btn btn-outline-primary" style="height: 100px;">New Transaction</button>
            </div>
            <div class="col-6" style="height: 100px;">
                <button class="w-100 btn btn-outline-primary" style="height: 100px;">Saved Transaction</button>
            </div>
        </div>
    </div>

    <!-- Ajax Sourced Server-side -->
    <div class="card">
        <div class="card-datatable text-nowrap">
            <table class="datatables-ajax table">
                <thead>
                    <tr>
                        <th>Trans No</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Ajax Sourced Server-side -->
@endsection