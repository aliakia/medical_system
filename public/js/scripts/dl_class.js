$(document).ready(function()
{
    var _user_id = $('#user_id').val(),
        _ds_code = $('#ds_code').val(),
        _api_url = $('#api_url').val();

    //dl_classification
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        method: "POST",
        url: _api_url+"get_dl_classification",
        data:{
            "user_id": _user_id,
            "ds_code": _ds_code
        },
        success:function(data)
        {
            // console.log(data);
            var _json = JSON.stringify(data.data);
            var _object = JSON.parse(_json), 
            _div_a = "", 
            _div_a1 = "", 
            _div_b = "";
            _div_b1 = "";
            _div_b2 = "";
            _div_c = "";
            _div_d = "";
            _div_be = "";
            _div_ce = "";
            for (var i = 0; i < _object.length; i++)
            {
                if (_object[i].dl_code == "A") {
                    $('#A_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_a += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
                if (_object[i].dl_code == "A1") {
                    $('#A1_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_a1 += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
                if (_object[i].dl_code == "B") {
                    $('#B_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_b += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
                if (_object[i].dl_code == "B1") {
                    $('#B1_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_b1 += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
                if (_object[i].dl_code == "B2") {
                    $('#B2_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_b2 += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
                if (_object[i].dl_code == "C") {
                    $('#C_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_c += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
                if (_object[i].dl_code == "D") {
                    $('#D_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_d += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
                if (_object[i].dl_code == "BE") {
                    $('#BE_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_be += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
                if (_object[i].dl_code == "CE") {
                    $('#CE_label').html(htmlEntities(_object[i].dl_code)+' - '+htmlEntities(_object[i].dl_description));
                    _div_ce += '<div class="row"><div class="form-group col-md-8"><div class="custom-control custom-checkbox ml-2"><input type="checkbox" class="custom-control-input" id="'+htmlEntities(_object[i].vehicle_category_code)+'"/><label class="custom-control-label font-weight-bolder" for="'+htmlEntities(_object[i].vehicle_category_code)+'">'+htmlEntities(_object[i].vehicle_category_code)+' - '+htmlEntities(_object[i].vehicle_category_description)+'</label></div></div><div class="form-group col-md-4"><div class="row"><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_np"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p" name="'+htmlEntities(_object[i].vehicle_category_code)+'_class" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_class_p"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_at"></label></div><div class="custom-control custom-radio col-3"><input type="radio" id="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt" name="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch" class="custom-control-input"/><label class="custom-control-label" for="'+htmlEntities(_object[i].vehicle_category_code)+'_clutch_mt"></label></div></div></div></div>';
                }
            }
            $("#div_a").html(_div_a);
            $("#div_a1").html(_div_a1);
            $("#div_b").html(_div_b);
            $("#div_b1").html(_div_b1);
            $("#div_b2").html(_div_b2);
            $("#div_c").html(_div_c);
            $("#div_d").html(_div_d);
            $("#div_be").html(_div_be);
            $("#div_ce").html(_div_ce);
        },
        error: function(xhr, status, error){
            var errorMessage = xhr.status + ': ' + xhr.statusText;
            if(xhr.status == 500){
                toastr['error']('There was a problem connecting to the server.', 'Error', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
            else if(xhr.status == 0){
                toastr['error']('Not Connected. Please verify your network connection.', 'Error', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });

            }else{
                toastr['error'](errorMessage, 'Error', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
        }
    });

    $('#cancel').on('click', function () {
        Swal.fire({
            title: "Are you sure!",
            text:'You want to cancel this transaction?',
            icon: "warning",
            showCancelButton: true,
			confirmButtonText: 'Yes',
			customClass: {
			  confirmButton: 'btn btn-primary',
			  cancelButton: 'btn btn-outline-danger ml-1'
			},
			buttonsStyling: false,
        }).then( function (isConfirm) {
			if (isConfirm.value) {
                    $("#loader").removeClass("hidden",function () {
                    $("#loader").fadeIn(500);
                    });
                    window.location.href = "main_page";
			    }
			}
		);
    });

    $('#save').on('click', function () {
        var newTransForm = $('#new_trans_form')
        newTransForm.validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                user_id: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                },
                employee_id: {
                    required: true
                },
                gender: {
                    required: true
                },
                user_type: {
                    required: true
                }
            }
        });
        if (newTransForm.valid()) {
            $("#loader").removeClass("hidden",function () {
                $("#loader").fadeIn(500);
            });
            newTransForm.submit();
        }
    });

    $('#next').on('click', function () {
        Swal.fire({
            title: "Are you sure!",
            text:'You want to cancel this transaction?',
            icon: "warning",
            showCancelButton: true,
			confirmButtonText: 'Yes',
			customClass: {
			  confirmButton: 'btn btn-primary',
			  cancelButton: 'btn btn-outline-danger ml-1'
			},
			buttonsStyling: false,
        }).then( function (isConfirm) {
			if (isConfirm.value) {
                    $("#loader").removeClass("hidden",function () {
                    $("#loader").fadeIn(500);
                    });
                    window.location.href = "course_details";
			    }
			}
		);
    });
    
    function htmlEntities(str) {
        if (str == null)
        {
            return "";
        }
        else
        {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
    }
});