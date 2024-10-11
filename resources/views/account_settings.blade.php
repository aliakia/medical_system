@extends('layouts/contentLayoutMaster2')

@section('title', 'Account Settings')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection

@section('content')
<section id="registration">
  <div class="row">
    <div class="col-md-6 col-12 mx-auto">
      <div class="card p-2">
        <div class="card-header w-100">
          <h4 class="card-title">User Details</h4>
          <div class="float-right">
            @if ($is_active == "1")
            <div>
              Status:  <span class="badge badge-light-success"> <i data-feather="check" class="mr-50"></i> Active</span>
            </div>
            @else
            <div>
              Status:  <span class="badge badge-light-success"> <i data-feather="x" class="mr-50"></i>Inactive</span>
            </div>
            @endif
          </div>
        </div>
        <div class="card-body">
          <form action="" method="POST" id="account_form" class="mt-1">
            <div class="col-12 col-md-3 my-1">
              <div class="embed-responsive-1by1">
                <img
                  src="{{$photo}}"
                  id="picture_3"
                  class="bg-secondary"
                  alt="default.png"
                  height="100%"
                  width="100%"
                />
              </div>
              {{-- <label id="select2" class="btn btn-primary my-25 w-100" data-toggle="modal" data-target="#camera2">Open Camera</label> --}}
              <input id="base_64" type="hidden" name="base_64" value=""/>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input
                  type="text"
                  id="first_name"
                  class="form-control"
                  name="first_name"
                  placeholder="First Name"
                  oninput="this.value = this.value.toUpperCase()"
                  value="{{$first_name}}"
                />
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input
                  type="text"
                  id="middle_name"
                  class="form-control"
                  name="middle_name"
                  placeholder="Middle Name"
                  oninput="this.value = this.value.toUpperCase()"
                  value="{{$middle_name}}"
                />
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input
                  type="text"
                  id="last_name"
                  class="form-control"
                  name="last_name"
                  placeholder="Last Name"
                  oninput="this.value = this.value.toUpperCase()"
                  value="{{$last_name}}"
                />
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="gender">Gender</label>
                <input
                  type="text"
                  id="gender"
                  class="form-control"
                  name="gender"
                  placeholder="Gender"
                  oninput="this.value = this.value.toUpperCase()"
                  value="{{$user_gender}}"
                  readonly
                />
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label for="employee_id">USER TYPE</label>
                <input
                  type="text"
                  id="employee_id"
                  class="form-control"
                  name="employee_id"
                  placeholder="Employee ID"
                  value="{{$user_type}}"
                  readonly
                />
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="user_id">User ID</label>
                <input
                  type="text"
                  id="user_id"
                  class="form-control"
                  name="user_id"
                  placeholder="User ID"
                  value="{{$user_id}}"
                  readonly
                />
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label for="user_id">User Expiration</label>
                <input
                  type="text"
                  id="user_id"
                  class="form-control"
                  name="user_id"
                  placeholder="User ID"
                  value="{{$user_expiration}}"
                  readonly
                />
              </div>
            </div>

            <div class="col-12">
              <div class="row p-0">
                   <button type="button" class="btn btn-success col-md-6 col-12 mx-1" tabindex="3" id="save">Save</button>
                   <a href="{{route('admin_page',Session('data_clinic')->clinic_id)}}" class="btn btn-outline-danger col-md col-12 load mx-1">
                      Cancel
                    </a>
                    <button type="button" class="btn btn-primary col-12 mt-1" data-toggle="modal" data-target="#changepass">Change password</button>
              </div>
            </div>

          </form>

        

        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade text-left" id="changepass" tabindex="-2" data-backdrop="static" role="dialog" aria-labelledby="changepass" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change password</h4>
          <button type="button" class="close text-danger" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="password_form" class="mt-1">

              <div class="col-12">
                <div class="form-group">
                  <label for="old_password">Old Password</label>
                  <input
                    type="text"
                    id="old_password"
                    class="form-control"
                    name="old_password"
                  />
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input
                    type="text"
                    id="new_password"
                    class="form-control"
                    name="new_password"
                  />
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input
                    type="text"
                    id="confirm_password"
                    class="form-control"
                    name="confirm_password"
                  />
                </div>
              </div>
            </form>
            <div class="col-12">
                <div class="row p-0">
                      <button type="button" class="btn btn-success col-md-12 col-12" tabindex="3" id="confirm_pass" name="confirm_pass">Confirm</button>
                </div>
             </div>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/account_settings.js') }}"></script>
@endsection
