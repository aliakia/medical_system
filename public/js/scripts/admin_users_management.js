$(document).ready(function () {
  localStorage.clear();
  var hideSearch = $('.hide-search'),
    basicPickr = $('.flatpickr-basic'),
    userTb = $('#myTable'),
    isRtl = $('html').attr('data-textdirection') === 'rtl';
  $('[data-toggle="tooltip"]').tooltip();


  if (userTb.length) {
    var userTbV = userTb.dataTable({
      autoWidth: false,
      scrollX: true,
      lengthMenu: [5, 10, 25, 50, 100],
      ordering: true,
      info: true,
      ajax: {
        url: 'fetch_admin_user_data',
        dataSrc: 'data'
    },
    columns: [
        { data: 'user_id', title: 'USER ID' },
        { data: 'full_name', title: 'NAME' },
        { data: 'user_type', title: 'USER TYPE' },
        { data: 'is_active', title: 'ACCOUNT STATUS' }
    ],
      columnDefs: [
        {
          responsivePriority: 1,
          targets: -1,
          render: function (data, type, full, meta) {
            // var status = full['is_active'];
            if (data == '0') {
              return '<span class="badge bg-label-warning">Inactive</span>';
            } else {
              return '<span class="badge bg-label-success">Active</span>';
            }
          }
        },
        {
          responsivePriority: 1,
          targets: 2,
          render: function (data, type, full, meta) {
            // var status = full['is_active'];
            if (data == 'Administrator') {
              return '<span class="badge bg-label-danger">Admin</span>';
            } else {
              return '<span class="badge bg-label-info">Encoder</span>';
            }
          }
        },
       
      ],
      // drawCallback: function (settings) {
      //   feather.replace();
      //   $('.edit').on('click', function () {
      //     var transValue = this.value;
      //     viewDetails(transValue);
      //   });
      // }
    });
  }

  hideSearch.select2({
    minimumResultsForSearch: Infinity
  });

  //------------camera functions-------------------------------------------------------------
  $('#select').on('click', function () {
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
    $('#camera').modal({
      backdrop: 'static',
      keyboard: false,
      backdrop: false
    });
    // Webcam.set({
    //     width: 640,
    //     height: 480,
    //     align:'center',
    //     image_format: 'jpeg',
    //     jpeg_quality: 100
    // });
    // Webcam.attach('#video');
  });
  $('#close_cam').on('click', function () {
    $('#canvas').addClass('hidden');
    $('#saveImg').addClass('hidden');
  });

  $('#capture').on('click', function () {
    capture();
  });
  $('#saveImg').on('click', function () {
    save();
  });
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
    // var base_64 = $('#canvas').attr('src');
    // $('#picture_1').attr('src', base_64);
    // $('#base_64').val(base_64);
    // $('#canvas').addClass('hidden');
    // $('#saveImg').addClass('hidden');
    document.getElementById('picture_1').src = canvas.toDataURL();
    $('#base_64').val(canvas.toDataURL());
    $('#canvas').addClass('hidden');
    $('#saveImg').addClass('hidden');
  }
  //------------------------------------------------------------------------------------------
  //--hide/show  Add physician user form
  $('#user_type').change(function () {
    if ($('#user_type').val() == 'Encoder') {
      $('.physician_form').removeClass('hidden');
    } else {
      $('.physician_form').addClass('hidden');
    }
  });

  //----insert new user----------------------------------------------------------------------
  $('#confirm').on('click', function () {
    var add_user = $('#reg_form');
    add_user.validate({
      rules: {
        first_name: {
          required: true
        },
        middle_name: {
          required: true
        },
        last_name: {
          required: true
        },
        gender: {
          required: true
        },
        user_type: {
          required: true
        },
        user_expiration: {
          required: true
        },
        user_id: {
          required: true
        },
        password: {
          required: true,
          minlength: 5
        },
        confirm_password: {
          required: true,
          minlength: 5,
          equalTo: '#password'
        },
        physician_id: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          }
        },
        bday: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          }
        },
        civil_status: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          }
        },
        email_address: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          },
          email: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          }
        },
        prc_no: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          }
        },
        ptr_no: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          }
        },
        contact_no: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          },
          digits: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          },
          maxlength: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return 11;
            } else {
              return false;
            }
          },
          minlength: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return 11;
            } else {
              return false;
            }
          }
        },
        prc_expiration: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          }
        },
        user_expiration: {
          required: function () {
            if ($('#user_type').find(':selected').val() == 'Encoder') {
              return true;
            } else {
              return false;
            }
          }
        }
      }
    });
    if (add_user.valid()) {
      if ($('#base_64').val() == '') {
        toastr['error']('Please Capture Student Image', 'Required Field', {
          closeButton: true,
          tapToDismiss: false,
          rtl: isRtl
        });
      } else {
        // if ($('#fp_idr1').val() == "-") {
        //     toastr['error']('Right Thumb Fingerprint are required', 'Fingerprint Required', {
        //         closeButton: true,
        //         tapToDismiss: false,
        //         rtl: isRtl
        //     });
        // } else {
        $('#loader').removeClass('hidden', function () {
          $('#loader').fadeIn(500);
        });
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          method: 'POST',
          url: 'admin_add_user',
          data: add_user.serialize(),
          success: function (data) {
            $('#loader').addClass('hidden', function () {
              $('#loader').fadeOut(500);
            });
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
                  window.location.href = 'admin_users_management';
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
        // }
      }
    }
  });
  //------------------------------------------------------------------------------------------

  //---show modal edit user-------------------------------------------------------------------
  $('.edit').on('click', function () {
    localStorage.clear();
    var transValue = this.value;
    viewDetails(transValue);
  });
  //------------------------------------------------------------------------------------------

  //-----retrive user data--------------------------------------------------------------------
  function viewDetails(transValue) {
    $('#loader').removeClass('hidden', function () {
      $('#loader').fadeIn(500);
    });
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      url: 'admin_select_user',
      data: {
        user_id: transValue
      },
      success: function (data) {
        if (data.status == '1') {
          $('#loader').addClass('hidden', function () {
            $('#loader').fadeOut(500);
          });
          var _user_data = data.data;
          var _user_data2 = data.data2;
          $('#edit_user_modal').modal({
            backdrop: 'static',
            keyboard: false,
            backdrop: false
          });
          document.getElementById('edit_form').reset();
          $('#base_64_edit').val(_user_data[0].pic1);
          // $('#edit_fp_idr1').val(_user_data.fp_idr1);
          // $('#edit_fp_idr2').val(_user_data.fp_idr2);
          // $('#edit_fp_idr3').val(_user_data.fp_idr3);
          // $('#edit_fp_idr4').val(_user_data.fp_idr4);
          // $('#edit_fp_idr5').val(_user_data.fp_idr5);
          // $('#edit_fp_idl1').val(_user_data.fp_idl1);
          // $('#edit_fp_idl2').val(_user_data.fp_idl2);
          // $('#edit_fp_idl3').val(_user_data.fp_idl3);
          // $('#edit_fp_idl4').val(_user_data.fp_idl4);
          // $('#edit_fp_idl5').val(_user_data.fp_idl5);
          $('#picture_1_edit').attr('src', _user_data[0].pic1);
          $('#first_name_edit').val(_user_data[0].first_name);
          $('#middle_name_edit').val(_user_data[0].middle_name);
          $('#last_name_edit').val(_user_data[0].last_name);
          $('#gender_edit').val(_user_data[0].gender).change();
          $('#user_type_edit').val(_user_data[0].user_type).change();

          if ($('#user_type_edit').val() == 'Encoder') {
            $('.physician_edit_form').removeClass('hidden');
            $('#bday_edit').val(_user_data2[0].birthday);
            $('#civil_status_edit').val(_user_data2[0].civil_status).change();
            $('#prc_no_edit').val(_user_data2[0].prc_no);
            $('#ptr_no_edit').val(_user_data2[0].ptr_no);
            $('#contact_no_edit').val(_user_data2[0].contact_no);
            $('#email_address_edit').val(_user_data2[0].email_address);
            $('#prc_expiration_edit').val(_user_data2[0].prc_expiration);
            $('#physician_id_edit').val(_user_data2[0].physician_id);
          } else {
            $('.physician_edit_form').addClass('hidden');
          }
          $('#user_expiration_edit').val(_user_data[0].expiration);
          $('#user_id_edit').val(_user_data[0].user_id);
        } else {
          toastr['error'](data.message, 'Error', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
        }
      },
      error: function (xhr, status, error) {
        $('#loader').addClass('hidden', function () {
          $('#loader').fadeOut(500);
        });
        var errorMessage = xhr.status + ': ' + xhr.statusText;
        if (xhr.status == 500) {
          alert('There was a problem connecting to the server.');
        } else if (xhr.status == 0) {
          alert('Not Connected. Please verify your network connection.');
        } else {
          alert(errorMessage);
        }
      }
    });
  }
  //------------------------------------------------------------------------------------------

  //-----camera2 functions--------------------------------------------------------------------
  $('#select2').on('click', function () {
    if (navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices
        .getUserMedia({ video: true })
        .then(function (stream) {
          video2.srcObject = stream;
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

  $('#close_cam2').on('click', function () {
    $('#canvas2').addClass('hidden');
    $('#saveImg2').addClass('hidden');
  });
  $('#capture2').on('click', function () {
    capture2();
  });
  $('#saveImg2').on('click', function () {
    save2();
  });
  function capture2() {
    // var canvas = $('#canvas');
    // Webcam.snap( function(data_uri) {
    //     canvas.attr('src', data_uri);
    //     $('#canvas').removeClass('hidden');
    //     $('#saveImg').removeClass('hidden');
    // });
    var canvas = document.getElementById('canvas2');
    var video = document.getElementById('video2');
    canvas.width = 640;
    canvas.height = 480;
    canvas.getContext('2d').drawImage(video, 0, 0, 640, 480);
    $('#canvas2').removeClass('hidden');
    $('#saveImg2').removeClass('hidden');
  }
  function save2() {
    // var base_64 = $('#canvas').attr('src');
    // $('#picture_1').attr('src', base_64);
    // $('#base_64').val(base_64);
    // $('#canvas').addClass('hidden');
    // $('#saveImg').addClass('hidden');
    document.getElementById('picture_1_edit').src = canvas2.toDataURL();
    $('#base_64_edit').val(canvas2.toDataURL());
    $('#canvas2').addClass('hidden');
    $('#saveImg2').addClass('hidden');
  }
  //------------------------------------------------------------------------------------------

  //----------- Save user data----------------------------------------------------------------
  $('#save').on('click', function () {
    Swal.fire({
      title: 'Are you sure!',
      allowOutsideClick: false,
      text: 'You want to save this changes?',
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
        var edit_user = $('#edit_form');
        edit_user.validate({
          rules: {
            first_name_edit: {
              required: true
            },
            middle_name_edit: {
              required: true
            },
            last_name_edit: {
              required: true
            },
            gender_edit: {
              required: true
            },
            user_type_edit: {
              required: true
            },
            user_expiration_edit: {
              required: true
            },
            user_id_edit: {
              required: true
            },
            physician_id_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              }
            },
            bday_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              }
            },
            civil_status_edit_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              }
            },
            email_address_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              },
              email: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              }
            },
            prc_no_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              }
            },
            ptr_no_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              }
            },
            contact_no_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              },
              digits: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              },
              maxlength: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return 11;
                } else {
                  return false;
                }
              },
              minlength: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return 11;
                } else {
                  return false;
                }
              }
            },
            prc_expiration_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              }
            },
            user_expiration_edit: {
              required: function () {
                if ($('#user_type_edit').find(':selected').val() == 'Encoder') {
                  return true;
                } else {
                  return false;
                }
              }
            }
          }
        });
        if (edit_user.valid()) {
          if ($('#base_64_edit').val() == '') {
            toastr['error']('Please Capture Student Image', 'Picture Required', {
              closeButton: true,
              tapToDismiss: false,
              rtl: isRtl
            });
          } else {
            $('#loader').removeClass('hidden', function () {
              $('#loader').fadeIn(500);
            });
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              method: 'POST',
              url: 'admin_edit_user',
              data: edit_user.serialize(),
              success: function (data) {
                $('#loader').addClass('hidden', function () {
                  $('#loader').fadeOut(500);
                });
                // console.log(data);
                if (data.status == '1') {
                  // sessionStorage.setItem("trans_no", data.trans_no);
                  // sessionStorage.setItem("student_id", data.student_id);
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
                      window.location.href = 'admin_users_management';
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
      }
    });
  });
});
