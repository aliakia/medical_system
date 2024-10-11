$(document).ready(function()
{
    var hideSearch = $('.hide-search'),
    isRtl = $('html').attr('data-textdirection') === 'rtl',
        basicPickr = $('.flatpickr-basic');
    var searchForm = $('#search_form');


    $('[data-toggle="tooltip"]').tooltip();
    
    $("#myTable").dataTable({
        "autoWidth": false,
        "scrollX":true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "ordering": true,
        "info": true,
        "drawCallback": function( settings ) {
            feather.replace();
            $('.view').on('click', function (){
                var transValue = this.value;
                viewDetails(transValue);
            });
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
        var _module = $('#logsModule').val();
        $("#loader").removeClass("hidden",function () {
            $("#loader").fadeIn(500);
        });
        window.location.href = "admin_generate_logs_by_date,"+_date_from+","+_date_to+","+_module;
    }

    $('.print').on('click', function () {
        var _data = this.value;
        Swal.fire({
            title: "Are you sure?",
            text: 'You want to generate and print Certificate now ?',
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
                window.open('admin_generate_cert,'+_data);
                $("#loader").removeClass("hidden",function () {
                    $("#loader").fadeIn(500);
                });
                window.location.href = "admin_certificate_list";
            } 
            // else if (result.isDenied) {
            //     $("#loader").removeClass("hidden",function () {
            //         $("#loader").fadeIn(500);
            //     });
            //     window.location.href = "dashboard_page";
            // }
        });
    });


    
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