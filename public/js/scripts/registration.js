    $(document).ready(function()
{
    var regForm = $('#reg_form');
    
    $('#first_name').change(function () {
        if ($('#first_name').val() != "" && $('#last_name').val() != "") {
            var user_id = $('#first_name').val()+"."+$('#last_name').val();
            $('#user_id').val(user_id);
        }
    });
    $('#last_name').change(function () {
        if ($('#first_name').val() != "" && $('#last_name').val() != "") {
            var user_id = $('#first_name').val()+"."+$('#last_name').val();
            $('#user_id').val(user_id);
        }
    });

    $('#create_user').on('click', function () {
        regForm.validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                user_id: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                },
                employee_id: {
                    required: true
                },
                gender: {
                    required: true
                },
                user_type: {
                    required: true
                }
            }
        });
        if (regForm.valid()) {
            $("#loader").removeClass("hidden",function () {
                $("#loader").fadeIn(500);
            });
            regForm.submit();
        }
    });      
});