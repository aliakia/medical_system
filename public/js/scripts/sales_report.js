$(document).ready(function()
{
    var hideSearch = $('.hide-search'),
    isRtl = $('html').attr('data-textdirection') === 'rtl',
        basicPickr = $('.flatpickr-basic'),
        date_from = $('#date_from').val(),
        date_to = $('#date_to').val();
    var searchForm = $('#search_form');
    $('[data-toggle="tooltip"]').tooltip();

    // var oTable = $("#myTable").dataTable({
    //     "autoWidth": false,
    //     "scrollX":true,
    //     "lengthMenu": [5,10,25,50],
    //     "ordering": true,
    //     "info": true,
    //     "drawCallback": function( settings ) {
    //         feather.replace();
    //         $('.view').on('click', function (){
    //             var transValue = this.value;
    //             viewDetails(transValue);
    //         });
    //     },
    //     stateSave: true
    // });

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
        window.location.href = "get_sales_report,"+_date_from+","+_date_to;
    }

    $('#btn_export').on('click', function () {
        Swal.fire({
            title: "Are you sure?",
            text: 'You want to Export this report as PDF ?',
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
              confirmButton: 'btn btn-primary',
              denyButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                exportNow();
            } 
            // else if (result.isDenied) {
            //     $("#loader").removeClass("hidden",function () {
            //         $("#loader").fadeIn(500);
            //     });
            //     window.location.href = "dashboard_page";
            // }
        });
    });

    function exportNow() {
        var _date_from = $('#date_from').val();
        var _date_to = $('#date_to').val();
        window.open("export_sales_report,"+_date_from+","+_date_to,'_blank');
    }
    
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