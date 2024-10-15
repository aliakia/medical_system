'use strict';

(function () {
  const select2 = $('.select2'),
    selectPicker = $('.selectpicker');

  // Wizard Validation
  // --------------------------------------------------------------------
  const wizardValidation = document.querySelector('#wizard-validation');
  if (wizardValidation) {
    // Wizard form
    const wizardValidationForm = wizardValidation.querySelector('#wizard-validation-form');
    // Wizard steps
    const wizardValidationFormStep1 = wizardValidationForm.querySelector('#step1');
    const wizardValidationFormStep2 = wizardValidationForm.querySelector('#step2');
    const wizardValidationFormStep3 = wizardValidationForm.querySelector('#step3');
    const wizardValidationFormStep4 = wizardValidationForm.querySelector('#step4');
    const wizardValidationFormStep5 = wizardValidationForm.querySelector('#step5');

    // Wizard next prev button
    const wizardValidationNext = Array.from(wizardValidationForm.querySelectorAll('.btn-next'));
    const wizardValidationPrev = Array.from(wizardValidationForm.querySelectorAll('.btn-prev'));

    const validationStepper = new Stepper(wizardValidation, {
      linear: true
    });

    // Helper function to create form validation
    const createFormValidation = (formStep, fields) => {
      return FormValidation.formValidation(formStep, {
        fields: fields,
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            eleInvalidClass: '',
            rowSelector: '.col-sm-12'
          }),
          submitButton: new FormValidation.plugins.SubmitButton()
        }
      }).on('core.form.valid', function () {
        // Jump to the next step when all fields in the current step are valid
        validationStepper.next();
      });
    };

    // Form validation for each step
    const formValidation1 = createFormValidation(wizardValidationFormStep1, {
      firstname: {
        validators: { notEmpty: { message: 'The first name is required' } }
      },
      middlename: {
        validators: { notEmpty: { message: 'The middle name is required' } }
      },
      lastname: {
        validators: { notEmpty: { message: 'The last name is required' } }
      },
      address: {
        validators: { notEmpty: { message: 'The address is required' } }
      },
      birthday: {
        validators: {
          notEmpty: { message: 'The birthday is required' },
          date: { format: 'YYYY-MM-DD', message: 'The birthday is not a valid date' }
        }
      },
      age: {
        validators: {
          notEmpty: { message: 'The age is required' },
          numeric: { message: 'The age must be a number' }
        }
      },
      nationality: {
        validators: { notEmpty: { message: 'The nationality is required' } }
      },
      gender: {
        validators: { notEmpty: { message: 'The gender is required' } }
      },
      civilstatus: {
        validators: { notEmpty: { message: 'The civil status is required' } }
      },
      occupation: {
        validators: { notEmpty: { message: 'The occupation is required' } }
      },
      purpose: {
        validators: { notEmpty: { message: 'The purpose is required' } }
      },
      license_no: {
        validators: { notEmpty: { message: 'The license number is required' } }
      },
      lto_client_id: {
        validators: { notEmpty: { message: 'The LTO client ID is required' } }
      }
    });

    const formValidation2 = createFormValidation(wizardValidationFormStep2, {
      height: {
        validators: {
          notEmpty: { message: 'Height is required' },
          numeric: { message: 'Height must be a number' }
        }
      },
      weight: {
        validators: {
          notEmpty: { message: 'Weight is required' },
          numeric: { message: 'Weight must be a number' }
        }
      },
      mm: {
        validators: {
          notEmpty: { message: 'Blood pressure mm is required' },
          numeric: { message: 'Blood pressure mm must be a number' }
        }
      },
      hg: {
        validators: {
          notEmpty: { message: 'Blood pressure Hg is required' },
          numeric: { message: 'Blood pressure Hg must be a number' }
        }
      },
      body_temperature: {
        validators: {
          notEmpty: { message: 'Body temperature is required' },
          numeric: { message: 'Body temperature must be a number' }
        }
      },
      pulse_rate: {
        validators: {
          notEmpty: { message: 'Pulse rate is required' },
          numeric: { message: 'Pulse rate must be a number' }
        }
      },
      respiratory_rate: {
        validators: {
          notEmpty: { message: 'Respiratory rate is required' },
          numeric: { message: 'Respiratory rate must be a number' }
        }
      },
      blood_type: {
        validators: {
          notEmpty: { message: 'Blood type is required' }
        }
      },
      upper_extremities_left: {
        validators: {
          notEmpty: { message: 'Upper extremities left is required' }
        }
      },
      upper_extremities_right: {
        validators: {
          notEmpty: { message: 'Upper extremities right is required' }
        }
      },
      lower_extremities_left: {
        validators: {
          notEmpty: { message: 'Lower extremities left is required' }
        }
      },
      lower_extremities_right: {
        validators: {
          notEmpty: { message: 'Lower extremities right is required' }
        }
      },
      disability: {
        validators: {
          notEmpty: { message: 'General physique is required' }
        }
      },
      disease: {
        validators: {
          notEmpty: { message: 'Contagious disease status is required' }
        }
      }
    });

    const formValidation3 = createFormValidation(wizardValidationFormStep3, {
      fields: {
        eye_color: {
          validators: {
            notEmpty: {
              message: 'Eye color is required'
            }
          }
        },
        snellen_bailey_lovie_left: {
          validators: {
            notEmpty: {
              message: 'Left Eye: Snellen/Bailey-Lovie result is required'
            },
            numeric: {
              message: 'The input must be a number'
            }
          }
        },
        snellen_bailey_lovie_right: {
          validators: {
            notEmpty: {
              message: 'Right Eye: Snellen/Bailey-Lovie result is required'
            },
            numeric: {
              message: 'The input must be a number'
            }
          }
        },
        corrective_lens_left: {
          validators: {
            notEmpty: {
              message: 'Selection is required for corrective lens left'
            }
          }
        },
        corrective_lens_right: {
          validators: {
            notEmpty: {
              message: 'Selection is required for corrective lens right'
            }
          }
        },
        color_blind_left: {
          validators: {
            notEmpty: {
              message: 'Selection is required for color blind left'
            }
          }
        },
        color_blind_right: {
          validators: {
            notEmpty: {
              message: 'Selection is required for color blind right'
            }
          }
        },
        glare_contrast_sensitivity_without_lense_right: {
          validators: {
            notEmpty: {
              message: 'Right Eye: Without Lenses result is required'
            },
            numeric: {
              message: 'The input must be a number'
            }
          }
        },
        glare_contrast_sensitivity_without_lense_left: {
          validators: {
            notEmpty: {
              message: 'Left Eye: Without Lenses result is required'
            },
            numeric: {
              message: 'The input must be a number'
            }
          }
        },
        glare_contrast_sensitivity_with_corrective_right: {
          validators: {
            notEmpty: {
              message: 'Right Eye: With Corrective or Contact Lenses result is required'
            },
            numeric: {
              message: 'The input must be a number'
            }
          }
        },
        glare_contrast_sensitivity_with_corrective_left: {
          validators: {
            notEmpty: {
              message: 'Left Eye: With Corrective or Contact Lenses result is required'
            },
            numeric: {
              message: 'The input must be a number'
            }
          }
        },
        color_blind_test: {
          validators: {
            notEmpty: {
              message: 'Color Blind Test result is required'
            }
          }
        },
        eye_injury: {
          validators: {
            notEmpty: {
              message: 'Please specify any eye injury or disease'
            }
          }
        },
        examination_suggested: {
          validators: {
            notEmpty: {
              message: 'Selection is required for further eye examination'
            }
          }
        },
        hearing_left: {
          validators: {
            notEmpty: {
              message: 'Selection is required for left ear hearing'
            }
          }
        },
        hearing_right: {
          validators: {
            notEmpty: {
              message: 'Selection is required for right ear hearing'
            }
          }
        }
      }
    });

    const formValidation4 = createFormValidation(wizardValidationFormStep3, {
      // Define fields for step 3 validation
      fields: {
        epilepsy: {
          validators: {
            notEmpty: {
              message: 'Epilepsy selection is required.'
            }
          }
        },
        epilepsy_treatment: {
          validators: {
            notEmpty: {
              message: 'Epilepsy treatment selection is required.'
            }
          }
        },
        last_seizure: {
          validators: {
            date: {
              format: 'YYYY-MM-DD', // Adjust format as needed
              message: 'The last seizure date is not valid.'
            },
            notEmpty: {
              message: 'Last seizure date is required if epilepsy is yes.'
            }
          }
        },
        diabetes: {
          validators: {
            notEmpty: {
              message: 'Diabetes selection is required.'
            }
          }
        },
        diabetes_treatment: {
          validators: {
            notEmpty: {
              message: 'Diabetes treatment selection is required.'
            }
          }
        },
        sleepapnea: {
          validators: {
            notEmpty: {
              message: 'Sleep Apnea selection is required.'
            }
          }
        },
        sleepapnea_treatment: {
          validators: {
            notEmpty: {
              message: 'Sleep Apnea treatment selection is required.'
            }
          }
        },
        mental: {
          validators: {
            notEmpty: {
              message: 'Aggressive, Manic or Depressive Order selection is required.'
            }
          }
        },
        mental_treatment: {
          validators: {
            notEmpty: {
              message: 'Mental treatment selection is required.'
            }
          }
        },
        other: {
          validators: {
            notEmpty: {
              message: 'Other Medical condition selection is required.'
            }
          }
        },
        other_medical_condition: {
          validators: {
            notEmpty: {
              message: 'Please specify the other medical condition if selected.'
            }
          }
        },
        other_treatment: {
          validators: {
            notEmpty: {
              message: 'Other treatment selection is required.'
            }
          }
        }
      }
    });
    const formValidation5 = createFormValidation(wizardValidationFormStep3, {
      assessment: {
        validators: {
          notEmpty: { message: 'Assessment is required' }
        }
      },
      assessment_status: {
        validators: {
          notEmpty: { message: 'Assessment status is required' }
        }
      },
      assessment_temporary_duration: {
        validators: {
          notEmpty: {
            message: 'Please specify the duration',
            message: 'The duration is required when the assessment status is temporary.'
          },
          numeric: { message: 'Duration must be a number' },
          greaterThan: {
            value: 0,
            message: 'Duration must be greater than 0'
          }
        }
      },
      conditions: {
        validators: {
          notEmpty: { message: 'At least one condition must be selected' }
        }
      },
      remarks: {
        validators: {
          notEmpty: { message: 'Remarks are required' },
          stringLength: {
            max: 500,
            message: 'Remarks cannot exceed 500 characters'
          }
        }
      }
    });

    wizardValidationNext.forEach(nextBtn => {
      nextBtn.addEventListener('click', function () {
        const currentStepIndex = validationStepper._currentIndex;
        // Validate the current step
        switch (currentStepIndex) {
          case 0:
            formValidation1.validate();
            break;
          case 1:
            formValidation2.validate();
            break;
          case 2:
            formValidation3.validate();
            break;
          case 3:
            formValidation4.validate();
            break;
          case 4:
            formValidation5.validate();
            break;
          default:
            break;
        }
      });
    });

    wizardValidationPrev.forEach(prevBtn => {
      prevBtn.addEventListener('click', function () {
        validationStepper.previous();
      });
    });
  }

  // Additional functionalities: camera, age calculation, etc.
  // ---------------------------------------------------------
  const vid = document.getElementById('video');

  $('#select').on('click', function () {
    $('#camera').modal('show');
    if (navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices
        .getUserMedia({ video: true })
        .then(function (stream) {
          vid.srcObject = stream;
        })
        .catch(function () {
          alert('Something went wrong!');
        });
    }
  });

  $('#recapture').on('click', function () {
    playVid();
    $('#capture').attr('disabled', false);
    $(this).attr('disabled', true);
  });

  $('#capture').on('click', function () {
    capture();
    pauseVid();
    save();
    $(this).attr('disabled', true);
    $('#recapture').attr('disabled', false);
  });

  function playVid() {
    vid.play();
  }

  function pauseVid() {
    vid.pause();
  }

  function capture() {
    const canvas = document.getElementById('canvas');
    canvas.width = 640;
    canvas.height = 480;
    canvas.getContext('2d').drawImage(vid, 0, 0, 640, 480);
    $('#canvas').removeClass('hidden');
    $('#saveImg').removeClass('hidden');
  }

  function save() {
    const canvas = document.getElementById('canvas');
    document.getElementById('picture_1').src = canvas.toDataURL();
    $('#base_64').val(canvas.toDataURL());
    $('#canvas').addClass('hidden');
    $('#saveImg').addClass('hidden');
  }

  // Age calculation
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

  // BMI calculation
  $('#height, #weight').on('input', function () {
    computeBMI();
  });

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

  // Toggle visibility for various inputs
  function toggleVisibility(inputName, checkedElementId, targetElementId, showIfChecked = true) {
    $('input[name="' + inputName + '"]').change(function () {
      const isChecked = $('#' + checkedElementId).is(':checked');
      if (isChecked === showIfChecked) {
        $(targetElementId).removeClass('visually-hidden'); // Show
      } else {
        $(targetElementId).addClass('visually-hidden'); // Hide
      }
    });
  }

  toggleVisibility('disability', 'disability2', '#txtdisability');
  toggleVisibility('disease', 'disease2', '#txtdisease');
  toggleVisibility('epilepsy', 'epilepsy1', '#div_epilepsy_treatment');
  toggleVisibility('epilepsy', 'epilepsy1', '#div_last_seizure');
  toggleVisibility('epilepsy_treatment', 'epilepsy_treatment1', '#txt_epilepsy_treatment');
  toggleVisibility('diabetes', 'diabetes1', '#div_diabetes_treatment');
  toggleVisibility('diabetes_treatment', 'diabetes_treatment1', '#txt_diabetes_treatment');
  toggleVisibility('sleepapnea', 'sleepapnea1', '#div_sleepapnea_treatment');
  toggleVisibility('sleepapnea_treatment', 'sleepapnea_treatment1', '#txt_sleepapnea_treatment');
  toggleVisibility('mental_treatment', 'mental_treatment1', '#txt_mental_treatment');
  toggleVisibility('other', 'other1', '#div_other_treatment');
  toggleVisibility('other_treatment', 'other_treatment1', '#txt_other_treatment');
  toggleVisibility('mental', 'mental1', '#div_mental_treatment');
  toggleVisibility('assessment', 'assessment1', '#div_condition');
  toggleVisibility('assessment', 'assessment2', '#div_assessment_status');

  // $('input[name="assessment"]').change(function () {
  //   const isChecked = $('#assessment1').is(':checked');
  //   if (isChecked === showIfChecked) {
  //     $('div_condition').removeClass('visually-hidden');
  //     $('div_assessment_status').addClass('visually-hidden');
  //   } else {
  //     $('div_condition').addClass('visually-hidden');
  //     $('div_assessment_status').removeClass('visually-hidden');
  //   }
  // });

  $('.btn-cancel').on('click', function () {
    Swal.fire({
      title: 'Are you sure!',
      text: 'You want to cancel this transaction?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-outline-danger ml-1'
      },
      buttonsStyling: false
    }).then(function (isConfirm) {
      if (isConfirm.value) {
        $('#loader').removeClass('hidden', function () {
          $('#loader').fadeIn(500);
        });
        sessionStorage.clear();
        window.location.href = 'main_page';
      }
    });
  });

  var ishihara_counter = 0;
  var ishihara_over = 0;
  var ishihara_answer = '';
  $('#color_blind_result').text('Ishihara Test Result: - /6');

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

    let newString = firstPart + replaceChar + lastPart;

    return newString;
  }

  var randpic = Math.floor(Math.random() * 4) + 1;

  var pic1 = $('#ishahara_1').val();
  var pic2 = $('#ishahara_2').val();
  var pic3 = $('#ishahara_3').val();
  var pic4 = $('#ishahara_4').val();
  var pic5 = $('#ishahara_5').val();
  var pic6 = $('#ishahara_6').val();

  var pic1final = replaceChar(pic1, randpic, 46),
    pic2final = replaceChar(pic2, randpic, 46),
    pic3final = replaceChar(pic3, randpic, 46),
    pic4final = replaceChar(pic4, randpic, 46),
    pic5final = replaceChar(pic5, randpic, 46),
    pic6final = replaceChar(pic6, randpic, 46);

  $('#ishahara_1').val(pic1final);
  $('#ishahara_2').val(pic2final);
  $('#ishahara_3').val(pic3final);
  $('#ishahara_4').val(pic4final);
  $('#ishahara_5').val(pic5final);
  $('#ishahara_6').val(pic6final);

  $('#ishahara_picture_1_viewer').attr('src', $('#ishahara_1').val());
  $('#ishahara_picture_2_viewer').attr('src', $('#ishahara_2').val());
  $('#ishahara_picture_3_viewer').attr('src', $('#ishahara_3').val());
  $('#ishahara_picture_4_viewer').attr('src', $('#ishahara_4').val());
  $('#ishahara_picture_5_viewer').attr('src', $('#ishahara_5').val());
  $('#ishahara_picture_6_viewer').attr('src', $('#ishahara_6').val());

  $('#btn_picture_1_pass').on('click', function () {
    $('#btn_picture_1_fail').prop('disabled', false);
    $('#btn_picture_1_pass').prop('disabled', true);

    $('#btn_picture_1_pass').removeClass('btn-outline-success');
    $('#btn_picture_1_pass').addClass('btn-success');

    $('#btn_picture_1_fail').addClass('btn-outline-danger');
    $('#btn_picture_1_fail').removeClass('btn-danger');
    ishihara_counter += 1;
  });
  $('#btn_picture_1_fail').on('click', function () {
    $('#btn_picture_1_fail').removeClass('btn-outline-danger');
    $('#btn_picture_1_fail').addClass('btn-danger');

    $('#btn_picture_1_pass').addClass('btn-outline-success');
    $('#btn_picture_1_pass').removeClass('btn-success');

    if ($('#btn_picture_1_pass').attr('disabled')) {
      ishihara_counter -= 1;
      $('#btn_picture_1_pass').prop('disabled', false);
      $('#btn_picture_1_fail').prop('disabled', true);
    } else {
      $('#btn_picture_1_pass').prop('disabled', false);
      $('#btn_picture_1_fail').prop('disabled', true);
    }
  });

  $('#btn_picture_2_pass').on('click', function () {
    $('#btn_picture_2_fail').prop('disabled', false);
    $('#btn_picture_2_pass').prop('disabled', true);

    $('#btn_picture_2_pass').removeClass('btn-outline-success');
    $('#btn_picture_2_pass').addClass('btn-success');

    $('#btn_picture_2_fail').addClass('btn-outline-danger');
    $('#btn_picture_2_fail').removeClass('btn-danger');
    ishihara_counter += 1;
  });
  $('#btn_picture_2_fail').on('click', function () {
    $('#btn_picture_2_fail').removeClass('btn-outline-danger');
    $('#btn_picture_2_fail').addClass('btn-danger');

    $('#btn_picture_2_pass').addClass('btn-outline-success');
    $('#btn_picture_2_pass').removeClass('btn-success');

    if ($('#btn_picture_2_pass').attr('disabled')) {
      ishihara_counter -= 1;
      $('#btn_picture_2_pass').prop('disabled', false);
      $('#btn_picture_2_fail').prop('disabled', true);
    } else {
      $('#btn_picture_2_pass').prop('disabled', false);
      $('#btn_picture_2_fail').prop('disabled', true);
    }
  });

  $('#btn_picture_3_pass').on('click', function () {
    $('#btn_picture_3_fail').prop('disabled', false);
    $('#btn_picture_3_pass').prop('disabled', true);

    $('#btn_picture_3_pass').removeClass('btn-outline-success');
    $('#btn_picture_3_pass').addClass('btn-success');

    $('#btn_picture_3_fail').addClass('btn-outline-danger');
    $('#btn_picture_3_fail').removeClass('btn-danger');
    ishihara_counter += 1;
  });
  $('#btn_picture_3_fail').on('click', function () {
    $('#btn_picture_3_fail').removeClass('btn-outline-danger');
    $('#btn_picture_3_fail').addClass('btn-danger');

    $('#btn_picture_3_pass').addClass('btn-outline-success');
    $('#btn_picture_3_pass').removeClass('btn-success');

    if ($('#btn_picture_3_pass').attr('disabled')) {
      ishihara_counter -= 1;
      $('#btn_picture_3_pass').prop('disabled', false);
      $('#btn_picture_3_fail').prop('disabled', true);
    } else {
      $('#btn_picture_3_pass').prop('disabled', false);
      $('#btn_picture_3_fail').prop('disabled', true);
    }
  });

  $('#btn_picture_4_pass').on('click', function () {
    $('#btn_picture_4_fail').prop('disabled', false);
    $('#btn_picture_4_pass').prop('disabled', true);

    $('#btn_picture_4_pass').removeClass('btn-outline-success');
    $('#btn_picture_4_pass').addClass('btn-success');

    $('#btn_picture_4_fail').addClass('btn-outline-danger');
    $('#btn_picture_4_fail').removeClass('btn-danger');
    ishihara_counter += 1;
  });
  $('#btn_picture_4_fail').on('click', function () {
    $('#btn_picture_4_fail').removeClass('btn-outline-danger');
    $('#btn_picture_4_fail').addClass('btn-danger');

    $('#btn_picture_4_pass').addClass('btn-outline-success');
    $('#btn_picture_4_pass').removeClass('btn-success');

    if ($('#btn_picture_4_pass').attr('disabled')) {
      ishihara_counter -= 1;
      $('#btn_picture_4_pass').prop('disabled', false);
      $('#btn_picture_4_fail').prop('disabled', true);
    } else {
      $('#btn_picture_4_pass').prop('disabled', false);
      $('#btn_picture_4_fail').prop('disabled', true);
    }
  });

  $('#btn_picture_5_pass').on('click', function () {
    $('#btn_picture_5_fail').prop('disabled', false);
    $('#btn_picture_5_pass').prop('disabled', true);

    $('#btn_picture_5_pass').removeClass('btn-outline-success');
    $('#btn_picture_5_pass').addClass('btn-success');

    $('#btn_picture_5_fail').addClass('btn-outline-danger');
    $('#btn_picture_5_fail').removeClass('btn-danger');
    ishihara_counter += 1;
  });
  $('#btn_picture_5_fail').on('click', function () {
    $('#btn_picture_5_fail').removeClass('btn-outline-danger');
    $('#btn_picture_5_fail').addClass('btn-danger');

    $('#btn_picture_5_pass').addClass('btn-outline-success');
    $('#btn_picture_5_pass').removeClass('btn-success');

    if ($('#btn_picture_5_pass').attr('disabled')) {
      ishihara_counter -= 1;
      $('#btn_picture_5_pass').prop('disabled', false);
      $('#btn_picture_5_fail').prop('disabled', true);
    } else {
      $('#btn_picture_5_pass').prop('disabled', false);
      $('#btn_picture_5_fail').prop('disabled', true);
    }
  });

  $('#btn_picture_6_pass').on('click', function () {
    $('#btn_picture_6_fail').prop('disabled', false);
    $('#btn_picture_6_pass').prop('disabled', true);

    $('#btn_picture_6_pass').removeClass('btn-outline-success');
    $('#btn_picture_6_pass').addClass('btn-success');

    $('#btn_picture_6_fail').addClass('btn-outline-danger');
    $('#btn_picture_6_fail').removeClass('btn-danger');

    ishihara_counter += 1;
  });
  $('#btn_picture_6_fail').on('click', function () {
    $('#btn_picture_6_fail').removeClass('btn-outline-danger');
    $('#btn_picture_6_fail').addClass('btn-danger');

    $('#btn_picture_6_pass').addClass('btn-outline-success');
    $('#btn_picture_6_pass').removeClass('btn-success');

    if ($('#btn_picture_6_pass').attr('disabled')) {
      ishihara_counter -= 1;
      $('#btn_picture_6_pass').prop('disabled', false);
      $('#btn_picture_6_fail').prop('disabled', true);
    } else {
      $('#btn_picture_6_pass').prop('disabled', false);
      $('#btn_picture_6_fail').prop('disabled', true);
    }
  });

  // $('#show_answer').on('click', function (){
  //     ishihara_answer =  $('#ishihara_value_answer').val();
  //     alertanswer(ishihara_answer)
  // });

  $('#ishahara_picture_1_viewer').on('click', function () {
    var source = $('#ishahara_1').val();
    ishihara_answer = 8;
    $('#ishihara_value_answer').val(ishihara_answer);
    $('#picture_modal').modal('show');
    $('#ishahara_picture_1').attr('src', source);
  });

  $('#ishahara_picture_2_viewer').on('click', function () {
    var source = $('#ishahara_2').val();
    ishihara_answer = 10;
    $('#ishihara_value_answer').val(ishihara_answer);
    $('#picture_modal').modal('show');
    $('#ishahara_picture_1').attr('src', source);
  });

  $('#ishahara_picture_3_viewer').on('click', function () {
    ishihara_answer = 13;
    $('#ishihara_value_answer').val(ishihara_answer);
    var source = $('#ishahara_3').val();
    $('#picture_modal').modal('show');
    $('#ishahara_picture_1').attr('src', source);
  });

  $('#ishahara_picture_4_viewer').on('click', function () {
    ishihara_answer = 22;
    $('#ishihara_value_answer').val(ishihara_answer);
    var source = $('#ishahara_4').val();
    $('#picture_modal').modal('show');
    $('#ishahara_picture_1').attr('src', source);
  });

  $('#ishahara_picture_5_viewer').on('click', function () {
    ishihara_answer = 52;
    $('#ishihara_value_answer').val(ishihara_answer);
    var source = $('#ishahara_5').val();
    $('#picture_modal').modal('show');
    $('#ishahara_picture_1').attr('src', source);
  });

  $('#ishahara_picture_6_viewer').on('click', function () {
    ishihara_answer = 69;
    $('#ishihara_value_answer').val(ishihara_answer);
    var source = $('#ishahara_6').val();
    $('#picture_modal').modal('show');
    $('#ishahara_picture_1').attr('src', source);
  });

  $('.ishihara').on('click', function () {
    $('#ishihara_modal').modal('show');
  });

  $('#confirm_ishihara').on('click', function () {
    $('#color_blind_test').val(ishihara_counter + '/6');
    $('#color_blind_result').text('Ishihara Test Result: ' + ishihara_counter + '/6');
    $('#ishihara_modal').modal('hide');
  });

  $('.hearing').on('click', function () {
    $('#hearing_modal').modal('show');
  });
  var randaudionumboth = Math.floor(Math.random() * 10) + 1;
  var randaudionumleft = Math.floor(Math.random() * 10) + 1;
  var randaudionumbright = Math.floor(Math.random() * 10) + 1;
  var hearingcounter = 0;
  var hearingover = 1;
  $('#hearing_result').text('Hearing Test Result: - /3');

  var hearingboth = $('#bothvalue').val();
  var hearingleft = $('#leftvalue').val();
  var hearingright = $('#rightvalue').val();

  var hearingbothfinal = replaceChar(hearingboth, randaudionumboth, 52),
    hearingleftfinal = replaceChar(hearingleft, randaudionumleft, 52),
    hearingrightfinal = replaceChar(hearingright, randaudionumbright, 52);

  $('#bothvalue').val(hearingbothfinal);
  $('#leftvalue').val(hearingleftfinal);
  $('#rightvalue').val(hearingrightfinal);

  $('#myAudio-both').attr('src', $('#bothvalue').val());
  $('#myAudio_left').attr('src', $('#leftvalue').val());
  $('#myAudio_right').attr('src', $('#rightvalue').val());

  $('#btn_hearing_left_right').click(function () {
    $('#myAudio-both')[0].play();
    $('#myAudio-both').prop('volume', 0.3);
  });

  $('#btn_hearing_left_1').click(function () {
    $('#myAudio_left')[0].play();
    $('#myAudio_left').prop('volume', 0.3);
  });

  $('#btn_hearing_right_1').click(function () {
    $('#myAudio_right')[0].play();
    $('#myAudio_right').prop('volume', 0.3);
  });

  $('#next_sound').click(function () {
    $('#hearing_result').text('Hearing Test Result: ' + hearingcounter + '/3');
    $('#hearing_modal').modal('hide');
  });

  $('#btn_hearing_left_right_answer').on('click', function () {
    if ($(this).val() == 'show') {
      $('#hearing_left_right_answer').text(': ' + randaudionumboth);
      $('#btn_hearing_left_right_answer').text('Hide Answer');
      $('#btn_hearing_left_right_answer').val('hide');
    } else {
      $('#hearing_left_right_answer').text('');
      $('#btn_hearing_left_right_answer').text('Show Answer');
      $('#btn_hearing_left_right_answer').val('show');
    }
  });
  $('#btn_hearing_left_1_answer').on('click', function () {
    if ($(this).val() == 'show') {
      $('#hearing_left_1_answer').text(': ' + randaudionumleft);
      $('#btn_hearing_left_1_answer').text('Hide Answer');
      $('#btn_hearing_left_1_answer').val('hide');
    } else {
      $('#hearing_left_1_answer').text('');
      $('#btn_hearing_left_1_answer').text('Show Answer');
      $('#btn_hearing_left_1_answer').val('show');
    }
  });
  $('#btn_hearing_right_1_answer').on('click', function () {
    if ($(this).val() == 'show') {
      $('#hearing_right_1_answer').text(': ' + randaudionumbright);
      $('#btn_hearing_right_1_answer').text('Hide Answer');
      $('#btn_hearing_right_1_answer').val('hide');
    } else {
      $('#hearing_right_1_answer').text('');
      $('#btn_hearing_right_1_answer').text('Show Answer');
      $('#btn_hearing_right_1_answer').val('show');
    }
  });

  $('#btn_hearing_left_right_pass').on('click', function () {
    $('#btn_hearing_left_right_fail').prop('disabled', false);
    $('#btn_hearing_left_right_pass').prop('disabled', true);

    $('#btn_hearing_left_right_pass').removeClass('btn-outline-success');
    $('#btn_hearing_left_right_pass').addClass('btn-success');

    $('#btn_hearing_left_right_fail').addClass('btn-outline-danger');
    $('#btn_hearing_left_right_fail').removeClass('btn-danger');
    hearingcounter += 1;
  });
  $('#btn_hearing_left_right_fail').on('click', function () {
    $('#btn_hearing_left_right_fail').removeClass('btn-outline-danger');
    $('#btn_hearing_left_right_fail').addClass('btn-danger');

    $('#btn_hearing_left_right_pass').addClass('btn-outline-success');
    $('#btn_hearing_left_right_pass').removeClass('btn-success');

    if ($('#btn_hearing_left_right_pass').attr('disabled')) {
      hearingcounter -= 1;
      $('#btn_hearing_left_right_pass').prop('disabled', false);
      $('#btn_hearing_left_right_fail').prop('disabled', true);
    } else {
      $('#btn_hearing_left_right_pass').prop('disabled', false);
      $('#btn_hearing_left_right_fail').prop('disabled', true);
    }
  });

  $('#btn_hearing_left_1_pass').on('click', function () {
    $('#btn_hearing_left_1_fail').prop('disabled', false);
    $('#btn_hearing_left_1_pass').prop('disabled', true);

    $('#btn_hearing_left_1_pass').removeClass('btn-outline-success');
    $('#btn_hearing_left_1_pass').addClass('btn-success');

    $('#btn_hearing_left_1_fail').addClass('btn-outline-danger');
    $('#btn_hearing_left_1_fail').removeClass('btn-danger');
    hearingcounter += 1;
  });
  $('#btn_hearing_left_1_fail').on('click', function () {
    $('#btn_hearing_left_1_fail').removeClass('btn-outline-danger');
    $('#btn_hearing_left_1_fail').addClass('btn-danger');

    $('#btn_hearing_left_1_pass').addClass('btn-outline-success');
    $('#btn_hearing_left_1_pass').removeClass('btn-success');

    if ($('#btn_hearing_left_1_pass').attr('disabled')) {
      hearingcounter -= 1;
      $('#btn_hearing_left_1_pass').prop('disabled', false);
      $('#btn_hearing_left_1_fail').prop('disabled', true);
    } else {
      $('#btn_hearing_left_1_pass').prop('disabled', false);
      $('#btn_hearing_left_1_fail').prop('disabled', true);
    }
  });

  $('#btn_hearing_right_1_pass').on('click', function () {
    $('#btn_hearing_right_1_fail').prop('disabled', false);
    $('#btn_hearing_right_1_pass').prop('disabled', true);

    $('#btn_hearing_right_1_pass').removeClass('btn-outline-success');
    $('#btn_hearing_right_1_pass').addClass('btn-success');

    $('#btn_hearing_right_1_fail').addClass('btn-outline-danger');
    $('#btn_hearing_right_1_fail').removeClass('btn-danger');
    hearingcounter += 1;
  });
  $('#btn_hearing_right_1_fail').on('click', function () {
    $('#btn_hearing_right_1_fail').removeClass('btn-outline-danger');
    $('#btn_hearing_right_1_fail').addClass('btn-danger');

    $('#btn_hearing_right_1_pass').addClass('btn-outline-success');
    $('#btn_hearing_right_1_pass').removeClass('btn-success');

    if ($('#btn_hearing_right_1_pass').attr('disabled')) {
      hearingcounter -= 1;
      $('#btn_hearing_right_1_pass').prop('disabled', false);
      $('#btn_hearing_right_1_fail').prop('disabled', true);
    } else {
      $('#btn_hearing_right_1_pass').prop('disabled', false);
      $('#btn_hearing_right_1_fail').prop('disabled', true);
    }
  });

  $('.btn-save').on('click', function () {
    // toastr['error']('Please Capture Student Image', 'Required Field', {
    //   closeButton: true,
    //   tapToDismiss: false,
    //   rtl: isRtl
    // });

    var newTransForm = $('#new_trans_form');
    const nf = newTransForm.val({
      rules: {
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
          required: true
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
        lto_client_id: {
          required: function () {
            if ($('#purpose').val() == '9' || $('#purpose').val() == '10') {
              return false;
            } else {
              return true;
            }
          }
        },
        license_no: {
          required: function () {
            if ($('#purpose').val() == '9' || $('#purpose').val() == '10') {
              return false;
            } else {
              return true;
            }
          }
        },
        purpose: {
          required: true
        }
      },
      messages: {
        base_64: 'Please Capture Student Image'
      }
    });
    if (newTransForm.val()) {
      // if ($('#base_64').val() == '') {
      //   toastr['error']('Please Capture Student Image', 'Required Field', {
      //     closeButton: true,
      //     tapToDismiss: false,
      //     rtl: isRtl
      //   });
      // } else {
      $('#loader').removeClass('hidden', function () {
        $('#loader').fadeIn(500);
      });
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: 'new_trans_next',
        data: newTransForm.serialize(),
        success: function (data) {
          $('#loader').addClass('hidden', function () {
            $('#loader').fadeOut(500);
          });
          // console.log(data);
          if (data.status == '1') {
            Swal.fire({
              title: 'Save Successful!',
              icon: 'success',
              confirmButtonText: 'Ok',
              allowOutsideClick: false,
              allowEscapeKey: false
            }).then(result => {
              if (result.isConfirmed) {
                sessionStorage.clear();
                window.location.href = 'main_page';
              }
            });

            toastr['success'](data.message, 'Transaction Saved', {
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
        error: function (xhr, status, error) {
          var errorMessage = xhr.status + ': ' + xhr.statusText;
          $('#loader').addClass('hidden', function () {
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
    // }
  });
})();
