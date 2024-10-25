$(document).ready(function () {
  localStorage.clear();
  var hideSearch = $('.hide-search'),
    basicPickr = $('.flatpickr-basic'),
    isRtl = $('html').attr('data-textdirection') === 'rtl';
  $('[data-toggle="tooltip"]').tooltip();

  if (basicPickr.length) {
    basicPickr.flatpickr({
      dateFormat: 'm-d-Y'
    });
  }

  hideSearch.select2({
    minimumResultsForSearch: Infinity
  });

  $('#save').on('click', function () {
    Swal.fire({
      title: 'WARNING!!',
      text: 'Are you sure you want to save changes?',
      icon: 'question',
      showDenyButton: true,
      confirmButtonText: 'Yes',
      allowOutsideClick: false,
      allowEscapeKey: false,
      // denyButtonText: 'No',
      customClass: {
        confirmButton: 'btn btn-primary',
        denyButton: 'btn btn-outline-danger ml-1'
      },
      buttonsStyling: false
    }).then(result => {
      if (result.isConfirmed) {
        var accountForm = $('#account_form');
        accountForm.validate({
          rules: {
            first_name: {
              required: true
            },
            middle_name: {
              required: true
            },
            last_name: {
              required: true
            }
          }
        });
        if (accountForm.valid()) {
          $('#loader').removeClass('hidden', function () {
            $('#loader').fadeIn(500);
          });
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: 'admin_account_setting_edit',
            data: accountForm.serialize(),
            success: function (data) {
              $('#loader').addClass('hidden', function () {
                $('#loader').fadeOut(500);
              });
              // console.log(data);
              if (data.status == '1') {
                Swal.fire({
                  title: 'Save Successful!',
                  text: data.message,
                  icon: 'success',
                  customClass: {
                    confirmButton: 'btn btn-primary'
                  },
                  buttonsStyling: false,
                  allowOutsideClick: () => {
                    this.wasOutsideClick = true;
                  }
                }).then(result => {
                  if (result.isConfirmed) {
                    $('#loader').removeClass('hidden', function () {
                      $('#loader').fadeIn(500);
                    });
                    window.location.href = 'logout_admin';
                    // location.reload(true);
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
      }
    });
  });

  $('#confirm_pass').on('click', function () {
    var newpass = $('#new_password').val();
    var confirmpass = $('#confirm_password').val();

    if (newpass == confirmpass) {
      Swal.fire({
        title: 'WARNING!!',
        text: 'Are you sure you want to change your password?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        allowOutsideClick: false,
        allowEscapeKey: false,
        // denyButtonText: 'No',
        customClass: {
          confirmButton: 'btn btn-primary',
          denyButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
      }).then(result => {
        if (result.isConfirmed) {
          var password_form = $('#password_form');
          password_form.validate({
            rules: {
              old_password: {
                required: true
              },
              new_password: {
                required: true,
                min: 5
              },
              confirm_password: {
                required: true,
                min: 5
              }
            }
          });
          if (password_form.valid()) {
            $('#loader').removeClass('hidden', function () {
              $('#loader').fadeIn(500);
            });
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              method: 'POST',
              url: 'admin_password_edit',
              data: password_form.serialize(),
              success: function (data) {
                $('#loader').addClass('hidden', function () {
                  $('#loader').fadeOut(500);
                });
                // console.log(data);
                if (data.status == '1') {
                  Swal.fire({
                    title: 'Success',
                    text: data.message,
                    icon: 'success',
                    customClass: {
                      confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false,
                    allowOutsideClick: () => {
                      this.wasOutsideClick = true;
                    }
                  }).then(result => {
                    if (result.isConfirmed) {
                      $('#loader').removeClass('hidden', function () {
                        $('#loader').fadeIn(500);
                      });
                      window.location.href = 'logout_admin';
                      // location.reload(true);
                    }
                  });
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Incorrect old password'
                  });
                }
              }
            });
          }
        }
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'The password confirmation does not match'
      });
    }
  });

  $('#cpmodal').on('click', function () {
    $('#changepass').modal('show');
  });

  function htmlEntities(str) {
    if (str == null) {
      return '';
    } else {
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
  }
});
