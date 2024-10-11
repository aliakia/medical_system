$(document).ready(function()
{
    var hideSearch = $('.hide-search'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        basicPickr = $('.flatpickr-basic'),
        date_from = $('#date_from').val(),
        date_to = $('#date_to').val();
    var searchForm = $('#search_form');
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

    $('#confirm').on('click', function () {
        search();
    });

    $('#btn_open_filter').on('click', function () {
        $('#filter_modal').modal('show');
    });

    function search() {
        var _date_from = $('#date_from').val();
        var _date_to = $('#date_to').val();
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        window.location.href = "get_trans_report,"+_date_from+","+_date_to;
    }

    $('#btn_export').on('click', function () {
        Swal.fire({
            title: "Are you sure?",
            text: 'You want to Export this report as Excel File ?',
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
              confirmButton: 'btn btn-primary',
              denyButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                exportNow();
            } 
            // else if (result.isDenied) {
            //     $("#loader").removeClass("hidden",function () {
            //         $("#loader").fadeIn(500);
            //     });
            //     window.location.href = "dashboard_page";
            // }
        });
    });

    function exportNow() {
        var _date_from = $('#date_from').val();
        var _date_to = $('#date_to').val();
        window.location.href= "export_trans_report,"+_date_from+","+_date_to;
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
            url: "view_trans_uploaded,"+transValue,
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