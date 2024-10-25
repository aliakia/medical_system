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
  localStorage.clear();
  var loginForm = $('#login_form');
  var hideSearch = $('.hide-search'),
    isRtl = $('html').attr('data-textdirection') === 'rtl';

  hideSearch.select2({
    minimumResultsForSearch: Infinity
  });

  $('#login').on('click', function () {
    // console.log('he');

    loginNow();
  });

  $('.form-control').keypress(function (e) {
    if (e.which == 13) {
      loginNow();
    }
  });

  function loginNow() {
    const lf = loginForm.val({
      rules: {
        user_id: {
          required: true
        },
        password: {
          required: true,
          minlength: 5
        }
      }
    });
    if (loginForm.val()) {
      $('#loader').removeClass('hidden', function () {
        $('#loader').fadeIn(500);
      });
      loginForm.submit();
    }
  }

  $('#login_bio').on('click', function () {
    var frameSrc =
      '<iframe src="biometrics/content2.html" style="zoom:1.0" frameborder="0" height="400" width="100%" id="frame1"></iframe>';
    $('#bio_modal_body').html(frameSrc);
    $('#biometrics_modal').modal({
      backdrop: 'static',
      keyboard: false,
      backdrop: false
    });
    $('#biometrics_modal').modal({ show: true });
  });

  $('#verify').on('click', function () {
    //    verify();
    var pngFile = localStorage.getItem('imageSrc');

    if (pngFile != null) {
      loginBio(pngFile);
      $('#biometrics_modal').modal('hide');
      var frameSrc = '';
      $('#bio_modal_body').html(frameSrc);
    } else {
      toastr['warning']('Please Scan your finger print', 'Biometrics Required', {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRtl
      });
    }
  });

  function loginBio(biometrics) {
    var ds_code = $('#ds_code').val();
    $('#loader').removeClass('hidden', function () {
      $('#loader').fadeIn(500);
    });
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      url: ds_code + '/login_bio',
      data: {
        user_id: 'admin',
        password: '12345'
      },
      success: function (data) {
        $('#loader').addClass('hidden', function () {
          $('#loader').fadeOut(500);
        });
        // console.log(data);
        if (data.status == '1') {
          window.location.href = ds_code + '/dashboard_page';
          // toastr['success'](data.message, 'Success', {
          //     closeButton: true,
          //     tapToDismiss: false,
          //     rtl: isRtl
          // });
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

  function htmlEntities(str) {
    if (str == null) {
      return '';
    } else {
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
  }
});
