@extends('layouts/contentLayoutMaster2')

@section('title', 'Admin Functions')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
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
<section id="basic-datatable">
  <div class="row">
    
    <!-- <div class="col-12 mb-1">
      <a class="btn btn-primary" data-toggle="modal" data-target="#add_user_modal" id="add_new">
        <i data-feather="user-plus" class="mr-1"></i>Add User
      </a>
    </div> -->
    
    <div class="col-12">
      <div class="card p-2">
        <table class="table table-bordered table-hover" id="myTable">
          <thead>
            <tr>
              <th scope="col" class="text-nowrap">USER ID</th>
              <th scope="col" class="text-nowrap">NAME</th>
              <th scope="col" class="text-nowrap">USER TYPE</th>
              <th scope="col" class="text-nowrap">ACCOUNT STATUS</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
              <td class="text-nowrap">{{$item->user_id}}</td>
              <td class="text-nowrap">{{$item->full_name}}</td>
              <td class="text-nowrap">

               @if ($item->user_type == "Encoder")
                <div class="d-flex align-items-center">
                  <div class="avatar bg-light-primary mr-1">
                    <div class="avatar-content">
                      <i data-feather="edit-2" class="font-medium-3"></i>
                    </div>
                  </div>
                  <span>Physician</span>
                </div>
              @elseif ($item->user_type == "Administrator")
                <div class="d-flex align-items-center">
                  <div class="avatar bg-light-danger mr-1">
                    <div class="avatar-content">
                      <i data-feather="server" class="font-medium-3"></i>
                    </div>
                  </div>
                  <span>Administrator</span>
                </div>
              @endif
              </td>
              <td class="text-nowrap">

              @if ($item->is_active == "1")
                <div class="badge badge-light-success">Active</div>
              @else
                <div class="badge badge-light-danger">Inactive</div>
              @endif

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-12 mb-2">
      <a href="{{route('admin_page',Session('data_clinic')->clinic_id)}}" class="btn btn-outline-primary float-right">
        <i data-feather="corner-down-left" class="mr-1"></i>Go Back
      </a>
    </div>
  </div>

  
  {{-- add user modal --}}
  <div class="modal modal-slide-in new-user-modal fade text-left" id="add_user_modal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content pt-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-light" id="myModalLabel2">Add New User</h4>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="reg_form" class="mt-1">
              <div class="col-12">
                <div class="w-100 mb-1 px-auto">
                  <img
                    src="{{asset('images/default.png')}}"
                    id="picture_1"
                    class="bg-secondary mx-auto col-12"
                    alt="default.png"
                    height="75%"
                    width="75%"
                  />
                </div>
                <label id="select" class="btn btn-secondary mb-1 w-100" data-toggle="modal" data-target="#camera">Open Camera</label>
                <input id="base_64" type="hidden" name="base_64" value=""/>

                <div id="no_need_bio">
                  <button type="button" class="btn btn-secondary mb-1 w-100" id="open_bio">Register fingerprint</button>
                  <input id="fp_idl5" type="hidden" name="fp_idl5" value="-"/>
                  <input id="fp_idl4" type="hidden" name="fp_idl4" value="-"/>
                  <input id="fp_idl3" type="hidden" name="fp_idl3" value="-"/>
                  <input id="fp_idl2" type="hidden" name="fp_idl2" value="-"/>
                  <input id="fp_idl1" type="hidden" name="fp_idl1" value="-"/>
                  <input id="fp_idr1" type="hidden" name="fp_idr1" value="-"/>
                  <input id="fp_idr2" type="hidden" name="fp_idr2" value="-"/>
                  <input id="fp_idr3" type="hidden" name="fp_idr3" value="-"/>
                  <input id="fp_idr4" type="hidden" name="fp_idr4" value="-"/>
                  <input id="fp_idr5" type="hidden" name="fp_idr5" value="-"/>
                </div>
                
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
                  />
                </div>
              </div>
              
              <div class="col-12">
                <div class="form-group">
                  <label for="gender">Gender</label>
                  <select name="gender" id="gender" class="select2 form-contol hide-search">
                    <option selected disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="user_type">User Type</label>
                  <select name="user_type" id="user_type" class="select2 form-contol hide-search">
                    <option selected disabled>Select User Type</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Encoder">Encoder</option>
                  </select>
                </div>
              </div>
  
              <div class="hidden physician_form" id="physician_form">

                <div class="col-12">
                    <div class="form-group">
                      <label class="form-label" for="bday">Birthday</label>
                      <input
                        type="date"
                        class="form-control flatpickr-basic"
                        id="bday"
                        placeholder="YYYY-MM-DD"
                        name="bday"
                        aria-describedby="bday"
                        value=""
                      />
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="form-group">
                      <label for="civil_status">Civil Status</label>
                      <select name="civil_status" id="civil_status" class="select2 form-contol hide-search">
                        <option selected disabled>Select User Type</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widow">Widow</option>
                      </select>
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="prc_no">PRC No.</label>
                      <input
                        type="text"
                        id="prc_no"
                        class="form-control"
                        name="prc_no"
                        placeholder="PRC No."
                      />
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="ptr_no">PTR No.</label>
                      <input
                        type="text"
                        id="ptr_no"
                        class="form-control"
                        name="ptr_no"
                        placeholder="PTR No."
                      />
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="contact_no">Contact No.</label>
                      <input
                        type="text"
                        id="contact_no"
                        class="form-control"
                        name="contact_no"
                        placeholder="Contact No."
                      />
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="contact_no">Email Address</label>
                      <input
                        type="text"
                        id="email_address"
                        class="form-control"
                        name="email_address"
                        placeholder="@"
                      />
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label class="form-label" for="prc_expiration">PRC Expiration</label>
                      <input
                        type="date"
                        class="form-control flatpickr-basic"
                        id="prc_expiration"
                        placeholder="YYYY-MM-DD"
                        name="prc_expiration"
                        aria-describedby="prc_expiration"
                        value=""
                      />
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="physician_id">Phyisician ID</label>
                      <input
                        type="text"
                        id="physician_id"
                        class="form-control"
                        name="physician_id"
                        placeholder="Phyisician ID"
                      />
                    </div>
                  </div>

              </div>

              <div class="col-12">
                <div class="form-group">
                  <label class="form-label" for="user_expiration">User Expiration</label>
                  <input
                    type="date"
                    class="form-control flatpickr-basic"
                    id="user_expiration"
                    placeholder="YYYY-MM-DD"
                    name="user_expiration"
                    aria-describedby="user_expiration"
                    value=""
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
                  />
                </div>
              </div>
              

              <div class="col-12">
                <div class="form-group">
                  <div class="d-flex justify-content-between">
                    <label for="password">Password</label>
                    {{-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                      <small>Forgot Password?</small>
                    </a>
                    @endif --}}
                  </div>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" id="password" name="password" tabindex="2" placeholder="Enter your Password" aria-describedby="password" />
                    <div class="input-group-append">
                      <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <div class="d-flex justify-content-between">
                    <label for="confirm_password">Confirm Password</label>
                    {{-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                      <small>Forgot Password?</small>
                    </a>
                    @endif --}}
                  </div>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" id="confirm_password" name="confirm_password" tabindex="2" placeholder="Confirm your Password" aria-describedby="conifirm_password" />
                    <div class="input-group-append">
                      <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
              <button type="button" class="btn btn-success btn-block" tabindex="3" id="confirm">Confirm</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  {{-- edit user modal --}}
  <div class="modal modal-slide-in new-user-modal fade text-left" id="edit_user_modal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content pt-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-light" id="myModalLabel2">Edit User</h4>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="edit_form" class="mt-1">
              <div class="col-12">
                <div class="w-100 mb-1 px-auto">
                  <img
                    src="{{asset('images/default.png')}}"
                    id="picture_1_edit"
                    class="bg-secondary mx-auto col-12"
                    alt="default.png"
                    height="75%"
                    width="75%"
                  />
                </div>
                <label id="select2" class="btn btn-secondary mb-1 w-100" data-toggle="modal" data-target="#camera2">Open Camera</label>
                <input id="base_64_edit" type="hidden" name="base_64_edit" value=""/>

                <div id="no_need_bio">
                  <button type="button" class="btn btn-secondary mb-1 w-100" id="open_bio">Register fingerprint</button>
                  <input id="fp_idl5" type="hidden" name="fp_idl5" value="-"/>
                  <input id="fp_idl4" type="hidden" name="fp_idl4" value="-"/>
                  <input id="fp_idl3" type="hidden" name="fp_idl3" value="-"/>
                  <input id="fp_idl2" type="hidden" name="fp_idl2" value="-"/>
                  <input id="fp_idl1" type="hidden" name="fp_idl1" value="-"/>
                  <input id="fp_idr1" type="hidden" name="fp_idr1" value="-"/>
                  <input id="fp_idr2" type="hidden" name="fp_idr2" value="-"/>
                  <input id="fp_idr3" type="hidden" name="fp_idr3" value="-"/>
                  <input id="fp_idr4" type="hidden" name="fp_idr4" value="-"/>
                  <input id="fp_idr5" type="hidden" name="fp_idr5" value="-"/>
                </div>
                
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="first_name_edit">First Name</label>
                  <input
                    type="text"
                    id="first_name_edit"
                    class="form-control"
                    name="first_name_edit"
                    placeholder="First Name"
                    oninput="this.value = this.value.toUpperCase()"
                  />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="middle_name_edit">Middle Name</label>
                  <input
                    type="text"
                    id="middle_name_edit"
                    class="form-control"
                    name="middle_name_edit"
                    placeholder="Middle Name"
                    oninput="this.value = this.value.toUpperCase()"
                  />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input
                    type="text"
                    id="last_name_edit"
                    class="form-control"
                    name="last_name_edit"
                    placeholder="Last Name"
                    oninput="this.value = this.value.toUpperCase()"
                  />
                </div>
              </div>
              
              <div class="col-12">
                <div class="form-group">
                  <label for="gender_edit">Gender</label>
                  <select name="gender_edit" id="gender_edit" class="select2 form-contol hide-search">
                    <option selected disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="user_type_edit">User Type</label>
                  <select name="user_type_edit" id="user_type_edit" class="select2 form-contol hide-search">
                    <option selected disabled>Select User Type</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Encoder">Encoder</option>
                  </select>
                </div>
              </div>
  
              <div class="hidden physician_edit_form" id="physician_edit_form">

                <div class="col-12">
                    <div class="form-group">
                      <label class="form-label" for="bday_edit">Birthday</label>
                      <input
                        type="date"
                        class="form-control flatpickr-basic"
                        id="bday_edit"
                        placeholder="YYYY-MM-DD"
                        name="bday_edit"
                        aria-describedby="bday"
                        value=""
                      />
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="form-group">
                      <label for="civil_status_edit">Civil Status</label>
                      <select name="civil_status_edit" id="civil_status_edit" class="select2 form-contol hide-search">
                        <option selected disabled>Select User Type</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widow">Widow</option>
                      </select>
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="prc_no_edit">PRC No.</label>
                      <input
                        type="text"
                        id="prc_no_edit"
                        class="form-control"
                        name="prc_no_edit"
                        placeholder="PRC No."
                      />
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="ptr_no_edit">PTR No.</label>
                      <input
                        type="text"
                        id="ptr_no_edit"
                        class="form-control"
                        name="ptr_no_edit"
                        placeholder="PTR No."
                      />
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="contact_no_edit">Contact No.</label>
                      <input
                        type="text"
                        id="contact_no_edit"
                        class="form-control"
                        name="contact_no_edit"
                        placeholder="Contact No."
                      />
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label for="contact_no_edit">Email Address</label>
                      <input
                        type="text"
                        id="email_address_edit"
                        class="form-control"
                        name="email_address_edit"
                        placeholder="@"
                      />
                    </div>
                  </div>
    
                  <div class="col-12">
                    <div class="form-group">
                      <label class="form-label" for="prc_expiration_edit">PRC Expiration</label>
                      <input
                        type="date"
                        class="form-control flatpickr-basic"
                        id="prc_expiration_edit"
                        placeholder="YYYY-MM-DD"
                        name="prc_expiration_edit"
                        aria-describedby="prc_expiration"
                        value=""
                      />
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="physician_id_edit">Phyisician ID</label>
                      <input
                        type="text"
                        id="physician_id_edit"
                        class="form-control"
                        name="physician_id_edit"
                        placeholder="Phyisician ID"
                      />
                    </div>
                  </div>
                  
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label class="form-label" for="user_expiration_edit">User Expiration</label>
                  <input
                    type="date"
                    class="form-control flatpickr-basic"
                    id="user_expiration_edit"
                    placeholder="YYYY-MM-DD"
                    name="user_expiration_edit"
                    aria-describedby="user_expiration"
                    value=""
                  />
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <input
                    type="hidden"
                    id="user_id_edit"
                    class="form-control"
                    name="user_id_edit"
                    placeholder="User ID"
                  />
                </div>
              </div>
              
              <div class="col-12">
              <button type="button" class="btn btn-success btn-block" tabindex="3" id="save">Confirm</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  {{-- camera modal --}}
  <div class="modal fade text-left" id="camera" tabindex="-2" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel4">Capture Image</h4>
          <button type="button" class="close" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
            <div class="embed-responsive embed-responsive-4by3">
              {{-- <iframe width="100%" frameborder="0" src="https://www.youtube-nocookie.com/embed/FdV_akxUnEM?controls=0&disablekb=1&modestbranding=1&rel=0&amp;showinfo=0&autoplay=1&loop=1" encrypted-media allowfullscreen></iframe> --}}
              <video width="100%" height="100%" autoplay="true" id="video"></video>
            </div>
            <button id="capture" type="button" class="btn btn-primary w-100 my-1"><i data-feather="camera" class="font-medium-4"></i></button>
            <canvas id="canvas" style="width:100%; height:auto;" class="hidden"></canvas>
            <button id="saveImg" type="button" class="btn btn-primary w-100 mt-1 hidden" data-dismiss="modal" aria-label="Close">Save</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  {{-- camera2 modal --}}
  <div class="modal fade text-left" id="camera2" tabindex="-2" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel5">Capture Image</h4>
          <button type="button" class="close" data-dismiss="modal" id="close_cam2" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
            <div class="embed-responsive embed-responsive-4by3">
              {{-- <iframe width="100%" frameborder="0" src="https://www.youtube-nocookie.com/embed/FdV_akxUnEM?controls=0&disablekb=1&modestbranding=1&rel=0&amp;showinfo=0&autoplay=1&loop=1" encrypted-media allowfullscreen></iframe> --}}
              <video width="100%" height="100%" autoplay="true" id="video2"></video>
            </div>
            <button id="capture2" type="button" class="btn btn-primary w-100 my-1"><i data-feather="camera" class="font-medium-4"></i></button>
            <canvas id="canvas2" style="width:100%; height:auto;" class="hidden"></canvas>
            <button id="saveImg2" type="button" class="btn btn-primary w-100 mt-1 hidden" data-dismiss="modal" aria-label="Close">Save</button>
            </div>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection

@section('vendor-script')
  
  <!-- vendor files -->
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
