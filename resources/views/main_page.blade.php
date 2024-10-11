@extends('layouts/contentLayoutMaster')

@section('title', 'Main Menu Page')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
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
<section id="main_page">

  <div class="row">

    <div class="col-12 col-md-12 col-lg-12">
      <div class="row">
        <div class="col-6 col-md-6 col-lg-6 mb-2">
          <a class="btn btn-outline-primary text-left px-auto py-1 w-100 load" href="{{route('new_trans',Session('data_clinic')->clinic_id)}}" id="btn_new_trans">
            <div class="row">
              <div class="col-3 mx-0">
                <div class="avatar bg-light-primary p-1 mr-50">
                  <div class="avatar-content">
                    <i data-feather="plus" class="font-large-1"></i>
                  </div>
                </div>
              </div>
              <div class="col-8 py-1">
                <span class="font-weight-bolder h5">NEW TRANSACTION</span>
              </div>
            </div>
          </a>
        </div>
      
        <div class="col-6 col-md-6 col-lg-6 mb-2">
          <a class="btn btn-outline-primary text-left px-auto py-1 w-100 load" href="{{route('saved_trans',Session('data_clinic')->clinic_id)}}" id="btn_saved_trans">
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
        </div> 
      </div>
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
          @foreach ( $data as $item )
            <tr>

                <td class="text-nowrap">{{$item->trans_no}}</td>
                <td class="text-nowrap">{{$item->first_name.' '.$item->middle_name.' '.$item->last_name}}</td>
                <td class="text-nowrap">
                  @if ($item->is_lto_sent == "0")
                  <div class="badge badge-light-warning">Pending</div>
                  @else
                  <div class="badge badge-light-success">Uploaded</div>
                  @endif
                </td>

            </tr>  
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  </div>

  <input type="hidden" id="clinic_balance" name="clinic_balance" value="{{$balance[0]->balance}}">

  <div class="modal fade" id="balance_" data-backdrop="static">
    <div class="modal-dialog modal-md">
      <div class="modal-content bg-danger">
        <div class="row p-3">
          <img
                src="{{asset('images/warning.png')}}"
                style=""
                class="mx-auto mb-2"
                alt="default.png"
                height="auto"
                width="30%"
                style="display:block"
                />
         <div class="col-12">
           <h1 class="text-center text-light mb-3">INSUFFICIENT BALANCE!!!</h1>
          </div>
          <div class="col-12">
           <h3 class="text-danger text-center text-light">Current Balance: ₱ {{$balance[0]->balance}}</h3>
          </div>
          <div class="col-12">
           <p class="text-danger text-center text-light">NOTE: when this message close system will automatically signout</p>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
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
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/main_page2.js') }}"></script>
@endsection
