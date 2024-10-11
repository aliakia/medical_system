$(document).ready(function()
{
    localStorage.clear();
    var hideSearch = $('.hide-search'),
    isRtl = $('html').attr('data-textdirection') === 'rtl',
        basicPickr = $('.flatpickr-basic'),
        date_from = $('#date_from').val(),
        date_to = $('#date_to').val();
    var searchForm = $('#search_form'),
        error_messages = [];
    $('[data-toggle="tooltip"]').tooltip();

    var oTable = $("#myTable").dataTable({
        "autoWidth": false,
        "scrollX":true,
        "lengthMenu": [5,10,25,50],
        "ordering": true,
        "info": true,
        "drawCallback": function( settings ) {
            feather.replace();
            $('.view').on('click', function (){
                var transValue = this.value;
                viewDetails(transValue);
            });
        },
        stateSave: true
    });

    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: 'Y-m-d'
        });
    }

    hideSearch.select2({
        minimumResultsForSearch: Infinity
    });

    $('#btn_search').on('click', function () {
        search();
    });

    function search() {
        var _date_from = $('#date_from').val();
        var _date_to = $('#date_to').val();
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        window.location.href = "get_uploading_list,"+_date_from+","+_date_to;
    }

    $('.view').on('click', function (){
        var transValue = this.value;
        viewDetails(transValue);
    });

    function viewDetails (transValue){
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "GET",
            url: "view_trans,"+transValue,
            success:function(data)
            {
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                // console.log(data);
                if (data.status == "1") {
                    var dataDetails = data.data_details[0];
                    
                    $('#disp_fname').html(dataDetails.first_name);
                    $('#disp_mname').html(dataDetails.middle_name);
                    $('#disp_lname').html(dataDetails.last_name);
                    $('#disp_license_no').html(dataDetails.license_no);
                    $('#disp_gender').html(dataDetails.gender);
                    $('#disp_birthday').html(dataDetails.birthdate);
                    $('#disp_age').html(dataDetails.age);
                    $('#disp_nationality').html(dataDetails.nationality);
                    $('#disp_marital_status').html(dataDetails.marital_status);
                    $('#disp_address').html(dataDetails.owner_address);
                    $('#picture_2').attr('src', dataDetails.student_pic1);
                    $('#disp_branch').html(dataDetails.ds_name);
                    $('#disp_course_name').html(dataDetails.program_description);
                    $('#disp_client_id').html(dataDetails.lto_client_id);
                    $('#disp_training_purpose').html(dataDetails.training_purpose);
                    if(dataDetails.date_started == null || dataDetails.date_started == ""){
                        $('#disp_date_started').html('-');
                    }else{
                        let dateStarted = dataDetails.date_started;
                        const dateOnlyStarted = dateStarted.split(" ");
                        $('#disp_date_started').html(dateOnlyStarted[0]);
                    }
                    if(dataDetails.date_completed == null || dataDetails.date_completed == ""){
                        $('#disp_date_completed').html('-');
                    }else{
                        let dateCompleted = dataDetails.date_completed;
                        const dateOnlyCompleted = dateCompleted.split(" ");
                        $('#disp_date_completed').html(dateOnlyCompleted[0]);
                    }
                    if (data.data_dl_codes =="") {
                        $('#disp_dl_class').html('-');
                    } else {
                        var dlClassArray = data.data_dl_codes;
                        var dlClass = "";
                        for (let i = 0; i < dlClassArray.length; i++) {
                            dlClass += dlClassArray[i].dl_code_remarks+'  '+dlClassArray[i].dl_code+'</br>';
                        }
                        $('#disp_dl_class').html(dlClass);
                    }
                    if (dataDetails.total_hours =="0") {
                        $('#disp_total_no_hours').html('-');
                        $('#disp_assessment').html('-');
                        $('#disp_overall').html('-');
                    } else {
                        $('#disp_total_no_hours').html(dataDetails.total_hours);
                        $('#disp_exam_score').html(dataDetails.exam_score);
                        if (dataDetails.assessment == 1) {
                            $('#disp_assessment').html('PASSED');
                        } else {
                            $('#disp_assessment').html('FAILED');
                        }
                        if (dataDetails.overall_rating == 1) {
                            $('#disp_overall').html('PASSED');
                        } else {
                            $('#disp_overall').html('FAILED');
                        }
                        $('#disp_additional_comments').html(dataDetails.remarks);
                    }
                    $('#view_details').modal('show');
                    
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

    $("#select_all").on("change", function(){
        if($(this).is(':checked')){
            oTable.$("input[type='checkbox']").prop('checked',true);
        }
        else{
            oTable.$("input[type='checkbox']").prop('checked',false);
        }  
    });
    // $('#select_all').on('click', function () {
        // if($(this).is(':checked')){
        //     $('table input[type=checkbox]').prop('checked', true);
        // }
        // else{
        //     $('table input[type=checkbox]').prop('checked', false);
        // }
        
    // });

    $('#btn_upload').on("click", function (){
        // var frameSrc = '<iframe src="../biometrics/content2.html" style="zoom:1.0" frameborder="0" height="400" width="100%" id="frame1"></iframe>';
        // $('#bio_modal_body').html(frameSrc);
        // $('#biometrics_modal').modal({
        //     backdrop: 'static',
        //     keyboard: false,
        //     backdrop: false
        // });
        // $("#biometrics_modal").modal({show:true});
        $.ajax({type:'GET', crossDomain: true,url: "http://localhost:5000/Verify_Biometrics", success: function(result){
            console.log(result);
            if (result != "") {
                uploadNow(result);
            }else{
                toastr['warning']('Please Scan the finger print of the Administrator', 'Biometrics Required', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
        }});
    });

    // $('#verify').on('click', function () {
    // //    verify();
    //     var pngFile = localStorage.getItem("imageSrc");
       
    //     if (pngFile != null) {
    //         uploadNow (pngFile);
            
    //     }else{
    //         toastr['warning']('Please Scan the finger print of the instructor before Uploading', 'Biometrics Required', {
    //             closeButton: true,
    //             tapToDismiss: false,
    //             rtl: isRtl
    //         });
    //     }
    // });

    function verify(){
        var selected = new Array();
        oTable.$('input[type=checkbox]:checked', {"page": "all"}).each(function(index, val) {
            selected.push($(val).val());
        });
        console.log(selected);
        // $("#loader1").removeClass("hidden",function () {
        //     $("#loader1").fadeIn(500);
        // });
        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     method: "POST",
        //     url: "instructor_upload",
        //     data: {
        //         'selected': selected
        //     },
        //     success:function(data)
        //     {
        //         $("#loader").addClass("hidden", function() {
        //             $("#loader").fadeOut(500);
        //         });
        //         // console.log(data);
        //         if (data.status == "1") {
        //             Swal.fire({
        //                 title: "Verify Successful!",
        //                 text: data.message,
        //                 icon: "success",
        //                 customClass: {
        //                     confirmButton: 'btn btn-primary'
        //                 },
        //                 buttonsStyling: false,
        //                 allowOutsideClick:() => {
        //                 this.wasOutsideClick = true;
        //                 }
        //             }).then((result) => {
        //                     if (result.isConfirmed) {
        //                         $("#loader").removeClass("hidden",function () {
        //                             $("#loader").fadeIn(500);
        //                         });
        //                         window.location.href = "student_list";
        //                     // location.reload(true);
        //                 }
        //             });
        //         } else {
        //             toastr['error'](data.message, 'Error', {
        //                 closeButton: true,
        //                 tapToDismiss: false,
        //                 rtl: isRtl
        //             });
        //         }
        //     },
        //     error: function(xhr, status, error){
        //         var errorMessage = xhr.status + ': ' + xhr.statusText;
        //         $("#loader").addClass("hidden", function() {
        //             $("#loader").fadeOut(500);
        //         });
        //         if(xhr.status == 500){
        //             toastr['error']('There was a problem connecting to the server.', 'Error', {
        //                 closeButton: true,
        //                 tapToDismiss: false,
        //                 rtl: isRtl
        //             });
        //         }
        //         else if(xhr.status == 0){
        //             toastr['error']('Not Connected. Please verify your network connection.', 'Error', {
        //                 closeButton: true,
        //                 tapToDismiss: false,
        //                 rtl: isRtl
        //             });
                    
        //         }else{
        //             toastr['error'](errorMessage, 'Error', {
        //                 closeButton: true,
        //                 tapToDismiss: false,
        //                 rtl: isRtl
        //             });
        //         }
        //     }
        // });
    }

    function uploadNow (adminBio) {
        var selected = new Array();
        var successUpload = 0, failedUpload = 0;
        oTable.$('input[type=checkbox]:checked', {"page": "all"}).each(function() {
            selected.push($(this).val());
        });

        console.log(selected);

        if (selected.length == 0) {
            toastr['warning']('Please Select transaction first', 'No Data Selected', {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl
            });
        } else {
            $("#biometrics_modal").modal('hide');
            var frameSrc = "";
            $('#bio_modal_body').html(frameSrc); 
            
            $("#loader1").removeClass("hidden",function () {
                $("#loader1").fadeIn(500);
            });
            for (let i = 0; i < selected.length; i++) {
                (function (i) {
                    var total = selected.length, current = i+1;
                    var item = selected[i].split("=");
                    console.log(item);
                    let trans_no = item[0],
                        student_id = item[1];
                        setTimeout(function () {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                async: false,
                                method: "POST",
                                url: "new_trans_upload",
                                data: {
                                    trans_no: trans_no,
                                    student_id: student_id,
                                    biometrics_data: adminBio
                                },
                                beforeSend: function () {
                                    $('#loadtext').html('Uploading '+current+' out of '+total);
                                },
                                success:function(data)
                                {
                                    if (data.status == "1") {
                                        successUpload += 1;
                                        error_messages.push(data.message);
                                    } else {
                                        failedUpload += 1;
                                        error_messages.push(data.message);  
                                    }
                                    // console.log(data);
                                    if (current == total) {
                                        $('#loadtext').html('Uploading '+current+' out of '+total);
                                        let messages = '<div class="col-12 mb-1">' +successUpload+' out of '+total+' Uploaded Successfully </div>';
                                        for (let err = 0; err < error_messages.length; err++) {
                                            let err1 = err+1;
                                            messages += '<div class="col-12 text-left ml-1">' +err1+'. ' +error_messages[err]+ '</div>';
                                        }
                                        setTimeout(function () {
                                           
                                            if (successUpload == 0) {
                                                $("#loader1").addClass("hidden", function() {
                                                    $("#loader1").fadeOut(500);
                                                });
                                                Swal.fire({
                                                    title: "Upload Unsuccessful",
                                                    html: '<div class="row">' + messages+ '</div>',
                                                    icon: "error",
                                                    confirmButtonText: 'Ok',
                                                    customClass: {
                                                        confirmButton: 'btn btn-primary',
                                                    },
                                                    buttonsStyling: false,
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        $("#loader").removeClass("hidden",function () {
                                                            $("#loader").fadeIn(500);
                                                        });
                                                        window.location.href = "uploading_list";
                                                    }
                                                });
                                            } else {
                                                $("#loader1").addClass("hidden", function() {
                                                    $("#loader1").fadeOut(500);
                                                });
                                                Swal.fire({
                                                    title: "Upload Finished",
                                                    html: '<div class="row">' + messages+ '</div>',
                                                    icon: "success",
                                                    confirmButtonText: 'Ok',
                                                    customClass: {
                                                        confirmButton: 'btn btn-primary',
                                                    },
                                                    buttonsStyling: false,
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        $("#loader").removeClass("hidden",function () {
                                                            $("#loader").fadeIn(500);
                                                        });
                                                        window.location.href = "uploading_list";
                                                    }
                                                });
                                            }
                                        }, 300);
                                    }else{   
                                        i++;
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
                        }, 100);
                })(i);
            }
        }
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