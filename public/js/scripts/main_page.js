$(document).ready(function () {
  // $('#myModal').modal('toggle');

  $('#balance_').modal('hide');

  if ($('#clinic_balance').val() <= -10000.0) {
    $('#balance_').modal('show');
    setTimeout(function () {
      $('#balance_').modal('hide');
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'GET',
        url: 'logout_user',
        success: function (data) {
          $('#loader').addClass('visually-hidden', function () {
            $('#loader').fadeOut(500);
          });
          window.location.href = 'balance_error';
        }
      });
    }, 5000);
  } else {
    $('#balance_').modal('hide');
  }

  var hideSearch = $('.hide-search'),
    isRtl = $('html').attr('data-textdirection') === 'rtl',
    basicPickr = $('.flatpickr-basic'),
    date_from = $('#date_from').val(),
    mainTable = $('#myTable'),
    date_to = $('#date_to').val();
  var searchForm = $('#search_form');
  $('[data-toggle="tooltip"]').tooltip();

  if (mainTable.length) {
    var mainTb = mainTable.DataTable({
      autoWidth: false,
      scrollX: true,
      lengthMenu: [5, 10, 25, 50, 100],
      ordering: true,
      info: true,
      ajax: {
        url: 'fetch_data'
        // dataSrc: 'data'
      },
      columns: [{ data: 'trans_no' }, { data: 'full_name' }, { data: 'is_lto_sent' }],
      columnDefs: [
        {
          responsivePriority: 1,
          targets: 2,
          render: function (data, type, full, meta) {
            var status = full['is_lto_sent'];

            if (status == '0') {
              return '<span class="badge bg-label-warning">Pending</span>';
            } else {
              return '<span class="badge bg-label-success">Uploaded</span>';
            }
          }
        }
      ]
    });
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
    search();
  });

  function search() {
    var _date_from = $('#date_from').val();
    var _date_to = $('#date_to').val();
    $('#loader').removeClass('visually-hidden', function () {
      $('#loader').fadeIn(500);
    });
    window.location.href = 'get_save_client_data_bydate,' + _date_from + ',' + _date_to;
  }

  // $('.viewUploaded').on('click', function (){
  //     var _transValue = this.value;
  //     var _url = "view_trans_uploaded";
  //     viewDetails(_transValue, _url);
  // });

  function htmlEntities(str) {
    if (str == null) {
      return '';
    } else {
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
  }
});
