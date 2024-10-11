$(document).ready(function()
{
    var hideSearch = $('.hide-search'),
    isRtl = $('html').attr('data-textdirection') === 'rtl',
        basicPickr = $('.flatpickr-basic');
    var searchForm = $('#search_form');
    $('[data-toggle="tooltip"]').tooltip();

    $("#myTable").dataTable({
        "autoWidth": false,
        "scrollX":true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "ordering": true,
        "info": true,
        "drawCallback": function( settings ) {
            feather.replace();

            $('.print').on('click', function () {
                var _data = this.value;
                Swal.fire({
                    title: "Are you sure?",
                    text: 'You want to generate and print Certificate now ?',
                    icon: "warning",
                    showDenyButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                      confirmButton: 'btn btn-primary',
                      denyButton: 'btn btn-outline-danger ml-1'
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open('admin_generate_cert,'+_data);
                        $("#loader").removeClass("hidden",function () {
                            $("#loader").fadeIn(500);
                        });
                        window.location.href = "admin_certificate_list";
                    } 
                    // else if (result.isDenied) {
                    //     $("#loader").removeClass("hidden",function () {
                    //         $("#loader").fadeIn(500);
                    //     });
                    //     window.location.href = "dashboard_page";
                    // }
                });
            });
            
        }
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
        window.location.href = "admin_certificate_list_by_date,"+_date_from+","+_date_to;
    }

    // $('.view').on('click', function (){
    //     var trans_no = this.value;
    //     viewDetails(trans_no);
    // });

    // function viewDetails (trans_no){
    //     $("#loader").removeClass("hidden",function () {
    //         $("#loader").fadeIn(500);
    //     });
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         method: "GET",
    //         url: "admin_preview_upload_user,"+trans_no,
    //         success:function(data)
    //         {
    //             $("#loader").addClass("hidden", function() {
    //                 $("#loader").fadeOut(500);
    //             });
    //             // console.log(data);
                // if (data.status == "1") {
                //     resetInput();
                //     $('#pv_firstname').html(data.data_scratch[0].first_name);
                //     $('#pv_middlname').html(data.data_scratch[0].middle_name);
                //     $('#pv_surname').html(data.data_scratch[0].last_name);
                //     $('#pv_address').html(data.data_scratch[0].address_full);
                //     $('#pv_bday').html(data.data_scratch[0].birthday);
                //     $('#picture_2').attr('src', data.data_scratch[0].id_picture);
                //     $('#pv_gender').html(data.data_scratch[0].gender);
                //     $('#pv_nationality').html(data.data_scratch[0].nationality);
                //     $('#pv_civil_status').html(data.data_scratch[0].civil_status);
                //     $('#pv_occupation').html(data.data_scratch[0].occupation);
                //     // $('#pv_license_type').html(data.data_scratch[0].license_type);  
                //     $('#pv_license_no').html(data.data_scratch[0].license_no);  
                //     if(data.data_scratch[0].purpose == '1'){
                //         $('#pv_purpose').html("New Non-Pro Driver´s License"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '2'){
                //         $('#pv_purpose').html("New Pro Driver´s License"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '3'){
                //         $('#pv_purpose').html("Renewal of Non-Pro Driver´s License"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '4'){
                //         $('#pv_purpose').html("Renewal of Pro Driver´s License"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '5'){
                //         $('#pv_purpose').html("Renewal of Conductor´s License"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '6'){
                //         $('#pv_purpose').html("Conversion from Non-Pro to Pro DL"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '7'){
                //         $('#pv_purpose').html("New Non-Pro Driver´s License (with Foreign License)"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '8'){
                //         $('#pv_purpose').html("New Pro Driver´s License (with Foreign License)"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '9'){
                //         $('#pv_purpose').html("New Conductor´s License"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '10'){
                //         $('#pv_purpose').html("New Student Permit"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '11'){
                //         $('#pv_purpose').html("Conversion from Pro to Non-Pro DL"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '12'){
                //         $('#pv_purpose').html("Add Restriction for Non-Pro Driver´s License"); 
                //     }
                //     else if(data.data_scratch[0].purpose == '13'){
                //         $('#pv_purpose').html("Add Restriction for Pro Driver´s License"); 
                //     }

                //     if(data.data_scratch[0].pt_height != ''){
                //         $('#pv_height').html(data.data_scratch[0].pt_height); 
                //     }
                //     else{
                //         $('#pv_height').html("*");
                //     }
                //     if(data.data_scratch[0].pt_weight != ''){
                //         $('#pv_weight').html(data.data_scratch[0].pt_weight); 
                //     }
                //     else{
                //         $('#pv_weight').html("*");
                //     }
                //     if(data.data_scratch[0].pt_blood_pressure != ''){
                //         $('#pv_bloodpressure').html(data.data_scratch[0].pt_blood_pressure); 
                //     }
                //     else{
                //         $('#pv_bloodpressure').html("*");
                //     }
                //     if(data.data_scratch[0].pt_body_temperature != ''){
                //         $('#pv_bodytemperature').html(data.data_scratch[0].pt_body_temperature); 
                //     }
                //     else{
                //         $('#pv_bodytemperature').html("*");
                //     }
                //     if(data.data_scratch[0].pt_respiratory_rate != ''){
                //         $('#pv_respiratory_rate').html(data.data_scratch[0].pt_respiratory_rate); 
                //     }
                //     else{
                //         $('#pv_respiratory_rate').html("*");
                //     }
                //     if(data.data_scratch[0].pt_pulse_rate != ''){
                //         $('#pv_pulserate').html(data.data_scratch[0].pt_pulse_rate); 
                //     }
                //     else{
                //         $('#pv_pulserate').html("*");
                //     }
                //     if(data.data_scratch[0].blood_type != ''){
                //         $('#pv_bloodtype').html(data.data_scratch[0].blood_type); 
                //     }
                //     else{
                //         $('#pv_bloodtype').html("*");
                //     }
                //     if(data.data_scratch[0].pt_general_physique != ''){
                //         $('#pv_generalphysique').html(data.data_scratch[0].pt_general_physique); 
                //     }
                //     else{
                //         $('#pv_generalphysique').html("*");
                //     }
                //     if(data.data_scratch[0].pt_contagious_disease != ''){
                //         $('#pv_contagiousdisease').html(data.data_scratch[0].pt_contagious_disease); 
                //     }
                //     else{
                //         $('#pv_contagiousdisease').html("*");
                //     }
                

                //     if(data.data_scratch[0].pt_ue_normal_left == '1'){
                //         $('#pv_upperextremities_right').html("normal"); 
                //     }
                //     else if(data.data_scratch[0].pt_ue_normal_left == '2'){
                //         $('#pv_upperextremities_right').html("With Disability"); 
                //     }  
                //     else if(data.data_scratch[0].pt_ue_normal_left == '3'){
                //         $('#pv_upperextremities_right').html("With special equipment"); 
                //     } 

                //     if(data.data_scratch[0].pt_ue_normal_right == '1'){
                //         $('#pv_upperextremities_left').html("normal"); 
                //     }
                //     else if(data.data_scratch[0].pt_ue_normal_right == '2'){
                //         $('#pv_upperextremities_left').html("With Disability"); 
                //     }  
                //     else if(data.data_scratch[0].pt_ue_normal_right == '3'){
                //         $('#pv_upperextremities_left').html("With special equipment"); 
                //     } 

                //     if(data.data_scratch[0].pt_le_normal_left == '1'){
                //         $('#pv_lowerextremities_left').html("normal"); 
                //     }
                //     else if(data.data_scratch[0].pt_le_normal_left == '2'){
                //         $('#pv_lowerextremities_left').html("With Disability"); 
                //     }  
                //     else if(data.data_scratch[0].pt_le_normal_left == '3'){
                //         $('#pv_lowerextremities_left').html("With special equipment"); 
                //     } 

                //     if(data.data_scratch[0].pt_le_normal_right == '1'){
                //         $('#pv_lowerextremities_right').html("normal"); 
                //     }
                //     else if(data.data_scratch[0].pt_le_normal_right == '2'){
                //         $('#pv_lowerextremities_right').html("With Disability"); 
                //     }  
                //     else if(data.data_scratch[0].pt_le_normal_right == '3'){
                //         $('#pv_lowerextremities_right').html("With special equipment"); 
                //     } 

                //     if(data.data_scratch[0].pt_eye_color == '1'){
                //         $('#pv_eyecolor').html("black"); 
                //     }
                //     else if(data.data_scratch[0].pt_eye_color == '2'){
                //         $('#pv_eyecolor').html("brown"); 
                //     }  
                //     else if(data.data_scratch[0].pt_eye_color == '3'){
                //         $('#pv_eyecolor').html("other"); 
                //     } 
                //     else if(data.data_scratch[0].pt_eye_color == '4'){
                //         $('#pv_eyecolor').html("blue"); 
                //     } 
                    
                //     if(data.data_scratch[0].vt_snellen_bailey_lovie_left != ''){
                //         $('#pv_snellen_bailey_lovie_left').html(data.data_scratch[0].vt_snellen_bailey_lovie_left);
                //     }
                //     else{
                //         $('#pv_snellen_bailey_lovie_left').html("*");
                //     }

                //     if(data.data_scratch[0].vt_snellen_bailey_lovie_right != ''){                    
                //         $('#pv_snellen_bailey_lovie_right').html(data.data_scratch[0].vt_snellen_bailey_lovie_right);
                //     }
                //     else{
                //         $('#pv_snellen_bailey_lovie_right').html("*");
                //     }

                //     if(data.data_scratch[0].vt_snellen_with_correct_right == '1'){
                //         $('#pv_snellen_with_correct_right').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].vt_snellen_with_correct_right == '0'){
                //         $('#pv_snellen_with_correct_right').html("No"); 
                //     }
                    
                //     if(data.data_scratch[0].vt_snellen_with_correct_left == '1'){
                //         $('#pv_snellen_with_correct_left').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].vt_snellen_with_correct_left == '0'){
                //         $('#pv_snellen_with_correct_left').html("No"); 
                //     } 

                //     if(data.data_scratch[0].vt_color_blind_left == '1'){
                //         $('#pv_color_blind_left').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].vt_color_blind_left == '0'){
                //         $('#pv_color_blind_left').html("No"); 
                //     } 

                //     if(data.data_scratch[0].vt_color_blind_right == '1'){
                //         $('#pv_color_blind_right').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].vt_color_blind_right == '0'){
                //         $('#pv_color_blind_right').html("No"); 
                //     } 

                //     if(data.data_scratch[0].at_hearing_left == '1'){
                //         $('#pv_hearing_left').html("Normal"); 
                //     }
                //     else if(data.data_scratch[0].at_hearing_left == '2'){
                //         $('#pv_hearing_left').html("Reduced"); 
                //     }
                //     else if(data.data_scratch[0].at_hearing_left == '3'){
                //         $('#pv_hearing_left').html("With hearing aid"); 
                //     } 


                //     if(data.data_scratch[0].at_hearing_right == '1'){
                //         $('#pv_hearing_right').html("Normal"); 
                //     }
                //     else if(data.data_scratch[0].at_hearing_right == '2'){
                //         $('#pv_hearing_right').html("Reduced"); 
                //     }
                //     else if(data.data_scratch[0].at_hearing_right == '3'){
                //         $('#pv_hearing_right').html("With hearing aid"); 
                //     }
            

                //     if(data.data_scratch[0].mn_epilepsy == '1'){
                //         $('#pv_epilepsy').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_epilepsy == '0'){
                //         $('#pv_epilepsy').html("No"); 
                //     }

                //     if(data.data_scratch[0].mn_epilepsy_treatment == '1'){
                //         $('#pv_epilepsytreatment').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_epilepsy_treatment == '0'){
                //         $('#pv_epilepsytreatment').html("No"); 
                //     }
                //     else{
                //         $('#pv_epilepsytreatment').html("*"); 
                //     }

                //     if(data.data_scratch[0].mn_last_seizure != '' && data.data_scratch[0].mn_last_seizure != null){
                //         $('#pv_lastseizure').html(data.data_scratch[0].mn_last_seizure);
                //     }
                //     else{
                //         $('#pv_lastseizure').html("*");
                //     }
                    
                //     if(data.data_scratch[0].mn_diabetes == '1'){
                //         $('#pv_diabetes').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_diabetes == '0'){
                //         $('#pv_diabetes').html("No"); 
                //     }

                //     if(data.data_scratch[0].mn_diabetes_treatment == '1'){
                //         $('#pv_diabetestreatment').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_diabetes_treatment == '0'){
                //         $('#pv_diabetestreatment').html("No"); 
                //     }

                //     if(data.data_scratch[0].mn_sleep_apnea == '1'){
                //         $('#pv_sleep_apnea').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_sleep_apnea == '0'){
                //         $('#pv_sleep_apnea').html("No"); 
                //     }

                //     if(data.data_scratch[0].mn_sleepapnea_treatment == '1'){
                //         $('#pv_sleep_apneatreatment').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_sleepapnea_treatment == '0'){
                //         $('#pv_sleep_apneatreatment').html("No"); 
                //     }

                //     if(data.data_scratch[0].mn_aggressive_manic == '1'){
                //         $('#pv_aggressive_manic').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_aggressive_manic == '0'){
                //         $('#pv_aggressive_manic').html("No"); 
                //     }

                //     if(data.data_scratch[0].mn_mental_treatment == '1'){
                //         $('#pv_mentaltreatment').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_mental_treatment == '0'){
                //         $('#pv_mentaltreatment').html("No"); 
                //     }

                //     if(data.data_scratch[0].mn_others == '1'){
                //         $('#pv_others').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_others == '0'){
                //         $('#pv_others').html("No"); 
                //     }

                //     if(data.data_scratch[0].mn_other_medical_condition != '' && data.data_scratch[0].mn_other_medical_condition != null){
                //         $('#pv_other_medical_condition').html(data.data_scratch[0].mn_other_medical_condition);
                //     }
                //     else{
                //         $('#pv_other_medical_condition').html("*");
                //     }
                
                //     if(data.data_scratch[0].mn_other_treatment == '1'){
                //         $('#pv_other_treatment').html("Yes"); 
                //     }
                //     else if(data.data_scratch[0].mn_other_treatment == '0'){
                //         $('#pv_other_treatment').html("No"); 
                //     }
                // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_head_neck_spinal_injury_disorders == '1'){
                // //     $('#pv_head_neck_spinal_injury_disorders').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_head_neck_spinal_injury_disorders == '0'){
                // //     $('#pv_head_neck_spinal_injury_disorders').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_head_neck_spinal_injury_disorders_remarks != '' && data.data_scratch2[0].qu_head_neck_spinal_injury_disorders_remarks != null){
                // //     $('#pv_head_neck_spinal_injury_disorders_remarks').html(data.data_scratch2[0].qu_head_neck_spinal_injury_disorders_remarks);
                // // }
                // // else{
                // //     $('#pv_head_neck_spinal_injury_disorders_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_seizure_convulsions == '1'){
                // //     $('#pv_seizure_convulsions').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_seizure_convulsions == '0'){
                // //     $('#pv_seizure_convulsions').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_seizure_convulsions_remarks != '' && data.data_scratch2[0].qu_seizure_convulsions_remarks != null){
                // //     $('#pv_seizure_convulsions_remarks').html(data.data_scratch2[0].qu_seizure_convulsions_remarks);
                // // }
                // // else{
                // //     $('#pv_seizure_convulsions_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_dizziness_fainting == '1'){
                // //     $('#pv_dizziness_fainting').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_dizziness_fainting == '0'){
                // //     $('#pv_dizziness_fainting').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_dizziness_fainting_remarks != '' && data.data_scratch2[0].qu_dizziness_fainting_remarks != null){
                // //     $('#pv_dizziness_fainting_remarks').html(data.data_scratch2[0].qu_dizziness_fainting_remarks);
                // // }
                // // else{
                // //     $('#pv_dizziness_fainting_remarks').html("*");
                // // }
                // //  //-------------------------------------------------------
                // //  if(data.data_scratch2[0].qu_eye_problem == '1'){
                // //     $('#pv_eye_problem').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_eye_problem == '0'){
                // //     $('#pv_eye_problem').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_eye_problem_remarks != '' && data.data_scratch2[0].qu_eye_problem_remarks != null){
                // //     $('#pv_eye_problem_remarks').html(data.data_scratch2[0].qu_eye_problem_remarks);
                // // }
                // // else{
                // //     $('#pv_eye_problem_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_hearing == '1'){
                // //     $('#pv_hearing').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_hearing == '0'){
                // //     $('#pv_hearing').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_hearing_remarks != '' && data.data_scratch2[0].qu_hearing_remarks != null){
                // //     $('#pv_hearing_remarks').html(data.data_scratch2[0].qu_hearing_remarks);
                // // }
                // // else{
                // //     $('#pv_hearing_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_hypertension == '1'){
                // //     $('#pv_hypertension').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_hypertension == '0'){
                // //     $('#pv_hypertension').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_hypertension_remarks != '' && data.data_scratch2[0].qu_hypertension_remarks != null){
                // //     $('#pv_hypertension_remarks').html(data.data_scratch2[0].qu_hypertension_remarks);
                // // }
                // // else{
                // //     $('#pv_hypertension_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_heart_attack_stroke == '1'){
                // //     $('#pv_heart_attack_stroke').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_heart_attack_stroke == '0'){
                // //     $('#pv_heart_attack_stroke').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_heart_attack_stroke_remarks != '' && data.data_scratch2[0].qu_heart_attack_stroke_remarks != null){
                // //     $('#pv_heart_attack_stroke_remarks').html(data.data_scratch2[0].qu_heart_attack_stroke_remarks);
                // // }
                // // else{
                // //     $('#pv_heart_attack_stroke_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_lung_disease == '1'){
                // //     $('#pv_lung_disease').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_lung_disease == '0'){
                // //     $('#pv_lung_disease').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_lung_disease_remarks != '' && data.data_scratch2[0].qu_lung_disease_remarks != null){
                // //     $('#pv_lung_disease_remarks').html(data.data_scratch2[0].qu_lung_disease_remarks);
                // // }
                // // else{
                // //     $('#pv_lung_disease_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_hyper_acidity_ulcer == '1'){
                // //     $('#pv_hyper_acidity_ulcer').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_hyper_acidity_ulcer == '0'){
                // //     $('#pv_hyper_acidity_ulcer').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_hyper_acidity_ulcer_remarks != '' && data.data_scratch2[0].qu_hyper_acidity_ulcer_remarks != null){
                // //     $('#pv_hyper_acidity_ulcer_remarks').html(data.data_scratch2[0].qu_hyper_acidity_ulcer_remarks);
                // // }
                // // else{
                // //     $('#pv_hyper_acidity_ulcer_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_diabetes == '1'){
                // //     $('#pv_diabetes_').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_diabetes == '0'){
                // //     $('#pv_diabetes_').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_diabetes_remarks != '' && data.data_scratch2[0].qu_diabetes_remarks != null){
                // //     $('#pv_diabetes_remarks_').html(data.data_scratch2[0].qu_diabetes_remarks);
                // // }
                // // else{
                // //     $('#pv_diabetes_remarks_').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_kidney_disease_stones_blood_in_urine == '1'){
                // //     $('#pv_kidney_disease_stones_blood_in_urine').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_kidney_disease_stones_blood_in_urine == '0'){
                // //     $('#pv_kidney_disease_stones_blood_in_urine').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_kidney_disease_stones_blood_in_urine_remarks != '' && data.data_scratch2[0].qu_kidney_disease_stones_blood_in_urine_remarks != null){
                // //     $('#pv_kidney_disease_stones_blood_in_urine_remarks').html(data.data_scratch2[0].qu_kidney_disease_stones_blood_in_urine_remarks)
                // // }
                // // else{
                // //     $('#pv_kidney_disease_stones_blood_in_urine_remarks').html("*");
                // // }
                // //  //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_muscular_disease == '1'){
                // //     $('#pv_muscular_disease').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_muscular_disease == '0'){
                // //     $('#pv_muscular_disease').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_muscular_disease_remarks != '' && data.data_scratch2[0].qu_muscular_disease_remarks != null){
                // //     $('#pv_muscular_disease_remarks').html(data.data_scratch2[0].qu_muscular_disease_remarks)
                // // }
                // // else{
                // //     $('#pv_muscular_disease_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_sleep_disorders_sleep_apnea == '1'){
                // //     $('#pv_sleep_disorders_sleep_apnea').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_sleep_disorders_sleep_apnea == '0'){
                // //     $('#pv_sleep_disorders_sleep_apnea').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_sleep_disorders_sleep_apnea_remarks != '' && data.data_scratch2[0].qu_sleep_disorders_sleep_apnea_remarks != null){
                // //     $('#pv_sleep_disorders_sleep_apnea_remarks').html(data.data_scratch2[0].qu_sleep_disorders_sleep_apnea_remarks)
                // // }
                // // else{
                // //     $('#pv_sleep_disorders_sleep_apnea_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_nervous_psychiatric == '1'){
                // //     $('#pv_nervous_psychiatric').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_nervous_psychiatric == '0'){
                // //     $('#pv_nervous_psychiatric').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_nervous_psychiatric_remarks != '' && data.data_scratch2[0].qu_nervous_psychiatric_remarks != null){
                // //     $('#pv_nervous_psychiatric_remarks').html(data.data_scratch2[0].qu_nervous_psychiatric_remarks)
                // // }
                // // else{
                // //     $('#pv_nervous_psychiatric_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_anger_management_issues == '1'){
                // //     $('#pv_anger_management_issues').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_nervous_psychiatric == '0'){
                // //     $('#pv_anger_management_issues').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_anger_management_issues_remarks != '' && data.data_scratch2[0].qu_anger_management_issues_remarks != null){
                // //     $('#pv_anger_management_issues_remarks').html(data.data_scratch2[0].qu_anger_management_issues_remarks)
                // // }
                // // else{
                // //     $('#pv_anger_management_issues_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_anger_management_issues == '1'){
                // //     $('#pv_regular_frequent_alcohol_drug').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_nervous_psychiatric == '0'){
                // //     $('#pv_regular_frequent_alcohol_drug').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_regular_frequent_alcohol_drug_remarks != '' && data.data_scratch2[0].qu_regular_frequent_alcohol_drug_remarks != null){
                // //     $('#pv_regular_frequent_alcohol_drug_remarks').html(data.data_scratch2[0].qu_regular_frequent_alcohol_drug_remarks)
                // // }
                // // else{
                // //     $('#pv_regular_frequent_alcohol_drug_remarks').html("*");
                // // }          
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_involved_mv_accident_while_driving == '1'){
                // //     $('#pv_involved_mv_accident_while_driving').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_involved_mv_accident_while_driving == '0'){
                // //     $('#pv_involved_mv_accident_while_driving').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_involved_mv_accident_while_driving_remarks != '' && data.data_scratch2[0].qu_involved_mv_accident_while_driving_remarks != null){
                // //     $('#pv_involved_mv_accident_while_driving_remarks').html(data.data_scratch2[0].qu_involved_mv_accident_while_driving_remarks)
                // // }
                // // else{
                // //     $('#pv_involved_mv_accident_while_driving_remarks').html("*");
                // // }  
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_any_major_illness_injury_operation == '1'){
                // //     $('#pv_any_major_illness_injury_operation').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_any_major_illness_injury_operation == '0'){
                // //     $('#pv_any_major_illness_injury_operation').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_any_major_illness_injury_operation_remarks != '' && data.data_scratch2[0].qu_any_major_illness_injury_operation_remarks != null){
                // //     $('#pv_any_major_illness_injury_operation_remarks').html(data.data_scratch2[0].qu_any_major_illness_injury_operation_remarks)
                // // }
                // // else{
                // //     $('#pv_any_major_illness_injury_operation_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_any_permanent_impairment== '1'){
                // //     $('#pv_any_permanent_impairment').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_any_permanent_impairment == '0'){
                // //     $('#pv_any_permanent_impairment').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_any_permanent_impairment_remarks != '' && data.data_scratch2[0].qu_any_permanent_impairment_remarks != null){
                // //     $('#pv_any_permanent_impairment_remarks').html(data.data_scratch2[0].qu_any_permanent_impairment_remarks)
                // // }
                // // else{
                // //     $('#pv_any_permanent_impairment_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_other_disorders == '1'){
                // //     $('#pv_other_disorders').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_other_disorders == '0'){
                // //     $('#pv_other_disorders').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_other_disorders_remarks != '' && data.data_scratch2[0].qu_other_disorders_remarks != null){
                // //     $('#pv_other_disorders_remarks').html(data.data_scratch2[0].qu_other_disorders_remarks)
                // // }
                // // else{
                // //     $('#pv_other_disorders_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_presently_experiencing_need_medical_attention == '1'){
                // //     $('#pv_presently_experiencing_need_medical_attention').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_presently_experiencing_need_medical_attention == '0'){
                // //     $('#pv_presently_experiencing_need_medical_attention').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_presently_experiencing_need_medical_attention_remarks != '' && data.data_scratch2[0].qu_presently_experiencing_need_medical_attention_remarks != null){
                // //     $('#pv_presently_experiencing_need_medical_attention_remarks').html(data.data_scratch2[0].qu_presently_experiencing_need_medical_attention_remarks)
                // // }
                // // else{
                // //     $('#pv_presently_experiencing_need_medical_attention_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_often_physician_remarks != '' && data.data_scratch2[0].qu_often_physician_remarks != null){
                // //     $('#pv_often_physician').html(data.data_scratch2[0].qu_often_physician_remarks)
                // // }
                // // else{
                // //     $('#pv_often_physician').html("*");
                // // }             
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_date_last_examination_physician_remarks != '' && data.data_scratch2[0].qu_date_last_examination_physician_remarks != null){
                // //     $('#pv_date_last_examination_physician').html(data.data_scratch2[0].qu_date_last_examination_physician_remarks)
                // // }
                // // else{
                // //     $('#pv_date_last_examination_physician').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_hospitalized_last_five_years == '1'){
                // //     $('#pv_hospitalized_last_five_years').html("Yes"); 
                // // }
                // // else if(data.data_scratch2[0].qu_hospitalized_last_five_years == '0'){
                // //     $('#pv_hospitalized_last_five_years').html("No"); 
                // // }
                // // if(data.data_scratch2[0].qu_hospitalized_last_five_years_remarks != '' && data.data_scratch2[0].qu_hospitalized_last_five_years_remarks != null){
                // //     $('#pv_hospitalized_last_five_years_remarks').html(data.data_scratch2[0].qu_hospitalized_last_five_years_remarks)
                // // }
                // // else{
                // //     $('#pv_hospitalized_last_five_years_remarks').html("*");
                // // }
                // // //-------------------------------------------------------
                // // if(data.data_scratch2[0].qu_date_last_confinement_remarks != '' && data.data_scratch2[0].qu_date_last_confinement_remarks != null){
                // //     $('#pv_date_last_confinement').html(data.data_scratch2[0].qu_date_last_confinement_remarks)
                // // }
                // // else{
                // //     $('#pv_date_last_confinement').html("*");
                // // }
                // //-------------------------------------------------------
                // if(data.data_scratch[0].exam_assessment != '' && data.data_scratch[0].exam_assessment != null){
                //     if(data.data_scratch[0].exam_assessment == 'Fit'){
                //         $('#pv_exam_assessment').html("FIT TO DRIVE"); 
                //     }
                //     else if(data.data_scratch[0].exam_assessment == 'Unfit'){
                //         $('#pv_exam_assessment').html("UNFIT TO DRIVE"); 
                //     }
                // }
                // else{
                //     $('#pv_exam_assessment').html("*");
                // }
                // //-------------------------------------------------------
                // if(data.data_scratch[0].exam_assessment_remarks != '' && data.data_scratch[0].exam_assessment_remarks != null){
                //     if(data.data_scratch[0].exam_assessment_remarks == 'Permanent'){
                //         $('#pv_assessment_status').html("Permanent"); 
                //     }
                //     else if(data.data_scratch[0].exam_assessment_remarks == 'Temporary'){
                //         $('#pv_assessment_status').html("Temporary"); 
                //     }
                //     else if(data.data_scratch[0].exam_assessment_remarks == 'Refer'){
                //         $('#pv_assessment_status').html("Refer to Specialist for further evaluation"); 
                //     }
                // }
                // else{
                //     $('#pv_assessment_status').html("*");
                // }
                // //-------------------------------------------------------
                // var ConditionOutput= [];
                
                // if(data.data_scratch[0].exam_conditions.includes("0")){
                //     ConditionOutput.push(" None");
                // }
                // if(data.data_scratch[0].exam_conditions.includes("1")){
                //     ConditionOutput.push(" Drive only with corrective lens");
                // }
                // if(data.data_scratch[0].exam_conditions.includes("2")){
                //     ConditionOutput.push(" Drive only with special equipment for upper limbs");
                // }
                // if(data.data_scratch[0].exam_conditions.includes("3")){
                //     ConditionOutput.push(" Drive only with special equipment for lower limbs");
                // }
                // if(data.data_scratch[0].exam_conditions.includes("4")){
                //     ConditionOutput.push(" Drive only during daylight");
                // }
                // if(data.data_scratch[0].exam_conditions.includes("5")){
                //     ConditionOutput.push(" Drive only with hearing aid");
                // }

                // if(data.data_scratch[0].exam_conditions != '' && data.data_scratch[0].exam_conditions != null){
                //     $('#pv_exam_conditions').html(ConditionOutput.toString()); 
                // }
                // else{
                //     $('#pv_exam_conditions').html("*");
                // }
                // //-------------------------------------------------------
                // if(data.data_scratch[0].pt_remarks != '' && data.data_scratch[0].pt_remarks != null){
                //     $('#pv_remarks').html(data.data_scratch[0].pt_remarks);
                // }
                // else{
                //     $('#pv_remarks').html("*");
                // }  

                // $('#view_details').modal('show'); 
                // }
    //            else {
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

    $('.print').on('click', function () {
        var _data = this.value;
        Swal.fire({
            title: "Are you sure?",
            text: 'You want to generate and print Certificate now ?',
            icon: "warning",
            showDenyButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
              confirmButton: 'btn btn-primary',
              denyButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                window.open('admin_generate_cert,'+_data);
                $("#loader").removeClass("hidden",function () {
                    $("#loader").fadeIn(500);
                });
                window.location.href = "admin_certificate_list";
            } 
            // else if (result.isDenied) {
            //     $("#loader").removeClass("hidden",function () {
            //         $("#loader").fadeIn(500);
            //     });
            //     window.location.href = "dashboard_page";
            // }
        });
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