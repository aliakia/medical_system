$(document).ready(function()
{
    //-------------------------------------------------------------------------------------------------------------------------------------------
    var hideSearch = $('.hide-search'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        _user_id = $('#user_id').val(),
        _ds_code = $('#ds_code').val(),
        _api_url = $('#api_url').val(),
        chartWrapper = $('.chartjs'),
        flatPicker = $('.flat-picker'),
        barChartEx = $('.bar-chart-ex'),
        horizontalBarChartEx = $('.horizontal-bar-chart-ex');
    
    var primaryColorShade = '#836AF9',
        yellowColor = '#ffe800',
        successColorShade = '#28dac6',
        warningColorShade = '#ffe802',
        warningLightColor = '#FDAC34',
        infoColorShade = '#299AFF',
        greyColor = '#4F5D70',
        blueColor = '#2c9aff',
        blueLightColor = '#84D0FF',
        greyLightColor = '#EDF1F4',
        tooltipShadow = 'rgba(0, 0, 0, 0.25)',
        lineChartPrimary = '#666ee8',
        lineChartDanger = '#ff4961',
        labelColor = '#6e6b7b',
        grid_line_color = 'rgba(200, 200, 200, 0.2)', // RGBA color helps in dark layout
        primary = '#5c69d1';

    hideSearch.select2({
        minimumResultsForSearch: Infinity
    });

    $("#select_year").val(active_year).change();

    $("#select_year").change(function(){
        $("#loader").removeClass("hidden",function () {
          $("#loader").fadeIn(500);
        });
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "select_active_year",
                data:{
                    "select_year":this.value
                },
                success:function(data)
                {   
    
            
            if (data.status == 1) 
            {         
               location.reload(true);
            }
            else
            {
                toastr['error'](data.message, 'Error', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
          },
          error: function(xhr, status, error){
            var errorMessage = xhr.status + ': ' + xhr.statusText;
            if(xhr.status == 500){
                toastr['error']('There was a problem connecting to the server.', 'Error', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
            else if(xhr.status == 0){
                toastr['error']('Not Connected. Please verify your network connection.', 'Error', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });

            }else{
                toastr['error'](errorMessage, 'Error', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
          }
        });
    });

    // Wrap charts with div of height according to their data-height
    if (chartWrapper.length) {
        chartWrapper.each(function () {
        $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
        });
    }
    // Bar Chart
    // --------------------------------------------------------------------
    if (barChartEx.length) {
        var barChartExample = new Chart(barChartEx, {
            type: 'bar',
            options: {
                elements: {
                rectangle: {
                    borderWidth: 1,
                    borderRadius: 5,
                    borderSkipped: 'bottom'
                }
                },
                responsive: true,
                maintainAspectRatio: false,
                responsiveAnimationDuration: 500,
                legend: {
                display: false
                },
                tooltips: {
                // Updated default tooltip UI
                shadowOffsetX: 1,
                shadowOffsetY: 1,
                shadowBlur: 8,
                shadowColor: tooltipShadow,
                backgroundColor: window.colors.solid.white,
                titleFontColor: window.colors.solid.black,
                bodyFontColor: window.colors.solid.black
                },
                scales: {
                xAxes: [
                    {
                        display: true,
                        gridLines: {
                            display: true,
                            color: grid_line_color,
                            zeroLineColor: grid_line_color
                        },
                        scaleLabel: {
                            display: false
                        },
                        ticks: {
                            fontColor: labelColor
                        }
                    }
                ],
                yAxes: [
                    {
                        display: true,
                        gridLines: {
                            color: grid_line_color,
                            zeroLineColor: grid_line_color
                        }
                    }
                ]
                }
            },
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [
                    {
                        barThickness: 15,
                        data:  JSON.parse(yearlyTrans),
                        backgroundColor: lineChartPrimary,
                        borderColor: 'transparent'
                    }
                ]
            }
        });
    }
//--------------------------------------------------------------------------------------------------------------------------------

$("#select_date").val(select_date);
    // Init flatpicker
    if (flatPicker.length) {
        var date = new Date();
        flatPicker.each(function () {
            $(this).flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d',
                maxRange: 10,
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length>1) {
                        var range = instance.formatDate(selectedDates[1], 'U') - instance.formatDate(selectedDates[0], 'U');
                        range = range / 86400;
                 
                            var dateStart = instance.formatDate(selectedDates[0], 'Y-m-d');
                            var dateEnd = instance.formatDate(selectedDates[1], 'Y-m-d');
                            var select_date =  dateStart+" to "+dateEnd;
                            $("#loader").removeClass("hidden",function () {
                                $("#loader").fadeIn(500);
                            });
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                method: "POST",
                                url: "select_date",
                                data:{
                                    "select_date":select_date
                                },
                                success:function(data)
                                { 
                                    // console.log(data[0].status);
                                    if (data.status == 1) 
                                    {
                                    
                                        location.reload(true);
                                    }
                                    else
                                    {
                                        toastr['error'](data.message, 'Error', {
                                            closeButton: true,
                                            tapToDismiss: false,
                                            rtl: isRtl
                                        });
                                    }
                                },
                                error: function(xhr, status, error){
                                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                                    if(xhr.status == 500){
                                        toastr['error']('There was a problem connecting to the server.', 'Error', {
                                            closeButton: true,
                                            tapToDismiss: false,
                                            rtl: isRtl
                                        });
                                    }
                                    else if(xhr.status == 0){
                                        toastr['error']('Not Connected. Please verify your network connection.', 'Error', {
                                            closeButton: true,
                                            tapToDismiss: false,
                                            rtl: isRtl
                                        });
                        
                                    }else{
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
    }
//--------------------------------------------------------------------------------------------------------------------------------

})