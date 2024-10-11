$(document).ready(function()
{
    $('#bio_form').addClass("hidden")
    $('#error_label').addClass("hidden")
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    var hideSearch = $('.hide-search');
    hideSearch.select2({
        minimumResultsForSearch: Infinity
    });

    $("#physician_user_id").val("Francis Lopregs Bones").change();
    $("#physician_user_id").val("Francis Lopregs Bones");

    $("input:text").keypress(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    }); 

    $('#login_bio_btn').on("click", function (){  
        var inputuser = $('#physician_user_id').val();
        if(inputuser == ''){
            $('#error_label').removeClass("hidden")
        }
        else{
            $('#error_label').addClass("hidden")
            $.ajax({type:'GET', crossDomain: true,url: "http://localhost:5000/Verify_Biometrics", success: function(bio){

            if (bio != "") {                                                             
                var bio_login_form = $('#bio_login_form');
                bio_login_form.validate({
                    rules: {
                    physician_user_id: {
                            required: true
                        }
                    }
                });
                if (bio_login_form.valid()) {
                        $("#loader").removeClass("hidden",function () {
                            $("#loader").fadeIn(500);
                        });
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "POST",
                            url: "bio_login",
                            data:{        
                                "physician_user_id" : $('#physician_user_id').val(),
                                "Biometrics_data":bio
                            },
                            // data: bio_login_form.serialize()+"&Biometrics_data="+bio,
                            success:function(data)
                            {
                                $("#loader").addClass("hidden", function() {
                                    $("#loader").fadeOut(500);
                                });
                                // console.log(data);
                                if (data.status == "1") {   
                                    if(data.balance > -10000.00 && data.balance <= 0){
                                        Swal.fire({
                                            title: "Success Login",
                                            text: "Warning!! Current Balance: ₱" + data.balance,
                                            icon: "success",
                                            confirmButtonText: 'Ok',
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            customClass: {
                                            confirmButton: 'btn btn-primary',
                                            },
                                            buttonsStyling: false,
                                        }).then((result) => {
                                            if (result.isConfirmed) {  
                                                $("#loader").removeClass("hidden",function () {
                                                    $("#loader").fadeIn(500);
                                                });
                                                window.location.href = "new_trans";                                                               
                                        
                                            } 
                                        }); 
                                    }
                                    else{
                                        Swal.fire({
                                            title: "Success!!",
                                            text: data.message,
                                            icon: "success",
                                            confirmButtonText: 'Ok',
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            customClass: {
                                            confirmButton: 'btn btn-primary',
                                            },
                                            buttonsStyling: false,
                                        }).then((result) => {
                                            if (result.isConfirmed) {  
                                                $("#loader").removeClass("hidden",function () {
                                                    $("#loader").fadeIn(500);
                                                });
                                                window.location.href = "new_trans";                                                               
                                        
                                            } 
                                        });  
                                    }                             
                                } 
                                else if(data.status == "2"){
                                    Swal.fire({
                                        title: "Sorry!!",
                                        text: "Insufficient balance",
                                        icon: "error",
                                        confirmButtonText: 'Ok',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        customClass: {
                                        confirmButton: 'btn btn-danger',
                                        },
                                        buttonsStyling: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {  
                                            $("#loader").removeClass("hidden",function () {
                                                $("#loader").fadeIn(500);
                                            });
                                            window.location.href = "balance_error";                                                              
                                    
                                        } 
                                    });                                  
                                }
                                else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: data.message,
                                    })
                                    $('#username_bio').removeClass("hidden")
                                    $('#bio_form').addClass("hidden")
                                }
                            },
                        });
                    
                }       
                }else{
                    toastr['warning']('Please Scan the finger print of the Physician', 'Biometrics Required', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                });
            }

            }}); 
        }   
             
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