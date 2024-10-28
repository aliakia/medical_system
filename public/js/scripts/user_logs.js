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
    logsTb = $('#myTable'),
    dataUrl = 'fetch_admin_generate_logs_by_date,' + $('#date_from').val() + ',' + $('#date_to').val() + ',*';
  basicPickr = $('.flatpickr-basic');
  var searchForm = $('#search_form');
  // console.log(dataUrl);
  logsData(dataUrl);

  $('[data-toggle="tooltip"]').tooltip();

  if (logsTb.length) {
    var logsTbV = logsTb.dataTable({
      autoWidth: false,
      scrollX: true,
      lengthMenu: [5, 10, 25, 50, 100],
      ordering: true,
      info: true,
      // ajax: {
      //   url: 'fetch_admin_generate_logs',
      //   data: 'data'
      // },
      data: [],
      columns: [
        { data: 'module' },
        { data: 'description' },
        { data: 'remarks' },
        { data: 'processed_by' },
        { data: 'period' }
        // { data: 'is_lto_sent' }
      ]
      // columnDefs: [
      //   {
      //     // responsivePriority: 1,
      //     targets: 6,
      //     render: function (data, type, full, meta) {
      //       var transNo = full['trans_no'];
      //       return `<button type="button" class="btn btn-sm btn-primary me-2 view" value="${transNo}"><i class="ti ti-file-text me-2"></i>View</button>`;
      //     }
      //   },
      //   {
      //     responsivePriority: 1,
      //     targets: 2,
      //     render: function (data, type, full, meta) {
      //       switch (data) {
      //         case '1':
      //           return '<span>New Non-Pro Driver´s License</span>';
      //         case '2':
      //           return '<span>New Pro Driver´s License</span>';
      //         case '3':
      //           return '<span>Renewal of Non-Pro Driver´s License</span>';
      //         case '4':
      //           return '<span>Renewal of Pro Driver´s License</span>';
      //         case '5':
      //           return '<span>Renewal of Conductor´s License</span>';
      //         case '6':
      //           return '<span>Conversion from Non-Pro to Pro DL</span>';
      //         case '7':
      //           return '<span>New Non-Pro Driver´s License (with Foreign License)</span>';
      //         case '8':
      //           return '<span>New Pro Driver´s License (with Foreign License)</span>';
      //         case '9':
      //           return '<span>New Conductor´s License</span>';
      //         case '10':
      //           return '<span>New Student Permit</span>';
      //         case '11':
      //           return '<span>Conversion from Pro to Non-Pro DL</span>';
      //         case '12':
      //           return '<span>Add Restriction for Non-Pro Driver´s License</span>';
      //         case '13':
      //           return '<span>Add Restriction for Pro Driver´s License</span>';
      //         default:
      //           return '<span class="badge bg-secondary">Encoder</span>';
      //       }
      //     }
      //   },
      //   {
      //     targets: 5, // Column index 5 (is_lto_sent)
      //     render: function (data) {
      //       if (data == 0) {
      //         return '<span class="badge bg-label-warning">Pending</span>';
      //       } else {
      //         return '<span class="badge bg-label-success">Uploaded</span>';
      //       }
      //     }
      //   }
      // ],
      // drawCallback: function (settings) {
      //   // feather.replace();
      //   $('.edit').on('click', function () {
      //     var transValue = this.value;
      //     viewDetails(transValue);
      //   });
      // }
    });
  }

  function logsData(url) {
    $('#loader').removeClass('visually-hidden').fadeIn(500);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'GET',
      url: url,
      success: function (data) {
        $('#loader').addClass('visually-hidden').fadeOut(500);
        // console.log(data.data);

        const dataDetails = data.data; // Assuming the data format contains a 'data' field
        logsTb.dataTable().fnClearTable(); // Clear existing data
        if (dataDetails.length !== 0) {
          logsTb.dataTable().fnAddData(dataDetails);
          toastr['success']('Records found.', 'Success', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
          // Add new data
        } else {
          // Optionally handle the case where no data is returned
          logsTb.dataTable().fnClearTable(); // Clear if no data
          toastr['info']('No records found for the selected date range.', 'Info', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
        }
      },
      error: function (xhr) {
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
    var logsModule = $('#logsModule').val();
    // $('#loader').removeClass('hidden', function () {
    //   $('#loader').fadeIn(500);
    // });
    let newDataUrl = 'fetch_admin_generate_logs_by_date,' + _date_from + ',' + _date_to + ',' + logsModule;
    // window.location.href = 'fetch_admin_generate_logs_by_date,' + _date_from + ',' + _date_to + ',' + logsModule;

    // console.log(newDataUrl);

    logsData(newDataUrl);
  }

  if (basicPickr.length) {
    basicPickr.flatpickr({
      dateFormat: 'Y-m-d'
    });
  }

  hideSearch.select2({
    minimumResultsForSearch: Infinity
  });

  $('#btn_search').on('click', function () {
    // e.preventDefault();
    search();
  });

  function htmlEntities(str) {
    if (str == null) {
      return '';
    } else {
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
  }
});
