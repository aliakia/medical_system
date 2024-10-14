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

        // Create validation for further steps as needed
        // Example for step 2 (you can customize these fields)
        const formValidation2 = createFormValidation(wizardValidationFormStep2, {
            // Define fields for step 2 validation
            // formValidationFieldName: { validators: { notEmpty: { message: 'Message' } } }
        });

        // Example for step 3
        const formValidation3 = createFormValidation(wizardValidationFormStep3, {
            // Define fields for step 3 validation
        });

        // ... Repeat for step 4 and step 5 as needed

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
                    // Add cases for additional steps if necessary
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
