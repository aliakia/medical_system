<!DOCTYPE html>
{{-- {!! Helper::applClasses() !!} --}}
@php
    $configData = Helper::appClasses();
@endphp
<html>
{{-- lang="@if (session()->has('locale')) {{ session()->get('locale') }}@else{{ $configData['defaultLanguage'] }} @endif"
    data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}"
    class="{{ $configData['theme'] === 'light' ? '' : $configData['layoutTheme'] }}"> --}}

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Medical System</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">
    <style>
        table.minimalistBlack {
            border: 0px solid #000000;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        table.minimalistBlack td,
        table.minimalistBlack th {
            border: 1px solid #000000;
            padding: 5px 4px;
        }

        table.minimalistBlack tbody td {
            font-size: 13px;
        }

        table.minimalistBlack thead {
            background: #CFCFCF;
            background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            border-bottom: 0px solid #000000;
        }

        table.minimalistBlack thead th {
            font-size: 15px;
            font-weight: bold;
            color: #000000;
            text-align: left;
        }

        table.minimalistBlack tfoot td {
            font-size: 14px;
        }
    </style>
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
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/Medical Raw.jpg'))) }}"
                    class="rounded mt-50 bg-secondary" alt="default.png" height="auto" width="10%" />
            </th>
        </tr>
        <tr style="width:100%">
            <th colspan="12" style="text-align:center; width:100%; padding-left:4px;">
                <b style="font-size:14px; color:black;">{{ Session('data_clinic')->clinic_name }}</b>
            </th>
        </tr>
        <tr style="width:100%">
            <th colspan="12" style="text-align:center; width:100%; padding-left:4px;">
                <b style="font-size:10px; color:black;">{{ Session('data_clinic')->address_full }}</b>
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
                @if ($status == 2)
                    <b style="font-size:14px; font-weight:bold; color:black;">TRANSACTION REPORT</b>
                @elseif($status == 0)
                    <b style="font-size:14px; font-weight:bold; color:black;">PENDING TRANSACTION REPORT</b>
                @elseif($status == 1)
                    <b style="font-size:14px; font-weight:bold; color:black;"> UPLOADED TRANSACTION REPORT</b>
                @endif
            </th>
        </tr>

        <tr style="width:100%;">
            <td colspan="12"
                style="padding-top: 30px; text-align: left; color:black; font-size:12px; font-weight:bold">Date:
                {{ $date_from }} - {{ $date_to }}</td>
        </tr>

        <table class="minimalistBlack">
            <thead>
                <tr>
                    <th>TRANS NO.</th>
                    <th>CLIENT NAME</th>
                    <th>TRANSACTION TYPE</th>
                    <th>PHYSICIAN NAME</th>
                    <th>DATE UPLOADED</th>
                    <th>TRANSACTION STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->trans_no }}</td>
                        <td>{{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}</td>
                        <td>
                            @if ($item->purpose == '1')
                                New Non-Pro Driver´s License
                            @elseif($item->purpose == '2')
                                New Pro Driver´s License
                            @elseif($item->purpose == '3')
                                Renewal of Non-Pro Driver´s License
                            @elseif($item->purpose == '4')
                                Renewal of Pro Driver´s License
                            @elseif($item->purpose == '5')
                                Renewal of Conductor´s License
                            @elseif($item->purpose == '6')
                                Conversion from Non-Pro to Pro DL
                            @elseif($item->purpose == '7')
                                New Non-Pro Driver´s License (with Foreign License)
                            @elseif($item->purpose == '8')
                                New Pro Driver´s License (with Foreign License)
                            @elseif($item->purpose == '9')
                                New Conductor´s License
                            @elseif($item->purpose == '10')
                                New Student Permit
                            @elseif($item->purpose == '11')
                                Conversion from Pro to Non-Pro DL
                            @elseif($item->purpose == '12')
                                Add Restriction for Non-Pro Driver´s License
                            @elseif($item->purpose == '13')
                                Add Restriction for Pro Driver´s License
                            @endif
                        </td>
                        <td>{{ $item->physician_name }}</td>
                        <td>{{ $item->date_uploaded }}</td>
                        <td>
                            @if ($item->is_lto_sent == '0')
                                <div class="badge badge-light-warning">Pending</div>
                            @else
                                <div class="badge badge-light-success">Uploaded</div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</body>

</html>
