$(document).ready(function()
{    
    localStorage.clear();
    var hideSearch = $('.hide-search'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        bsStepper = document.querySelectorAll('.bs-stepper'),
        horizontalWizard = document.querySelector('.horizontal-wizard-example'),
        video = document.querySelector("#video"),
        basicPickr = $('.flatpickr-basic'),
        _progress1 = $('#data_test_physical_completed').val(),
        _progress2 = $('#data_test_visual_actuity_completed').val(),
        _progress3 = $('#data_test_hearing_auditory_completed').val(),
        _progress4 = $('#data_test_metabolic_neurological_completed').val(),
        // _progress5 = $('#data_test_health_history_completed').val();
        _progress6 = $('#data_is_final').val();
        
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: 'Y-m-d'
        });
    }


    hideSearch.select2({
        minimumResultsForSearch: Infinity
    });

    if (typeof bsStepper !== undefined && bsStepper !== null) {
        for (var el = 0; el < bsStepper.length; ++el) {
          bsStepper[el].addEventListener('show.bs-stepper', function (event) {
            var index = event.detail.indexStep;
            var numberOfSteps = $(event.target).find('.step').length - 1;
            var line = $(event.target).find('.step');
    
            // The first for loop is for increasing the steps,
            // the second is for turning them off when going back
            // and the third with the if statement because the last line
            // can't seem to turn off when I press the first item. ¯\_(ツ)_/¯
    
            for (var i = 0; i < index; i++) {
              line[i].classList.add('crossed');
    
              for (var j = index; j < numberOfSteps; j++) {
                line[j].classList.remove('crossed');
              }
            }
            if (event.detail.to == 0) {
              for (var k = index; k < numberOfSteps; k++) {
                line[k].classList.remove('crossed');
              }
              line[0].classList.remove('crossed');
            }
          });
        }
    }

    if (typeof horizontalWizard !== undefined && horizontalWizard !== null) {
        var numberedStepper = new Stepper(horizontalWizard);
        clientData();
        numberedStepper.next(); 
        if (_progress1 == "1") {
            clientphysicalexamData(); 
            numberedStepper.next();   
        }
        if(_progress2 == "1" &&  _progress3 == "1"){
            clientvisualauditoryexamData();
            numberedStepper.next();
        }
        if(_progress4 == "1"){
            clientmetabolicandneurologicaexamData();
            numberedStepper.next();
        }
        // if(_progress5 == "1"){
        //     clienthealthhistorydata();
        //     numberedStepper.next();
        // }
        if(_progress6 == "1"){
            reviewData();  
            clientassessmentconditionData();
            numberedStepper.next();
        }

        $(horizontalWizard).find('#next_1').on('click', function () {
            var saveTransForm = $('#saveTransForm')
            saveTransForm.validate({
                rules: {
                    trans_no: {
                        required: true
                    },
                    firstname: {
                        required: true
                    },
                    middlename: {
                        required: true
                    },
                    middle_name: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    age: {
                        required: true,
                        min: 18,
                        max: 65
                    },
                    birthday: {
                        required: true,
                    },
                    nationality: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    civilstatus: {
                        required: true
                    },
                    occupation: {
                        required: true
                    },
                    // licenseType: {
                    //     required: true
                    // },
                    // newRenewal: {
                    //     required: true
                    // },
                    lto_client_id:{
                        required: function() {
                            if($('#purpose').val() == "9" || $('#purpose').val() == "10"){
                                 return false
                            } 
                            else{
                                return true
                            } 
                        } 
                    },
                    license_no: {
                        required: function() {
                            if($('#purpose').val() == "9" || $('#purpose').val() == "10"){
                                 return false
                            } 
                            else{
                                return true
                            } 
                        } 
                    },
                    purpose: {
                        required: true
                    }
                },
                messages: {
                    base_64: "Please Capture Student Image"
                }
            });
            if (saveTransForm.valid()) {
                if ($('#base_64').val() == "") {
                    toastr['error']('Please Capture Student Image', 'Required Field', {
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
                        url: "save_trans_next",
                        data: saveTransForm.serialize(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            // console.log(data);
                            if (data.status == "1") {

                                numberedStepper.next();

                                if(data.progress[0].test_created != null && data.progress[0].test_created != ''){
                                    $('#progressbar').attr('aria-valuenow', '20').css('width', '20%');
                                    $("#progressbar").html("20% Progress");
                                }
                                if(data.progress[0].test_physical_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '40').css('width', '40%');
                                    $("#progressbar").html("40% Progress");
                                }
                                if(data.progress[0].test_visual_actuity_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '60').css('width', '60%');
                                    $("#progressbar").html("60% Progress");
                                }
                                if(data.progress[0].test_metabolic_neurological_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '80').css('width', '80%');
                                    $("#progressbar").html("80% Progress");
                                }
                                if(data.progress[0].is_final == 1){
                                    $('#progressbar').attr('aria-valuenow', '90').css('width', '90%');
                                    $("#progressbar").html("90% Progress");
                                }

                                toastr['success'](data.message, 'Next Step', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
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

        $(horizontalWizard).find('#next_2').on('click', function () {
            var save_physical_trans_form = $('#save_physical_trans_form')
            save_physical_trans_form.validate({
                rules: {
                    trans_no: {
                        required: true
                    },
                    height: {
                        required: true,
                        maxlength: 4,
                        min: 54,
                        max: 300
                    },
                    weight: {
                        required: true,
                        maxlength: 4,
                        min: 20,
                        max: 600
                    },
                    bmi: {
                        required: true
                    },
                    mm: {
                        required: true,
                        maxlength: 4,
                        min: 30,
                        max: 400
                    },
                    hg: {
                        required: true,
                        maxlength: 4,
                        min: 30,
                        max: 400
                    },
                    body_temperature: {
                        required: true,
                        maxlength: 4,
                        max:  40,
                        min: 35
                    },
                    pulse_rate: {
                        required: true,
                        maxlength: 3,
                        min: 60,
                        max: 200
                    },
                    respiratory_rate: {
                        required: true,
                        maxlength: 6
                    },
                    blood_type: {
                        required: true
                    },
                    upper_extremities_left: {
                        required: true,
                    },
                    upper_extremities_right: {
                        required: true
                    },
                    lower_extremities_left: {
                        required: true
                    },
                    lower_extremities_right: {
                        required: true
                    },
                    disability: {
                        required: true
                    },
                    txtdisability: {
                        required: function() {
                           
                            if($('input:radio[name="disability"]:checked').val() == "WithDisability"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    disease: {
                        required: true
                    },
                    txtdisease: {
                        required: function() {
                           
                            if($('input:radio[name="disease"]:checked').val() == "with_disease"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    }
                },
            });
            if (save_physical_trans_form.valid()) {
                    $("#loader").removeClass("hidden",function () {
                        $("#loader").fadeIn(500);
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: "save_physical_trans",
                        data: save_physical_trans_form.serialize(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            // console.log(data);
                            if (data.status == "1") {

                                numberedStepper.next();

                                if(data.progress[0].test_created != null && data.progress[0].test_created != ''){
                                    $('#progressbar').attr('aria-valuenow', '20').css('width', '20%');
                                    $("#progressbar").html("20% Progress");
                                }
                                if(data.progress[0].test_physical_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '40').css('width', '40%');
                                    $("#progressbar").html("40% Progress");
                                }
                                if(data.progress[0].test_visual_actuity_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '60').css('width', '60%');
                                    $("#progressbar").html("60% Progress");
                                }
                                if(data.progress[0].test_metabolic_neurological_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '80').css('width', '80%');
                                    $("#progressbar").html("80% Progress");
                                }
                                if(data.progress[0].is_final == 1){
                                    $('#progressbar').attr('aria-valuenow', '90').css('width', '90%');
                                    $("#progressbar").html("90% Progress");
                                }

                                toastr['success'](data.message, 'Next Step', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
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
        });

        $(horizontalWizard).find('#next_3').on('click', function () {
            var save_visual_hearing_trans_form = $('#save_visual_hearing_trans_form')
            save_visual_hearing_trans_form.validate({
                rules: {
                    trans_no: {
                        required: true
                    },
                    eye_color: {
                        required: true
                    },
                    snellen_bailey_lovie_left: {
                        required: true
                    },
                    snellen_bailey_lovie_right: {
                        required: true
                    },
                    corrective_lens_left: {
                        required: true
                    },
                    corrective_lens_right: {
                        required: true
                    },
                    color_blind_left: {
                        required: true
                    },
                    glare_contrast_sensitivity_without_lense_right: {
                        required: true
                    },
                    glare_contrast_sensitivity_without_lense_left: {
                        required: true
                    },
                    glare_contrast_sensitivity_with_corrective_right: {
                        required: true
                    },
                    glare_contrast_sensitivity_with_corrective_left: {
                        required: true
                    },
                    color_blind_test: {
                        required: true
                    },
                    examination_suggested: {
                        required: true
                    },
                    eye_injury: {
                        required: true
                    },
                    hearing_left: {
                        required: true
                    },
                    hearing_right: {
                        required: true
                    }            
                },
            });
            if (save_visual_hearing_trans_form.valid()) {
                    $("#loader").removeClass("hidden",function () {
                        $("#loader").fadeIn(500);
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: "save_visual_hearing_trans",
                        data: save_visual_hearing_trans_form.serialize(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            // console.log(data);
                            if (data.status == "1") {

                                numberedStepper.next();

                                if(data.progress[0].test_created != null && data.progress[0].test_created != ''){
                                    $('#progressbar').attr('aria-valuenow', '20').css('width', '20%');
                                    $("#progressbar").html("20% Progress");
                                }
                                if(data.progress[0].test_physical_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '40').css('width', '40%');
                                    $("#progressbar").html("40% Progress");
                                }
                                if(data.progress[0].test_visual_actuity_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '60').css('width', '60%');
                                    $("#progressbar").html("60% Progress");
                                }
                                if(data.progress[0].test_metabolic_neurological_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '80').css('width', '80%');
                                    $("#progressbar").html("80% Progress");
                                }
                                if(data.progress[0].is_final == 1){
                                    $('#progressbar').attr('aria-valuenow', '90').css('width', '90%');
                                    $("#progressbar").html("90% Progress");
                                }

                                toastr['success'](data.message, 'Next Step', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
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
        });

        $(horizontalWizard).find('#next_4').on('click', function () {
            var save_metabolic_neurological_exam_form = $('#save_metabolic_neurological_exam_form')
            save_metabolic_neurological_exam_form.validate({
                rules: {
                    trans_no: {
                        required: true
                    },
                    epilepsy: {
                        required: true
                    },
                    epilepsy_treatment: {
                        required: function() {       
                            if($('input:radio[name="epilepsy"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    txt_epilepsy_treatment: {
                        required: function() {           
                            if($('input:radio[name="epilepsy_treatment"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    last_seizure: {
                        required: function() {           
                            if($('input:radio[name="epilepsy"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    diabetes: {
                        required: true
                    },
                    diabetes_treatment: {
                        required: function() {           
                            if($('input:radio[name="diabetes"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    txt_diabetes_treatment: {
                        required: function() {           
                            if($('input:radio[name="diabetes_treatment"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    sleepapnea: {
                        required: true
                    },
                    sleepapnea_treatment: {
                        required: function() {           
                            if($('input:radio[name="sleepapnea"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    txt_sleepapnea_treatment: {
                        required: function() {           
                            if($('input:radio[name="sleepapnea_treatment"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    mental: {
                        required: true
                    },
                    mental_treatment: {
                        required: function() {           
                            if($('input:radio[name="mental"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    txt_mental_treatment: {
                        required: function() {           
                            if($('input:radio[name="mental_treatment"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    other: {
                        required: true
                    },
                    other_medical_condition: {
                        required: function() {           
                            if($('input:radio[name="other"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    other_treatment: {
                        required: function() {           
                            if($('input:radio[name="other"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    txt_other_treatment: {
                        required: function() {           
                            if($('input:radio[name="other_treatment"]:checked').val() == "1"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    
                },
            });
            if (save_metabolic_neurological_exam_form.valid()) {
                    $("#loader").removeClass("hidden",function () {
                        $("#loader").fadeIn(500);
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: "save_metabolic_neurological_trans",
                        data: save_metabolic_neurological_exam_form.serialize(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            // console.log(data);
                            if (data.status == "1") {

                                numberedStepper.next();

                                if(data.progress[0].test_created != null && data.progress[0].test_created != ''){
                                    $('#progressbar').attr('aria-valuenow', '20').css('width', '20%');
                                    $("#progressbar").html("20% Progress");
                                }
                                if(data.progress[0].test_physical_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '40').css('width', '40%');
                                    $("#progressbar").html("40% Progress");
                                }
                                if(data.progress[0].test_visual_actuity_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '60').css('width', '60%');
                                    $("#progressbar").html("60% Progress");
                                }
                                if(data.progress[0].test_metabolic_neurological_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '80').css('width', '80%');
                                    $("#progressbar").html("80% Progress");
                                }
                                if(data.progress[0].is_final == 1){
                                    $('#progressbar').attr('aria-valuenow', '90').css('width', '90%');
                                    $("#progressbar").html("90% Progress");
                                }

                                toastr['success'](data.message, 'Next Step', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
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
        });

        // $(horizontalWizard).find('#next_5').on('click', function () {
        //     var health_history_form = $('#health_history_form')
        //     health_history_form.validate({
        //         rules: {
        //             trans_no: {
        //                 required: true
        //             },
        //             head_neck_spinal_injury_disorders: {
        //                 required: true
        //             },
        //             head_neck_spinal_injury_disorders_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="head_neck_spinal_injury_disorders"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             seizure_convulsions: {
        //                 required: true
        //             },
        //             seizure_convulsions_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="seizure_convulsions"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             dizziness_fainting: {
        //                 required: true
        //             },
        //             dizziness_fainting_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="dizziness_fainting"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             eye_problem: {
        //                 required: true
        //             },
        //             eye_problem_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="eye_problem"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             hearing: {
        //                 required: true
        //             },
        //             hearing_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="hearing"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             hypertension: {
        //                 required: true
        //             },
        //             hypertension_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="hypertension"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             heart_attack_stroke: {
        //                 required: true
        //             },
        //             heart_attack_stroke_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="heart_attack_stroke"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             lung_disease: {
        //                 required: true
        //             },
        //             lung_disease_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="lung_disease"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             hyper_acidity_ulcer: {
        //                 required: true
        //             },
        //             hyper_acidity_ulcer_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="hyper_acidity_ulcer"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             diabetes_: {
        //                 required: true
        //             },
        //             diabetes_remarks_: {
        //                 required: function() {       
        //                     if($('input:radio[name="diabetes_"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             kidney_disease_stones_blood_in_urine: {
        //                 required: true
        //             },
        //             kidney_disease_stones_blood_in_urine_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="kidney_disease_stones_blood_in_urine"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             muscular_disease: {
        //                 required: true
        //             },
        //             muscular_disease_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="muscular_disease"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             sleep_disorders_sleep_apnea: {
        //                 required: true
        //             },
        //             sleep_disorders_sleep_apnea_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="sleep_disorders_sleep_apnea"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             nervous_psychiatric: {
        //                 required: true
        //             },
        //             nervous_psychiatric_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="nervous_psychiatric"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             anger_management_issues: {
        //                 required: true
        //             },
        //             anger_management_issues_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="anger_management_issues"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             regular_frequent_alcohol_drug: {
        //                 required: true
        //             },
        //             regular_frequent_alcohol_drug_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="regular_frequent_alcohol_drug"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             involved_mv_accident_while_driving: {
        //                 required: true
        //             },
        //             involved_mv_accident_while_driving_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="involved_mv_accident_while_driving"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             any_major_illness_injury_operation: {
        //                 required: true
        //             },
        //             any_major_illness_injury_operation_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="any_major_illness_injury_operation"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             any_permanent_impairment: {
        //                 required: true
        //             },
        //             any_permanent_impairment_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="any_permanent_impairment"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             other_disorders: {
        //                 required: true
        //             },
        //             other_disorders_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="other_disorders"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             presently_experiencing_need_medical_attention: {
        //                 required: true
        //             },
        //             presently_experiencing_need_medical_attention_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="presently_experiencing_need_medical_attention"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             hospitalized_last_five_years: {
        //                 required: true
        //             },
        //             hospitalized_last_five_years_remarks: {
        //                 required: function() {       
        //                     if($('input:radio[name="hospitalized_last_five_years"]:checked').val() == "1"){
        //                         return true
        //                     }
        //                     else{
        //                         return false
        //                     }
        //                 }
        //             },
        //             often_physician: {
        //                 required: true
        //             },
        //             date_last_examination_physician: {
        //                 required: true
        //             },
                    
        //         },
        //     });
        //     if (health_history_form.valid()) {
        //             $("#loader").removeClass("hidden",function () {
        //                 $("#loader").fadeIn(500);
        //             });
        //             $.ajax({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 method: "POST",
        //                 url: "save_health_history_trans",
        //                 data: health_history_form.serialize(),
        //                 success:function(data)
        //                 {
        //                     $("#loader").addClass("hidden", function() {
        //                         $("#loader").fadeOut(500);
        //                     });
        //                     // console.log(data);
        //                     if (data.status == "1") {
        //                         numberedStepper.next();

        //                         toastr['success'](data.message, 'Next Step', {
        //                             closeButton: true,
        //                             tapToDismiss: false,
        //                             rtl: isRtl
        //                         });
        //                     } else {
        //                         toastr['error'](data.message, 'Error', {
        //                             closeButton: true,
        //                             tapToDismiss: false,
        //                             rtl: isRtl
        //                         });
        //                     }
        //                 },
        //                 error: function(xhr, status, error){
        //                     var errorMessage = xhr.status + ': ' + xhr.statusText;
        //                     $("#loader").addClass("hidden", function() {
        //                         $("#loader").fadeOut(500);
        //                     });
        //                     if(xhr.status == 500){
        //                         toastr['error']('There was a problem connecting to the server.', 'Error', {
        //                             closeButton: true,
        //                             tapToDismiss: false,
        //                             rtl: isRtl
        //                         });
        //                     }
        //                     else if(xhr.status == 0){
        //                         toastr['error']('Not Connected. Please verify your network connection.', 'Error', {
        //                             closeButton: true,
        //                             tapToDismiss: false,
        //                             rtl: isRtl
        //                         });
                
        //                     }else{
        //                         toastr['error'](errorMessage, 'Error', {
        //                             closeButton: true,
        //                             tapToDismiss: false,
        //                             rtl: isRtl
        //                         });
        //                     }
        //                 }
        //             });
        //     }
        // });

        $(horizontalWizard).find('#next_6').on('click', function () {
            var save_assessment_condition_form = $('#save_assessment_condition_form');
            data_condition  = document.querySelectorAll('input[name="conditions"]:checked')
            var ConditionOutput= [];
            data_condition.forEach((checkboxValues) => {
                ConditionOutput.push(checkboxValues.value);
            })    
            save_assessment_condition_form.validate({
                rules: {
                    assessment: {
                        required: true
                    },
                    assessment_status: {
                        required: function() {       
                            if($('input:radio[name="assessment"]:checked').val() == "Unfit"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    assessment_temporary_duration: {
                        required: function() {       
                            if($('input:radio[name="assessment_status"]:checked').val() == "Temporary"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                   
                    conditions: {
                        required: function() {       
                            if($('input:radio[name="assessment"]:checked').val() == "Fit"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    remarks: {
                        required: true,
                        maxlength:100
                    }
                },
            });
            if (save_assessment_condition_form.valid()) {
                    $("#loader").removeClass("hidden",function () {
                        $("#loader").fadeIn(500);
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: "save_assessment_condition_trans",
                        data: save_assessment_condition_form.serialize()+"&ConditionOutput="+ConditionOutput.toString(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            // console.log(data);
                            if (data.status == "1") {

                                if(data.progress[0].test_created != null && data.progress[0].test_created != ''){
                                    $('#progressbar').attr('aria-valuenow', '20').css('width', '20%');
                                    $("#progressbar").html("20% Progress");
                                }
                                if(data.progress[0].test_physical_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '40').css('width', '40%');
                                    $("#progressbar").html("40% Progress");
                                }
                                if(data.progress[0].test_visual_actuity_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '60').css('width', '60%');
                                    $("#progressbar").html("60% Progress");
                                }
                                if(data.progress[0].test_metabolic_neurological_completed == 1){
                                    $('#progressbar').attr('aria-valuenow', '80').css('width', '80%');
                                    $("#progressbar").html("80% Progress");
                                }
                                if(data.progress[0].is_final == 1){
                                    $('#progressbar').attr('aria-valuenow', '90').css('width', '90%');
                                    $("#progressbar").html("90% Progress");
                                }

                                reviewData();
                                toastr['success'](data.message, 'Next Step', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
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
          
        });

        $(horizontalWizard).find('.btn-prev').on('click', function () {
            numberedStepper.previous();
        });
      }

    
    function clientData(){
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        var _trans_no = $('#trans_no').val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "get_client_data",
            data: {
                trans_no: _trans_no,
            },
            success:function(data)
            {     
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                if (data.status == "1") {
                    
                    if(data.progress[0].test_created != null && data.progress[0].test_created != ''){
                        $('#progressbar').attr('aria-valuenow', '20').css('width', '20%');
                        $("#progressbar").html("20% Progress");
                    }
                    if(data.progress[0].test_physical_completed == 1){
                        $('#progressbar').attr('aria-valuenow', '40').css('width', '40%');
                        $("#progressbar").html("40% Progress");
                    }
                    if(data.progress[0].test_visual_actuity_completed == 1){
                        $('#progressbar').attr('aria-valuenow', '60').css('width', '60%');
                        $("#progressbar").html("60% Progress");
                    }
                    if(data.progress[0].test_metabolic_neurological_completed == 1){
                        $('#progressbar').attr('aria-valuenow', '80').css('width', '80%');
                        $("#progressbar").html("80% Progress");
                    }
                    if(data.progress[0].is_final == 1){
                        $('#progressbar').attr('aria-valuenow', '90').css('width', '90%');
                        $("#progressbar").html("90% Progress");
                    }

                    $('#firstname').val(data.data_scratch[0].first_name);
                    $('#picture_1').attr('src', data.data_scratch[0].id_picture);
                    $('#middlename').val(data.data_scratch[0].middle_name);
                    $('#base_64').val(data.data_scratch[0].id_picture);
                    $('#lastname').val(data.data_scratch[0].last_name);
                    $('#address').val(data.data_scratch[0].address_full);
                    $('#birthday').val(data.data_scratch[0].birthday);
                    age();
                    $("#nationality").val(data.data_scratch[0].nationality).change();
                    $("#nationality").val(data.data_scratch[0].nationality);
                    $("#gender").val(data.data_scratch[0].gender).change();
                    $("#gender").val(data.data_scratch[0].gender);
                    $("#civilstatus").val(data.data_scratch[0].civil_status).change();
                    $("#civilstatus").val(data.data_scratch[0].civil_status);
                    $('#occupation').val(data.data_scratch[0].occupation);
                    // $("#licenseType").val(data.data_scratch[0].license_type).change();
                    // $("#licenseType").val(data.data_scratch[0].license_type);
                    // $("#newRenewal").val(data.data_scratch[0].new_renew).change();
                    // $("#newRenewal").val(data.data_scratch[0].new_renew);
                    $('#license_no').val(data.data_scratch[0].license_no);
                    $("#purpose").val(data.data_scratch[0].purpose).change();
                    $("#purpose").val(data.data_scratch[0].purpose);
                    
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
    function age(){
        var bdate = $("#birthday").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            method: "GET",
            url: "age/"+bdate,
            success:function(data)
            {
                // console.log(data);
                var _json = JSON.stringify(data);
                var _object = JSON.parse(_json);
                if (data.status == "1") {
                    $('#age').val(data.age);
                } else {
                    toastr['error']('There was an error', 'Error', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                }
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
    }
    function clientphysicalexamData(){
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        var _trans_no = $('#trans_no').val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "get_client_data",
            data: {
                trans_no: _trans_no,
            },
            success:function(data)
            {     
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                if (data.status == "1") {

                    $('#height').val(data.data_scratch[0].pt_height);
                    $('#weight').val(data.data_scratch[0].pt_weight);
                    $('#bmi').val(data.data_scratch[0].pt_bmi);

                    var myblood_pressure = data.data_scratch[0].pt_blood_pressure.split("/");
                    $('#mm').val(myblood_pressure[0]);
                    $('#hg').val(myblood_pressure[1]);

                    var mybody_temperature = data.data_scratch[0].pt_body_temperature.split("°");
                    $('#body_temperature').val(mybody_temperature[0]);

                    $('#pulse_rate').val(data.data_scratch[0].pt_pulse_rate);
                    $('#respiratory_rate').val(data.data_scratch[0].pt_respiratory_rate);

                    $("#blood_type").val(data.data_scratch[0].blood_type).change();
                    $("#disability").val(data.data_scratch[0].pt_general_physique).change();
                    $("#disease").val(data.data_scratch[0].pt_contagious_disease).change();
                    $("#upper_extremities_left").val(data.data_scratch[0].pt_ue_normal_left).change();
                    $("#upper_extremities_right").val(data.data_scratch[0].pt_ue_normal_right).change();
                    $("#lower_extremities_left").val(data.data_scratch[0].pt_le_normal_left).change();
                    $("#lower_extremities_right").val(data.data_scratch[0].pt_le_normal_right).change();

                    $("#blood_type").val(data.data_scratch[0].blood_type);
                    $("#disability").val(data.data_scratch[0].pt_general_physique);
                    $("#disease").val(data.data_scratch[0].pt_contagious_disease);
                    $("#upper_extremities_left").val(data.data_scratch[0].pt_ue_normal_left);
                    $("#upper_extremities_right").val(data.data_scratch[0].pt_ue_normal_right);
                    $("#lower_extremities_left").val(data.data_scratch[0].pt_le_normal_left);
                    $("#lower_extremities_right").val(data.data_scratch[0].pt_le_normal_right);

                    if(data.data_scratch[0].pt_general_physique == "normal"){
                        $("input[name=disability][value='normal']").prop("checked",true);
                        $('#txtdisability').addClass('hidden');
                    }
                    else{
                        $("input[name=disability][value='WithDisability']").prop("checked",true);
                        $('#txtdisability').val(data.data_scratch[0].pt_general_physique);
                        $('#txtdisability').removeClass('hidden');
                    }

                    if(data.data_scratch[0].pt_contagious_disease == "none"){
                        $("input[name=disease][value='none']").prop("checked",true);
                        $('#txtdisease').addClass('hidden');
                    }
                    else{
                        $("input[name=disease][value='with_disease']").prop("checked",true);
                        $('#txtdisease').val(data.data_scratch[0].pt_contagious_disease);
                        $('#txtdisease').removeClass('hidden');
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
    function clientvisualauditoryexamData(){
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        var _trans_no = $('#trans_no').val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "get_client_data",
            data: {
                trans_no: _trans_no,
            },
            success:function(data)
            {     
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                if (data.status == "1") {

                    $("#eye_color").val(data.data_scratch[0].pt_eye_color).change();
                    $("#eye_color").val(data.data_scratch[0].pt_eye_color);

                    $('#snellen_bailey_lovie_right').val(data.data_scratch[0].vt_snellen_bailey_lovie_right);
                    $('#snellen_bailey_lovie_left').val(data.data_scratch[0].vt_snellen_bailey_lovie_left);

                    if(data.data_scratch[0].vt_snellen_with_correct_left == "1"){
                        $("input[name=corrective_lens_left][value='1']").prop("checked",true);
                    }
                    else{
                        $("input[name=corrective_lens_left][value='0']").prop("checked",true);
                    }

                    if(data.data_scratch[0].vt_snellen_with_correct_right == "1"){
                        $("input[name=corrective_lens_right][value='1']").prop("checked",true);
                    }
                    else{
                        $("input[name=corrective_lens_right][value='0']").prop("checked",true);
                    }

                    if(data.data_scratch[0].vt_color_blind_left == "1"){
                        $("input[name=color_blind_left][value='1']").prop("checked",true);
                    }
                    else{
                        $("input[name=color_blind_left][value='0']").prop("checked",true);
                    }

                    if(data.data_scratch[0].vt_color_blind_right == "1"){
                        $("input[name=color_blind_right][value='1']").prop("checked",true);
                    }
                    else{
                        $("input[name=color_blind_right][value='0']").prop("checked",true);
                    }

                    $('#glare_contrast_sensitivity_without_lense_right').val(data.data_scratch[0].vt_glare_contrast_sensitivity_function_without_lenses_right);
                    $('#glare_contrast_sensitivity_without_lense_left').val(data.data_scratch[0].vt_glare_contrast_sensitivity_function_without_lenses_left);
                    $('#glare_contrast_sensitivity_with_corrective_right').val(data.data_scratch[0].vt_glare_contrast_sensitivity_function_with_corretive_lenses_le);
                    $('#glare_contrast_sensitivity_with_corrective_left').val(data.data_scratch[0].vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri);
                    $('#color_blind_test').val(data.data_scratch[0].vt_color_blind_test);
                    $('#eye_injury').val(data.data_scratch[0].vt_any_eye_injury_disease);

                    if(data.data_scratch[0].vt_further_examination == "YES"){
                        $("input[name=examination_suggested][value='YES']").prop("checked",true);
                    }
                    else{
                        $("input[name=examination_suggested][value='NO']").prop("checked",true);
                    }

                    $("#hearing_left").val(data.data_scratch[0].at_hearing_left).change();
                    $("#hearing_right").val(data.data_scratch[0].at_hearing_right).change();

                    $("#hearing_left").val(data.data_scratch[0].at_hearing_left);
                    $("#hearing_right").val(data.data_scratch[0].at_hearing_right);
                 
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
    function clientmetabolicandneurologicaexamData(){
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        var _trans_no = $('#trans_no').val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "get_client_data",
            data: {
                trans_no: _trans_no,
            },
            success:function(data)
            {     
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                if (data.status == "1") {
          
                    if(data.data_scratch[0].mn_epilepsy == "0"){
                        $("input[name=epilepsy][value='0']").prop("checked",true);
                        $('#div_epilepsy_treatment').addClass('hidden');
                        $('#div_last_seizure').addClass('hidden');
                    }
                    else{
                        $("input[name=epilepsy][value='1']").prop("checked",true);
                        $('#last_seizure').val(data.data_scratch[0].mn_last_seizure);
                        $('#div_last_seizure').removeClass('hidden');

                        $('#div_epilepsy_treatment').removeClass('hidden');
                        if(data.data_scratch[0].mn_epilepsy_treatment == "1"){
                            $("input[name=epilepsy_treatment][value='1']").prop("checked",true);
                            $('#txt_epilepsy_treatment').removeClass('hidden');
                            $('#txt_epilepsy_treatment').val(data.data_scratch[0].mn_epilepsy_remarks);
                        }
                        else{
                            $("input[name=epilepsy_treatment][value='0']").prop("checked",true);
                            $('#txt_epilepsy_treatment').addClass('hidden');
                            $('#txt_epilepsy_treatment').val(''); 
                        }
                    }                  

                    if(data.data_scratch[0].mn_diabetes == "0"){
                        $("input[name=diabetes][value='0']").prop("checked",true);
                        $('#div_diabetes_treatment').addClass('hidden');
                    }
                    else{
                        $("input[name=diabetes][value='1']").prop("checked",true);
                        $('#div_diabetes_treatment').removeClass('hidden');
                        if(data.data_scratch[0].mn_diabetes_treatment == "1"){
                            $("input[name=diabetes_treatment][value='1']").prop("checked",true);
                            $('#txt_diabetes_treatment').val(data.data_scratch[0].mn_diabetes_remarks);
                            $('#txt_diabetes_treatment').removeClass('hidden');
                        }
                        else{
                            $("input[name=diabetes_treatment][value='0']").prop("checked",true);
                            $('#txt_diabetes_treatment').val('');
                            $('#txt_diabetes_treatment').addClass('hidden');
                        }
                    }

                    if(data.data_scratch[0].mn_sleep_apnea == "0"){
                        $("input[name=sleepapnea][value='0']").prop("checked",true);
                        $('#div_sleepapnea_treatment').addClass('hidden');
                    }
                    else{
                        $("input[name=sleepapnea][value='1']").prop("checked",true);
                        $('#div_sleepapnea_treatment').removeClass('hidden');
                        if(data.data_scratch[0].mn_sleepapnea_treatment == "1"){
                            $("input[name=sleepapnea_treatment][value='1']").prop("checked",true);
                            $('#txt_sleepapnea_treatment').val(data.data_scratch[0].mn_sleep_apnea_remarks);
                            $('#txt_sleepapnea_treatment').removeClass('hidden');
                        }
                        else{
                            $("input[name=sleepapnea_treatment][value='0']").prop("checked",true);
                            $('#txt_sleepapnea_treatment').val('');
                            $('#txt_sleepapnea_treatment').addClass('hidden');
                        }
                    }

                    if(data.data_scratch[0].mn_aggressive_manic == "0"){
                        $("input[name=mental][value='0']").prop("checked",true);
                        $('#div_mental_treatment').addClass('hidden');
                    }
                    else{
                        $("input[name=mental][value='1']").prop("checked",true);
                        $('#div_mental_treatment').removeClass('hidden');
                        if(data.data_scratch[0].mn_mental_treatment == "1"){
                            $("input[name=mental_treatment][value='1']").prop("checked",true);
                            $('#txt_mental_treatment').val(data.data_scratch[0].mn_aggresive_manic_remarks);
                            $('#txt_mental_treatment').removeClass('hidden');
                        }
                        else{
                            $("input[name=mental_treatment][value='0']").prop("checked",true);
                            $('#txt_mental_treatment').val('');
                            $('#txt_mental_treatment').addClass('hidden');
                        }
                    }

                    if(data.data_scratch[0].mn_others == "1"){
                        $("input[name=other][value='1']").prop("checked",true);
                        $('#other_medical_condition').val(data.data_scratch[0].mn_other_medical_condition);
                        $('#other_medical_condition').removeClass('hidden');

                        $('#div_other_treatment').removeClass('hidden');
                        if(data.data_scratch[0].mn_other_treatment == "1"){
                            $("input[name=other_treatment][value='1']").prop("checked",true);
                            $('#txt_other_treatment').val(data.data_scratch[0].mn_other_medical_condition_remarks);
                            $('#txt_other_treatment').removeClass('hidden');
                            
                        }
                        else{
                            $("input[name=other_treatment][value='0']").prop("checked",true);
                            $('#txt_other_treatment').val('');
                            $('#txt_other_treatment').addClass('hidden');
                        }
                    }
                    else{
                        $("input[name=other][value='0']").prop("checked",true);
                        $('#other_medical_condition').addClass('hidden');
                        $('#div_other_treatment').addClass('hidden');
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
    // function clienthealthhistorydata(){
    //     $("#loader").removeClass("hidden",function () {
    //         $("#loader").fadeIn(500);
    //     });
        
    //     var _trans_no = $('#trans_no').val()
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         method: "POST",
    //         url: "get_client_data",
    //         data: {
    //             trans_no: _trans_no,
    //         },
    //         success:function(data)
    //         {     
    //             $("#loader").addClass("hidden", function() {
    //                 $("#loader").fadeOut(500);
    //             });
    //             if (data.status == "1") {

    //                 if(data.data_scratch2[0].qu_head_neck_spinal_injury_disorders == "0"){
    //                     $("input[name=head_neck_spinal_injury_disorders][value='0']").prop("checked",true);
    //                     $('#head_neck_spinal_injury_disorders_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=head_neck_spinal_injury_disorders][value='1']").prop("checked",true);
    //                     $('#head_neck_spinal_injury_disorders_remarks').removeClass('hidden');
    //                     $('#head_neck_spinal_injury_disorders_remarks').val(data.data_scratch2[0].qu_head_neck_spinal_injury_disorders_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_seizure_convulsions == "0"){
    //                     $("input[name=seizure_convulsions][value='0']").prop("checked",true);
    //                     $('#seizure_convulsions_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=seizure_convulsions][value='1']").prop("checked",true);
    //                     $('#seizure_convulsions_remarks').removeClass('hidden');
    //                     $('#seizure_convulsions_remarks').val(data.data_scratch2[0].qu_seizure_convulsions_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_dizziness_fainting == "0"){
    //                     $("input[name=dizziness_fainting][value='0']").prop("checked",true);
    //                     $('#dizziness_fainting_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=dizziness_fainting][value='1']").prop("checked",true);
    //                     $('#dizziness_fainting_remarks').removeClass('hidden');
    //                     $('#dizziness_fainting_remarks').val(data.data_scratch2[0].qu_dizziness_fainting_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_eye_problem == "0"){
    //                     $("input[name=eye_problem][value='0']").prop("checked",true);
    //                     $('#eye_problem_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=eye_problem][value='1']").prop("checked",true);
    //                     $('#eye_problem_remarks').removeClass('hidden');
    //                     $('#eye_problem_remarks').val(data.data_scratch2[0].qu_eye_problem_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_hearing == "0"){
    //                     $("input[name=hearing][value='0']").prop("checked",true);
    //                     $('#hearing_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=hearing][value='1']").prop("checked",true);
    //                     $('#hearing_remarks').removeClass('hidden');
    //                     $('#hearing_remarks').val(data.data_scratch2[0].qu_hearing_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_hypertension == "0"){
    //                     $("input[name=hypertension][value='0']").prop("checked",true);
    //                     $('#hypertension_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=hypertension][value='1']").prop("checked",true);
    //                     $('#hypertension_remarks').removeClass('hidden');
    //                     $('#hypertension_remarks').val(data.data_scratch2[0].qu_hypertension_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_heart_attack_stroke == "0"){
    //                     $("input[name=heart_attack_stroke][value='0']").prop("checked",true);
    //                     $('#hearing_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=heart_attack_stroke][value='1']").prop("checked",true);
    //                     $('#heart_attack_stroke_remarks').removeClass('hidden');
    //                     $('#heart_attack_stroke_remarks').val(data.data_scratch2[0].qu_heart_attack_stroke_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_lung_disease == "0"){
    //                     $("input[name=lung_disease][value='0']").prop("checked",true);
    //                     $('#lung_disease_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=lung_disease][value='1']").prop("checked",true);
    //                     $('#lung_disease_remarks').removeClass('hidden');
    //                     $('#lung_disease_remarks').val(data.data_scratch2[0].qu_lung_disease_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_hyper_acidity_ulcer == "0"){
    //                     $("input[name=hyper_acidity_ulcer][value='0']").prop("checked",true);
    //                     $('#hyper_acidity_ulcer_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=hyper_acidity_ulcer][value='1']").prop("checked",true);
    //                     $('#hyper_acidity_ulcer_remarks').removeClass('hidden');
    //                     $('#hyper_acidity_ulcer_remarks').val(data.data_scratch2[0].qu_hyper_acidity_ulcer_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_diabetes == "0"){
    //                     $("input[name=diabetes_][value='0']").prop("checked",true);
    //                     $('#diabetes_remarks_').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=diabetes_][value='1']").prop("checked",true);
    //                     $('#diabetes_remarks_').removeClass('hidden');
    //                     $('#diabetes_remarks_').val(data.data_scratch2[0].qu_diabetes_remarks);
    //                 }
                    
    //                 if(data.data_scratch2[0].qu_kidney_disease_stones_blood_in_urine == "0"){
    //                     $("input[name=kidney_disease_stones_blood_in_urine][value='0']").prop("checked",true);
    //                     $('#kidney_disease_stones_blood_in_urine_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=kidney_disease_stones_blood_in_urine][value='1']").prop("checked",true);
    //                     $('#kidney_disease_stones_blood_in_urine_remarks').removeClass('hidden');
    //                     $('#kidney_disease_stones_blood_in_urine_remarks').val(data.data_scratch2[0].qu_kidney_disease_stones_blood_in_urine_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_muscular_disease == "0"){
    //                     $("input[name=muscular_disease][value='0']").prop("checked",true);
    //                     $('#muscular_disease_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=muscular_disease][value='1']").prop("checked",true);
    //                     $('#muscular_disease_remarks').removeClass('hidden');
    //                     $('#muscular_disease_remarks').val(data.data_scratch2[0].qu_muscular_disease_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_sleep_disorders_sleep_apnea == "0"){
    //                     $("input[name=sleep_disorders_sleep_apnea][value='0']").prop("checked",true);
    //                     $('#sleep_disorders_sleep_apnea_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=sleep_disorders_sleep_apnea][value='1']").prop("checked",true);
    //                     $('#sleep_disorders_sleep_apnea_remarks').removeClass('hidden');
    //                     $('#sleep_disorders_sleep_apnea_remarks').val(data.data_scratch2[0].qu_sleep_disorders_sleep_apnea_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_nervous_psychiatric == "0"){
    //                     $("input[name=nervous_psychiatric][value='0']").prop("checked",true);
    //                     $('#nervous_psychiatric_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=nervous_psychiatric][value='1']").prop("checked",true);
    //                     $('#nervous_psychiatric_remarks').removeClass('hidden');
    //                     $('#nervous_psychiatric_remarks').val(data.data_scratch2[0].qu_nervous_psychiatric_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_anger_management_issues == "0"){
    //                     $("input[name=anger_management_issues][value='0']").prop("checked",true);
    //                     $('#anger_management_issues_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=anger_management_issues][value='1']").prop("checked",true);
    //                     $('#anger_management_issues_remarks').removeClass('hidden');
    //                     $('#anger_management_issues_remarks').val(data.data_scratch2[0].anger_management_issues_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_regular_frequent_alcohol_drug == "0"){
    //                     $("input[name=regular_frequent_alcohol_drug][value='0']").prop("checked",true);
    //                     $('#regular_frequent_alcohol_drug_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=regular_frequent_alcohol_drug][value='1']").prop("checked",true);
    //                     $('#regular_frequent_alcohol_drug_remarks').removeClass('hidden');
    //                     $('#regular_frequent_alcohol_drug_remarks').val(data.data_scratch2[0].qu_regular_frequent_alcohol_drug_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_involved_mv_accident_while_driving == "0"){
    //                     $("input[name=involved_mv_accident_while_driving][value='0']").prop("checked",true);
    //                     $('#involved_mv_accident_while_driving_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=involved_mv_accident_while_driving][value='1']").prop("checked",true);
    //                     $('#involved_mv_accident_while_driving_remarks').removeClass('hidden');
    //                     $('#involved_mv_accident_while_driving_remarks').val(data.data_scratch2[0].qu_involved_mv_accident_while_driving_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_any_major_illness_injury_operation == "0"){
    //                     $("input[name=any_major_illness_injury_operation][value='0']").prop("checked",true);
    //                     $('#any_major_illness_injury_operation_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=any_major_illness_injury_operation][value='1']").prop("checked",true);
    //                     $('#any_major_illness_injury_operation_remarks').removeClass('hidden');
    //                     $('#any_major_illness_injury_operation_remarks').val(data.data_scratch2[0].qu_any_major_illness_injury_operation_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_any_permanent_impairment == "0"){
    //                     $("input[name=any_permanent_impairment][value='0']").prop("checked",true);
    //                     $('#any_permanent_impairment_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=any_permanent_impairment][value='1']").prop("checked",true);
    //                     $('#any_permanent_impairment_remarks').removeClass('hidden');
    //                     $('#any_permanent_impairment_remarks').val(data.data_scratch2[0].qu_any_permanent_impairment_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_other_disorders == "0"){
    //                     $("input[name=other_disorders][value='0']").prop("checked",true);
    //                     $('#other_disorders_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=other_disorders][value='1']").prop("checked",true);
    //                     $('#other_disorders_remarks').removeClass('hidden');
    //                     $('#other_disorders_remarks').val(data.data_scratch2[0].qu_other_disorders_remarks);
    //                 }
    //                 //----------------------------------------------------------------------------------------------//
    //                 if(data.data_scratch2[0].qu_presently_experiencing_need_medical_attention == "0"){
    //                     $("input[name=presently_experiencing_need_medical_attention][value='0']").prop("checked",true);
    //                     $('#presently_experiencing_need_medical_attention_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=presently_experiencing_need_medical_attention][value='1']").prop("checked",true);
    //                     $('#presently_experiencing_need_medical_attention_remarks').removeClass('hidden');
    //                     $('#presently_experiencing_need_medical_attention_remarks').val(data.data_scratch2[0].qu_presently_experiencing_need_medical_attention_remarks);
    //                 }

    //                 if(data.data_scratch2[0].qu_hospitalized_last_five_years == "0"){
    //                     $("input[name=hospitalized_last_five_years][value='0']").prop("checked",true);
    //                     $('#hospitalized_last_five_years_remarks').addClass('hidden');
    //                 }
    //                 else{
    //                     $("input[name=hospitalized_last_five_years][value='1']").prop("checked",true);
    //                     $('#hospitalized_last_five_years_remarks').removeClass('hidden');
    //                     $('#hospitalized_last_five_years_remarks').val(data.data_scratch2[0].qu_hospitalized_last_five_years_remarks);
    //                 }
    //                 $('#often_physician').val(data.data_scratch2[0].qu_often_physician_remarks);
    //                 $('#date_last_examination_physician').val(data.data_scratch2[0].qu_date_last_examination_physician_remarks);
    //                 $('#date_last_confinement').val(data.data_scratch2[0].qu_date_last_confinement_remarks);

    //              } else {
    //                 toastr['error'](data.message, 'Error', {
    //                     closeButton: true,
    //                     tapToDismiss: false,
    //                     rtl: isRtl
    //                 });
    //             }
    //         },
    //         error: function(xhr, status, error){
    //             var errorMessage = xhr.status + ': ' + xhr.statusText;
    //             $("#loader").addClass("hidden", function() {
    //                 $("#loader").fadeOut(500);
    //             });
    //             if(xhr.status == 500){
    //                 toastr['error']('There was a problem connecting to the server.', 'Error', {
    //                     closeButton: true,
    //                     tapToDismiss: false,
    //                     rtl: isRtl
    //                 });
    //             }
    //             else if(xhr.status == 0){
    //                 toastr['error']('Not Connected. Please verify your network connection.', 'Error', {
    //                     closeButton: true,
    //                     tapToDismiss: false,
    //                     rtl: isRtl
    //                 });
                    
    //             }else{
    //                 toastr['error'](errorMessage, 'Error', {
    //                     closeButton: true,
    //                     tapToDismiss: false,
    //                     rtl: isRtl
    //                 });
    //             }
    //         }
    //     });
    // }
    function clientassessmentconditionData(){
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        var _trans_no = $('#trans_no').val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "get_client_data",
            data: {
                trans_no: _trans_no,
            },
            success:function(data)
            {     
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                if (data.status == "1") {
          
                    if(data.data_scratch[0].exam_assessment == "Fit"){
                        $("input[name=assessment][value='Fit']").prop("checked",true);
                        $('#div_assessment_status').addClass('hidden');
                    }
                    else{
                        $("input[name=assessment][value='Unfit']").prop("checked",true);
                        $('#div_assessment_status').removeClass('hidden');

                        if(data.data_scratch[0].exam_assessment_remarks == "Temporary"){
                            $("input[name=assessment_status][value='Temporary']").prop("checked",true);
                        }                      
                        else if(data.data_scratch[0].exam_assessment_remarks == "Permanent"){
                            $("input[name=assessment_status][value='Permanent']").prop("checked",true);
                        }
                        else if(data.data_scratch[0].exam_assessment_remarks == "Refer"){
                            $("input[name=assessment_status][value='Refer']").prop("checked",true);
                        }                    
                    }
                    if(data.data_scratch[0].exam_conditions.includes("0")){
                        $("input[name=conditions][value='0']").prop("checked",true);
                    }
                    if(data.data_scratch[0].exam_conditions.includes("1")){
                        $("input[name=conditions][value='1']").prop("checked",true);
                    }
                    if(data.data_scratch[0].exam_conditions.includes("2")){
                        $("input[name=conditions][value='2']").prop("checked",true);
                    }
                    if(data.data_scratch[0].exam_conditions.includes("3")){
                        $("input[name=conditions][value='3']").prop("checked",true);
                    }
                    if(data.data_scratch[0].exam_conditions.includes("4")){
                        $("input[name=conditions][value='4']").prop("checked",true);
                    }
                    if(data.data_scratch[0].exam_conditions.includes("5")){
                        $("input[name=conditions][value='5']").prop("checked",true);
                    }

                    $('#remarks').val(data.data_scratch[0].pt_remarks);

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
    function reviewData(){
        var _trans_no = $('#trans_no').val()
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "Preview",
                data: {
                    trans_no: _trans_no,
                },
                success:function(data)
                {
                    // console.log(data);
                    if (data.status == "1") {
                        sessionStorage.setItem("trans_no", data.tb_scratch[0].trans_no); 
                        numberedStepper.next();
                        toastr['success'](data.message, 'Final Step', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                        $('#pv_firstname').html("<b>"+ data.tb_scratch[0].first_name+"</b>");
                        $('#pv_middlname').html("<b>"+ data.tb_scratch[0].middle_name+"</b>");
                        $('#pv_surname').html("<b>"+ data.tb_scratch[0].last_name+"</b>");                
                        $('#pv_address').html("<b>"+ data.tb_scratch[0].address_full+"</b>");
                        $('#pv_bday').html("<b>"+data.tb_scratch[0].birthday);
                        $('#picture_2').attr('src', data.tb_scratch[0].id_picture);
                        $('#pv_gender').html("<b>"+data.tb_scratch[0].gender);
                        $('#pv_nationality').html("<b>"+data.tb_scratch[0].nationality);
                        $('#pv_civil_status').html("<b>"+data.tb_scratch[0].civil_status);

                        $('#pv_occupation').html("<b>"+data.tb_scratch[0].occupation);
                        // $('#pv_license_type').html(data.tb_scratch[0].license_type);  
                        $('#pv_license_no').html("<b>"+data.tb_scratch[0].license_no);  
                        if(data.tb_scratch[0].purpose == '1'){
                            $('#pv_purpose').html("<b>"+"New Non-Pro Driver´s License"); 
                        }
                        else if(data.tb_scratch[0].purpose == '2'){
                            $('#pv_purpose').html("<b>"+"New Pro Driver´s License"); 
                        }
                        else if(data.tb_scratch[0].purpose == '3'){
                            $('#pv_purpose').html("<b>"+"Renewal of Non-Pro Driver´s License"); 
                        }
                        else if(data.tb_scratch[0].purpose == '4'){
                            $('#pv_purpose').html("<b>"+"Renewal of Pro Driver´s License"); 
                        }
                        else if(data.tb_scratch[0].purpose == '5'){
                            $('#pv_purpose').html("<b>"+"Renewal of Conductor´s License"); 
                        }
                        else if(data.tb_scratch[0].purpose == '6'){
                            $('#pv_purpose').html("<b>"+"Conversion from Non-Pro to Pro DL"); 
                        }
                        else if(data.tb_scratch[0].purpose == '7'){
                            $('#pv_purpose').html("<b>"+"New Non-Pro Driver´s License (with Foreign License)"); 
                        }
                        else if(data.tb_scratch[0].purpose == '8'){
                            $('#pv_purpose').html("<b>"+"New Pro Driver´s License (with Foreign License)"); 
                        }
                        else if(data.tb_scratch[0].purpose == '9'){
                            $('#pv_purpose').html("<b>"+"New Conductor´s License"); 
                        }
                        else if(data.tb_scratch[0].purpose == '10'){
                            $('#pv_purpose').html("<b>"+"New Student Permit"); 
                        }
                        else if(data.tb_scratch[0].purpose == '11'){
                            $('#pv_purpose').html("<b>"+"Conversion from Pro to Non-Pro DL"); 
                        }
                        else if(data.tb_scratch[0].purpose == '12'){
                            $('#pv_purpose').html("<b>"+"Add Restriction for Non-Pro Driver´s License"); 
                        }
                        else if(data.tb_scratch[0].purpose == '13'){
                            $('#pv_purpose').html("<b>"+"Add Restriction for Pro Driver´s License"); 
                        }
                        $('#pv_height').html("<b>"+data.tb_scratch[0].pt_height);  
                        $('#pv_weight').html("<b>"+data.tb_scratch[0].pt_weight);  
                        $('#pv_bmi').html("<b>"+data.tb_scratch[0].pt_bmi);
                        $('#pv_bloodpressure').html("<b>"+data.tb_scratch[0].pt_blood_pressure);
                        $('#pv_bodytemperature').html("<b>"+data.tb_scratch[0].pt_body_temperature);
                        $('#pv_respiratory_rate').html("<b>"+data.tb_scratch[0].pt_respiratory_rate);
                        $('#pv_pulserate').html("<b>"+data.tb_scratch[0].pt_pulse_rate);
                        $('#pv_bloodtype').html("<b>"+data.tb_scratch[0].blood_type);                    
                        $('#pv_generalphysique').html("<b>"+data.tb_scratch[0].pt_general_physique);
                        $('#pv_contagiousdisease').html("<b>"+data.tb_scratch[0].pt_contagious_disease);

                        if(data.tb_scratch[0].pt_ue_normal_left == '1'){
                            $('#pv_upperextremities_right').html("<b>"+"normal"); 
                        }
                        else if(data.tb_scratch[0].pt_ue_normal_left == '2'){
                            $('#pv_upperextremities_right').html("<b>"+"With Disability"); 
                        }  
                        else if(data.tb_scratch[0].pt_ue_normal_left == '3'){
                            $('#pv_upperextremities_right').html("<b>"+"With special equipment"); 
                        } 

                        if(data.tb_scratch[0].pt_ue_normal_right == '1'){
                            $('#pv_upperextremities_left').html("<b>"+"normal"); 
                        }
                        else if(data.tb_scratch[0].pt_ue_normal_right == '2'){
                            $('#pv_upperextremities_left').html("<b>"+"With Disability"); 
                        }  
                        else if(data.tb_scratch[0].pt_ue_normal_right == '3'){
                            $('#pv_upperextremities_left').html("<b>"+"With special equipment"); 
                        } 

                        if(data.tb_scratch[0].pt_le_normal_left == '1'){
                            $('#pv_lowerextremities_left').html("<b>"+"normal"); 
                        }
                        else if(data.tb_scratch[0].pt_le_normal_left == '2'){
                            $('#pv_lowerextremities_left').html("<b>"+"With Disability"); 
                        }  
                        else if(data.tb_scratch[0].pt_le_normal_left == '3'){
                            $('#pv_lowerextremities_left').html("<b>"+"With special equipment"); 
                        } 

                        if(data.tb_scratch[0].pt_le_normal_right == '1'){
                            $('#pv_lowerextremities_right').html("<b>"+"normal"); 
                        }
                        else if(data.tb_scratch[0].pt_le_normal_right == '2'){
                            $('#pv_lowerextremities_right').html("<b>"+"With Disability"); 
                        }  
                        else if(data.tb_scratch[0].pt_le_normal_right == '3'){
                            $('#pv_lowerextremities_right').html("<b>"+"With special equipment"); 
                        } 

                        if(data.tb_scratch[0].pt_eye_color == '1'){
                            $('#pv_eyecolor').html("<b>"+"black"); 
                        }
                        else if(data.tb_scratch[0].pt_eye_color == '2'){
                            $('#pv_eyecolor').html("<b>"+"brown"); 
                        }  
                        else if(data.tb_scratch[0].pt_eye_color == '3'){
                            $('#pv_eyecolor').html("<b>"+"other"); 
                        } 
                        else if(data.tb_scratch[0].pt_eye_color == '4'){
                            $('#pv_eyecolor').html("<b>"+"blue"); 
                        } 
                        $('#pv_snellen_bailey_lovie_left').html("<b>"+data.tb_scratch[0].vt_snellen_bailey_lovie_left);
                        $('#pv_snellen_bailey_lovie_right').html("<b>"+data.tb_scratch[0].vt_snellen_bailey_lovie_right);

                        if(data.tb_scratch[0].vt_snellen_with_correct_right == '1'){
                            $('#pv_snellen_with_correct_right').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].vt_snellen_with_correct_right == '0'){
                            $('#pv_snellen_with_correct_right').html("<b>"+"No"); 
                        }
                        
                        if(data.tb_scratch[0].vt_snellen_with_correct_left == '1'){
                            $('#pv_snellen_with_correct_left').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].vt_snellen_with_correct_left == '0'){
                            $('#pv_snellen_with_correct_left').html("<b>"+"No"); 
                        } 

                        if(data.tb_scratch[0].vt_color_blind_left == '1'){
                            $('#pv_color_blind_left').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].vt_color_blind_left == '0'){
                            $('#pv_color_blind_left').html("<b>"+"No"); 
                        } 

                        if(data.tb_scratch[0].vt_color_blind_right == '1'){
                            $('#pv_color_blind_right').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].vt_color_blind_right == '0'){
                            $('#pv_color_blind_right').html("<b>"+"No"); 
                        } 
                        
                        $('#pv_glare_contrast_sensitivity_without_lense_right').html("<b>"+data.tb_scratch[0].vt_glare_contrast_sensitivity_function_without_lenses_right); 
                        $('#pv_glare_contrast_sensitivity_without_lense_left').html("<b>"+data.tb_scratch[0].vt_glare_contrast_sensitivity_function_without_lenses_left); 
                        $('#pv_glare_contrast_sensitivity_with_corrective_right').html("<b>"+data.tb_scratch[0].vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri); 
                        $('#pv_glare_contrast_sensitivity_with_corrective_left').html("<b>"+data.tb_scratch[0].vt_glare_contrast_sensitivity_function_with_corretive_lenses_le);
                        $('#pv_color_blind_test').html("<b>"+data.tb_scratch[0].vt_color_blind_test); 
                        $('#pv_eye_injury').html("<b>"+data.tb_scratch[0].vt_any_eye_injury_disease); 
                        $('#pv_examination_suggested').html("<b>"+data.tb_scratch[0].vt_further_examination);  

                        if(data.tb_scratch[0].at_hearing_left == '1'){
                            $('#pv_hearing_left').html("<b>"+"Normal"); 
                        }
                        else if(data.tb_scratch[0].at_hearing_left == '2'){
                            $('#pv_hearing_left').html("<b>"+"Reduced"); 
                        }
                        else if(data.tb_scratch[0].at_hearing_left == '3'){
                            $('#pv_hearing_left').html("<b>"+"With hearing aid"); 
                        } 

                        if(data.tb_scratch[0].at_hearing_right == '1'){
                            $('#pv_hearing_right').html("<b>"+"Normal"); 
                        }
                        else if(data.tb_scratch[0].at_hearing_right == '2'){
                            $('#pv_hearing_right').html("<b>"+"Reduced"); 
                        }
                        else if(data.tb_scratch[0].at_hearing_right == '3'){
                            $('#pv_hearing_right').html("<b>"+"With hearing aid"); 
                        }

                        if(data.tb_scratch[0].mn_epilepsy == '1'){
                            $('#pv_epilepsy').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].mn_epilepsy == '0'){
                            $('#pv_epilepsy').html("<b>"+"No"); 
                        }

                        if(data.tb_scratch[0].mn_epilepsy_treatment == '1'){
                            $('#pv_epilepsytreatment').html("<b>"+data.tb_scratch[0].mn_epilepsy_remarks); 
                        }
                        else if(data.tb_scratch[0].mn_epilepsy_treatment == '0'){
                            $('#pv_epilepsytreatment').html("<b>"+"No"); 
                        }
                        else{
                            $('#pv_epilepsytreatment').html("<b>"+"*"); 
                        }

                        if(data.tb_scratch[0].mn_last_seizure == '' || data.tb_scratch[0].mn_last_seizure == null){
                            $('#pv_lastseizure').html("<b>"+'*');
                        }
                        else{
                            $('#pv_lastseizure').html("<b>"+data.tb_scratch[0].mn_last_seizure);
                        }

                        if(data.tb_scratch[0].mn_diabetes == '1'){
                            $('#pv_diabetes').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].mn_diabetes == '0'){
                            $('#pv_diabetes').html("<b>"+"No"); 
                        }

                        if(data.tb_scratch[0].mn_diabetes_treatment == '1'){
                            $('#pv_diabetestreatment').html("<b>"+data.tb_scratch[0].mn_diabetes_remarks); 
                        }
                        else if(data.tb_scratch[0].mn_diabetes_treatment == '0'){
                            $('#pv_diabetestreatment').html("<b>"+"No"); 
                        }
                        else{
                            $('#pv_diabetestreatment').html("<b>"+"*"); 
                        }

                        if(data.tb_scratch[0].mn_sleep_apnea == '1'){
                            $('#pv_sleep_apnea').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].mn_sleep_apnea == '0'){
                            $('#pv_sleep_apnea').html("<b>"+"No"); 
                        }

                        if(data.tb_scratch[0].mn_sleepapnea_treatment == '1'){
                            $('#pv_sleep_apneatreatment').html("<b>"+data.tb_scratch[0].mn_sleep_apnea_remarks); 
                        }
                        else if(data.tb_scratch[0].mn_sleepapnea_treatment == '0'){
                            $('#pv_sleep_apneatreatment').html("<b>"+"No"); 
                        }
                        else{
                            $('#pv_sleep_apneatreatment').html("<b>"+"*"); 
                        }

                        if(data.tb_scratch[0].mn_aggressive_manic == '1'){
                            $('#pv_aggressive_manic').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].mn_aggressive_manic == '0'){
                            $('#pv_aggressive_manic').html("<b>"+"No"); 
                        }

                        if(data.tb_scratch[0].mn_mental_treatment == '1'){
                            $('#pv_mentaltreatment').html("<b>"+data.tb_scratch[0].mn_aggresive_manic_remarks); 
                        }
                        else if(data.tb_scratch[0].mn_mental_treatment == '0'){
                            $('#pv_mentaltreatment').html("<b>"+"No"); 
                        }
                        else{
                            $('#pv_mentaltreatment').html("<b>"+"*"); 
                        }

                        if(data.tb_scratch[0].mn_others == '1'){
                            $('#pv_others').html("<b>"+"Yes"); 
                        }
                        else if(data.tb_scratch[0].mn_others == '0'){
                            $('#pv_others').html("<b>"+"No"); 
                        }

                       if(data.tb_scratch[0].mn_other_medical_condition == null || data.tb_scratch[0].mn_other_medical_condition == ''){
                        $('#pv_other_medical_condition').html("<b>"+'*');
                       }
                       else{
                        $('#pv_other_medical_condition').html("<b>"+data.tb_scratch[0].mn_other_medical_condition);
                       }
                      
                        if(data.tb_scratch[0].mn_other_treatment == '1'){
                            $('#pv_other_treatment').html("<b>"+data.tb_scratch[0].mn_other_medical_condition_remarks); 
                        }
                        else if(data.tb_scratch[0].mn_other_treatment == '0'){
                            $('#pv_other_treatment').html("<b>"+"No"); 
                        }
                        else{
                            $('#pv_other_treatment').html("<b>"+"*"); 
                        }
                    //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_head_neck_spinal_injury_disorders == '1'){
                    //     $('#pv_head_neck_spinal_injury_disorders').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_head_neck_spinal_injury_disorders == '0'){
                    //     $('#pv_head_neck_spinal_injury_disorders').html("No"); 
                    // }
                    // $('#pv_head_neck_spinal_injury_disorders_remarks').html(data.tb_scratch2[0].qu_head_neck_spinal_injury_disorders_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_seizure_convulsions == '1'){
                    //     $('#pv_seizure_convulsions').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_seizure_convulsions == '0'){
                    //     $('#pv_seizure_convulsions').html("No"); 
                    // }
                    // $('#pv_seizure_convulsions_remarks').html(data.tb_scratch2[0].qu_seizure_convulsions_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_dizziness_fainting == '1'){
                    //     $('#pv_dizziness_fainting').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_dizziness_fainting == '0'){
                    //     $('#pv_dizziness_fainting').html("No"); 
                    // }
                    // $('#pv_dizziness_fainting_remarks').html(data.tb_scratch2[0].qu_dizziness_fainting_remarks);
                    //  //-------------------------------------------------------
                    //  if(data.tb_scratch2[0].qu_eye_problem == '1'){
                    //     $('#pv_eye_problem').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_eye_problem == '0'){
                    //     $('#pv_eye_problem').html("No"); 
                    // }
                    // $('#pv_eye_problem_remarks').html(data.tb_scratch2[0].qu_eye_problem_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_hearing == '1'){
                    // $('#pv_hearing').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_hearing == '0'){
                    //     $('#pv_hearing').html("No"); 
                    // }
                    // $('#pv_hearing_remarks').html(data.tb_scratch2[0].qu_hearing_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_hypertension == '1'){
                    //     $('#pv_hypertension').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_hypertension == '0'){
                    //     $('#pv_hypertension').html("No"); 
                    // }
                    // $('#pv_hypertension_remarks').html(data.tb_scratch2[0].qu_hypertension_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_heart_attack_stroke == '1'){
                    //     $('#pv_heart_attack_stroke').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_heart_attack_stroke == '0'){
                    //     $('#pv_heart_attack_stroke').html("No"); 
                    // }
                    // $('#pv_heart_attack_stroke_remarks').html(data.tb_scratch2[0].qu_heart_attack_stroke_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_lung_disease == '1'){
                    //     $('#pv_lung_disease').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_lung_disease == '0'){
                    //     $('#pv_lung_disease').html("No"); 
                    // }
                    // $('#pv_lung_disease_remarks').html(data.tb_scratch2[0].qu_lung_disease_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_hyper_acidity_ulcer == '1'){
                    //     $('#pv_hyper_acidity_ulcer').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_hyper_acidity_ulcer == '0'){
                    //     $('#pv_hyper_acidity_ulcer').html("No"); 
                    // }
                    // $('#pv_hyper_acidity_ulcer_remarks').html(data.tb_scratch2[0].qu_hyper_acidity_ulcer_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_diabetes == '1'){
                    //     $('#pv_diabetes_').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_diabetes == '0'){
                    //     $('#pv_diabetes_').html("No"); 
                    // }
                    // $('#pv_diabetes_remarks_').html(data.tb_scratch2[0].qu_diabetes_remarks);
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_kidney_disease_stones_blood_in_urine == '1'){
                    //     $('#pv_kidney_disease_stones_blood_in_urine').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_kidney_disease_stones_blood_in_urine == '0'){
                    //     $('#pv_kidney_disease_stones_blood_in_urine').html("No"); 
                    // }
                    // $('#pv_kidney_disease_stones_blood_in_urine_remarks').html(data.tb_scratch2[0].qu_kidney_disease_stones_blood_in_urine_remarks)
                     //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_muscular_disease == '1'){
                    //     $('#pv_muscular_disease').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_muscular_disease == '0'){
                    //     $('#pv_muscular_disease').html("No"); 
                    // }
                    // $('#pv_muscular_disease_remarks').html(data.tb_scratch2[0].qu_muscular_disease_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_sleep_disorders_sleep_apnea == '1'){
                    //     $('#pv_sleep_disorders_sleep_apnea').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_sleep_disorders_sleep_apnea == '0'){
                    //     $('#pv_sleep_disorders_sleep_apnea').html("No"); 
                    // }
                    // $('#pv_sleep_disorders_sleep_apnea_remarks').html(data.tb_scratch2[0].qu_sleep_disorders_sleep_apnea_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_nervous_psychiatric == '1'){
                    //     $('#pv_nervous_psychiatric').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_nervous_psychiatric == '0'){
                    //     $('#pv_nervous_psychiatric').html("No"); 
                    // }
                    // $('#pv_nervous_psychiatric_remarks').html(data.tb_scratch2[0].qu_nervous_psychiatric_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_anger_management_issues == '1'){
                    //     $('#pv_anger_management_issues').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_nervous_psychiatric == '0'){
                    //     $('#pv_anger_management_issues').html("No"); 
                    // }
                    // $('#pv_anger_management_issues_remarks').html(data.tb_scratch2[0].qu_anger_management_issues_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_anger_management_issues == '1'){
                    //     $('#pv_regular_frequent_alcohol_drug').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_nervous_psychiatric == '0'){
                    //     $('#pv_regular_frequent_alcohol_drug').html("No"); 
                    // }
                    // $('#pv_regular_frequent_alcohol_drug_remarks').html(data.tb_scratch2[0].qu_regular_frequent_alcohol_drug_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_involved_mv_accident_while_driving == '1'){
                    //     $('#pv_involved_mv_accident_while_driving').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_involved_mv_accident_while_driving == '0'){
                    //     $('#pv_involved_mv_accident_while_driving').html("No"); 
                    // }
                    // $('#pv_involved_mv_accident_while_driving_remarks').html(data.tb_scratch2[0].qu_involved_mv_accident_while_driving_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_any_major_illness_injury_operation == '1'){
                    //     $('#pv_any_major_illness_injury_operation').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_any_major_illness_injury_operation == '0'){
                    //     $('#pv_any_major_illness_injury_operation').html("No"); 
                    // }
                    // $('#pv_any_major_illness_injury_operation_remarks').html(data.tb_scratch2[0].qu_any_major_illness_injury_operation_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_any_permanent_impairment== '1'){
                    //     $('#pv_any_permanent_impairment').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_any_permanent_impairment == '0'){
                    //     $('#pv_any_permanent_impairment').html("No"); 
                    // }
                    // $('#pv_any_permanent_impairment_remarks').html(data.tb_scratch2[0].qu_any_permanent_impairment_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_other_disorders == '1'){
                    //     $('#pv_other_disorders').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_other_disorders == '0'){
                    //     $('#pv_other_disorders').html("No"); 
                    // }
                    // $('#pv_other_disorders_remarks').html(data.tb_scratch2[0].qu_other_disorders_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_presently_experiencing_need_medical_attention == '1'){
                    //     $('#pv_presently_experiencing_need_medical_attention').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_presently_experiencing_need_medical_attention == '0'){
                    //     $('#pv_presently_experiencing_need_medical_attention').html("No"); 
                    // }
                    // $('#pv_presently_experiencing_need_medical_attention_remarks').html(data.tb_scratch2[0].qu_presently_experiencing_need_medical_attention_remarks)
                    // //-------------------------------------------------------
                    // if(data.tb_scratch2[0].qu_hospitalized_last_five_years == '1'){
                    //     $('#pv_hospitalized_last_five_years').html("Yes"); 
                    // }
                    // else if(data.tb_scratch2[0].qu_hospitalized_last_five_years == '0'){
                    //     $('#pv_hospitalized_last_five_years').html("No"); 
                    // }
                    // $('#pv_hospitalized_last_five_years_remarks').html(data.tb_scratch2[0].qu_hospitalized_last_five_years_remarks)
                    // $('#pv_often_physician').html(data.tb_scratch2[0].qu_often_physician_remarks)
                    // $('#pv_date_last_examination_physician').html(data.tb_scratch2[0].qu_date_last_examination_physician_remarks)
                    // $('#pv_date_last_confinement').html(data.tb_scratch2[0].qu_date_last_confinement_remarks)
                    //-------------------------------------------------------
                    if(data.tb_scratch[0].exam_assessment == 'Fit'){
                        $('#pv_exam_assessment').html("<b>"+"FIT TO DRIVE"); 
                    }
                    else if(data.tb_scratch[0].exam_assessment == 'Unfit'){
                        $('#pv_exam_assessment').html("<b>"+"UNFIT TO DRIVE"); 
                    }

                    if(data.tb_scratch[0].exam_assessment_remarks == 'Permanent'){
                        $('#pv_assessment_status').html("<b>"+"Permanent"); 
                    }
                    else if(data.tb_scratch[0].exam_assessment_remarks == 'Temporary'){
                        $('#pv_assessment_status').html("<b>"+"Temporary - "+"Duration: "+data.tb_scratch[0].exam_duration_remarks); 
                    }
                    else if(data.tb_scratch[0].exam_assessment_remarks == 'Refer'){
                        $('#pv_assessment_status').html("<b>"+"Refer to Specialist for further evaluation"); 
                    }
                    else if(data.tb_scratch[0].exam_assessment_remarks == null){
                        $('#pv_assessment_status').html("<b>"+"*"); 
                    }

                    var ConditionOutput= [];
                    if(data.tb_scratch[0].exam_conditions.includes("0")){
                        ConditionOutput.push("<b>"+"None");
                    }
                    if(data.tb_scratch[0].exam_conditions.includes("1")){
                        ConditionOutput.push("<b>"+"Drive only with corrective lens");
                    }
                    if(data.tb_scratch[0].exam_conditions.includes("2")){
                        ConditionOutput.push("<b>"+"Drive only with special equipment for upper limbs");
                    }
                    if(data.tb_scratch[0].exam_conditions.includes("3")){
                        ConditionOutput.push("<b>"+"Drive only with special equipment for lower limbs");
                    }
                    if(data.tb_scratch[0].exam_conditions.includes("4")){
                        ConditionOutput.push("<b>"+"Drive only during daylight");
                    }
                    if(data.tb_scratch[0].exam_conditions.includes("5")){
                        ConditionOutput.push("<b>"+"Drive only with hearing aid");
                    }
                    $('#pv_exam_conditions').html("<b>"+ConditionOutput.toString()); 

                    $('#pv_remarks').html("<b>"+data.tb_scratch[0].pt_remarks+"</b>"); 

                    $("#loader").addClass("hidden", function() {
                        $("#loader").fadeOut(500);
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

      //camera functions
    $("#recapture").attr("disabled", true);
    $('#select').on('click', function(){     
        if (navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
              .then(function (stream) {
                    video.srcObject = stream;
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
    $('#recapture').on('click', function() { 
        playVid();
        $("#capture").attr("disabled", false);
        $("#recapture").attr("disabled", true);
    });
    $('#capture').on('click', function() {     
        capture();
        pauseVid();
        save();
        $("#capture").attr("disabled", true);
        $("#recapture").attr("disabled", false);
    });
    var vid = document.getElementById("video");
    function playVid() {
        vid.play();
    }
    function pauseVid() {
        vid.pause();
    }
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
        document.getElementById("picture_1").src = canvas.toDataURL();;
        $("#base_64").val(canvas.toDataURL());
        $('#canvas').addClass('hidden');
        $('#saveImg').addClass('hidden');
    }

    //cancel 1
    $('#cancel_1').on('click', function () {
        cancel();
    });

     //save 1
    $('#save_1').on('click', function () {
        var saveTransForm = $('#saveTransForm')
            saveTransForm.validate({
                rules: {
                    trans_no: {
                        required: true
                    },
                    firstname: {
                        required: true
                    },
                    middlename: {
                        required: true
                    },
                    middle_name: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    age: {
                        required: true,
                        min: 18,
                        max: 300
                    },
                    birthday: {
                        required: true,
                    },
                    nationality: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    civilstatus: {
                        required: true
                    },
                    occupation: {
                        required: true
                    },
                    // licenseType: {
                    //     required: true
                    // },
                    // newRenewal: {
                    //     required: true
                    // },
                    lto_client_id:{
                        required: function() {
                            if($('#purpose').val() == "9" || $('#purpose').val() == "10"){
                                 return false
                            } 
                            else{
                                return true
                            } 
                        } 
                    },
                    license_no: {
                        required: function() {
                            if($('#purpose').val() == "9" || $('#purpose').val() == "10"){
                                 return false
                            } 
                            else{
                                return true
                            } 
                        } 
                    },
                    purpose: {
                        required: true
                    }
                },
                messages: {
                    base_64: "Please Capture Student Image"
                }
            });
            if (saveTransForm.valid()) {
                if ($('#base_64').val() == "") {
                    toastr['error']('Please Capture Student Image', 'Required Field', {
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
                        url: "save_trans_next",
                        data: saveTransForm.serialize(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            // console.log(data);
                            if (data.status == "1") {
                                Swal.fire({
                                    title: 'Save Successful!',
                                    icon: 'success',
                                    confirmButtonText: 'Ok',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        sessionStorage.clear();
                                        window.location.href = "main_page";
                                    }   
                                })
    
                                toastr['success'](data.message, 'Saved changes', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
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

    //---step 2---//
    //cancel 2
    $('#cancel_2').on('click', function () {
        cancel();
    });
    //save 2
    $('#save_2').on('click', function () {
        var save_physical_trans_form = $('#save_physical_trans_form')
            save_physical_trans_form.validate({
                rules: {
                    trans_no: {
                        required: true
                    },
                    height: {
                        required: true,
                        maxlength: 4,
                        min: 54,
                        max: 300
                    },
                    weight: {
                        required: true,
                        maxlength: 4,
                        min: 20,
                        max: 600
                    },
                    bmi: {
                        required: true
                    },
                    mm: {
                        required: true,
                        maxlength: 4,
                        min: 30,
                        max: 400
                    },
                    hg: {
                        required: true,
                        maxlength: 4,
                        min: 30,
                        max: 400
                    },
                    body_temperature: {
                        required: true,
                        maxlength: 4,
                        max:  40,
                        min: 35
                    },
                    pulse_rate: {
                        required: true,
                        maxlength: 3,
                        min: 60,
                        max: 200
                    },
                    respiratory_rate: {
                        required: true,
                        maxlength: 6
                    },
                    disability: {
                        required: true
                    },
                    disability: {
                        required: true
                    },
                    txtdisability: {
                        required: function() {
                           
                            if($('input:radio[name="disability"]:checked').val() == "WithDisability"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    },
                    blood_type: {
                        required: true
                    },
                    upper_extremities_left: {
                        required: true,
                    },
                    upper_extremities_right: {
                        required: true
                    },
                    lower_extremities_left: {
                        required: true
                    },
                    lower_extremities_right: {
                        required: true
                    },
                    disease: {
                        required: true
                    },
                    txtdisease: {
                        required: function() {
                           
                            if($('input:radio[name="disease"]:checked').val() == "with_disease"){
                                return true
                            }
                            else{
                                return false
                            }
                        }
                    }
                },
            });
            if (save_physical_trans_form.valid()) {
                if ($('#base_64').val() == "") {
                    toastr['error']('Please Capture Student Image', 'Required Field', {
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
                        url: "save_physical_trans",
                        data: save_physical_trans_form.serialize(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            // console.log(data);
                            if (data.status == "1") {
                                    Swal.fire({
                                        title: 'Save Successful!',
                                        icon: 'success',
                                        confirmButtonText: 'Ok',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            sessionStorage.clear();
                                            window.location.href = "main_page";
                                        }   
                                    })
        
                                    toastr['success'](data.message, 'Saved changes', {
                                        closeButton: true,
                                        tapToDismiss: false,
                                        rtl: isRtl
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

    //---step 3---//
    //cancel 3
    $('#cancel_3').on('click', function () {
        cancel();
    });
    //save 3
    $('#save_3').on('click', function () {
        var save_visual_hearing_trans_form = $('#save_visual_hearing_trans_form')
            save_visual_hearing_trans_form.validate({
                rules: {
                    trans_no: {
                        required: true
                    },
                    eye_color: {
                        required: true
                    },
                    snellen_bailey_lovie_left: {
                        required: true
                    },
                    snellen_bailey_lovie_right: {
                        required: true
                    },
                    corrective_lens_left: {
                        required: true
                    },
                    corrective_lens_right: {
                        required: true
                    },
                    color_blind_left: {
                        required: true
                    },
                    color_blind_right: {
                        required: true
                    },
                    glare_contrast_sensitivity_without_lense_right: {
                        required: true
                    },
                    glare_contrast_sensitivity_without_lense_left: {
                        required: true
                    },
                    glare_contrast_sensitivity_with_corrective_right: {
                        required: true
                    },
                    glare_contrast_sensitivity_with_corrective_left: {
                        required: true
                    },
                    color_blind_test: {
                        required: true
                    },
                    examination_suggested: {
                        required: true
                    },
                    eye_injury: {
                        required: true
                    },
                    hearing_left: {
                        required: true
                    },
                    hearing_right: {
                        required: true
                    }            
                },
            });
            if (save_visual_hearing_trans_form.valid()) {
                    $("#loader").removeClass("hidden",function () {
                        $("#loader").fadeIn(500);
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: "save_visual_hearing_trans",
                        data: save_visual_hearing_trans_form.serialize(),
                        success:function(data)
                        {
                            $("#loader").addClass("hidden", function() {
                                $("#loader").fadeOut(500);
                            });
                            // console.log(data);
                            if (data.status == "1") {
                                Swal.fire({
                                    title: 'Save Successful!',
                                    icon: 'success',
                                    confirmButtonText: 'Ok',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        sessionStorage.clear();
                                        window.location.href = "main_page";
                                    }   
                                })
    
                                toastr['success'](data.message, 'Saved changes', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
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
    });

    //---step 4---//
    //cancel_4
    $('#cancel_4').on('click', function () {
        cancel();
    });
    //save 4
    $('#save_4').on('click',function(){
        var save_metabolic_neurological_exam_form = $('#save_metabolic_neurological_exam_form')
        save_metabolic_neurological_exam_form.validate({
            rules: {
                trans_no: {
                    required: true
                },
                epilepsy: {
                    required: true
                },
                epilepsy_treatment: {
                    required: function() {       
                        if($('input:radio[name="epilepsy"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                txt_epilepsy_treatment: {
                    required: function() {           
                        if($('input:radio[name="epilepsy_treatment"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                last_seizure: {
                    required: function() {           
                        if($('input:radio[name="epilepsy"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                diabetes: {
                    required: true
                },
                diabetes_treatment: {
                    required: function() {           
                        if($('input:radio[name="diabetes"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                txt_diabetes_treatment: {
                    required: function() {           
                        if($('input:radio[name="diabetes_treatment"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                sleepapnea: {
                    required: true
                },
                sleepapnea_treatment: {
                    required: function() {           
                        if($('input:radio[name="sleepapnea"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                txt_sleepapnea_treatment: {
                    required: function() {           
                        if($('input:radio[name="sleepapnea_treatment"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                mental: {
                    required: true
                },
                mental_treatment: {
                    required: function() {           
                        if($('input:radio[name="mental"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                txt_mental_treatment: {
                    required: function() {           
                        if($('input:radio[name="mental_treatment"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                other: {
                    required: true
                },
                other_medical_condition: {
                    required: function() {           
                        if($('input:radio[name="other"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                other_treatment: {
                    required: function() {           
                        if($('input:radio[name="other"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                txt_other_treatment: {
                    required: function() {           
                        if($('input:radio[name="other_treatment"]:checked').val() == "1"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                
            },
        });
        if (save_metabolic_neurological_exam_form.valid()) {
                $("#loader").removeClass("hidden",function () {
                    $("#loader").fadeIn(500);
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "save_metabolic_neurological_trans",
                    data: save_metabolic_neurological_exam_form.serialize(),
                    success:function(data)
                    {
                        $("#loader").addClass("hidden", function() {
                            $("#loader").fadeOut(500);
                        });
                        // console.log(data);
                        if (data.status == "1") {
                            Swal.fire({
                                title: 'Save Successful!',
                                icon: 'success',
                                confirmButtonText: 'Ok',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    sessionStorage.clear();
                                    window.location.href = "main_page";
                                }   
                            })

                            toastr['success'](data.message, 'Saved changes', {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl
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
    });

    //---step 5---//
    //cancel_5
    // $('#cancel_5').on('click', function () {
    //     cancel();
    // });
    // //save 5
    // $('#save_5').on('click',function(){
    //     $("#loader").removeClass("hidden",function () {
    //         $("#loader").fadeIn(500);
    //     });
    //     var health_history_form = $('#health_history_form')
    //     health_history_form.validate({
    //         rules: {
    //             trans_no: {
    //                 required: true
    //             },
    //             head_neck_spinal_injury_disorders: {
    //                 required: true
    //             },
    //             head_neck_spinal_injury_disorders_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="head_neck_spinal_injury_disorders"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             seizure_convulsions: {
    //                 required: true
    //             },
    //             seizure_convulsions_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="seizure_convulsions"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             dizziness_fainting: {
    //                 required: true
    //             },
    //             dizziness_fainting_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="dizziness_fainting"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             eye_problem: {
    //                 required: true
    //             },
    //             eye_problem_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="eye_problem"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             hearing: {
    //                 required: true
    //             },
    //             hearing_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="hearing"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             hypertension: {
    //                 required: true
    //             },
    //             hypertension_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="hypertension"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             heart_attack_stroke: {
    //                 required: true
    //             },
    //             heart_attack_stroke_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="heart_attack_stroke"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             lung_disease: {
    //                 required: true
    //             },
    //             lung_disease_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="lung_disease"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             hyper_acidity_ulcer: {
    //                 required: true
    //             },
    //             hyper_acidity_ulcer_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="hyper_acidity_ulcer"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             diabetes_: {
    //                 required: true
    //             },
    //             diabetes_remarks_: {
    //                 required: function() {       
    //                     if($('input:radio[name="diabetes_"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             kidney_disease_stones_blood_in_urine: {
    //                 required: true
    //             },
    //             kidney_disease_stones_blood_in_urine_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="kidney_disease_stones_blood_in_urine"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             muscular_disease: {
    //                 required: true
    //             },
    //             muscular_disease_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="muscular_disease"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             sleep_disorders_sleep_apnea: {
    //                 required: true
    //             },
    //             sleep_disorders_sleep_apnea_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="sleep_disorders_sleep_apnea"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             nervous_psychiatric: {
    //                 required: true
    //             },
    //             nervous_psychiatric_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="nervous_psychiatric"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             anger_management_issues: {
    //                 required: true
    //             },
    //             anger_management_issues_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="anger_management_issues"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             regular_frequent_alcohol_drug: {
    //                 required: true
    //             },
    //             regular_frequent_alcohol_drug_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="regular_frequent_alcohol_drug"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             involved_mv_accident_while_driving: {
    //                 required: true
    //             },
    //             involved_mv_accident_while_driving_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="involved_mv_accident_while_driving"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             any_major_illness_injury_operation: {
    //                 required: true
    //             },
    //             any_major_illness_injury_operation_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="any_major_illness_injury_operation"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             any_permanent_impairment: {
    //                 required: true
    //             },
    //             any_permanent_impairment_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="any_permanent_impairment"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             other_disorders: {
    //                 required: true
    //             },
    //             other_disorders_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="other_disorders"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             presently_experiencing_need_medical_attention: {
    //                 required: true
    //             },
    //             presently_experiencing_need_medical_attention_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="presently_experiencing_need_medical_attention"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             hospitalized_last_five_years: {
    //                 required: true
    //             },
    //             hospitalized_last_five_years_remarks: {
    //                 required: function() {       
    //                     if($('input:radio[name="hospitalized_last_five_years"]:checked').val() == "1"){
    //                         return true
    //                     }
    //                     else{
    //                         return false
    //                     }
    //                 }
    //             },
    //             often_physician: {
    //                 required: true
    //             },
    //             date_last_examination_physician: {
    //                 required: true
    //             },
                
    //         },
    //     });
    //     if (health_history_form.valid()) {
    //             $("#loader").removeClass("hidden",function () {
    //                 $("#loader").fadeIn(500);
    //             });
    //             $.ajax({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 method: "POST",
    //                 url: "save_health_history",
    //                 data: health_history_form.serialize(),
    //                 success:function(data)
    //                 {
    //                     $("#loader").addClass("hidden", function() {
    //                         $("#loader").fadeOut(500);
    //                     });
    //                     // console.log(data);
    //                     if (data.status == "1") {
    //                         Swal.fire({
    //                             title: 'Save Successful!',
    //                             icon: 'success',
    //                             confirmButtonText: 'Ok',
    //                             allowOutsideClick: false,
    //                             allowEscapeKey: false
    //                         }).then((result) => {
    //                             if (result.isConfirmed) {
    //                                 sessionStorage.clear();
    //                                 window.location.href = "main_page";
    //                             }   
    //                         })

    //                         toastr['success'](data.message, 'Saved changes', {
    //                             closeButton: true,
    //                             tapToDismiss: false,
    //                             rtl: isRtl
    //                         });
    //                     } else {
    //                         toastr['error'](data.message, 'Error', {
    //                             closeButton: true,
    //                             tapToDismiss: false,
    //                             rtl: isRtl
    //                         });
    //                     }
    //                 },
    //                 error: function(xhr, status, error){
    //                     var errorMessage = xhr.status + ': ' + xhr.statusText;
    //                     $("#loader").addClass("hidden", function() {
    //                         $("#loader").fadeOut(500);
    //                     });
    //                     if(xhr.status == 500){
    //                         toastr['error']('There was a problem connecting to the server.', 'Error', {
    //                             closeButton: true,
    //                             tapToDismiss: false,
    //                             rtl: isRtl
    //                         });
    //                     }
    //                     else if(xhr.status == 0){
    //                         toastr['error']('Not Connected. Please verify your network connection.', 'Error', {
    //                             closeButton: true,
    //                             tapToDismiss: false,
    //                             rtl: isRtl
    //                         });
            
    //                     }else{
    //                         toastr['error'](errorMessage, 'Error', {
    //                             closeButton: true,
    //                             tapToDismiss: false,
    //                             rtl: isRtl
    //                         });
    //                     }
    //                 }
    //             });
    //     }             
    // });

    //---step 6---//
    //cancel_6
    $('#cancel_6').on('click', function () {
        cancel();
    });
    //save 6 
    $('#save_6').on('click',function(){
        var save_assessment_condition_form = $('#save_assessment_condition_form');
        data_condition  = document.querySelectorAll('input[name="conditions"]:checked')
        var ConditionOutput= [];
        data_condition.forEach((checkboxValues) => {
            ConditionOutput.push(checkboxValues.value);
        })    
        save_assessment_condition_form.validate({
            rules: {
                assessment: {
                    required: true
                },
                assessment_status: {
                    required: function() {       
                        if($('input:radio[name="assessment"]:checked').val() == "Unfit"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                assessment_temporary_duration: {
                    required: function() {       
                        if($('input:radio[name="assessment_status"]:checked').val() == "Temporary"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                conditions: {
                    required: function() {       
                        if($('input:radio[name="assessment"]:checked').val() == "Fit"){
                            return true
                        }
                        else{
                            return false
                        }
                    }
                },
                remarks: {
                    required: true,
                    maxlength:100
                }
            },
        });
        if (save_assessment_condition_form.valid()) {
                $("#loader").removeClass("hidden",function () {
                    $("#loader").fadeIn(500);
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "save_assessment_condition_trans",
                    data: save_assessment_condition_form.serialize()+"&ConditionOutput="+ConditionOutput.toString(),
                    success:function(data)
                    {
                        $("#loader").addClass("hidden", function() {
                            $("#loader").fadeOut(500);
                        });
                        // console.log(data);
                        if (data.status == "1") {
                            Swal.fire({
                                    title: 'Save Successful!',
                                    icon: 'success',
                                    confirmButtonText: 'Ok',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        sessionStorage.clear();
                                        window.location.href = "main_page";
                                    }   
                                })
    
                                toastr['success'](data.message, 'Saved changes', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
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
    });
    

    //upload
    $('#verify').on("click", function (){
        $('#verify').prop( "disabled", true);   
        _trans_no = $('#trans_no').val()
        // var timer =  $('#timer').text();
        // var timerArray = timer.split(/[:]+/);
        // if(timerArray[0] >= 0 && timerArray[0] <= 8  && timerArray[1] > 0){
        //     Swal.fire({
        //         title: timer+" minutes left to upload data",
        //         text: "Try again later",
        //         icon: 'warning',
        //         confirmButtonColor: '#3085d6',
        //         confirmButtonText: 'Ok',
        //         customClass: {
        //           confirmButton: 'btn btn-success me-1',
        //         },
        //     })                                     
        // }
        // // else if(timerArray[0] < 0 && timerArray[1] < 0){
          
        // // }
        // else{
            $("#loader").removeClass("hidden",function () {
                $("#loader").fadeIn(500);
            }); 
        
            $.ajax({type:'GET', crossDomain: true,url: "http://localhost:5000/Verify_Biometrics", success: function(bio){
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });

                $("#loader").removeClass("hidden",function () {
                    $("#loader").fadeIn(500);
                });
                if (bio != "") { 
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                            async: true,
                            type: "POST",
                            url: "save_verify_biometrics",
                            data:{        
                                "trans_no" : _trans_no,
                                "Biometrics_data":bio
                            },
                            success:function(data)
                            {           
                                if(data.status == 1){
                                    $("#loader").addClass("hidden", function() {
                                        $("#loader").fadeOut(500);
                                    });   
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
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            },
                                                    async: false,
                                                    type: "POST",
                                                    url: "save_transaction_upload",
                                                    data:{        
                                                        "trans_no" : _trans_no,
                                                        "api_payload" :data.api_payload,
                                                        "api_response" :data.api_response,
                                                        "certificate_number" : data.certificate_number
                                                    },
                                                    success:function(data){           
                                                        if(data.status == 1){
                                                            $("#loader").addClass("hidden", function() {
                                                                $("#loader").fadeOut(500);
                                                            });   
                                                            Swal.fire({
                                                                title: "Client data Upload Success",
                                                                text: 'You want to generate Certificate now?',
                                                                icon: "success",
                                                                showDenyButton: true,
                                                                confirmButtonText: 'Yes',
                                                                allowOutsideClick: false,
                                                                allowEscapeKey: false,
                                                                denyButtonText: 'No',
                                                                customClass: {
                                                                confirmButton: 'btn btn-primary',
                                                                denyButton: 'btn btn-outline-danger ml-1'
                                                                },
                                                                buttonsStyling: false,
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {                                                                 
                                                                        window.open('GetNewCertData,'+_trans_no);
                                                                    $("#loader").removeClass("hidden",function () {
                                                                        $("#loader").fadeIn(500);
                                                                    });
                                                                    sessionStorage.clear();
                                                                    window.location.href = "main_page";
                                                                } 
                                                                else if (result.isDenied) {
                                                                    $("#loader").removeClass("hidden",function () {
                                                                        $("#loader").fadeIn(500);
                                                                    });
                                                                    window.location.href = "main_page";
                                                                }
                                                            });                     
                                                        }
                                                        else{
                                                            $("#loader").addClass("hidden", function() {
                                                                $("#loader").fadeOut(500);
                                                            });
                                                            toastr['warning'](data.message, 'Scan Physician Biometrics Again', {
                                                                closeButton: true,
                                                                tapToDismiss: false,
                                                                rtl: isRtl
                                                            });
                                                        }
                                                    },   
                                            })
                                        } 
                                    });                                                                 
                                }
                                else if(data.status == 0){
                                    $('#verify').prop( "disabled", false);   
                                    $("#loader").addClass("hidden", function() {
                                        $("#loader").fadeOut(500);
                                    });
                                    Swal.fire({
                                        title: "Verification Failed",
                                        text: data.message,
                                        icon: 'warning',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok',
                                        customClass: {
                                          confirmButton: 'btn btn-success me-1',
                                        },
                                    }) 
                                }
                                else{
                                    $('#verify').prop( "disabled", false);   
                                    $("#loader").addClass("hidden", function() {
                                        $("#loader").fadeOut(500);
                                    });
                                    Swal.fire({
                                        title: "Verification Failed",
                                        text: "Scan Physician Biometrics Again",
                                        icon: 'warning',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok',
                                        customClass: {
                                          confirmButton: 'btn btn-success me-1',
                                        },
                                    }) 

                                    // toastr['warning'](data.message, 'Scan Physician Biometrics Again', {
                                    //     closeButton: true,
                                    //     tapToDismiss: false,
                                    //     rtl: isRtl
                                    // });
                                }
                            },   
                    })
                    // verify(result);
                }else{
                    $('#verify').prop( "disabled", false);   
                    toastr['warning']('Please Scan the finger print of the Physician', 'Biometrics Required', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                }
  
            }});
        // }        
    });
    //cancel_7
    $('#cancel_7').on('click', function () {
        cancel();
    });


    function verify(instructorBio){
        var trans_no = sessionStorage.getItem("trans_no"),
            student_id = sessionStorage.getItem("student_id");
        
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "new_transaction_upload",
            data: {
                trans_no: trans_no,
                student_id: student_id,
                instructor_bio:instructorBio
            },
            success:function(data)
            {
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                // console.log(data);
                if (data.status == "1") {
                    Swal.fire({
                        title: "Verify Successful!",
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
                            window.location.href = "dashboard_page";
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

    $('#verify2').on('click', function () {
        verify2();
        $("#biometrics_modal").modal('hide');
        var frameSrc = "";
        $('#bio_modal_body').html(frameSrc);
    });

    function verify2(){
        var trans_no = sessionStorage.getItem("trans_no"),
            student_id = sessionStorage.getItem("student_id");
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "verify_by_administrator",
            data: {
                trans_no: trans_no,
                student_id: student_id
            },
            success:function(data)
            {
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                // console.log(data);
                if (data.status == "1") {
                    Swal.fire({
                        title: "Verify Successful",
                        text: data.message+'. Do you want to upload this transaction now ?',
                        icon: "success",
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
                           uploadNow();
                        } else if (result.isDenied) {
                            $("#loader").removeClass("hidden",function () {
                                $("#loader").fadeIn(500);
                            });
                            window.location.href = "dashboard_page";
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

    function uploadNow (instructorBio) {
        var trans_no = sessionStorage.getItem("trans_no"),
            student_id = sessionStorage.getItem("student_id");
            // var trans_no = "DS-DS_HRK-2022-15215164123",
            //     student_id = "DS-DS_HRK-2022-64123";
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "new_trans_upload",
            data: {
                trans_no: trans_no,
                student_id: student_id
            },
            success:function(data)
            {
                $("#loader").addClass("hidden", function() {
                    $("#loader").fadeOut(500);
                });
                // console.log(data);
                if (data.status == "1") {
                    sessionStorage.setItem("trans_no", data.trans_no); 
                    sessionStorage.setItem("student_id", data.student_id);
                    // Swal.fire({
                    //     title: "Upload Successful",
                    //     text: data.message+'. Do you want to generate Certificate now ?',
                    //     icon: "success",
                    //     showDenyButton: true,
                    //     confirmButtonText: 'Yes',
                    //     denyButtonText: 'No',
                    //     customClass: {
                    //       confirmButton: 'btn btn-primary',
                    //       denyButton: 'btn btn-outline-danger ml-1'
                    //     },
                    //     buttonsStyling: false,
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         window.open('generate_cert,'+data.trans_no+','+data.student_id,'_blank');
                    //         $("#loader").removeClass("hidden",function () {
                    //             $("#loader").fadeIn(500);
                    //         });
                    //         window.location.href = "dashboard_page";
                    //     } else if (result.isDenied) {
                    //         $("#loader").removeClass("hidden",function () {
                    //             $("#loader").fadeIn(500);
                    //         });
                    //         window.location.href = "dashboard_page";
                    //     }
                    // });
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
    
    function cancel(){
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
                    sessionStorage.clear();
                    window.location.href = "saved_trans";
			    }
			}
		);
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
    
    $("#remarks").attr('maxlength','100');
    $("#remarks").css('resize', 'none');
    $('#txtdisability').addClass('hidden');
    // $('#respiratory_rate').on('input', function (event) {
    //     this.value = this.value.replace(/[^0-9]/g, '');
    // });
    $("#respiratory_rate").attr('maxlength','6');

    $('#body_temperature').on('input', function (event) {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
    $("#body_temperature").attr('maxlength','4');
    $("#scale_temperature").prop( "readonly", true );
    
    $('#pulse_rate').on('input', function (event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $("#pulse_rate").attr('maxlength','3');

    $("#hg").attr('maxlength','4');
    $("#mm").attr('maxlength','4');
    $('#hg').on('input', function (event) {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
    $('#mm').on('input', function (event) {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });

    $("#weight").attr('maxlength','4');
    $("#height").attr('maxlength','4');
    $( "#bmi" ).prop( "readonly", true );
    function bmi(){
        var height = $("#height").val(),
            weight = $("#weight").val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            method: "GET",
            url: "bmi",
            data: {
                weight: weight,
                height: height,
            },
            success:function(data)
            {

                if (data.status == "1") {
                    $('#bmi').val(data.bmi);
                } else {
                    toastr['error']('There was an error', 'Error', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                }
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
    }
    $("#height").change(function(){
        weight = $("#weight").val()
        height = $("#height").val()
        if(weight == null || height == null || weight == '' || height == ''){
            $("#bmi").val('')
        }
        else{
            bmi();
        }
    });
    $("#weight").change(function(){
        weight = $("#weight").val()
        height = $("#height").val()
        if(weight == null || height == null || weight == '' || height == ''){
            $("#bmi").val('')
        }
        else{
            bmi();
        }
    });
    $('#weight').on('input', function (event) {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
    $('#height').on('input', function (event) {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });

    $( "#age" ).prop( "readonly", true );
    $('#purpose').change(function() {
        if($(this).val() == '10') {
            $("#license_no").val("");          
            $( "#license_no" ).prop( "readonly", true );        
        }
        else if($(this).val() == '9') {
            $("#license_no").val("");          
            $( "#license_no" ).prop( "readonly", true );        
        } 
         else {
            $("#license_no").val("");
            $( "#license_no" ).prop( "readonly", false );
        }
    });

    $('input:radio[name="disease"]').change(function() {
        if ($(this).val() == 'none') {
            $('#txtdisease').addClass('hidden');
        } else {
            $('#txtdisease').removeClass('hidden');
        }
    });
    
    $('input:radio[name="disability"]').change(function() {
        if ($(this).val() == 'normal') {
            $('#txtdisability').addClass('hidden');
        } else {
            $('#txtdisability').removeClass('hidden');
        }
    });

    $('input:radio[name="epilepsy"]').change(function() {
        if ($(this).val() == '0') {
            $('#div_last_seizure').addClass('hidden');
            $('#div_epilepsy_treatment').addClass('hidden');
            $("input[name=epilepsy_treatment]").prop("checked",false);
            $('#txt_epilepsy_treatment').addClass('hidden');
        } else {
            $('#div_epilepsy_treatment').removeClass('hidden');
            $('#div_last_seizure').removeClass('hidden');
        }
    });
    $('#txt_epilepsy_treatment').addClass('hidden');
    $('input:radio[name="epilepsy_treatment"]').change(function() {
        if ($(this).val() == '0') {
            $('#txt_epilepsy_treatment').addClass('hidden');
        } else {
            $('#txt_epilepsy_treatment').removeClass('hidden');
        }
    });

    $('input:radio[name="diabetes"]').change(function() {
        if ($(this).val() == '0') {
            $('#div_diabetes_treatment').addClass('hidden');
            $("input[name=diabetes_treatment]").prop("checked",false);
            $('#txt_diabetes_treatment').addClass('hidden');
        } else {
            $('#div_diabetes_treatment').removeClass('hidden');
        }
    });
    $('#txt_diabetes_treatment').addClass('hidden');
    $('input:radio[name="diabetes_treatment"]').change(function() {
        if ($(this).val() == '0') {
            $('#txt_diabetes_treatment').addClass('hidden');
        } else {
            $('#txt_diabetes_treatment').removeClass('hidden');
        }
    });

    $('input:radio[name="sleepapnea"]').change(function() {
        if ($(this).val() == '0') {
            $('#div_sleepapnea_treatment').addClass('hidden');
            $("input[name=sleepapnea_treatment]").prop("checked",false);
            $('#txt_sleepapnea_treatment').addClass('hidden');
        } else {
            $('#div_sleepapnea_treatment').removeClass('hidden');
        }
    });
    $('#txt_sleepapnea_treatment').addClass('hidden');
    $('input:radio[name="sleepapnea_treatment"]').change(function() {
        if ($(this).val() == '0') {
            $('#txt_sleepapnea_treatment').addClass('hidden');
        } else {
            $('#txt_sleepapnea_treatment').removeClass('hidden');
        }
    });
    
    $('input:radio[name="mental"]').change(function() {
        if ($(this).val() == '0') {
            $('#div_mental_treatment').addClass('hidden');
            $("input[name=mental_treatment]").prop("checked",false);
            $('#txt_mental_treatment').addClass('hidden');
        } else {
            $('#div_mental_treatment').removeClass('hidden');
        }
    });
    $('#txt_mental_treatment').addClass('hidden');
    $('input:radio[name="mental_treatment"]').change(function() {
        if ($(this).val() == '0') {
            $('#txt_mental_treatment').addClass('hidden');
        } else {
            $('#txt_mental_treatment').removeClass('hidden');
        }
    });

    $('input:radio[name="other"]').change(function() {
        if ($(this).val() == '0') {
            $('#other_medical_condition').addClass('hidden');
            $('#div_other_treatment').addClass('hidden');
            $("input[name=other_treatment]").prop("checked",false);
            $('#txt_other_treatment').addClass('hidden')
        } else {
            $('#other_medical_condition').removeClass('hidden');
            $('#div_other_treatment').removeClass('hidden');
        }
    });
    $('#txt_other_treatment').addClass('hidden');
    $('input:radio[name="other_treatment"]').change(function() {
        if ($(this).val() == '0') {
            $('#txt_other_treatment').addClass('hidden');
        } else {
            $('#txt_other_treatment').removeClass('hidden');
        }
    });
    //-----------------------------------------------
    // $('input:radio[name="head_neck_spinal_injury_disorders"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#head_neck_spinal_injury_disorders_remarks').addClass('hidden');
    //     } else {
    //         $('#head_neck_spinal_injury_disorders_remarks').removeClass('hidden');
    //     }
    // });


    // $('input:radio[name="seizure_convulsions"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#seizure_convulsions_remarks').addClass('hidden');
    //     } else {
    //         $('#seizure_convulsions_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="dizziness_fainting"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#dizziness_fainting_remarks').addClass('hidden');
    //     } else {
    //         $('#dizziness_fainting_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="eye_problem"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#eye_problem_remarks').addClass('hidden');
    //     } else {
    //         $('#eye_problem_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="hearing"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#hearing_remarks').addClass('hidden');
    //     } else {
    //         $('#hearing_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="hypertension"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#hypertension_remarks').addClass('hidden');
    //     } else {
    //         $('#hypertension_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="heart_attack_stroke"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#heart_attack_stroke_remarks').addClass('hidden');
    //     } else {
    //         $('#heart_attack_stroke_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="lung_disease"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#lung_disease_remarks').addClass('hidden');
    //     } else {
    //         $('#lung_disease_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="hyper_acidity_ulcer"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#hyper_acidity_ulcer_remarks').addClass('hidden');
    //     } else {
    //         $('#hyper_acidity_ulcer_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="kidney_disease_stones_blood_in_urine"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#kidney_disease_stones_blood_in_urine_remarks').addClass('hidden');
    //     } else {
    //         $('#kidney_disease_stones_blood_in_urine_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="muscular_disease"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#muscular_diseaser_remarks').addClass('hidden');
    //     } else {
    //         $('#muscular_diseaser_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="diabetes_"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#diabetes_remarks_').addClass('hidden');
    //     } else {
    //         $('#diabetes_remarks_').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="kidney_disease_stones_blood_in_urine"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#kidney_disease_stones_blood_in_urine_remarks').addClass('hidden');
    //     } else {
    //         $('#kidney_disease_stones_blood_in_urine_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="muscular_disease"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#muscular_disease_remarks').addClass('hidden');
    //     } else {
    //         $('#muscular_disease_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="sleep_disorders_sleep_apnea"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#sleep_disorders_sleep_apnea_remarks').addClass('hidden');
    //     } else {
    //         $('#sleep_disorders_sleep_apnea_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="nervous_psychiatric"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#nervous_psychiatric_remarks').addClass('hidden');
    //     } else {
    //         $('#nervous_psychiatric_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="anger_management_issues"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#anger_management_issues_remarks').addClass('hidden');
    //     } else {
    //         $('#anger_management_issues_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="regular_frequent_alcohol_drug"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#regular_frequent_alcohol_drug_remarks').addClass('hidden');
    //     } else {
    //         $('#regular_frequent_alcohol_drug_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="involved_mv_accident_while_driving"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#involved_mv_accident_while_driving_remarks').addClass('hidden');
    //     } else {
    //         $('#involved_mv_accident_while_driving_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="any_major_illness_injury_operation"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#any_major_illness_injury_operation_remarks').addClass('hidden');
    //     } else {
    //         $('#any_major_illness_injury_operation_remarks').removeClass('hidden');
    //     }
    // });


    // $('input:radio[name="any_permanent_impairment"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#any_permanent_impairment_remarks').addClass('hidden');
    //     } else {
    //         $('#any_permanent_impairment_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="other_disorders"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#other_disorders_remarks').addClass('hidden');
    //     } else {
    //         $('#other_disorders_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="presently_experiencing_need_medical_attention"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#presently_experiencing_need_medical_attention_remarks').addClass('hidden');
    //     } else {
    //         $('#presently_experiencing_need_medical_attention_remarks').removeClass('hidden');
    //     }
    // });

    // $('input:radio[name="hospitalized_last_five_years"]').change(function() {
    //     if ($(this).val() == '0') {
    //         $('#hospitalized_last_five_years_remarks').addClass('hidden');
    //     } else {
    //         $('#hospitalized_last_five_years_remarks').removeClass('hidden');
    //     }
    // });

    $('#div_condition').addClass('hidden');
    $('input:radio[name="assessment"]').change(function() {
        if($(this).val() == 'Fit') {
            $('#div_condition').removeClass('hidden');
            $('#div_assessment_status').addClass('hidden');
        } else {
            $('#div_condition').addClass('hidden');
            $('#div_assessment_status').removeClass('hidden');
        }
    });

    $("input:checkbox[name='conditions'][value='0']").click(function(){
        document.getElementsByClassName('conditions')[1].checked = false
        document.getElementsByClassName('conditions')[2].checked = false
        document.getElementsByClassName('conditions')[3].checked = false
        document.getElementsByClassName('conditions')[4].checked = false 
        document.getElementsByClassName('conditions')[5].checked = false  
    })
    $("input:checkbox[name='conditions'][value='1']").click(function(){
            document.getElementsByClassName('conditions')[0].checked = false
    })
    $("input:checkbox[name='conditions'][value='2']").click(function(){
            document.getElementsByClassName('conditions')[0].checked = false
    })
    $("input:checkbox[name='conditions'][value='3']").click(function(){
            document.getElementsByClassName('conditions')[0].checked = false
    })
    $("input:checkbox[name='conditions'][value='4']").click(function(){
            document.getElementsByClassName('conditions')[0].checked = false
    })
    $("input:checkbox[name='conditions'][value='5']").click(function(){
            document.getElementsByClassName('conditions')[0].checked = false
    })

    $(document).on('blur', "input[type=text]", function () {
        $(this).val(function (_, val) {
            return val.toUpperCase();
        });
    });
    
    $('#assessment_temporary_duration').addClass('hidden');
    $('input:radio[name="assessment_status"]').change(function() {
        if($('input:radio[name="assessment_status"]:checked').val() == "Temporary"){
            $('#assessment_temporary_duration').removeClass('hidden');
        }
        else{
            $('#assessment_temporary_duration').addClass('hidden');
        }
    })

    var ishihara_counter = 0;
    var ishihara_over = 0;
    var ishihara_answer = '';
    $('#color_blind_result').text('Ishihara Test Result: - /6')

    // function alertanswer(answer){
    //     Swal.fire({
    //         icon: 'info',
    //         title: 'Answer:',
    //         text: answer
    //     })
    // }

    function replaceChar(origString, replaceChar, index) {
        let firstPart = origString.substr(0, index);
 
        let lastPart = origString.substr(index + 1);
 
        let newString =
            firstPart + replaceChar + lastPart;
 
        return newString;
    }
    var randpic=  Math.floor(Math.random() * 4) + 1;
    
    var pic1 = $("#ishahara_1").val();
    var pic2 = $("#ishahara_2").val();
    var pic3 = $("#ishahara_3").val();
    var pic4 = $("#ishahara_4").val();
    var pic5 = $("#ishahara_5").val();
    var pic6 = $("#ishahara_6").val();

    pic1final = replaceChar(pic1, randpic, 59);
    pic2final = replaceChar(pic2, randpic, 59);
    pic3final = replaceChar(pic3, randpic, 59);
    pic4final = replaceChar(pic4, randpic, 59);
    pic5final = replaceChar(pic5, randpic, 59);
    pic6final = replaceChar(pic6, randpic, 59);

    $("#ishahara_1").val(pic1final)
    $("#ishahara_2").val(pic2final)
    $("#ishahara_3").val(pic3final)
    $("#ishahara_4").val(pic4final)
    $("#ishahara_5").val(pic5final)
    $("#ishahara_6").val(pic6final)

    $("#ishahara_picture_1_viewer").attr("src",  $("#ishahara_1").val());
    $("#ishahara_picture_2_viewer").attr("src",  $("#ishahara_2").val());
    $("#ishahara_picture_3_viewer").attr("src",  $("#ishahara_3").val());
    $("#ishahara_picture_4_viewer").attr("src",  $("#ishahara_4").val());
    $("#ishahara_picture_5_viewer").attr("src",  $("#ishahara_5").val());
    $("#ishahara_picture_6_viewer").attr("src",  $("#ishahara_6").val());

    $('#btn_picture_1_pass').on('click', function (){
        $( "#btn_picture_1_fail" ).prop( "disabled", false );
        $( "#btn_picture_1_pass" ).prop( "disabled", true );

        $( "#btn_picture_1_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_picture_1_pass" ).addClass( "btn-success" );

        $( "#btn_picture_1_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_picture_1_fail" ).removeClass( "btn-danger" );
        ishihara_counter += 1;        
    });
    $('#btn_picture_1_fail').on('click', function (){

        $( "#btn_picture_1_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_picture_1_fail" ).addClass( "btn-danger" );

        $( "#btn_picture_1_pass" ).addClass( "btn-outline-success" );
        $( "#btn_picture_1_pass" ).removeClass( "btn-success" );

        if($("#btn_picture_1_pass" ).attr('disabled')){
            ishihara_counter -= 1; 
            $( "#btn_picture_1_pass" ).prop( "disabled", false );
            $( "#btn_picture_1_fail" ).prop( "disabled", true );          
        }
        else{
            $( "#btn_picture_1_pass" ).prop( "disabled", false );
            $( "#btn_picture_1_fail" ).prop( "disabled", true );
        }
    });

    $('#btn_picture_2_pass').on('click', function (){
        $( "#btn_picture_2_fail" ).prop( "disabled", false );
        $( "#btn_picture_2_pass" ).prop( "disabled", true );

        $( "#btn_picture_2_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_picture_2_pass" ).addClass( "btn-success" );

        $( "#btn_picture_2_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_picture_2_fail" ).removeClass( "btn-danger" );
        ishihara_counter += 1;        
    });
    $('#btn_picture_2_fail').on('click', function (){

        $( "#btn_picture_2_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_picture_2_fail" ).addClass( "btn-danger" );

        $( "#btn_picture_2_pass" ).addClass( "btn-outline-success" );
        $( "#btn_picture_2_pass" ).removeClass( "btn-success" );
        

        if($("#btn_picture_2_pass" ).attr('disabled')){
            ishihara_counter -= 1; 
            $( "#btn_picture_2_pass" ).prop( "disabled", false );
            $( "#btn_picture_2_fail" ).prop( "disabled", true );
        }
        else{
            $( "#btn_picture_2_pass" ).prop( "disabled", false );
            $( "#btn_picture_2_fail" ).prop( "disabled", true );
        }
    });

    $('#btn_picture_3_pass').on('click', function (){
        $( "#btn_picture_3_fail" ).prop( "disabled", false );
        $( "#btn_picture_3_pass" ).prop( "disabled", true );

        $( "#btn_picture_3_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_picture_3_pass" ).addClass( "btn-success" );

        $( "#btn_picture_3_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_picture_3_fail" ).removeClass( "btn-danger" );
        ishihara_counter += 1;        
    });
    $('#btn_picture_3_fail').on('click', function (){
        $( "#btn_picture_3_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_picture_3_fail" ).addClass( "btn-danger" );

        $( "#btn_picture_3_pass" ).addClass( "btn-outline-success" );
        $( "#btn_picture_3_pass" ).removeClass( "btn-success" );

        if($("#btn_picture_3_pass" ).attr('disabled')){
            ishihara_counter -= 1; 
            $( "#btn_picture_3_pass" ).prop( "disabled", false );
            $( "#btn_picture_3_fail" ).prop( "disabled", true );
        }
        else{
            $( "#btn_picture_3_pass" ).prop( "disabled", false );
            $( "#btn_picture_3_fail" ).prop( "disabled", true );
        }
    });

    $('#btn_picture_4_pass').on('click', function (){
        $( "#btn_picture_4_fail" ).prop( "disabled", false );
        $( "#btn_picture_4_pass" ).prop( "disabled", true );

        $( "#btn_picture_4_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_picture_4_pass" ).addClass( "btn-success" );

        $( "#btn_picture_4_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_picture_4_fail" ).removeClass( "btn-danger" );
        ishihara_counter += 1;        
    });
    $('#btn_picture_4_fail').on('click', function (){

        $( "#btn_picture_4_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_picture_4_fail" ).addClass( "btn-danger" );

        $( "#btn_picture_4_pass" ).addClass( "btn-outline-success" );
        $( "#btn_picture_4_pass" ).removeClass( "btn-success" );

        if($("#btn_picture_4_pass" ).attr('disabled')){
            ishihara_counter -= 1; 
            $( "#btn_picture_4_pass" ).prop( "disabled", false );
            $( "#btn_picture_4_fail" ).prop( "disabled", true );
        }
        else{
            $( "#btn_picture_4_pass" ).prop( "disabled", false );
            $( "#btn_picture_4_fail" ).prop( "disabled", true );
        }
    });

    $('#btn_picture_5_pass').on('click', function (){
        $( "#btn_picture_5_fail" ).prop( "disabled", false );
        $( "#btn_picture_5_pass" ).prop( "disabled", true );

        $( "#btn_picture_5_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_picture_5_pass" ).addClass( "btn-success" );

        $( "#btn_picture_5_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_picture_5_fail" ).removeClass( "btn-danger" );
        ishihara_counter += 1;        
    });
    $('#btn_picture_5_fail').on('click', function (){

        $( "#btn_picture_5_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_picture_5_fail" ).addClass( "btn-danger" );

        $( "#btn_picture_5_pass" ).addClass( "btn-outline-success" );
        $( "#btn_picture_5_pass" ).removeClass( "btn-success" );

        if($("#btn_picture_5_pass" ).attr('disabled')){
            ishihara_counter -= 1; 
            $( "#btn_picture_5_pass" ).prop( "disabled", false );
            $( "#btn_picture_5_fail" ).prop( "disabled", true );
        }
        else{
            $( "#btn_picture_5_pass" ).prop( "disabled", false );
            $( "#btn_picture_5_fail" ).prop( "disabled", true );
        }
    });

    $('#btn_picture_6_pass').on('click', function (){
        $( "#btn_picture_6_fail" ).prop( "disabled", false );
        $( "#btn_picture_6_pass" ).prop( "disabled", true );

        $( "#btn_picture_6_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_picture_6_pass" ).addClass( "btn-success" );

        $( "#btn_picture_6_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_picture_6_fail" ).removeClass( "btn-danger" );

        ishihara_counter += 1;        
    });
    $('#btn_picture_6_fail').on('click', function (){

        $( "#btn_picture_6_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_picture_6_fail" ).addClass( "btn-danger" );

        $( "#btn_picture_6_pass" ).addClass( "btn-outline-success" );
        $( "#btn_picture_6_pass" ).removeClass( "btn-success" );

        if($("#btn_picture_6_pass" ).attr('disabled')){
            ishihara_counter -= 1; 
            $( "#btn_picture_6_pass" ).prop( "disabled", false );
            $( "#btn_picture_6_fail" ).prop( "disabled", true );
        }
        else{
            $( "#btn_picture_6_pass" ).prop( "disabled", false );
            $( "#btn_picture_6_fail" ).prop( "disabled", true );
        }
    });

    // $('#show_answer').on('click', function (){
    //     ishihara_answer =  $('#ishihara_value_answer').val();
    //     alertanswer(ishihara_answer) 
    // });

    $('#ishahara_picture_1_viewer').on('click', function (){
        var source = $("#ishahara_1").val();
        ishihara_answer = 8;
        $('#ishihara_value_answer').val(ishihara_answer);
        $('#picture_modal').modal('show'); 
        $('#ishahara_picture_1').attr('src', source);  
    });

    $('#ishahara_picture_2_viewer').on('click', function (){
        var source = $("#ishahara_2").val();
        ishihara_answer = 10;
        $('#ishihara_value_answer').val(ishihara_answer);
        $('#picture_modal').modal('show'); 
        $('#ishahara_picture_1').attr('src', source);  

    });

    $('#ishahara_picture_3_viewer').on('click', function (){
        ishihara_answer = 13;
        $('#ishihara_value_answer').val(ishihara_answer);
        var source = $("#ishahara_3").val();
        $('#picture_modal').modal('show'); 
        $('#ishahara_picture_1').attr('src', source);  
    });

    $('#ishahara_picture_4_viewer').on('click', function (){
        ishihara_answer = 22;
        $('#ishihara_value_answer').val(ishihara_answer);
        var source = $("#ishahara_4").val();
        $('#picture_modal').modal('show'); 
        $('#ishahara_picture_1').attr('src', source);  
    });

    $('#ishahara_picture_5_viewer').on('click', function (){
        ishihara_answer = 52;
        $('#ishihara_value_answer').val(ishihara_answer);
        var source = $("#ishahara_5").val();
        $('#picture_modal').modal('show'); 
        $('#ishahara_picture_1').attr('src', source);  
    });

    $('#ishahara_picture_6_viewer').on('click', function (){
        ishihara_answer = 69;
        $('#ishihara_value_answer').val(ishihara_answer);
        var source = $("#ishahara_6").val();
        $('#picture_modal').modal('show'); 
        $('#ishahara_picture_1').attr('src', source);  
    });
    
    $('.ishihara').on('click', function (){
       $('#ishihara_modal').modal('show');   
    });

    $('#confirm_ishihara').on('click', function (){
        
        $('#color_blind_test').val(ishihara_counter+'/6') 
        $('#color_blind_result').text('Ishihara Test Result: '+ishihara_counter+'/6')      
        $('#ishihara_modal').modal('hide');    
    });

    var randaudionumboth=  Math.floor(Math.random() * 10) + 1;
    var randaudionumleft=  Math.floor(Math.random() * 10) + 1;
    var randaudionumbright=  Math.floor(Math.random() * 10) + 1;
    var hearingcounter = 0;
    var hearingover = 1;
    $('#hearing_result').text('Hearing Test Result: - /3')  

    $('.hearing').on('click', function (){
        $('#hearing_modal').modal('show');  
    });
         
    var hearingboth = $("#bothvalue").val();
    var hearingleft = $("#leftvalue").val();
    var hearingright = $("#rightvalue").val();
 
    hearingbothfinal = replaceChar(hearingboth, randaudionumboth, 65);
    hearingleftfinal = replaceChar(hearingleft, randaudionumleft, 65);
    hearingrightfinal = replaceChar(hearingright, randaudionumbright, 65);

    $("#bothvalue").val(hearingbothfinal)
    $("#leftvalue").val(hearingleftfinal)
    $("#rightvalue").val(hearingrightfinal)

    $("#myAudio-both").attr("src",  $("#bothvalue").val());
    $("#myAudio_left").attr("src",  $("#leftvalue").val());
    $("#myAudio_right").attr("src",  $("#rightvalue").val());
   
    $('#btn_hearing_left_right').click(function() {
        $('#myAudio-both')[0].play();
        $('#myAudio-both').prop("volume", 0.3);
    });

    $('#btn_hearing_left_1').click(function() {
        $('#myAudio_left')[0].play();
        $('#myAudio_left').prop("volume", 0.3);
    });

    $('#btn_hearing_right_1').click(function() {
        $('#myAudio_right')[0].play();
        $('#myAudio_right').prop("volume", 0.3);
    });

    $('#next_sound').click(function() {
        $('#hearing_result').text('Hearing Test Result: '+hearingcounter+'/3')      
        $('#hearing_modal').modal('hide');  
    });

    $('#btn_hearing_left_right_answer').on('click', function (){
        if($(this).val() == 'show'){
            $('#hearing_left_right_answer').text(': '+randaudionumboth)
            $('#btn_hearing_left_right_answer').text("Hide Answer")
            $('#btn_hearing_left_right_answer').val("hide")
        }
        else{
            $('#hearing_left_right_answer').text("")
            $('#btn_hearing_left_right_answer').text("Show Answer")
            $('#btn_hearing_left_right_answer').val("show")
        }
    });
    $('#btn_hearing_left_1_answer').on('click', function (){
        if($(this).val() == 'show'){
            $('#hearing_left_1_answer').text(": " +randaudionumleft)
            $('#btn_hearing_left_1_answer').text("Hide Answer")
            $('#btn_hearing_left_1_answer').val("hide")
        }
        else{
            $('#hearing_left_1_answer').text("")
            $('#btn_hearing_left_1_answer').text("Show Answer")
            $('#btn_hearing_left_1_answer').val("show")
        }
    });
    $('#btn_hearing_right_1_answer').on('click', function (){
        if($(this).val() == 'show'){
            $('#hearing_right_1_answer').text(": "+randaudionumbright)
            $('#btn_hearing_right_1_answer').text("Hide Answer")
            $('#btn_hearing_right_1_answer').val("hide")
        }
        else{
            $('#hearing_right_1_answer').text("")
            $('#btn_hearing_right_1_answer').text("Show Answer")
            $('#btn_hearing_right_1_answer').val("show")
        }
    })
    

    $('#btn_hearing_left_right_pass').on('click', function (){
        $( "#btn_hearing_left_right_fail" ).prop( "disabled", false );
        $( "#btn_hearing_left_right_pass" ).prop( "disabled", true );

        $( "#btn_hearing_left_right_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_hearing_left_right_pass" ).addClass( "btn-success" );

        $( "#btn_hearing_left_right_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_hearing_left_right_fail" ).removeClass( "btn-danger" );
        hearingcounter += 1;        
    });
    $('#btn_hearing_left_right_fail').on('click', function (){

        $( "#btn_hearing_left_right_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_hearing_left_right_fail" ).addClass( "btn-danger" );

        $( "#btn_hearing_left_right_pass" ).addClass( "btn-outline-success" );
        $( "#btn_hearing_left_right_pass" ).removeClass( "btn-success" );

        if($("#btn_hearing_left_right_pass" ).attr('disabled')){
            hearingcounter -= 1; 
            $( "#btn_hearing_left_right_pass" ).prop( "disabled", false );
            $( "#btn_hearing_left_right_fail" ).prop( "disabled", true );
        }
        else{
            $( "#btn_hearing_left_right_pass" ).prop( "disabled", false );
            $( "#btn_hearing_left_right_fail" ).prop( "disabled", true );
        }
    });

    $('#btn_hearing_left_1_pass').on('click', function (){
        $( "#btn_hearing_left_1_fail" ).prop( "disabled", false );
        $( "#btn_hearing_left_1_pass" ).prop( "disabled", true );

        $( "#btn_hearing_left_1_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_hearing_left_1_pass" ).addClass( "btn-success" );

        $( "#btn_hearing_left_1_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_hearing_left_1_fail" ).removeClass( "btn-danger" );
        hearingcounter += 1;        
    });
    $('#btn_hearing_left_1_fail').on('click', function (){

        $( "#btn_hearing_left_1_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_hearing_left_1_fail" ).addClass( "btn-danger" );

        $( "#btn_hearing_left_1_pass" ).addClass( "btn-outline-success" );
        $( "#btn_hearing_left_1_pass" ).removeClass( "btn-success" );

        if($("#btn_hearing_left_1_pass" ).attr('disabled')){
            hearingcounter -= 1; 
            $( "#btn_hearing_left_1_pass" ).prop( "disabled", false );
            $( "#btn_hearing_left_1_fail" ).prop( "disabled", true );
        }
        else{
            $( "#btn_hearing_left_1_pass" ).prop( "disabled", false );
            $( "#btn_hearing_left_1_fail" ).prop( "disabled", true );
        }
    });

    $('#btn_hearing_right_1_pass').on('click', function (){
        $( "#btn_hearing_right_1_fail" ).prop( "disabled", false );
        $( "#btn_hearing_right_1_pass" ).prop( "disabled", true );

        $( "#btn_hearing_right_1_pass" ).removeClass( "btn-outline-success" );
        $( "#btn_hearing_right_1_pass" ).addClass( "btn-success" );

        $( "#btn_hearing_right_1_fail" ).addClass( "btn-outline-danger" );
        $( "#btn_hearing_right_1_fail" ).removeClass( "btn-danger" );
        hearingcounter += 1;        
    });
    $('#btn_hearing_right_1_fail').on('click', function (){
        $( "#btn_hearing_right_1_fail" ).removeClass( "btn-outline-danger" );
        $( "#btn_hearing_right_1_fail" ).addClass( "btn-danger" );

        $( "#btn_hearing_right_1_pass" ).addClass( "btn-outline-success" );
        $( "#btn_hearing_right_1_pass" ).removeClass( "btn-success" );

        if($("#btn_hearing_right_1_pass" ).attr('disabled')){
            hearingcounter -= 1; 
            $( "#btn_hearing_right_1_pass" ).prop( "disabled", false );
            $( "#btn_hearing_right_1_fail" ).prop( "disabled", true );
        }
        else{
            $( "#btn_hearing_right_1_pass" ).prop( "disabled", false );
            $( "#btn_hearing_right_1_fail" ).prop( "disabled", true );
        }
    });

    
    // $('#timer_div').addClass('hidden');
    // $('#timer_div').removeClass('my-1'); 
    // $('#timer_div').removeClass('p-1');
    // $('#timer').addClass('hidden');

    // var timer =  $('#timer').text();
    // var timerArray = timer.split(/[:]+/);
    // if(timerArray[0] <= 8 && timerArray[0] > 0){
    //     $('#timer_div').removeClass('hidden');
    //     $('#timer').removeClass('hidden');
    //     $('#timer_div').addClass('my-1');
    //     $('#timer_div').addClass('p-1'); 
    //     startTimer();
    // }
    // else if(timerArray[0] < 0){
    //     $('#timer_div').addClass('hidden'); 
    //     $('#timer').addClass('hidden');
    //     $('#timer_div').removeClass('hidden');
    //     $('#timer_div').removeClass('p-1');
    // }
    // else{
    //     $('#timer_div').addClass('hidden'); 
    //     $('#timer').addClass('hidden');
    //     $('#timer_div').removeClass('hidden');
    //     $('#timer_div').removeClass('p-1');
    // }
    // function startTimer() {
    //     var presentTime = $('#timer').text();
    //     var timeArray = presentTime.split(/[:]+/);
    //     var m = timeArray[0];
    //     var s = checkSecond((timeArray[1] - 1));
    //     if(s==59){
    //         m=m-1
    //     }
    //     if((m + '').length == 1){
    //         m = '0' + m;
    //     }
    //     if(m==0 && s == 0){
    //         $('#timer_div').addClass('hidden'); 
    //         $('#timer').addClass('hidden');
    //         $('#timer_div').removeClass('my-1');
    //         $('#timer_div').removeClass('p-1');
    //     }
    //     $('#timer').text(m + ":" + s);
    //     setTimeout(startTimer, 1000);
    //     }
    // function checkSecond(sec) {
    //     if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
    //     if (sec < 0) {sec = "59"};
    //     return sec;
    // }
});