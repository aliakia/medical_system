$(document).ready(function () {
  toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: '3000',
    extendedTimeOut: '2000',
    onShown: function () {
      $('.toast').find('.toast-message').append('<div class="loader"></div>');
    }
  };
  var hideSearch = $('.hide-search'),
    isRtl = $('html').attr('data-textdirection') === 'rtl',
    reportsTb = $('#myTable'),
    select2 = $('.select2'),
    basicPickr = $('.flatpickr-basic'),
    dataUrl =
      'fetch_admin_summary_reportsby_date,' +
      $('#date_from').val() +
      ',' +
      $('#date_to').val() +
      ',' +
      $('#status').val();
  $('[data-toggle="tooltip"]').tooltip();

  console.log(dataUrl);
  reportsData(dataUrl);

  if (reportsTb.length) {
    var reportsTbV = reportsTb.dataTable({
      autoWidth: false,
      scrollX: true,
      lengthMenu: [5, 10, 25, 50, 100],
      ordering: true,
      info: true,
      // ajax: {
      //   url: 'fetch_admin_summary_reportsby_date',
      //   data: 'data'
      // },
      data: [],
      columns: [
        { data: 'trans_no' },
        { data: 'full_name' },
        { data: 'purpose' },
        { data: 'physician_name' },
        { data: 'date_uploaded' },
        { data: 'is_lto_sent' }
      ],
      columnDefs: [
        {
          // responsivePriority: 1,
          targets: 6,
          render: function (data, type, full, meta) {
            var transNo = full['trans_no'];
            return `<button type="button" class="btn btn-sm btn-primary me-2 view" value="${transNo}"><i class="ti ti-file-text me-2"></i>View</button>`;
          }
        },
        {
          responsivePriority: 1,
          targets: 2,
          render: function (data, type, full, meta) {
            switch (data) {
              case '1':
                return '<span>New Non-Pro Driver´s License</span>';
              case '2':
                return '<span>New Pro Driver´s License</span>';
              case '3':
                return '<span>Renewal of Non-Pro Driver´s License</span>';
              case '4':
                return '<span>Renewal of Pro Driver´s License</span>';
              case '5':
                return '<span>Renewal of Conductor´s License</span>';
              case '6':
                return '<span>Conversion from Non-Pro to Pro DL</span>';
              case '7':
                return '<span>New Non-Pro Driver´s License (with Foreign License)</span>';
              case '8':
                return '<span>New Pro Driver´s License (with Foreign License)</span>';
              case '9':
                return '<span>New Conductor´s License</span>';
              case '10':
                return '<span>New Student Permit</span>';
              case '11':
                return '<span>Conversion from Pro to Non-Pro DL</span>';
              case '12':
                return '<span>Add Restriction for Non-Pro Driver´s License</span>';
              case '13':
                return '<span>Add Restriction for Pro Driver´s License</span>';
              default:
                return '<span class="badge bg-secondary">Encoder</span>';
            }
          }
        },
        {
          targets: 5, // Column index 5 (is_lto_sent)
          render: function (data) {
            if (data == 0) {
              return '<span class="badge bg-label-warning">Pending</span>';
            } else {
              return '<span class="badge bg-label-success">Uploaded</span>';
            }
          }
        }
      ],
      drawCallback: function (settings) {
        // feather.replace();
        $('.view').on('click', function () {
          var _transValue = this.value;
          // var _url = 'view_saved_data';
          viewDetails(_transValue);
        });
      }
    });
  }

  if (basicPickr.length) {
    basicPickr.flatpickr({
      dateFormat: 'Y-m-d'
    });
  }

  if (select2.length) {
    select2.each(function () {
      $(this)
        .wrap('<div class="position-relative"></div>')
        .select2({
          placeholder: 'Select value',
          dropdownParent: $(this).parent(),
          minimumResultsForSearch: Infinity
        });
    });
  }

  $('#btn_search').on('click', function () {
    search();
  });

  // Function to fetch saved transaction data based on the URL
  // function sumReportsData(url) {
  //   $('#loader').removeClass('visually-hidden').fadeIn(500);
  //   $.ajax({
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     method: 'GET',
  //     url: url,
  //     success: function (data) {
  //       $('#loader').addClass('visually-hidden').fadeOut(500);
  //       // console.log(data);

  //       const dataDetails = data.data; // Assuming the data format contains a 'data' field
  //       reportsTb.dataTable().fnClearTable(); // Clear existing data

  //       if (dataDetails.length !== 0) {
  //         reportsTb.dataTable().fnAddData(dataDetails); // Add new data
  //       } else {
  //         // Optionally handle the case where no data is returned
  //         reportsTb.dataTable().fnClearTable(); // Clear if no data
  //         toastr['info']('No records found for the selected date range.', 'Info', {
  //           closeButton: true,
  //           tapToDismiss: false,
  //           rtl: isRtl
  //         });
  //       }
  //     },
  //     error: function (xhr) {
  //       $('#loader').addClass('visually-hidden').fadeOut(500);
  //       let errorMessage = xhr.status + ': ' + xhr.statusText;
  //       toastr['error'](errorMessage, 'Error', {
  //         closeButton: true,
  //         tapToDismiss: false,
  //         rtl: isRtl
  //       });
  //     }
  //   });
  // }

  // function search() {
  //   var _date_from = $('#date_from').val();
  //   var _date_to = $('#date_to').val();
  //   var _status = $('#status').val();
  //   $('#loader').removeClass('hidden', function () {
  //     $('#loader').fadeIn(500);
  //   });
  //   window.location.href = 'admin_summary_reportsby_date,' + _date_from + ',' + _date_to + ',' + _status;
  // }

  function reportsData(url) {
    $('#loader').removeClass('visually-hidden').fadeIn(500);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'GET',
      url: url,
      success: function (data) {
        $('#loader').addClass('visually-hidden').fadeOut(500);

        console.log(data);

        const dataDetails = data.data; // Assuming the data format contains a 'data' field
        reportsTb.dataTable().fnClearTable(); // Clear existing data
        // console.log(data.transaction_pending);

        let transaction_upload = data.transaction_upload;
        let transaction_pending = data.transaction_pending;

        if (dataDetails.length !== 0) {
          toastr['success']('Records found.', 'Success', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });

          reportsTb.dataTable().fnAddData(dataDetails); // Add new data
          $('#transaction_upload').text(transaction_upload);
          $('#transaction_pending').text(transaction_pending);
        } else {
          // Optionally handle the case where no data is returned
          reportsTb.dataTable().fnClearTable(); // Clear if no data
          toastr['info']('No records found for the selected date range.', 'Info', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
        }
      },
      error: function (xhr) {
        // console.log(xhr);
        $('#loader').addClass('visually-hidden').fadeOut(500);
        let errorMessage = xhr.status + ': ' + xhr.statusText;
        toastr['error'](errorMessage, 'Error', {
          closeButton: true,
          tapToDismiss: false,
          rtl: isRtl
        });
      }
    });
  }

  function search() {
    var _date_from = $('#date_from').val();
    var _date_to = $('#date_to').val();
    var _status = $('#status').val();
    $('#loader').removeClass('visually-hidden', function () {
      $('#loader').fadeIn(500);
    });

    let newDataUrl = 'fetch_admin_summary_reportsby_date,' + _date_from + ',' + _date_to + ',' + _status;
    // console.log(newDataUrl);
    reportsData(newDataUrl);
    // window.location.href = 'fetch_admin_summary_reportsby_date,' + _date_from + ',' + _date_to + ',' + _status;
  }

  $('.view').on('click', function () {
    var trans_no = this.value;
    viewDetails(trans_no);
  });

  function viewDetails(trans_no) {
    $('#loader').removeClass('visually-hidden', function () {
      $('#loader').fadeIn(500);
    });
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'GET',
      url: 'admin_preview_upload_user,' + trans_no,
      success: function (data) {
        $('#loader').addClass('visually-hidden', function () {
          $('#loader').fadeOut(500);
        });
        // console.log(data);
        if (data.status == '1') {
          // resetInput();
          $('#pv_firstname').html(data.tb_scratch[0].first_name);
          $('#pv_middlname').html(data.tb_scratch[0].middle_name);
          $('#pv_surname').html(data.tb_scratch[0].last_name);
          $('#pv_address').html(data.tb_scratch[0].address_full);
          $('#pv_bday').html(data.tb_scratch[0].birthday);
          $('#picture_2').attr('src', data.tb_scratch[0].id_picture);
          $('#pv_gender').html(data.tb_scratch[0].gender);
          $('#pv_nationality').html(data.tb_scratch[0].nationality);
          $('#pv_civil_status').html(data.tb_scratch[0].civil_status);
          $('#pv_occupation').html(data.tb_scratch[0].occupation);
          // $('#pv_license_type').html(data.tb_scratch[0].license_type);
          $('#pv_license_no').html(data.tb_scratch[0].license_no);
          if (data.tb_scratch[0].purpose == '1') {
            $('#pv_purpose').html('New Non-Pro Driver´s License');
          } else if (data.tb_scratch[0].purpose == '2') {
            $('#pv_purpose').html('New Pro Driver´s License');
          } else if (data.tb_scratch[0].purpose == '3') {
            $('#pv_purpose').html('Renewal of Non-Pro Driver´s License');
          } else if (data.tb_scratch[0].purpose == '4') {
            $('#pv_purpose').html('Renewal of Pro Driver´s License');
          } else if (data.tb_scratch[0].purpose == '5') {
            $('#pv_purpose').html('Renewal of Conductor´s License');
          } else if (data.tb_scratch[0].purpose == '6') {
            $('#pv_purpose').html('Conversion from Non-Pro to Pro DL');
          } else if (data.tb_scratch[0].purpose == '7') {
            $('#pv_purpose').html('New Non-Pro Driver´s License (with Foreign License)');
          } else if (data.tb_scratch[0].purpose == '8') {
            $('#pv_purpose').html('New Pro Driver´s License (with Foreign License)');
          } else if (data.tb_scratch[0].purpose == '9') {
            $('#pv_purpose').html('New Conductor´s License');
          } else if (data.tb_scratch[0].purpose == '10') {
            $('#pv_purpose').html('New Student Permit');
          } else if (data.tb_scratch[0].purpose == '11') {
            $('#pv_purpose').html('Conversion from Pro to Non-Pro DL');
          } else if (data.tb_scratch[0].purpose == '12') {
            $('#pv_purpose').html('Add Restriction for Non-Pro Driver´s License');
          } else if (data.tb_scratch[0].purpose == '13') {
            $('#pv_purpose').html('Add Restriction for Pro Driver´s License');
          }

          if (data.tb_scratch[0].pt_height != '') {
            $('#pv_height').html(data.tb_scratch[0].pt_height);
          } else {
            $('#pv_height').html('*');
          }
          if (data.tb_scratch[0].pt_weight != '') {
            $('#pv_weight').html(data.tb_scratch[0].pt_weight);
          } else {
            $('#pv_weight').html('*');
          }
          if (data.tb_scratch[0].pt_blood_pressure != '') {
            $('#pv_bloodpressure').html(data.tb_scratch[0].pt_blood_pressure);
          } else {
            $('#pv_bloodpressure').html('*');
          }
          if (data.tb_scratch[0].pt_body_temperature != '') {
            $('#pv_bodytemperature').html(data.tb_scratch[0].pt_body_temperature);
          } else {
            $('#pv_bodytemperature').html('*');
          }
          if (data.tb_scratch[0].pt_respiratory_rate != '') {
            $('#pv_respiratory_rate').html(data.tb_scratch[0].pt_respiratory_rate);
          } else {
            $('#pv_respiratory_rate').html('*');
          }
          if (data.tb_scratch[0].pt_pulse_rate != '') {
            $('#pv_pulserate').html(data.tb_scratch[0].pt_pulse_rate);
          } else {
            $('#pv_pulserate').html('*');
          }
          if (data.tb_scratch[0].blood_type != '') {
            $('#pv_bloodtype').html(data.tb_scratch[0].blood_type);
          } else {
            $('#pv_bloodtype').html('*');
          }
          if (data.tb_scratch[0].pt_general_physique != '') {
            $('#pv_generalphysique').html(data.tb_scratch[0].pt_general_physique);
          } else {
            $('#pv_generalphysique').html('*');
          }
          if (data.tb_scratch[0].pt_contagious_disease != '') {
            $('#pv_contagiousdisease').html(data.tb_scratch[0].pt_contagious_disease);
          } else {
            $('#pv_contagiousdisease').html('*');
          }

          if (data.tb_scratch[0].pt_ue_normal_left == '1') {
            $('#pv_upperextremities_right').html('normal');
          } else if (data.tb_scratch[0].pt_ue_normal_left == '2') {
            $('#pv_upperextremities_right').html('With Disability');
          } else if (data.tb_scratch[0].pt_ue_normal_left == '3') {
            $('#pv_upperextremities_right').html('With special equipment');
          }

          if (data.tb_scratch[0].pt_ue_normal_right == '1') {
            $('#pv_upperextremities_left').html('normal');
          } else if (data.tb_scratch[0].pt_ue_normal_right == '2') {
            $('#pv_upperextremities_left').html('With Disability');
          } else if (data.tb_scratch[0].pt_ue_normal_right == '3') {
            $('#pv_upperextremities_left').html('With special equipment');
          }

          if (data.tb_scratch[0].pt_le_normal_left == '1') {
            $('#pv_lowerextremities_left').html('normal');
          } else if (data.tb_scratch[0].pt_le_normal_left == '2') {
            $('#pv_lowerextremities_left').html('With Disability');
          } else if (data.tb_scratch[0].pt_le_normal_left == '3') {
            $('#pv_lowerextremities_left').html('With special equipment');
          }

          if (data.tb_scratch[0].pt_le_normal_right == '1') {
            $('#pv_lowerextremities_right').html('normal');
          } else if (data.tb_scratch[0].pt_le_normal_right == '2') {
            $('#pv_lowerextremities_right').html('With Disability');
          } else if (data.tb_scratch[0].pt_le_normal_right == '3') {
            $('#pv_lowerextremities_right').html('With special equipment');
          }

          if (data.tb_scratch[0].pt_eye_color == '1') {
            $('#pv_eyecolor').html('black');
          } else if (data.tb_scratch[0].pt_eye_color == '2') {
            $('#pv_eyecolor').html('brown');
          } else if (data.tb_scratch[0].pt_eye_color == '3') {
            $('#pv_eyecolor').html('other');
          } else if (data.tb_scratch[0].pt_eye_color == '4') {
            $('#pv_eyecolor').html('blue');
          }

          if (data.tb_scratch[0].vt_snellen_bailey_lovie_left != '') {
            $('#pv_snellen_bailey_lovie_left').html(data.tb_scratch[0].vt_snellen_bailey_lovie_left);
          } else {
            $('#pv_snellen_bailey_lovie_left').html('*');
          }

          if (data.tb_scratch[0].vt_snellen_bailey_lovie_right != '') {
            $('#pv_snellen_bailey_lovie_right').html(data.tb_scratch[0].vt_snellen_bailey_lovie_right);
          } else {
            $('#pv_snellen_bailey_lovie_right').html('*');
          }

          if (data.tb_scratch[0].vt_snellen_with_correct_right == '1') {
            $('#pv_snellen_with_correct_right').html('Yes');
          } else if (data.tb_scratch[0].vt_snellen_with_correct_right == '0') {
            $('#pv_snellen_with_correct_right').html('No');
          }

          if (data.tb_scratch[0].vt_snellen_with_correct_left == '1') {
            $('#pv_snellen_with_correct_left').html('Yes');
          } else if (data.tb_scratch[0].vt_snellen_with_correct_left == '0') {
            $('#pv_snellen_with_correct_left').html('No');
          }

          if (data.tb_scratch[0].vt_color_blind_left == '1') {
            $('#pv_color_blind_left').html('Yes');
          } else if (data.tb_scratch[0].vt_color_blind_left == '0') {
            $('#pv_color_blind_left').html('No');
          }

          if (data.tb_scratch[0].vt_color_blind_right == '1') {
            $('#pv_color_blind_right').html('Yes');
          } else if (data.tb_scratch[0].vt_color_blind_right == '0') {
            $('#pv_color_blind_right').html('No');
          }

          $('#pv_glare_contrast_sensitivity_without_lense_right').html(
            data.tb_scratch[0].vt_glare_contrast_sensitivity_function_without_lenses_right
          );
          $('#pv_glare_contrast_sensitivity_without_lense_left').html(
            data.tb_scratch[0].vt_glare_contrast_sensitivity_function_without_lenses_left
          );
          $('#pv_glare_contrast_sensitivity_with_corrective_right').html(
            data.tb_scratch[0].vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri
          );
          $('#pv_glare_contrast_sensitivity_with_corrective_left').html(
            data.tb_scratch[0].vt_glare_contrast_sensitivity_function_with_corretive_lenses_le
          );
          $('#pv_color_blind_test').html(data.tb_scratch[0].vt_color_blind_test);
          $('#pv_eye_injury').html(data.tb_scratch[0].vt_any_eye_injury_disease);
          $('#pv_examination_suggested').html(data.tb_scratch[0].vt_further_examination);

          if (data.tb_scratch[0].at_hearing_left == '1') {
            $('#pv_hearing_left').html('Normal');
          } else if (data.tb_scratch[0].at_hearing_left == '2') {
            $('#pv_hearing_left').html('Reduced');
          } else if (data.tb_scratch[0].at_hearing_left == '3') {
            $('#pv_hearing_left').html('With hearing aid');
          }

          if (data.tb_scratch[0].at_hearing_right == '1') {
            $('#pv_hearing_right').html('Normal');
          } else if (data.tb_scratch[0].at_hearing_right == '2') {
            $('#pv_hearing_right').html('Reduced');
          } else if (data.tb_scratch[0].at_hearing_right == '3') {
            $('#pv_hearing_right').html('With hearing aid');
          }

          if (data.tb_scratch[0].mn_epilepsy == '1') {
            $('#pv_epilepsy').html('Yes');
          } else if (data.tb_scratch[0].mn_epilepsy == '0') {
            $('#pv_epilepsy').html('No');
          }

          if (data.tb_scratch[0].mn_epilepsy_treatment == '1') {
            $('#pv_epilepsytreatment').html('Yes');
          } else if (data.tb_scratch[0].mn_epilepsy_treatment == '0') {
            $('#pv_epilepsytreatment').html('No');
          } else {
            $('#pv_epilepsytreatment').html('*');
          }

          if (data.tb_scratch[0].mn_last_seizure != '' && data.tb_scratch[0].mn_last_seizure != null) {
            $('#pv_lastseizure').html(data.tb_scratch[0].mn_last_seizure);
          } else {
            $('#pv_lastseizure').html('*');
          }

          if (data.tb_scratch[0].mn_diabetes == '1') {
            $('#pv_diabetes').html('Yes');
          } else if (data.tb_scratch[0].mn_diabetes == '0') {
            $('#pv_diabetes').html('No');
          }

          if (data.tb_scratch[0].mn_diabetes_treatment == '1') {
            $('#pv_diabetestreatment').html('Yes');
          } else if (data.tb_scratch[0].mn_diabetes_treatment == '0') {
            $('#pv_diabetestreatment').html('No');
          }

          if (data.tb_scratch[0].mn_sleep_apnea == '1') {
            $('#pv_sleep_apnea').html('Yes');
          } else if (data.tb_scratch[0].mn_sleep_apnea == '0') {
            $('#pv_sleep_apnea').html('No');
          }

          if (data.tb_scratch[0].mn_sleepapnea_treatment == '1') {
            $('#pv_sleep_apneatreatment').html('Yes');
          } else if (data.tb_scratch[0].mn_sleepapnea_treatment == '0') {
            $('#pv_sleep_apneatreatment').html('No');
          }

          if (data.tb_scratch[0].mn_aggressive_manic == '1') {
            $('#pv_aggressive_manic').html('Yes');
          } else if (data.tb_scratch[0].mn_aggressive_manic == '0') {
            $('#pv_aggressive_manic').html('No');
          }

          if (data.tb_scratch[0].mn_mental_treatment == '1') {
            $('#pv_mentaltreatment').html('Yes');
          } else if (data.tb_scratch[0].mn_mental_treatment == '0') {
            $('#pv_mentaltreatment').html('No');
          }

          if (data.tb_scratch[0].mn_others == '1') {
            $('#pv_others').html('Yes');
          } else if (data.tb_scratch[0].mn_others == '0') {
            $('#pv_others').html('No');
          }

          if (
            data.tb_scratch[0].mn_other_medical_condition != '' &&
            data.tb_scratch[0].mn_other_medical_condition != null
          ) {
            $('#pv_other_medical_condition').html(data.tb_scratch[0].mn_other_medical_condition);
          } else {
            $('#pv_other_medical_condition').html('*');
          }

          if (data.tb_scratch[0].mn_other_treatment == '1') {
            $('#pv_other_treatment').html('Yes');
          } else if (data.tb_scratch[0].mn_other_treatment == '0') {
            $('#pv_other_treatment').html('No');
          }
          //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_head_neck_spinal_injury_disorders == '1'){
          //     $('#pv_head_neck_spinal_injury_disorders').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_head_neck_spinal_injury_disorders == '0'){
          //     $('#pv_head_neck_spinal_injury_disorders').html("No");
          // }
          // if(data.tb_scratch2[0].qu_head_neck_spinal_injury_disorders_remarks != '' && data.tb_scratch2[0].qu_head_neck_spinal_injury_disorders_remarks != null){
          //     $('#pv_head_neck_spinal_injury_disorders_remarks').html(data.tb_scratch2[0].qu_head_neck_spinal_injury_disorders_remarks);
          // }
          // else{
          //     $('#pv_head_neck_spinal_injury_disorders_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_seizure_convulsions == '1'){
          //     $('#pv_seizure_convulsions').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_seizure_convulsions == '0'){
          //     $('#pv_seizure_convulsions').html("No");
          // }
          // if(data.tb_scratch2[0].qu_seizure_convulsions_remarks != '' && data.tb_scratch2[0].qu_seizure_convulsions_remarks != null){
          //     $('#pv_seizure_convulsions_remarks').html(data.tb_scratch2[0].qu_seizure_convulsions_remarks);
          // }
          // else{
          //     $('#pv_seizure_convulsions_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_dizziness_fainting == '1'){
          //     $('#pv_dizziness_fainting').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_dizziness_fainting == '0'){
          //     $('#pv_dizziness_fainting').html("No");
          // }
          // if(data.tb_scratch2[0].qu_dizziness_fainting_remarks != '' && data.tb_scratch2[0].qu_dizziness_fainting_remarks != null){
          //     $('#pv_dizziness_fainting_remarks').html(data.tb_scratch2[0].qu_dizziness_fainting_remarks);
          // }
          // else{
          //     $('#pv_dizziness_fainting_remarks').html("*");
          // }
          //  //-------------------------------------------------------
          //  if(data.tb_scratch2[0].qu_eye_problem == '1'){
          //     $('#pv_eye_problem').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_eye_problem == '0'){
          //     $('#pv_eye_problem').html("No");
          // }
          // if(data.tb_scratch2[0].qu_eye_problem_remarks != '' && data.tb_scratch2[0].qu_eye_problem_remarks != null){
          //     $('#pv_eye_problem_remarks').html(data.tb_scratch2[0].qu_eye_problem_remarks);
          // }
          // else{
          //     $('#pv_eye_problem_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_hearing == '1'){
          //     $('#pv_hearing').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_hearing == '0'){
          //     $('#pv_hearing').html("No");
          // }
          // if(data.tb_scratch2[0].qu_hearing_remarks != '' && data.tb_scratch2[0].qu_hearing_remarks != null){
          //     $('#pv_hearing_remarks').html(data.tb_scratch2[0].qu_hearing_remarks);
          // }
          // else{
          //     $('#pv_hearing_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_hypertension == '1'){
          //     $('#pv_hypertension').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_hypertension == '0'){
          //     $('#pv_hypertension').html("No");
          // }
          // if(data.tb_scratch2[0].qu_hypertension_remarks != '' && data.tb_scratch2[0].qu_hypertension_remarks != null){
          //     $('#pv_hypertension_remarks').html(data.tb_scratch2[0].qu_hypertension_remarks);
          // }
          // else{
          //     $('#pv_hypertension_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_heart_attack_stroke == '1'){
          //     $('#pv_heart_attack_stroke').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_heart_attack_stroke == '0'){
          //     $('#pv_heart_attack_stroke').html("No");
          // }
          // if(data.tb_scratch2[0].qu_heart_attack_stroke_remarks != '' && data.tb_scratch2[0].qu_heart_attack_stroke_remarks != null){
          //     $('#pv_heart_attack_stroke_remarks').html(data.tb_scratch2[0].qu_heart_attack_stroke_remarks);
          // }
          // else{
          //     $('#pv_heart_attack_stroke_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_lung_disease == '1'){
          //     $('#pv_lung_disease').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_lung_disease == '0'){
          //     $('#pv_lung_disease').html("No");
          // }
          // if(data.tb_scratch2[0].qu_lung_disease_remarks != '' && data.tb_scratch2[0].qu_lung_disease_remarks != null){
          //     $('#pv_lung_disease_remarks').html(data.tb_scratch2[0].qu_lung_disease_remarks);
          // }
          // else{
          //     $('#pv_lung_disease_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_hyper_acidity_ulcer == '1'){
          //     $('#pv_hyper_acidity_ulcer').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_hyper_acidity_ulcer == '0'){
          //     $('#pv_hyper_acidity_ulcer').html("No");
          // }
          // if(data.tb_scratch2[0].qu_hyper_acidity_ulcer_remarks != '' && data.tb_scratch2[0].qu_hyper_acidity_ulcer_remarks != null){
          //     $('#pv_hyper_acidity_ulcer_remarks').html(data.tb_scratch2[0].qu_hyper_acidity_ulcer_remarks);
          // }
          // else{
          //     $('#pv_hyper_acidity_ulcer_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_diabetes == '1'){
          //     $('#pv_diabetes_').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_diabetes == '0'){
          //     $('#pv_diabetes_').html("No");
          // }
          // if(data.tb_scratch2[0].qu_diabetes_remarks != '' && data.tb_scratch2[0].qu_diabetes_remarks != null){
          //     $('#pv_diabetes_remarks_').html(data.tb_scratch2[0].qu_diabetes_remarks);
          // }
          // else{
          //     $('#pv_diabetes_remarks_').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_kidney_disease_stones_blood_in_urine == '1'){
          //     $('#pv_kidney_disease_stones_blood_in_urine').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_kidney_disease_stones_blood_in_urine == '0'){
          //     $('#pv_kidney_disease_stones_blood_in_urine').html("No");
          // }
          // if(data.tb_scratch2[0].qu_kidney_disease_stones_blood_in_urine_remarks != '' && data.tb_scratch2[0].qu_kidney_disease_stones_blood_in_urine_remarks != null){
          //     $('#pv_kidney_disease_stones_blood_in_urine_remarks').html(data.tb_scratch2[0].qu_kidney_disease_stones_blood_in_urine_remarks)
          // }
          // else{
          //     $('#pv_kidney_disease_stones_blood_in_urine_remarks').html("*");
          // }
          //  //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_muscular_disease == '1'){
          //     $('#pv_muscular_disease').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_muscular_disease == '0'){
          //     $('#pv_muscular_disease').html("No");
          // }
          // if(data.tb_scratch2[0].qu_muscular_disease_remarks != '' && data.tb_scratch2[0].qu_muscular_disease_remarks != null){
          //     $('#pv_muscular_disease_remarks').html(data.tb_scratch2[0].qu_muscular_disease_remarks)
          // }
          // else{
          //     $('#pv_muscular_disease_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_sleep_disorders_sleep_apnea == '1'){
          //     $('#pv_sleep_disorders_sleep_apnea').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_sleep_disorders_sleep_apnea == '0'){
          //     $('#pv_sleep_disorders_sleep_apnea').html("No");
          // }
          // if(data.tb_scratch2[0].qu_sleep_disorders_sleep_apnea_remarks != '' && data.tb_scratch2[0].qu_sleep_disorders_sleep_apnea_remarks != null){
          //     $('#pv_sleep_disorders_sleep_apnea_remarks').html(data.tb_scratch2[0].qu_sleep_disorders_sleep_apnea_remarks)
          // }
          // else{
          //     $('#pv_sleep_disorders_sleep_apnea_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_nervous_psychiatric == '1'){
          //     $('#pv_nervous_psychiatric').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_nervous_psychiatric == '0'){
          //     $('#pv_nervous_psychiatric').html("No");
          // }
          // if(data.tb_scratch2[0].qu_nervous_psychiatric_remarks != '' && data.tb_scratch2[0].qu_nervous_psychiatric_remarks != null){
          //     $('#pv_nervous_psychiatric_remarks').html(data.tb_scratch2[0].qu_nervous_psychiatric_remarks)
          // }
          // else{
          //     $('#pv_nervous_psychiatric_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_anger_management_issues == '1'){
          //     $('#pv_anger_management_issues').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_nervous_psychiatric == '0'){
          //     $('#pv_anger_management_issues').html("No");
          // }
          // if(data.tb_scratch2[0].qu_anger_management_issues_remarks != '' && data.tb_scratch2[0].qu_anger_management_issues_remarks != null){
          //     $('#pv_anger_management_issues_remarks').html(data.tb_scratch2[0].qu_anger_management_issues_remarks)
          // }
          // else{
          //     $('#pv_anger_management_issues_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_anger_management_issues == '1'){
          //     $('#pv_regular_frequent_alcohol_drug').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_nervous_psychiatric == '0'){
          //     $('#pv_regular_frequent_alcohol_drug').html("No");
          // }
          // if(data.tb_scratch2[0].qu_regular_frequent_alcohol_drug_remarks != '' && data.tb_scratch2[0].qu_regular_frequent_alcohol_drug_remarks != null){
          //     $('#pv_regular_frequent_alcohol_drug_remarks').html(data.tb_scratch2[0].qu_regular_frequent_alcohol_drug_remarks)
          // }
          // else{
          //     $('#pv_regular_frequent_alcohol_drug_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_involved_mv_accident_while_driving == '1'){
          //     $('#pv_involved_mv_accident_while_driving').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_involved_mv_accident_while_driving == '0'){
          //     $('#pv_involved_mv_accident_while_driving').html("No");
          // }
          // if(data.tb_scratch2[0].qu_involved_mv_accident_while_driving_remarks != '' && data.tb_scratch2[0].qu_involved_mv_accident_while_driving_remarks != null){
          //     $('#pv_involved_mv_accident_while_driving_remarks').html(data.tb_scratch2[0].qu_involved_mv_accident_while_driving_remarks)
          // }
          // else{
          //     $('#pv_involved_mv_accident_while_driving_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_any_major_illness_injury_operation == '1'){
          //     $('#pv_any_major_illness_injury_operation').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_any_major_illness_injury_operation == '0'){
          //     $('#pv_any_major_illness_injury_operation').html("No");
          // }
          // if(data.tb_scratch2[0].qu_any_major_illness_injury_operation_remarks != '' && data.tb_scratch2[0].qu_any_major_illness_injury_operation_remarks != null){
          //     $('#pv_any_major_illness_injury_operation_remarks').html(data.tb_scratch2[0].qu_any_major_illness_injury_operation_remarks)
          // }
          // else{
          //     $('#pv_any_major_illness_injury_operation_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_any_permanent_impairment== '1'){
          //     $('#pv_any_permanent_impairment').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_any_permanent_impairment == '0'){
          //     $('#pv_any_permanent_impairment').html("No");
          // }
          // if(data.tb_scratch2[0].qu_any_permanent_impairment_remarks != '' && data.tb_scratch2[0].qu_any_permanent_impairment_remarks != null){
          //     $('#pv_any_permanent_impairment_remarks').html(data.tb_scratch2[0].qu_any_permanent_impairment_remarks)
          // }
          // else{
          //     $('#pv_any_permanent_impairment_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_other_disorders == '1'){
          //     $('#pv_other_disorders').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_other_disorders == '0'){
          //     $('#pv_other_disorders').html("No");
          // }
          // if(data.tb_scratch2[0].qu_other_disorders_remarks != '' && data.tb_scratch2[0].qu_other_disorders_remarks != null){
          //     $('#pv_other_disorders_remarks').html(data.tb_scratch2[0].qu_other_disorders_remarks)
          // }
          // else{
          //     $('#pv_other_disorders_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_presently_experiencing_need_medical_attention == '1'){
          //     $('#pv_presently_experiencing_need_medical_attention').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_presently_experiencing_need_medical_attention == '0'){
          //     $('#pv_presently_experiencing_need_medical_attention').html("No");
          // }
          // if(data.tb_scratch2[0].qu_presently_experiencing_need_medical_attention_remarks != '' && data.tb_scratch2[0].qu_presently_experiencing_need_medical_attention_remarks != null){
          //     $('#pv_presently_experiencing_need_medical_attention_remarks').html(data.tb_scratch2[0].qu_presently_experiencing_need_medical_attention_remarks)
          // }
          // else{
          //     $('#pv_presently_experiencing_need_medical_attention_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_often_physician_remarks != '' && data.tb_scratch2[0].qu_often_physician_remarks != null){
          //     $('#pv_often_physician').html(data.tb_scratch2[0].qu_often_physician_remarks)
          // }
          // else{
          //     $('#pv_often_physician').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_date_last_examination_physician_remarks != '' && data.tb_scratch2[0].qu_date_last_examination_physician_remarks != null){
          //     $('#pv_date_last_examination_physician').html(data.tb_scratch2[0].qu_date_last_examination_physician_remarks)
          // }
          // else{
          //     $('#pv_date_last_examination_physician').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_hospitalized_last_five_years == '1'){
          //     $('#pv_hospitalized_last_five_years').html("Yes");
          // }
          // else if(data.tb_scratch2[0].qu_hospitalized_last_five_years == '0'){
          //     $('#pv_hospitalized_last_five_years').html("No");
          // }
          // if(data.tb_scratch2[0].qu_hospitalized_last_five_years_remarks != '' && data.tb_scratch2[0].qu_hospitalized_last_five_years_remarks != null){
          //     $('#pv_hospitalized_last_five_years_remarks').html(data.tb_scratch2[0].qu_hospitalized_last_five_years_remarks)
          // }
          // else{
          //     $('#pv_hospitalized_last_five_years_remarks').html("*");
          // }
          // //-------------------------------------------------------
          // if(data.tb_scratch2[0].qu_date_last_confinement_remarks != '' && data.tb_scratch2[0].qu_date_last_confinement_remarks != null){
          //     $('#pv_date_last_confinement').html(data.tb_scratch2[0].qu_date_last_confinement_remarks)
          // }
          // else{
          //     $('#pv_date_last_confinement').html("*");
          // }
          //-------------------------------------------------------
          if (data.tb_scratch[0].exam_assessment != '' && data.tb_scratch[0].exam_assessment != null) {
            if (data.tb_scratch[0].exam_assessment == 'Fit') {
              $('#pv_exam_assessment').html('FIT TO DRIVE');
            } else if (data.tb_scratch[0].exam_assessment == 'Unfit') {
              $('#pv_exam_assessment').html('UNFIT TO DRIVE');
            }
          } else {
            $('#pv_exam_assessment').html('*');
          }
          //-------------------------------------------------------
          if (data.tb_scratch[0].exam_assessment_remarks != '' && data.tb_scratch[0].exam_assessment_remarks != null) {
            if (data.tb_scratch[0].exam_assessment_remarks == 'Permanent') {
              $('#pv_assessment_status').html('Permanent');
            } else if (data.tb_scratch[0].exam_assessment_remarks == 'Temporary') {
              $('#pv_assessment_status').html('Temporary - ' + 'Duration: ' + data.tb_scratch[0].exam_duration_remarks);
            } else if (data.tb_scratch[0].exam_assessment_remarks == 'Refer') {
              $('#pv_assessment_status').html('Refer to Specialist for further evaluation');
            }
          } else {
            $('#pv_assessment_status').html('*');
          }
          //-------------------------------------------------------
          var ConditionOutput = [];

          if (data.tb_scratch[0].exam_conditions.includes('0')) {
            ConditionOutput.push(' None');
          }
          if (data.tb_scratch[0].exam_conditions.includes('1')) {
            ConditionOutput.push(' Drive only with corrective lens');
          }
          if (data.tb_scratch[0].exam_conditions.includes('2')) {
            ConditionOutput.push(' Drive only with special equipment for upper limbs');
          }
          if (data.tb_scratch[0].exam_conditions.includes('3')) {
            ConditionOutput.push(' Drive only with special equipment for lower limbs');
          }
          if (data.tb_scratch[0].exam_conditions.includes('4')) {
            ConditionOutput.push(' Drive only during daylight');
          }
          if (data.tb_scratch[0].exam_conditions.includes('5')) {
            ConditionOutput.push(' Drive only with hearing aid');
          }

          if (data.tb_scratch[0].exam_conditions != '' && data.tb_scratch[0].exam_conditions != null) {
            $('#pv_exam_conditions').html(ConditionOutput.toString());
          } else {
            $('#pv_exam_conditions').html('*');
          }
          //-------------------------------------------------------
          if (data.tb_scratch[0].pt_remarks != '' && data.tb_scratch[0].pt_remarks != null) {
            $('#pv_remarks').html(data.tb_scratch[0].pt_remarks);
          } else {
            $('#pv_remarks').html('*');
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
      error: function (xhr, status, error) {
        var errorMessage = xhr.status + ': ' + xhr.statusText;
        $('#loader').addClass('visually-hidden', function () {
          $('#loader').fadeOut(500);
        });
        if (xhr.status == 500) {
          toastr['error']('There was a problem connecting to the server.', 'Error', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
        } else if (xhr.status == 0) {
          toastr['error']('Not Connected. Please verify your network connection.', 'Error', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
        } else {
          toastr['error'](errorMessage, 'Error', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
        }
      }
    });
  }

  $('#btn_export').on('click', function () {
    Swal.fire({
      title: 'Are you sure?',
      text: 'You want to Export this report as PDF ?',
      icon: 'warning',
      showDenyButton: true,
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        confirmButton: 'btn btn-primary',
        denyButton: 'btn btn-outline-danger ml-1'
      },
      buttonsStyling: false
    }).then(result => {
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
    var _status = $('#status').val();
    var _date_from = $('#date_from').val();
    var _date_to = $('#date_to').val();
    var _date_to = $('#date_to').val();
    window.open('export_admin_summary_reports,' + _date_from + ',' + _date_to + ',' + _status);
  }

  function htmlEntities(str) {
    if (str == null) {
      return '';
    } else {
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
  }
});
