'use strict';

$(document).ready(function () {
  const select2 = $('.select2'),
    selectPicker = $('.selectpicker'),
    bsStepper = document.querySelectorAll('.bs-stepper');

  // Next button functionality
  //camera functions
  $('#recapture').attr('disabled', true);
  $('#select').on('click', function () {
    $('#camera').modal('show');
    if (navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices
        .getUserMedia({ video: true })
        .then(function (stream) {
          video.srcObject = stream;
        })
        .catch(function (err0r) {
          alert('Something went wrong!');
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
  $('#recapture').on('click', function () {
    playVid();
    $('#capture').attr('disabled', false);
    $('#recapture').attr('disabled', true);
  });
  $('#capture').on('click', function () {
    capture();
    pauseVid();
    save();
    $('#capture').attr('disabled', true);
    $('#recapture').attr('disabled', false);
  });
  var vid = document.getElementById('video');
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
    document.getElementById('picture_1').src = canvas.toDataURL();
    $('#base_64').val(canvas.toDataURL());
    $('#canvas').addClass('hidden');
    $('#saveImg').addClass('hidden');
  }

  // $('#age').prop('disabled', true);
  $('#purpose').on('change', function () {
    if ($('#purpose').val() == '9' || $('#purpose').val() == '10') {
      $('#license_no').prop('disabled', true);
    } else {
      $('#license_no').prop('disabled', false);
    }
  });

  //age calculation
  $('#birthday').on('change', function () {
    const birthdayInput = $(this).val();
    if (birthdayInput) {
      const birthday = new Date(birthdayInput);
      const today = new Date();

      let age = today.getFullYear() - birthday.getFullYear();

      const monthDifference = today.getMonth() - birthday.getMonth();
      if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthday.getDate())) {
        age--;
      }

      $('#age').val(age);
    } else {
      $('#age').val('');
    }
  });

  const defaultDate = '2005-01-01';
  $('#birthday').val(defaultDate);
  $('.bday').flatpickr({
    dateFormat: 'Y-m-d',
    defaultDate: defaultDate
  });

  //bmi calculation
  function computeBMI() {
    const height = parseFloat($('#height').val());
    const weight = parseFloat($('#weight').val());

    if (!isNaN(height) && !isNaN(weight) && height > 0) {
      const heightInMeters = height / 100;
      const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(2);
      $('#bmi').val(bmi);
    } else {
      $('#bmi').val('');
    }
  }
  $('#height, #weight').on('input', computeBMI);

  //hidden inputs
  $('input[name="disability"]').change(function () {
    if ($('#disability2').is(':checked')) {
      $('#txtdisability').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#txtdisability').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="disease"]').change(function () {
    if ($('#disease2').is(':checked')) {
      $('#txtdisease').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#txtdisease').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="epilepsy_treatment"]').change(function () {
    if ($('#epilepsy_treatment1').is(':checked')) {
      $('#txt_epilepsy_treatment').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#txt_epilepsy_treatment').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="epilepsy"]').change(function () {
    if ($('#epilepsy1').is(':checked')) {
      // Show the treatment and last seizure sections if "Yes" is selected
      $('#div_epilepsy_treatment').removeClass('visually-hidden');
      $('#div_last_seizure').removeClass('visually-hidden');
    } else {
      // Hide them if "No" is selected
      $('#div_epilepsy_treatment').addClass('visually-hidden');
      $('#div_last_seizure').addClass('visually-hidden');
    }
  });

  $('input[name="diabetes"]').change(function () {
    if ($('#diabetes1').is(':checked')) {
      // Show the treatment and last seizure sections if "Yes" is selected
      $('#div_diabetes_treatment').removeClass('visually-hidden');
    } else {
      // Hide them if "No" is selected
      $('#div_diabetes_treatment').addClass('visually-hidden');
    }
  });

  $('input[name="diabetes_treatment"]').change(function () {
    if ($('#diabetes_treatment1').is(':checked')) {
      $('#txt_diabetes_treatment').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#txt_diabetes_treatment').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="sleepapnea"]').change(function () {
    if ($('#sleepapnea1').is(':checked')) {
      $('#div_sleepapnea_treatment').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#div_sleepapnea_treatment').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="sleepapnea_treatment"]').change(function () {
    if ($('#sleepapnea_treatment1').is(':checked')) {
      $('#txt_sleepapnea_treatment').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#txt_sleepapnea_treatment').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="mental"]').change(function () {
    if ($('#mental1').is(':checked')) {
      $('#div_mental_treatment').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#div_mental_treatment').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="mental_treatment"]').change(function () {
    if ($('#mental_treatment1').is(':checked')) {
      $('#txt_mental_treatment').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#txt_mental_treatment').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="other_treatment"]').change(function () {
    if ($('#other_treatment1').is(':checked')) {
      $('#txt_other_treatment').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#txt_other_treatment').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="other"]').change(function () {
    if ($('#other1').is(':checked')) {
      $('#other_medical_condition').removeClass('visually-hidden'); // Show the text input
      $('#div_other_treatment').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#other_medical_condition').addClass('visually-hidden'); // Hide the text input
      $('#div_other_treatment').addClass('visually-hidden'); // Hide the text input
    }
  });

  $('input[name="assessment"]').change(function () {
    if ($('#assessment1').is(':checked')) {
      $('#div_assessment_status').addClass('visually-hidden');
      $('#div_condition').removeClass('visually-hidden'); // Show the text input
    } else {
      $('#div_condition').addClass('visually-hidden'); // Hide the text input
      $('#div_assessment_status').removeClass('visually-hidden');
    }
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

  // const wizardValidation = document.querySelector('#wizard-validation');
  // if (typeof wizardValidation !== undefined && wizardValidation !== null) {
  //   const wizardValidationForm = wizardValidation.querySelector('#wizard-validation-form');
  //   // const wizardValidationFormStep1 = wizardValidationForm.querySelector('#account-details-validation');
  //   // const wizardValidationFormStep2 = wizardValidationForm.querySelector('#personal-info-validation');
  //   // const wizardValidationFormStep3 = wizardValidationForm.querySelector('#social-links-validation');
  //   // const wizardValidationFormStep4 = wizardValidationForm.querySelector('#mnd-test');
  //   // const wizardValidationFormStep5 = wizardValidationForm.querySelector('#assessment-condition');

  //   const wizardValidationNext = [].slice.call(wizardValidationForm.querySelectorAll('.btn-next'));
  //   const wizardValidationPrev = [].slice.call(wizardValidationForm.querySelectorAll('.btn-prev'));

  //   const progressBar = document.querySelector('.progress-bar');
  //   const totalSteps = 5; // Adjust this based on the total number of steps in your wizard

  //   const validationStepper = new Stepper(wizardValidation, {
  //     linear: true
  //   });

  //   // Function to update the progress bar
  //   function updateProgressBar() {
  //     const currentIndex = validationStepper._currentIndex;
  //     const progressPercentage = ((currentIndex + 1) / totalSteps) * 100;
  //     progressBar.style.width = `${progressPercentage}%`;
  //     progressBar.setAttribute('aria-valuenow', progressPercentage);
  //   }

  //   // Initial update when the page loads
  //   updateProgressBar();

  //   wizardValidationNext.forEach(item => {
  //     item.addEventListener('click', () => {
  //       validationStepper.next();
  //       updateProgressBar();
  //     });
  //   });

  //   wizardValidationPrev.forEach(item => {
  //     item.addEventListener('click', () => {
  //       validationStepper.previous();
  //       updateProgressBar();
  //     });
  //   });
  // }
})();
