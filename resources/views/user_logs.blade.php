@extends('layouts/contentLayoutMaster2')

@section('title', 'User Logs')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/previewclientinfo.css') }}">

@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection

@section('content')
<section id="basic-datatable">
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
            <input
              type="text"
              class="form-control flatpickr-basic"
              id="date_from"
              placeholder="MM-DD-YYYY"
              name="date_from"
              aria-describedby="date_from"
              value={{$date_from}}
            />
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label class="form-label" for="date_to">Date Completed</label>
            <input
              type="text"
              class="form-control flatpickr-basic"
              id="date_to"
              placeholder="MM-DD-YYYY"
              name="date_to"
              aria-describedby="date_to"
              value={{$date_to}}
            />
          </div> 
        </div>
        <div class="col-12 col-md-3 p-2">
          <button type="button" class="btn btn-primary mr-25" value="" id="btn_search">
            <i data-feather="filter" class="mr-25"></i>Filter
          </button>
        </div>
        
      </div>
  <div class="row">
    <div class="col-12">
      <div class="card p-2">
        <table class="table table-bordered table-hover" id="myTable">
          <thead>
            <tr>
              <th scope="col" class="text-nowrap">Module</th>
              <th scope="col" class="text-nowrap">Description</th>
              <th scope="col" class="text-nowrap">Remarks</th>
              <th scope="col" class="text-nowrap">Processed By</th>
              <th scope="col" class="text-nowrap">Date & Time</th>
            </tr>
          </thead>
          <tbody id="table_body">
              @foreach ($data as $item)
              <tr>
                <td class="text-nowrap">{{$item->module}}</td>
                <td class="text-nowrap">{{$item->description}}</td>
                <td class="text-nowrap">{{$item->remarks}}</td>
                <td class="text-nowrap">{{$item->processed_by}}</td>
                <td class="text-nowrap">{{$item->period}}</td>
              </tr>
              @endforeach 
          
          </tbody>
        </table>
      </div>
    </div>
    <!-- <div class="col-6 mb-2">
      <button type="button" class="btn btn-success float-left load" value="" id="btn_export">
        <i data-feather="external-link" class="mr-25"></i>Export
      </button>
    </div> -->
    <div class="col-6 mb-2">
        <a href="{{route('admin_page',Session('data_clinic')->clinic_id)}}" class="btn btn-outline-primary float-right load">
          <i data-feather="corner-down-left" class="mr-1"></i>Go Back
        </a>
      </div>
  </div>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
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
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
{{-- <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script> --}}
  <script src="{{ asset('js/scripts/user_logs.js') }}"></script>
  <script>
    document.querySelector('#logsModule').value = '{{$module}}';
    $(function() {
    $("#logsModule").val('{{$module}}');
    });
  </script>
@endsection
