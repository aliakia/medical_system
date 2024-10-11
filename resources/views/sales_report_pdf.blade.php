<!DOCTYPE html>
{{-- {!! Helper::applClasses() !!} --}}
@php
$configData = Helper::applClasses();
@endphp
<html lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{$configData['defaultLanguage']}}@endif" data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}" class="{{ ($configData['theme'] === 'light') ? '' : $configData['layoutTheme'] }}">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') - Driving School System</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo/favicon.ico')}}">

</head>



<body style="background:white;margin-top:10px;">
    {{-- <img
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/lto_logo.png'))) }}"
            style="position:absolute; opacity:0.1; z-index:-100; margin-top:20%;"
            alt="default.png"
            height="auto"
            width="100%"
    /> --}}
    <table style="width:90%; margin:auto auto;">
        <tr>
            <th colspan="12" style="text-align:center; width:100%; padding-left:4px;">
                <img
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/ds_icon.png'))) }}"
                    class="rounded mt-50 bg-secondary"
                    alt="default.png"
                    height="auto"
                    width="10%"
                />
            </th>
        </tr>
        <tr style="width:100%">
            <th colspan="12" style="text-align:center; width:100%; padding-left:4px;">
                <b style="font-size:14px; color:black;">{{Session('data_ds')->ds_name}}</b> 
            </th>
        </tr>
        <tr style="width:100%">
            <th colspan="12" style="text-align:center; width:100%; padding-left:4px;">
                <b style="font-size:10px; color:black;">{{Session('data_ds')->ds_address}}</b> 
            </th>
        </tr>
        <tr style="width:100%;">
            <td colspan="12"><br><br></td>
        </tr>
        <tr>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>
            <th style="width: 8.3%"></th>

        </tr>
        <tr style="width:100%;">
            <th colspan="12" style="text-align:center; width:100%; padding-left:4px;">
                <b style="font-size:14px; font-weight:bold; color:black;">SALES REPORT</b> 
            </th>
        </tr>

        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 30px; text-align: right; color:black; font-size:12px; font-weight:bold">Date From:</td>
            <td colspan="6" style="padding-top: 30px; text-align: center; color:black; font-size:12px;">{{$date_from}}</td>
        </tr>

        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">Date To:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$date_to}}</td>
        </tr>
       
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">TDC Total Upload:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->tdc_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">PDC Total Upload:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->pdc_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">CDE Total Upload:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->dep_cde_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">DRC Total Upload:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->dep_drc_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold"> Student Permit Total:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->sp_code_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">New License Total</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->nl_code_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold"> Renewal of License Total:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->rl_code_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">ADL Total:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->adl_code_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">Total Passed:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->passed_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">Total Failed:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;"> {{$data->failed_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">Printed Certificate:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->is_printed_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold"> Gross Total:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->gross_total}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="4" style="padding-top: 15px; text-align: right; color:black; font-size:12px; font-weight:bold">LTO Uploaded Total:</td>
            <td colspan="6" style="padding-top: 15px; text-align: center; color:black; font-size:12px;">{{$data->lto_uploaded_total}}</td>
        </tr>
    </table>
</body>
</html>
