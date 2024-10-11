$(document).ready(function()
{
    var hideSearch = $('.hide-search'),
        basicPickr = $('.flatpickr-basic'),
        bsStepper = document.querySelectorAll('.bs-stepper'),
        video = document.querySelector("#video"),
        horizontalWizard = document.querySelector('.horizontal-wizard-example');

    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: 'm-d-Y'
        });
    }

    hideSearch.select2({
        minimumResultsForSearch: Infinity
    });

    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
                video.srcObject = stream;
        })
        .catch(function (err0r) {
                console.log("Something went wrong!");
        });
    }

    $('#capture').on('click', function() {     
        capture();
    });
    
    $('#saveImg').on('click', function() {     
        save();
    });
    function capture() {        
        var canvas = document.getElementById('canvas');     
        var video = document.getElementById('video');
        canvas.width = 1024;
        canvas.height = 768;
        canvas.getContext('2d').drawImage(video, 0, 0, 1024, 768);  
        $('#canvas').removeClass('hidden');
        $('#saveImg').removeClass('hidden');
    }

    function save() {
        document.getElementById("picture").src = canvas.toDataURL();;
        $("#base_64").val(canvas.toDataURL());
        $('#canvas').addClass('hidden');
        $('#saveImg').addClass('hidden');
    }

    $('#reset').on('click', function() {     
      document.getElementById("picture").src= 'public/images/default.png';
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
    
        $(horizontalWizard).find('#step_1_next').on('click', function () {
            numberedStepper.next();
        });

        $(horizontalWizard).find('#step_2_next').on('click', function () {
            numberedStepper.next();
        });

        $(horizontalWizard).find('#step_3_next').on('click', function () {
            numberedStepper.next();
        });

        $(horizontalWizard).find('#step_4_submit').on('click', function () {
            $("#loader").removeClass("hidden",function () {
                $("#loader").fadeIn(500);
            });
        });
    
        $(horizontalWizard).find('.btn-prev').on('click', function () {
            numberedStepper.previous();
        });
    }      
});