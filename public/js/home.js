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
                  numeric: { message: 'Height must be a number' },
              }
          },
          weight: {
              validators: {
                  notEmpty: { message: 'Weight is required' },
                  numeric: { message: 'Weight must be a number' },
              }
          },
          mm: {
              validators: {
                  notEmpty: { message: 'Blood pressure mm is required' },
                  numeric: { message: 'Blood pressure mm must be a number' },
              }
          },
          hg: {
              validators: {
                  notEmpty: { message: 'Blood pressure Hg is required' },
                  numeric: { message: 'Blood pressure Hg must be a number' },
              }
          },
          body_temperature: {
              validators: {
                  notEmpty: { message: 'Body temperature is required' },
                  numeric: { message: 'Body temperature must be a number' },
              }
          },
          pulse_rate: {
              validators: {
                  notEmpty: { message: 'Pulse rate is required' },
                  numeric: { message: 'Pulse rate must be a number' },
              }
          },
          respiratory_rate: {
              validators: {
                  notEmpty: { message: 'Respiratory rate is required' },
                  numeric: { message: 'Respiratory rate must be a number' },
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
          },
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
              },
          },
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
                          message: 'Epilepsy treatment selection is required.',
                      },
                  },
              },
              last_seizure: {
                  validators: {
                      date: {
                          format: 'YYYY-MM-DD', // Adjust format as needed
                          message: 'The last seizure date is not valid.',
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
                          message: 'Diabetes treatment selection is required.',
                      },
                  },
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
                          message: 'Sleep Apnea treatment selection is required.',
                      },
                  },
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
                          message: 'Mental treatment selection is required.',
                      },
                  },
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
                          message: 'Other treatment selection is required.',
                      },
                  },
              },
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
                    case 2:
                        formValidation4.validate();
                        break;
                    case 2:
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
            navigator.mediaDevices.getUserMedia({ video: true })
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
    toggleVisibility('epilepsy_treatment', 'epilepsy_treatment1', '#txt_epilepsy_treatment');
    toggleVisibility('diabetes_treatment', 'diabetes_treatment1', '#txt_diabetes_treatment');
    toggleVisibility('sleepapnea_treatment', 'sleepapnea_treatment1', '#txt_sleepapnea_treatment');
    toggleVisibility('mental_treatment', 'mental_treatment1', '#txt_mental_treatment');
    toggleVisibility('other_treatment', 'other_treatment1', '#txt_other_treatment');
    toggleVisibility('mental', 'mental1', '#div_mental_treatment');

})();
