@extends('layouts/contentLayoutMaster')

@section('title', 'Certificate Management')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">

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
            <label class="form-label" for="date_from">Date Started</label>
            <input
              type="text"
              class="form-control flatpickr-basic"
              id="date_from"
              placeholder="MM-DD-YYYY"
              name="date_from"
              aria-describedby="date_from"
              value="{{$date_from}}"
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
              value="{{$date_to}}"
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
              <th scope="col" class="text-nowrap">TRANS NO.</th>
              <th scope="col" class="text-nowrap">NAME</th>
              <th scope="col" class="text-nowrap">TYPE</th>
              <th scope="col" class="text-nowrap">FILE</th>
              <th scope="col" class="text-nowrap">GRADUATED</th>
              <th scope="col" class="text-nowrap">ACTION</th>
            </tr>
          </thead>
          <tbody id="table_body">
            @if ($data == "")
                {{-- <tr>
                  <td scope="col" class="text-nowrap">No Records Found</td>
                </tr> --}}
            @else
              @foreach ($data as $item)
              <tr>
                <td class="text-nowrap">{{$item->trans_no}}</td>
                <td class="text-nowrap">{{$item->first_name.' '.$item->middle_name.' '.$item->last_name}}</td>
                <td class="text-nowrap">{{$item->program_description}}</td>
                <td class="text-nowrap">
                @if ($item->is_printed == "1")
                  <div class="badge badge-light-success">Printed</div>
                @else
                  <div class="badge badge-light-danger">Not Printed</div>
                @endif
                </td>
                <td class="text-nowrap">{{$item->date_completed}}</td>
                <td class="text-nowrap">
                  <button type="button" class="btn btn-sm btn-primary mr-25 view" value="{{$item->trans_no."=".$item->student_id}}">
                    <i data-feather="file-text" class="mr-25"></i>View
                  </button>
                  @if ($item->is_printed == "1")
                  <button type="button" class="btn btn-sm btn-success mr-25 reprint" value="{{$item->trans_no."=".$item->student_id}}">
                    <i data-feather="printer" class="mr-25"></i>Reprint
                  </button>
                  @else
                  <button type="button" class="btn btn-sm btn-success mr-25 print" value="{{$item->trans_no."=".$item->student_id}}">
                    <i data-feather="printer" class="mr-25"></i>Print
                  </button>
                  @endif
                  
                </td>
              </tr>
              @endforeach 
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-12 mb-2">
      <a href="{{route('dashboard_page',Session('data_ds')->ds_code)}}" class="btn btn-outline-primary float-right load">
        <i data-feather="corner-down-left" class="mr-1"></i>Go Back
      </a>
    </div>
  </div>

  <div class="modal fade text-left" id="view_details" tabindex="-3" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel1">View Details</h4>
          <button type="button" class="close" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="col-12 col-md-3 float-right mb-1">
                    <div class="embed-responsive-1by1">
                      <img
                        src="{{asset('images/default.png')}}"
                        id="picture_2"
                        class="bg-secondary"
                        alt="default.png"
                        height="100%"
                        width="100%"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-md-9">
                    <div class="row">
                      <div class="mb-1 col-12 font-weight-bolder h2 text-white">Student Driver Information</div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">CLIENT ID :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_client_id"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">FIRST NAME :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_fname"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">MIDDLE NAME :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_mname"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">LAST NAME :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_lname"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">LICENSE NO:</div>
                      <div class="my-25 col-6 col-md-8" id="disp_license_no"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">GENDER :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_gender"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">BIRTHDAY :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_birthday"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">AGE :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_age"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">NATIONALITY :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_nationality"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">MARITAL STATUS :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_marital_status"></div>
                      <div class="my-25 col-6 col-md-4 font-weight-bolder">ADDRESS :</div>
                      <div class="my-25 col-6 col-md-8" id="disp_address"></div>
                      
                    </div>
                  </div>
                </div>
                
                <div class="col-12">
                  <hr>
                </div>
      
                <div class="col-12 ml-1 mb-1">
                  <div class="row">
                    <div class="mb-1 col-12 font-weight-bolder h2 text-white">Course Details</div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">BRANCH :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_branch"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">COURSE NAME :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_course_name"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">TRAINING PURPOSE :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_training_purpose"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">DL CLASSIFICATION :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_dl_class"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">DATE STARTED :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_date_started"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">DATE COMPLETED :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_date_completed"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">TOTAL NUMBER OF HOURS :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_total_no_hours"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">ASSESSMENT :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_assessment"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">OVERALL :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_overall"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">EXAM SCORE :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_exam_score"></div>
                    <div class="my-25 col-6 col-md-4 font-weight-bolder">ADDITIONAL COMMENTS :</div>
                    <div class="my-25 col-6 col-md-8" id="disp_additional_comments"></div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
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
  <script src="{{ asset('js/scripts/certificates.js') }}"></script>
@endsection
