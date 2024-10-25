@extends('layouts/LayoutMaster2')

@section('title', 'User Logs')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('vendors/css/previewclientinfo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />

@endsection

@section('content')
    <div class="row">

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="logsModule">Module</label>
                <select name="logsModule" id="logsModule" class="select2 form-control hide-search">
                    <!-- <option value="*" selected disabled>Select Module Use</option> -->
                    <option value="*">All</option>
                    <option value="NEW TRANSACTION">NEW TRANSACTION</option>
                    <option value="CONTINUE TRANSACTION">CONTINUE TRANSACTION</option>
                    <option value="SAVE PENDING TRANSACTION">SAVE PENDING TRANSACTION</option>
                    <option value="VIEW SAVED DATA">VIEW SAVED DATA</option>
                    <option value="USER LOGOUT">USER LOGOUT</option>
                    <option value="USER LOGIN">USER LOGIN</option>
                    <option value="GENERATE CERTIFICATE">Generate Certificate</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label class="form-label" for="date_from">Date Started</label>
                <input type="text" class="form-control flatpickr-basic" id="date_from" placeholder="MM-DD-YYYY"
                    name="date_from" aria-describedby="date_from" value={{ $date_from }} />
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label class="form-label" for="date_to">Date Completed</label>
                <input type="text" class="form-control flatpickr-basic" id="date_to" placeholder="MM-DD-YYYY"
                    name="date_to" aria-describedby="date_to" value={{ $date_to }} />
            </div>
        </div>
        <div class="col-12 col-md-3 d-flex align-items-end">

            <button type="button" class="btn btn-primary" style="height: 38px" value="" id="btn_search">
                <i class="ti ti-filter"></i> Filter
            </button>
        </div>



    </div>
    <div class="card p-2 mt-4">
        <table class="table table-bordered table-hover" id="myTable"
            data-url="{{ route('fetch_admin_generate_logs_by_date', [Session('data_clinic')->clinic_id, $date_from, $date_to, $module]) }}">
            <thead>
                <tr>
                    <th scope="col" class="text-nowrap">Module</th>
                    <th scope="col" class="text-nowrap">Description</th>
                    <th scope="col" class="text-nowrap">Remarks</th>
                    <th scope="col" class="text-nowrap">Processed By</th>
                    <th scope="col" class="text-nowrap">Date & Time</th>
                </tr>
            </thead>
            {{-- <tbody id="table_body">
                  @foreach ($data as $item)
                      <tr>
                          <td class="text-nowrap">{{ $item->module }}</td>
                          <td class="text-nowrap">{{ $item->description }}</td>
                          <td class="text-nowrap">{{ $item->remarks }}</td>
                          <td class="text-nowrap">{{ $item->processed_by }}</td>
                          <td class="text-nowrap">{{ $item->period }}</td>
                      </tr>
                  @endforeach

              </tbody> --}}
        </table>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
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
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection
@section('page-script')
    {{-- <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script> --}}
    <script src="{{ asset('js/scripts/user_logs.js') }}"></script>
    {{-- <script>
        document.querySelector('#logsModule').value = '{{ $module }}';
        $(function() {
            $("#logsModule").val('{{ $module }}');
        });
    </script> --}}
@endsection
