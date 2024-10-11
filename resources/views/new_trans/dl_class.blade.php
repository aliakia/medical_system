@extends('layouts/contentLayoutMaster')

@section('title', 'New Transaction')

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
  <input type="hidden" name="user_id" id="user_id" value="{{Session('LoggedUser')->user_id}}">
  <input type="hidden" name="ds_code" id="ds_code" value="{{Session('config')['ds_code']}}">
  <input type="hidden" name="api_url" id="api_url" value="{{Session('config')['api_url']}}">
  <div class="row">
    <div class="col-12 mx-auto">
      <div class="card px-2 pt-2">
        <div class="card-header">
          <h4 class="card-title">Driver's License Classification</h4>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-8"></div>
              <div class="form-group col-md-4">
                <div class="row">
                  <div class="col-3 text-left font-weight-bolder m-0 p-0">NON-PRO</div>
                  <div class="col-3 text-left font-weight-bolder m-0 p-0">PRO</div>
                  <div class="col-3 text-left font-weight-bolder m-0 p-0">AT</div>
                  <div class="col-3 text-left font-weight-bolder m-0 p-0">MT</div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="A" name="A" value="A"/>
                  <label class="custom-control-label font-weight-bolder" for="A" id="A_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_a"></div>
  
            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="A1" name="A1" value="A1"/>
                  <label class="custom-control-label font-weight-bolder" for="A1" id="A1_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_a1"></div>

            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="B" name="B" value="B"/>
                  <label class="custom-control-label font-weight-bolder" for="B" id="B_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_b"></div>

            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="B1" name="B1" value="B1"/>
                  <label class="custom-control-label font-weight-bolder" for="B1" id="B1_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_b1"></div>
  
            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="B2" name="B2" value="B2"/>
                  <label class="custom-control-label font-weight-bolder" for="B2" id="B2_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_b2"></div>

            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="C" name="C" value="C"/>
                  <label class="custom-control-label font-weight-bolder" for="C" id="C_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_c"></div>

            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="D" name="D" value="D"/>
                  <label class="custom-control-label font-weight-bolder" for="D" id="D_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_d"></div>

            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="BE" name="BE" value="BE"/>
                  <label class="custom-control-label font-weight-bolder" for="BE" id="BE_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_be"></div>

            <div class="row">
              <div class="form-group col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="CE" name="CE" value="CE"/>
                  <label class="custom-control-label font-weight-bolder" for="CE" id="CE_label">
                  </label>
                </div>
              </div>
            </div>
            <div id="div_ce"></div>

          </form>
          <div class="col-12 mt-2 px-0">
            <a href="javascript:history.back()" type="button" class="btn btn-outline-primary px-2 ml-md-1 mb-25 col-12 col-md-2" id="previous"><i data-feather="arrow-left" class="ml-25"></i> Previous</a>
            <button type="button" class="btn btn-primary px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="next">Next <i data-feather="arrow-right" class="ml-25"></i></button>
            <button type="button" class="btn btn-success px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="save">Save <i data-feather="save" class="ml-25"></i></button>
            <button type="button" class="btn btn-danger px-2 ml-md-1 mb-25 col-12 col-md-2 float-right" id="cancel">Cancel <i data-feather="x" class="ml-25"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div
  class="modal fade text-left" id="camera" tabindex="-2" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel1">Capture Image</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
</section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
  <script src="{{ asset('js/scripts/dl_class.js') }}"></script>
@endsection
