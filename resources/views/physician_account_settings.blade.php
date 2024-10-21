@extends('layouts/LayoutMaster')

@section('title', 'Account Settings')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
@endsection

@section('content')
    <section id="registration">
        <div class="row">
            <div class="col-md-6 col-12 mx-auto">
                <div class="card p-2">
                    <div class="card-header w-100">
                        <h4 class="card-title">User Details</h4>

                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="account_form" class="mt-1">

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" class="form-control" name="first_name"
                                        placeholder="First Name" oninput="this.value = this.value.toUpperCase()"
                                        value="{{ $data[0]->first_name }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" id="middle_name" class="form-control" name="middle_name"
                                        placeholder="Middle Name" oninput="this.value = this.value.toUpperCase()"
                                        value="{{ $data[0]->middle_name }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" class="form-control" name="last_name"
                                        placeholder="Last Name" oninput="this.value = this.value.toUpperCase()"
                                        value="{{ $data[0]->last_name }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="prc">PRC</label>
                                    <input type="text" id="prc" class="form-control" name="prc" placeholder=""
                                        value="{{ $data[0]->prc_no }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="ptr">PTR</label>
                                    <input type="text" id="ptr" class="form-control" name="ptr" placeholder=""
                                        value="{{ $data[0]->ptr_no }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="email">Email Address</label>
                                    <input type="text" id="email" class="form-control" name="email" placeholder=""
                                        value="{{ $data[0]->email_address }}" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row p-0">
                                    <button type="button" class="btn btn-success col-md-6 col-12 m-1" tabindex="3"
                                        id="save_details_account">Save</button>
                                    <a href="{{ route('main_page', Session('data_clinic')->clinic_id) }}"
                                        class="btn btn-outline-danger col-md col-12 load m-1">
                                        Cancel
                                    </a>
                                    <button type="button" class="btn btn-primary col-12 mt-1" id="change_pass_modal"
                                        data-toggle="modal" data-target="#changepass">Change password</button>
                                </div>
                            </div>

                        </form>



                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade text-left" id="changepass" tabindex="-2" data-backdrop="static" role="dialog"
        aria-labelledby="changepass" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="password_form" class="mt-1">

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="old_password">Old Password</label>
                                <input type="text" id="old_password" class="form-control" name="old_password" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="new_password">New Password</label>
                                <input type="text" id="new_password" class="form-control" name="new_password" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="text" id="confirm_password" class="form-control"
                                    name="confirm_password" />
                            </div>
                        </div>
                    </form>
                    <div class="row p-2">
                        <button type="button" class="btn btn-success" tabindex="3" id="confirm_pass"
                            name="confirm_pass">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset('js/scripts/encoder_setting.js') }}"></script>
@endsection
