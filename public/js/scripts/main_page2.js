$(document).ready(function()
{
    // $('#myModal').modal('toggle');

    $('#balance_').modal('hide');

    if($('#clinic_balance').val() <=  -10000.00){
        $('#balance_').modal('show');
        setTimeout(function(){
            $('#balance_').modal('hide');
            $.ajax({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               method: "GET",
               url: "logout_user",
               success:function(data)
               {
                   $("#loader").addClass("hidden", function() {
                       $("#loader").fadeOut(500);
                   });  
                       window.location.href = "balance_error";             
               },
           });
           }, 5000);
    }
    else{
        $('#balance_').modal('hide');
    }

    var hideSearch = $('.hide-search'),
    isRtl = $('html').attr('data-textdirection') === 'rtl',
        basicPickr = $('.flatpickr-basic'),
        date_from = $('#date_from').val(),
        date_to = $('#date_to').val();
    var searchForm = $('#search_form');
    $('[data-toggle="tooltip"]').tooltip();

    $('#myTable').dataTable({
        "autoWidth": false,
        "scrollX":true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "ordering": true,
        "info": true,
        "drawCallback": function( settings ) {
            feather.replace();
            // $('.viewUploaded').on('click', function (){
            //     var _transValue = this.value;
            //     var _url = "view_trans_uploaded";
            //     viewDetails(_transValue, _url);
            // });
        }
    });

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
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        window.location.href = "get_save_client_data_bydate,"+_date_from+","+_date_to;
    }

    // $('.viewUploaded').on('click', function (){
    //     var _transValue = this.value;
    //     var _url = "view_trans_uploaded";
    //     viewDetails(_transValue, _url);
    // });
    

    function htmlEntities(str) {
        if (str == null)
        {
            return "";
        }
        else
        {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
    }
});