$(document).ready(function()
{
    localStorage.clear();
    var hideSearch = $('.hide-search'),
        basicPickr = $('.flatpickr-basic'),
        isRtl = $('html').attr('data-textdirection') === 'rtl';
    $('[data-toggle="tooltip"]').tooltip();

    $("#myTable").dataTable({
        "autoWidth": true,
        "scrollX": true,
        "lengthMenu": [10, 25, 50, 100],
        "ordering": false,
        "info": true,
        "drawCallback": function( settings ) {
            feather.replace();
            $(".edit").on('click', function(){
                var transValue = this.value;
                viewDetails(transValue);
            });
        }
    });

    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: 'm-d-Y'
        });
    }

    hideSearch.select2({
        minimumResultsForSearch: Infinity
    });

    $('.fingers').on('click', function () {
        localStorage.setItem("fp", this.value);
        // var frameSrc = '<iframe src="../biometrics/content.html" style="zoom:1.0" frameborder="0" height="400" width="100%" id="frame1"></iframe>';
        // $('#bio_modal_body').html(frameSrc);
        // $('#biometrics_modal').modal({
        //     backdrop: 'static',
        //     keyboard: false,
        //     backdrop: false
        // });
        // $("#biometrics_modal").modal({show:true});
        var fp = localStorage.getItem("fp");
        $.ajax({type:'GET', crossDomain: true,url: "http://localhost:5000/Enroll_Biometrics", success: function(result){
            if (fp == ""||fp == null) {
                $("#scan_success").html("Error Scanning");
            }
            else if (fp == "1") {
                localStorage.setItem("fp_idl1", result);
            }
            else if(fp == "2"){
                localStorage.setItem("fp_idl2", result);
            }
            else if(fp == "3"){
                localStorage.setItem("fp_idl3", result);
            }
            else if(fp == "4"){
                localStorage.setItem("fp_idl4", result);
            }
            else if(fp == "5"){
                localStorage.setItem("fp_idl5", result);
            }
            else if(fp == "6"){
                localStorage.setItem("fp_idr1", result);
            }
            else if(fp == "7"){
                localStorage.setItem("fp_idr2", result);
            }
            else if(fp == "8"){
                localStorage.setItem("fp_idr3", result);
            }
            else if(fp == "9"){
                localStorage.setItem("fp_idr4", result);
            }
            else if(fp == "10"){
                localStorage.setItem("fp_idr10", result);
            }
        }});
    });

    $('#open_bio').on('click', function () {
        // var frameSrc = '<iframe src="../biometrics/content.html" style="zoom:1.0" frameborder="0" height="400" width="100%" id="frame"></iframe>';
        // $('#bio_modal_body').html(frameSrc);
        $('#hand_modal').modal({
            backdrop: 'static',
            keyboard: false,
            backdrop: false
        });
        $("#hand_modal").modal({show:true});
    });

    // $('#close_bio').on('click', function () {
    //     var fp = localStorage.getItem("fp");
    //     var fpFile = "";
    //     if (fp == ""||fp == null) {
    //         $("#scan_success").html("Error Scanning");
    //     }
    //     else if (fp == "1") {
    //         localStorage.setItem("intermediate1", fpFile);
    //     }
    //     else if(fp == "2"){
    //         localStorage.setItem("intermediate2", fpFile);
    //     }
    //     else if(fp == "3"){
    //         localStorage.setItem("intermediate3", fpFile);
    //     }
    //     else if(fp == "4"){
    //         localStorage.setItem("intermediate4", fpFile);
    //     }
    //     else if(fp == "5"){
    //         localStorage.setItem("intermediate5", fpFile);
    //     }
    //     else if(fp == "6"){
    //         localStorage.setItem("intermediate6", fpFile);
    //     }
    //     else if(fp == "7"){
    //         localStorage.setItem("intermediate7", fpFile);
    //     }
    //     else if(fp == "8"){
    //         localStorage.setItem("intermediate8", fpFile);
    //     }
    //     else if(fp == "9"){
    //         localStorage.setItem("intermediate9", fpFile);
    //     }
    //     else if(fp == "10"){
    //         localStorage.setItem("intermediate10", fpFile);
    //     }
    //     $("#biometrics_modal").modal('hide');
    //     var frameSrc = "";
    //     $('#bio_modal_body').html(frameSrc);
    // });

    // $('#save_bio').on('click', function () {
    //     $("#biometrics_modal").modal('hide');
    //     var frameSrc = "";
    //     $('#bio_modal_body').html(frameSrc);
    // });

    $('#close_fp').on('click', function () {
        localStorage.clear();
        $("#hand_modal").modal('hide');
    });

    $('#save_fp').on('click', function () {
        
        var fp_idl1 = localStorage.getItem("fp_idl1"),
            fp_idl2 = localStorage.getItem("fp_idl2"),
            fp_idl3 = localStorage.getItem("fp_idl3"),
            fp_idl4 = localStorage.getItem("fp_idl4"),
            fp_idl5 = localStorage.getItem("fp_idl5"),
            fp_idr1 = localStorage.getItem("fp_idr1"),
            fp_idr2 = localStorage.getItem("fp_idr2"),
            fp_idr3 = localStorage.getItem("fp_idr3"),
            fp_idr4 = localStorage.getItem("fp_idr4"),
            fp_idr5 = localStorage.getItem("fp_idr5");
        if (fp_idl1 != "" || fp_idl1 != null) {
            $('#fp_idl1').val(fp_idl1);
        } else {
            let fp = "1";
            errorMessage(fp);
        }
        if (fp_idl2 != "" || fp_idl2 != null) {
            $('#fp_idl2').val(fp_idl2);
            
        } else {
            let fp = "2";
            errorMessage(fp);
        }
        if (fp_idl3 != "" || fp_idl3 != null) {
            $('#fp_idl3').val(fp_idl3);
        } else {
            let fp = "3";
            errorMessage(fp);
        }
        if (fp_idl4 != "" || fp_idl4 != null) {
            $('#fp_idl4').val(fp_idl4);
        } else {
            let fp = "4";
            errorMessage(fp);
        }
        if (fp_idl5 != "" || fp_idl5 != null) {
            $('#fp_idl5').val(fp_idl5);
        } else {
            let fp = "5";
            errorMessage(fp);
        }
        if (fp_idr1 != "" || fp_idr1 != null) {
            $('#fp_idr1').val(fp_idr1);
        } else {
            let fp = "6";
            errorMessage(fp);
        }
        if (fp_idr2 != "" || fp_idr2 != null) {
            $('#fp_idr2').val(fp_idr2);
            
        } else {
            let fp = "7";
            errorMessage(fp);
        }
        if (fp_idr3 != "" || fp_idr3 != null) {
            $('#fp_idr3').val(fp_idr3);
        } else {
            let fp = "8";
            errorMessage(fp);
        }
        if (fp_idr4 != "" || fp_idr4 != null) {
            $('#fp_idr4').val(fp_idr4);
        } else {
            let fp = "9";
            errorMessage(fp);
        }
        if (fp_idr5 != "" || fp_idr5 != null) {
            $('#fp_idr5').val(fp_idr5);
        } else {
            let fp = "10";
            errorMessage(fp);
        }
        $("#hand_modal").modal('hide');
    });

    //edit user
    $('.fingers2').on('click', function () {
        localStorage.setItem("fp", this.value);
        // var frameSrc = '<iframe src="../biometrics/content.html" style="zoom:1.0" frameborder="0" height="400" width="100%" id="frame2"></iframe>';
        // $('#bio_modal_body2').html(frameSrc);
        // $('#biometrics_modal2').modal({
        //     backdrop: 'static',
        //     keyboard: false,
        //     backdrop: false
        // });
        // $("#biometrics_modal2").modal({show:true});
        var fp = localStorage.getItem("fp");
        $.ajax({type:'GET', crossDomain: true,url: "http://localhost:5000/Enroll_Biometrics", success: function(result){
            if (fp == ""||fp == null) {
                $("#scan_success").html("Error Scanning");
            }
            else if (fp == "1") {
                localStorage.setItem("fp_idl1", result);
            }
            else if(fp == "2"){
                localStorage.setItem("fp_idl2", result);
            }
            else if(fp == "3"){
                localStorage.setItem("fp_idl3", result);
            }
            else if(fp == "4"){
                localStorage.setItem("fp_idl4", result);
            }
            else if(fp == "5"){
                localStorage.setItem("fp_idl5", result);
            }
            else if(fp == "6"){
                localStorage.setItem("fp_idr1", result);
            }
            else if(fp == "7"){
                localStorage.setItem("fp_idr2", result);
            }
            else if(fp == "8"){
                localStorage.setItem("fp_idr3", result);
            }
            else if(fp == "9"){
                localStorage.setItem("fp_idr4", result);
            }
            else if(fp == "10"){
                localStorage.setItem("fp_idr10", result);
            }
        }});
    });

    $('#open_bio2').on('click', function () {
        // var frameSrc = '<iframe src="../biometrics/content.html" style="zoom:1.0" frameborder="0" height="400" width="100%" id="frame"></iframe>';
        // $('#bio_modal_body').html(frameSrc);
        $('#hand_modal2').modal({
            backdrop: 'static',
            keyboard: false,
            backdrop: false
        });
        $("#hand_modal2").modal({show:true});
    });

    // $('#close_bio2').on('click', function () {
    //     var fp = localStorage.getItem("fp");
    //     var fpFile = "";
    //     if (fp == ""||fp == null) {
    //         $("#scan_success").html("Error Scanning");
    //     }
    //     else if (fp == "1") {
    //         localStorage.setItem("intermediate1", fpFile);
    //     }
    //     else if(fp == "2"){
    //         localStorage.setItem("intermediate2", fpFile);
    //     }
    //     else if(fp == "3"){
    //         localStorage.setItem("intermediate3", fpFile);
    //     }
    //     else if(fp == "4"){
    //         localStorage.setItem("intermediate4", fpFile);
    //     }
    //     else if(fp == "5"){
    //         localStorage.setItem("intermediate5", fpFile);
    //     }
    //     else if(fp == "6"){
    //         localStorage.setItem("intermediate6", fpFile);
    //     }
    //     else if(fp == "7"){
    //         localStorage.setItem("intermediate7", fpFile);
    //     }
    //     else if(fp == "8"){
    //         localStorage.setItem("intermediate8", fpFile);
    //     }
    //     else if(fp == "9"){
    //         localStorage.setItem("intermediate9", fpFile);
    //     }
    //     else if(fp == "10"){
    //         localStorage.setItem("intermediate10", fpFile);
    //     }
    //     $("#biometrics_modal2").modal('hide');
    //     var frameSrc = "";
    //     $('#bio_modal_body2').html(frameSrc);
    // });

    // $('#save_bio2').on('click', function () {
    //     $("#biometrics_modal2").modal('hide');
    //     var frameSrc = "";
    //     $('#bio_modal_body2').html(frameSrc);
    // });

    $('#close_fp2').on('click', function () {
        localStorage.clear();
        $("#hand_modal2").modal('hide');
    });

    function errorMessage(fp) {
        toastr['error']('Fingerprint '+fp+' not Scanned', 'Error', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
        });
    }

    $('#save_fp2').on('click', function () {
        
        var fp_idl1 = localStorage.getItem("fp_idl1"),
            fp_idl2 = localStorage.getItem("fp_idl2"),
            fp_idl3 = localStorage.getItem("fp_idl3"),
            fp_idl4 = localStorage.getItem("fp_idl4"),
            fp_idl5 = localStorage.getItem("fp_idl5"),
            fp_idr1 = localStorage.getItem("fp_idr1"),
            fp_idr2 = localStorage.getItem("fp_idr2"),
            fp_idr3 = localStorage.getItem("fp_idr3"),
            fp_idr4 = localStorage.getItem("fp_idr4"),
            fp_idr5 = localStorage.getItem("fp_idr5");
        if (fp_idl1 != "" || fp_idl1 != null) {
            $('#edit_fp_idl1').val(fp_idl1);
        } else {
            let fp = "1";
            errorMessage(fp);
        }
        if (fp_idl2 != "" || fp_idl2 != null) {
            $('#edit_fp_idl2').val(fp_idl2);
            
        } else {
            let fp = "2";
            errorMessage(fp);
        }
        if (fp_idl3 != "" || fp_idl3 != null) {
            $('#edit_fp_idl3').val(fp_idl3);
        } else {
            let fp = "3";
            errorMessage(fp);
        }
        if (fp_idl4 != "" || fp_idl4 != null) {
            $('#edit_fp_idl4').val(fp_idl4);
        } else {
            let fp = "4";
            errorMessage(fp);
        }
        if (fp_idl5 != "" || fp_idl5 != null) {
            $('#edit_fp_idl5').val(fp_idl5);
        } else {
            let fp = "5";
            errorMessage(fp);
        }
        if (fp_idr1 != "" || fp_idr1 != null) {
            $('#edit_fp_idr1').val(fp_idr1);
        } else {
            let fp = "6";
            errorMessage(fp);
        }
        if (fp_idr2 != "" || fp_idr2 != null) {
            $('#edit_fp_idr2').val(fp_idr2);
            
        } else {
            let fp = "7";
            errorMessage(fp);
        }
        if (fp_idr3 != "" || fp_idr3 != null) {
            $('#edit_fp_idr3').val(fp_idr3);
        } else {
            let fp = "8";
            errorMessage(fp);
        }
        if (fp_idr4 != "" || fp_idr4 != null) {
            $('#edit_fp_idr4').val(fp_idr4);
        } else {
            let fp = "9";
            errorMessage(fp);
        }
        if (fp_idr5 != "" || fp_idr5 != null) {
            $('#edit_fp_idr5').val(fp_idr5);
        } else {
            let fp = "10";
            errorMessage(fp);
        }
        $("#hand_modal2").modal('hide');

    });

    //camera functions
    $('#select').on('click', function() {      
        if (navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
              .then(function (stream) {
                    video.srcObject = stream;
              })
              .catch(function (err0r) {
                    alert("Something went wrong!");
              });
        }
        $('#camera').modal({
            backdrop: 'static',
            keyboard: false,
            backdrop: false
        });
        // Webcam.set({
        //     width: 640,
        //     height: 480,
        //     align:'center',
        //     image_format: 'jpeg',
        //     jpeg_quality: 100
        // });
        // Webcam.attach('#video');
    });
    $('#close_cam').on('click', function() { 
        
    });
    
    $('#capture').on('click', function() {     
        capture();
    });
    $('#saveImg').on('click', function() {     
        save();
    });
    function capture() {        
        // var canvas = $('#canvas');
        // Webcam.snap( function(data_uri) {
        //     canvas.attr('src', data_uri);
        //     $('#canvas').removeClass('hidden');
        //     $('#saveImg').removeClass('hidden');
        // });
        var canvas = document.getElementById('canvas');     
        var video = document.getElementById('video');
        canvas.width = 640;
        canvas.height = 480;
        canvas.getContext('2d').drawImage(video, 0, 0, 640, 480);  
        $('#canvas').removeClass('hidden');
        $('#saveImg').removeClass('hidden');
    }
    function save() {
        // var base_64 = $('#canvas').attr('src');
        // $('#picture_1').attr('src', base_64);
        // $('#base_64').val(base_64);
        // $('#canvas').addClass('hidden');
        // $('#saveImg').addClass('hidden');
        document.getElementById("picture_1").src = canvas.toDataURL();
        $("#base_64").val(canvas.toDataURL());
        $('#canvas').addClass('hidden');
        $('#saveImg').addClass('hidden');
    }

    $('#user_type').on('change', function() {
        if (this.value == "instructor") {
            $('#cert_tesda_div').removeClass('hidden');
            $('#tesda_expiration_div').removeClass('hidden');
        } else {
            $('#cert_tesda_div').addClass('hidden');
            $('#tesda_expiration_div').addClass('hidden');
        }
    });

    $('#user_type_edit').on('change', function() {
        if (this.value == "instructor") {
            $('#cert_tesda_edit_div').removeClass('hidden');
            $('#tesda_expiration_edit_div').removeClass('hidden');
        } else {
            $('#cert_tesda_edit_div').addClass('hidden');
            $('#tesda_expiration_edit_div').addClass('hidden');
        }
    });

    $('#confirm').on('click', function () {
        var add_user = $('#reg_form');
        add_user.validate({
            rules: {
                base_64:{
                    required: true
                },
                first_name: {
                    required: true
                },
                middle_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                gender: {
                    required: true
                },
                cert_tesda: {
                    required: true
                },
                tesda_expiration: {
                    required: true
                },
                user_type: {
                    required: true
                },
                user_expiration: {
                    required: true
                },
                employee_id: {
                    required: true
                },
                user_id: {
                    required: true
                },
                password: {
                    required: true
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: '#password'
                }
            }
        });
        if (add_user.valid()) {
            if ($('#base_64').val() == "") {
                toastr['error']('Please Capture Student Image', 'Required Field', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
            else {
                if ($('#fp_idr1').val() == "-") {
                    toastr['error']('Right Thumb Fingerprint are required', 'Fingerprint Required', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                } else {
                    $("#loader").removeClass("hidden",function () {
                        $("#loader").fadeIn(500);
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: "add_new_user",
                        data: add_user.serialize(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            if (data.status == "1") {
                                Swal.fire({
                                    title: "Save Successful!",
                                    text: data.message,
                                    icon: "success",
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false,
                                    allowOutsideClick:() => {
                                    this.wasOutsideClick = true;
                                    }
                                }).then((result) => {
                                        if (result.isConfirmed) {
                                            $("#loader").removeClass("hidden",function () {
                                                $("#loader").fadeIn(500);
                                            });
                                            window.location.href = "admin_functions";
                                        // location.reload(true);
                                    }
                                });
                            } else {
                                toastr['error'](data.message, 'Error', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });
                            }
                        },
                        error: function(xhr, status, error){
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
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
                }
               
            }
        }
    });
    
    $(".edit").on('click', function()
    {
        localStorage.clear();
        var transValue = this.value;
        viewDetails(transValue);
    });

    function viewDetails (transValue){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "select_user",
            data:{
                "user_id": transValue
            },
            success:function(data)
            {   
                if (data.status == "1") {
                    var _user_data = data.data
                    $('#edit_user_modal').modal({
                        backdrop: 'static',
                        keyboard: false,
                        backdrop: false
                    });
    
                    $('#base_64_edit').val(_user_data.pic_id1);
                    // $('#edit_fp_idr1').val(_user_data.fp_idr1);
                    // $('#edit_fp_idr2').val(_user_data.fp_idr2);
                    // $('#edit_fp_idr3').val(_user_data.fp_idr3);
                    // $('#edit_fp_idr4').val(_user_data.fp_idr4);
                    // $('#edit_fp_idr5').val(_user_data.fp_idr5);
                    // $('#edit_fp_idl1').val(_user_data.fp_idl1);
                    // $('#edit_fp_idl2').val(_user_data.fp_idl2);
                    // $('#edit_fp_idl3').val(_user_data.fp_idl3);
                    // $('#edit_fp_idl4').val(_user_data.fp_idl4);
                    // $('#edit_fp_idl5').val(_user_data.fp_idl5);
                    $('#picture_3').attr('src', _user_data.pic_id1);
                    $('#first_name_edit').val(_user_data.first_name);
                    $('#middle_name_edit').val(_user_data.middle_name);
                    $('#last_name_edit').val(_user_data.last_name); 
                    $('#gender_edit').val(_user_data.gender).change();
                    $('#cert_tesda_edit').val(_user_data.certificate_tesda);
                    $('#tesda_expiration_edit').val(_user_data.certificate_tesda_expiration).change();
                    $('#user_type_edit').val(_user_data.user_type).change();
                    $('#user_expiration_edit').val(_user_data.user_expiration).change();
                    $('#employee_id_edit').val(_user_data.employee_id);
                    $('#user_id_edit').val(_user_data.user_id);
                    $('#status').val(_user_data.is_active).change();
                    if ($('#user_type_edit').val() == "instructor") {
                        $('#cert_tesda_edit_div').removeClass('hidden');
                        $('#tesda_expiration_edit_div').removeClass('hidden');
                    } else {
                        $('#cert_tesda_edit_div').addClass('hidden');
                        $('#tesda_expiration_edit_div').addClass('hidden');
                    }
    
                } else {
                    toastr['error'](data.message, 'Error', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                }
            },
            error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                if(xhr.status == 500){
                alert("There was a problem connecting to the server.");
                }
                else if(xhr.status == 0){
                alert("Not Connected. Please verify your network connection.");
    
                }else{
                alert(errorMessage);
    
                }
            }
            });
    }

    $('#save').on('click', function () {
        var edit_user = $('#edit_form');
        edit_user.validate({
            rules: {
                first_name_edit: {
                    required: true
                },
                middle_name_edit: {
                    required: true
                },
                last_name_edit: {
                    required: true
                },
                gender_edit: {
                    required: true
                },
                cert_tesda_edit: {
                    required: true
                },
                tesda_expiration_edit: {
                    required: true
                },
                user_type_edit: {
                    required: true
                },
                user_expiration_edit: {
                    required: true
                },
                employee_id_edit: {
                    required: true
                },
                user_id_edit: {
                    required: true
                },
                // password_edit: {
                //     required: true
                // },
                // confirm_password_edit: {
                //     required: true,
                //     minlength: 5,
                //     equalTo: '#password'
                // },
                status: {
                    required: true
                }
            }
        });
        if (edit_user.valid()) {
            if ($('#base_64_edit').val() == "") {
                toastr['error']('Please Capture Student Image', 'Picture Required', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            } else {
                $("#loader").removeClass("hidden",function () {
                    $("#loader").fadeIn(500);
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "edit_user",
                    data: edit_user.serialize(),
                    success:function(data)
                    {
                        $("#loader").addClass("hidden", function() {
                            $("#loader").fadeOut(500);
                        });
                        // console.log(data);
                        if (data.status == "1") {
                            // sessionStorage.setItem("trans_no", data.trans_no); 
                            // sessionStorage.setItem("student_id", data.student_id);   
                            Swal.fire({
                                title: "Save Successful!",
                                text: data.message,
                                icon: "success",
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false,
                                allowOutsideClick:() => {
                                this.wasOutsideClick = true;
                                }
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                        $("#loader").removeClass("hidden",function () {
                                            $("#loader").fadeIn(500);
                                        });
                                        window.location.href = "admin_functions";
                                    // location.reload(true);
                                }
                            });
                        } else {
                            toastr['error'](data.message, 'Error', {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl
                            });
                        }
                    },
                    error: function(xhr, status, error){
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        $("#loader").addClass("hidden", function() {
                            $("#loader").fadeOut(500);
                        });
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
            }
        }
    });

    $('#select2').on('click', function() {     
        if (navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
              .then(function (stream) {
                    video2.srcObject = stream;
              })
              .catch(function (err0r) {
                    alert("Something went wrong!");
              });
        }
        // Webcam.set({
        //     width: 640,
        //     height: 480,
        //     align:'center',
        //     image_format: 'jpeg',
        //     jpeg_quality: 100
        // });
        // Webcam.attach('#video');
    });
    $('#close_cam').on('click', function() { 
        
    });
    
    $('#capture2').on('click', function() {     
        capture2();
    });
    $('#saveImg2').on('click', function() {     
        save2();
    });
    function capture2() {        
        // var canvas = $('#canvas');
        // Webcam.snap( function(data_uri) {
        //     canvas.attr('src', data_uri);
        //     $('#canvas').removeClass('hidden');
        //     $('#saveImg').removeClass('hidden');
        // });
        var canvas = document.getElementById('canvas2');     
        var video = document.getElementById('video2');
        canvas.width = 640;
        canvas.height = 480;
        canvas.getContext('2d').drawImage(video, 0, 0, 640, 480);  
        $('#canvas2').removeClass('hidden');
        $('#saveImg2').removeClass('hidden');
    }
    function save2() {
        // var base_64 = $('#canvas').attr('src');
        // $('#picture_1').attr('src', base_64);
        // $('#base_64').val(base_64);
        // $('#canvas').addClass('hidden');
        // $('#saveImg').addClass('hidden');
        document.getElementById("picture_3").src = canvas2.toDataURL();;
        $("#base_64_edit").val(canvas2.toDataURL());
        $('#canvas2').addClass('hidden');
        $('#saveImg2').addClass('hidden');
    }
 
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