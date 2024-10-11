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

  <title>@yield('title') - Medical System</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/Medical Raw.jpg')}}">
    <style type="text/css">
        @page { margin:0px; }
    </style>
</head>



<body style="background:white; font-family:sans-serif; width: 100%; margin: 20px 0px;">
    @foreach ($data as $item)
                <!-- <img
            src="{{asset('images/Land_Transportation_Office.png')}}"
            style="position:absolute; opacity:0.1; z-index:-100; margin-top:20%;"
            alt="default.png"
            height="auto"
            width="100%"
    /> -->
    <table style="width: 88.235294117647%; margin: auto auto;">
        <tr>
            <th style="width: 8.3%;"></th>
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
        <tr style="width:100%">
             <th colspan="3" style="text-align:center; width:100%; ">
                <img
                src="{{asset('images/dotr.png')}}"
                style=""
                alt="default.png"
                height=""
                width="30%"
                style="display:block"
                /> 
                
            </th>
            <th colspan="7" style="vertical-align:bottom; width:100%; font-size:13px; font-weight:700; color:black;">
            MEDICAL CERTIFICATE<br><b style="font-size:13px; font-weight:800; color:black;">DERMALOG REFERENCE NO: {{$item->trans_no}}</b> 
            </th>
            
            <th colspan="3" style="text-align:center; width:100%;">
                <img
                src="{{asset('images/Land_Transportation_Office.png')}}"
                style=""
                alt="default.png"
                height=""
                width="30%"
                />
            </th>
            
        </tr>
            <!-- <tr style="width:100%">
             <th colspan="2" style="text-align:right; width:100%;">
           
            </th>
            <th colspan="8" style="vertical-align:bottom; text-align:center; width:100%; ">
                <b style="font-size:15px; font-weight:700; color:black;">DERMALOG REFERENCE NO: {{$item->reference_no}}</b> 
            </th>
            <th colspan="2" style="text-align:left; width:100%;">
           
            </th>
        </tr> -->
  
    </table>
    
    <table style="width: 88.235294117647%; margin:auto auto; border:1px solid black; border-collapse: separate; border-spacing: 8px 0px;">
        <tr style="width:100%;">
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
        </tr>
        <tr style="width:100%">
            <th colspan="20" style="border:1px solid black; text-align:left; width:90%; padding:1px 8px;">
                <b style="font-size: 12px; font-weight:bold; color:black;">APPLICANT'S INFORMATION</b>  
            </th>
        </tr>
        <tr>
            <th colspan="20" style="width: 100%; padding-top: 5px;"></th>
        </tr>
        <tr style="width:100%;">
            <td colspan="2" style="vertical-align: bottom; text-align: left; color:black; font-size:11px; height: 10px;">NAME:</td>
            <td colspan="5" style="vertical-align: bottom; text-align: center; color:black; font-size:11px; border-bottom:1px solid black;">{{$item->last_name}}</td>
            <td colspan="5" style="vertical-align: bottom; text-align: center; color:black; font-size:11px; border-bottom:1px solid black;">{{$item->first_name}}</td>
            <td colspan="4" style="vertical-align: bottom; text-align: center; color:black; font-size:11px; border-bottom:1px solid black;">{{$item->middle_name}}</td>
            <td colspan="4" rowspan="6" style="border: 1px solid black; padding: auto;">
                @if ($item->id_picture == '' || $item->id_picture == null)
                <img
                src="default.png"
                alt="{{asset('images/default.png')}}"
                style="width:100%; height:auto; display: block;"
                />
                @else
                <img
                src="{{$item->id_picture}}"
                alt="default.png"
                style="width:100%; height:auto; display: block;"
                />
                @endif
   
            </td>
        </tr>
        <tr style="width:100%;">
            <td colspan="2" style="text-align: left; color:black; font-size: 9px; height: 10px;"></td>
            <td colspan="5" style="text-align: center; color:black; font-size: 9px;">SURNAME</td>
            <td colspan="5" style="text-align: center; color:black; font-size: 9px;">FIRST NAME</td>
            <td colspan="4" style="text-align: center; color:black; font-size: 9px;">MIDDLE NAME</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="2" style="vertical-align: bottom; text-align: left; color:black; font-size:11px; height: 10px;">ADDRESS:</td>
            <td colspan="14" style="vertical-align: bottom; text-align: left; color:black; font-size:11px;">
                <div style=" border-bottom: 1px solid black; position: relative; left: -5px;">
                     {{$item->address_full}}
                </div>
            </td>
        </tr>
        <tr style="width:100%;">
            <td colspan="5" style="vertical-align: bottom; text-align: left; color:black; font-size:11px; height: 10px;">DRIVERS LINCENSE NUMBER:</td>
            <td colspan="5" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;">
                <div style=" border-bottom: 1px solid black; position: relative; left: -5px;">       
                      {{$item->license_no}}
                </div>
            </td>
            <td colspan="3" style="vertical-align: bottom; text-align: right; color:black; font-size:11px;">DATE OF BIRTH:</td>
            <td colspan="3" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;">
                <div style=" border-bottom: 1px solid black; position: relative; left: -5px;">
                     {{$item->birthday}}
                </div>
            </td>
        </tr>
        <tr style="width:100%;">
            <td colspan="3" style="vertical-align: bottom; text-align: left; color:black; font-size:11px; height: 10px;">NATIONALITY:</td>
            <td colspan="2" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;">
                <div style=" border-bottom: 1px solid black; position: relative; left: -21px;">
                     {{$item->nationality}}
                </div>
            </td>
                
            <td colspan="1" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;">AGE:</td>
            <td colspan="1" style="vertical-align: bottom; text-align: center; color:black; font-size:11px; margin-right:1px">
                <div style=" border-bottom: 1px solid black; position: relative; left: -5px;">
                     {{$item->age}}
                </div>
            </td>
            <td colspan="2" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;">GENDER:</td>
            <td colspan="2" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;">  
                <div style=" border-bottom: 1px solid black; position: relative; left: -5px;">       
                        @if ($item->gender == 'M')
                            Male
                        @else
                            Female
                        @endif
                </div>
            </td>
            <td colspan="4" style="vertical-align: bottom; text-align: left; color:black; font-size:11px;">MARTIAL STATUS:</td>
            <td colspan="2" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;">
                <div style=" border-bottom: 1px solid black; position: relative; left: -38px; width:100%;">       
                    @if($item->civil_status == 'S')
                        Single
                    @elseif($item->civil_status == 'M')
                        Married
                    @elseif($item->civil_status == 'W')
                        Widow
                    @elseif($item->civil_status == 'P')
                    Separate
                    @endif
                </div>
            </td>
        </tr>

        <tr>
        <td colspan="4" style="vertical-align: bottom; text-align: left; color:black; font-size:11px;">OCCUPATION:</td>
            <td colspan="8" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;">
                <div style=" border-bottom: 1px solid black; position: relative; left: -60px; width:100%;">       
                {{$item->occupation}}
                </div>
            </td>
        </tr>

        <tr>
            <th colspan="20" style="width: 100%; padding-top: 5px;"></th>
        </tr>
    </table>

    <table style="width: 88.235294117647%; margin:auto auto; margin-top: 5px; border:1px solid black; border-collapse: separate; border-spacing: 8px 0px;">
        <tr style="width:100%;">
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
            <th style="width: 5%;padding-top: 5px;"></th>
        </tr>

        <tr style="width:100%">
            <th colspan="20" style="border:1px solid black; text-align:center; width:90%; padding:1px 8px;">
                <b style="font-size: 12px; font-weight:bold; color:black;">PHYSICAL EXAMINATION</b>  
            </th>
        </tr>

        <tr style="width:100%;">
            <td colspan="8" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">GENERAL PHYSIQUE</td>
            <td colspan="8" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">CONTAGIOUS DISEASE</td>
            <td colspan="4" style="padding-top: 5px; text-align: center; color:black; font-size:11px; font-weight:bold;">BLOOD PRESSURE</td>
        </tr>

        <tr style="width:100%;">
            <td colspan="8" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_general_physique == 'normal')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif 
                    <div style="font-size:11px; display:inline-block;">Normal</div>
                </div>
            </td>
            <td colspan="8" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_contagious_disease == 'none')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif 
                    <div style="font-size:11px; display:inline-block;">None</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align: bottom; text-align: center; color:black; font-size:11px; border-bottom: 1px solid black;">
                {{$item->pt_blood_pressure}}
            </td>
        </tr>

        <tr style="width:100%;">
            
            <td colspan="5" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_general_physique != 'normal')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif 
                    <div style="font-size:9px; display:inline-block;">With Disability, pls specify:</div>
                </div>
            </td>
            <td colspan="3" style="vertical-align:middle; text-align: left; color:black; font-size:9px;;"> 
                <div style=" border-bottom: 1px solid black; position: relative; left: -40px;">
                    @if (str_contains($item->pt_general_physique, 'normal') == FALSE)
                    {{$item->pt_general_physique}}
                    @else
                    &nbsp
                    @endif
                </div> 
            </td>

            <td colspan="5" style="vertical-align:middle; text-align:left; color:black;"> 
                <div style="display: flex;">
                    @if (str_contains($item->pt_contagious_disease, 'none') == FALSE)
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif 
                    <div style="font-size:9px; display:inline-block;">With Disease, pls specify:</div>
                </div>
            </td>
            <td colspan="3" style="vertical-align: middle; text-align: left; color:black; font-size:9px;"> 
                <div style=" border-bottom: 1px solid black; position: relative; left: -40px;">
                    @if (str_contains($item->pt_contagious_disease, 'none') == FALSE)
                    {{$item->pt_contagious_disease}}
                    @else
                    &nbsp
                    @endif
                </div> 
            </td>
            <td colspan="4" style="text-align: center; color:black; font-size:11px; font-weight:bold;">BLOOD TYPE</td>
        </tr>

        <tr style="width:100%;">
            <td colspan="3" style="text-align: left; color:black; font-size:11px;">
                HEIGHT (cms):
            </td>
            <td colspan="2" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                <div style=" border-bottom: 1px solid black; position: relative; left: -21px;">
                    {{$item->pt_height}}
                </div>
            </td>
            <td colspan="3" style="text-align: left; color:black; font-size:11px;">
                WEIGHT (kgs):  
            </td>
            <td colspan="2" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                <div style=" border-bottom: 1px solid black; position: relative; left: -21px;">
                     {{$item->pt_weight}}
                </div>
            </td>
            <td colspan="6" style="text-align: left; color:black; font-size:11px;">
              
            </td>
            <td colspan="4" style="vertical-align: bottom; text-align: center; color:black; font-size:11px; border-bottom: 1px solid black;">  {{$item->blood_type}}</td>
        </tr>
        <tr style="width:100%;">
            <td colspan="6" style="padding-top: 3px; text-align: left; color:black; font-size:11px; font-weight:bold">UPPER EXTREMITES:</td>
    
            <td colspan="10" style="text-align: left; color:black; font-size:11px; font-weight:bold">LOWER EXTREMITES:</td>

            <td colspan="4" style="text-align: center; color:black; font-size:11px; font-weight:bold">EYE COLOR</td>
        </tr>
        
        <tr style="width:100%;">
            <td colspan="4" style="text-align: left; color:black; font-size:11px; font-weight:bold">LEFT</td>
            <td colspan="4" style="text-align: left; color:black; font-size:11px; font-weight:bold">RIGHT</td>
            <td colspan="4" style="text-align: left; color:black; font-size:11px; font-weight:bold">LEFT</td>
            <td colspan="4" style="text-align: left; color:black; font-size:11px; font-weight:bold;">RIGHT</td>
            <td colspan="6" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                <div style=" border-bottom: 1px solid black; position: relative;">
                    @if($item->pt_eye_color == 1)
                    Black
                    @elseif($item->pt_eye_color == 2)
                    Brown
                    @elseif($item->pt_eye_color == 3)
                    Other
                    @elseif($item->pt_eye_color == 4)
                    Blue
                    @endif
                </div>
            </td>
        </tr>

        <tr style="width:100%;">
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_ue_normal_left == '1')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif 
                    <div style="font-size:9px; display:inline-block;">Normal</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_ue_normal_right == '1')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">Normal</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_le_normal_left == '1')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">Normal</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_le_normal_right == '1')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">Normal</div>
                </div>
            </td>
        </tr>

        <tr style="width:100%;">
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_ue_normal_left == '2')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">With Disability</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_ue_normal_right == '2')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">With Disability</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_le_normal_left == '2')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">With Disability</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_le_normal_right == '2')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">With Disability</div>
                </div>
            </td>
        </tr>

        <tr style="width:100%;">
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_ue_normal_left == '3')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">With Special Equipment</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_ue_normal_right == '3')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">With Special Equipment</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_le_normal_left == '3')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">With Special Equipment</div>
                </div>
            </td>
            <td colspan="4" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                <div style="display: flex;">
                    @if ($item->pt_le_normal_right == '3')
                    <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @else
                    <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                    @endif
                    <div style="font-size:9px; display:inline-block;">With Special Equipment</div>
                </div>
            </td>
        </tr>

        <tr>
            <th colspan="20" style="width: 100%; padding-top: 3px;"></th>
        </tr>
    </table>

    <table style="width: 88.235294117647%; margin:auto auto; padding-top: 3px; border-collapse: separate; border-spacing: 0px 0px;">
        <tr style="width:100%;">
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
            <th style="width: 10%;"></th>
        </tr>
        <tr style="width: 100%; page-break-inside: auto;">
            <td colspan="6" style="vertical-align: top; padding:0px; padding-right: 5px;">
                <table style="width: 100%; margin:0px; border:1px solid black; border-collapse: separate; border-spacing: 8px 0px;">
                    <tr style="width:100%;">
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                    </tr>
            
                    <tr style="width:100%">
                        <th colspan="20" style="border:1px solid black; text-align:center; width:90%; padding:1px 8px;">
                            <b style="font-size: 12px; font-weight:bold; color:black;">VISUAL TEST</b>  
                        </th>
                    </tr>
            
                    <tr style="width:100%;">
                        <td colspan="20" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">Visual Acuity</td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="11" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">LEFT EYE: SNELLEN/BAILEY-LOVIE</td>
                        <td colspan="8" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -21px;">
                                 {{$item->vt_snellen_bailey_lovie_left}}
                            </div>
                        </td>
                    </tr>
                    
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                            <div style="display: flex;">
                                @if ($item->vt_snellen_with_correct_left == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">With corrective lens</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                            <div style="display: flex;">
                                @if ($item->vt_color_blind_left == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Color blind</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="11" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">RIGHT EYE: SNELLEN/BAILEY-LOVIE</td>
                        <td colspan="8" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -21px;">
                                {{$item->vt_snellen_bailey_lovie_right}}
                            </div>
                        </td>
                    </tr>
                    
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                            <div style="display: flex;">
                                @if ($item->vt_snellen_with_correct_right == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">With corrective lens</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                            <div style="display: flex;">
                                @if ($item->vt_color_blind_right == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Color blind</div>
                            </div>
                        </td>
                    </tr>

                    <tr style="width:100%;">
                        <td colspan="12" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">Glare/Contrast Sensitivity Function</td>
                        <td colspan="4" style="padding-top: 5px; text-align: center; color:black; font-size:10px; font-weight:bold;">RIGHT EYE</td>
                        <td colspan="4" style="padding-top: 5px; text-align: center; color:black; font-size:10px; font-weight:bold;">LEFT EYE</td>
                    </tr>

                    <tr>
                        <td colspan="12" style="padding-top: 5px; text-align: left; color:black; font-size:10px;">Without Lenses</td>

                        <td colspan="4" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->vt_glare_contrast_sensitivity_function_without_lenses_right}}
                            </div>
                        </td>

                        <td colspan="4" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->vt_glare_contrast_sensitivity_function_without_lenses_left}}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="12" style="padding-top: 5px; text-align: middle; color:black; font-size:10px;">Without Corrective or Contact Lenses</td>

                        <td colspan="4" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri}}
                            </div>
                        </td>

                        <td colspan="4" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->vt_glare_contrast_sensitivity_function_with_corretive_lenses_le}}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" style="padding-top: 5px; text-align: middle; color:black; font-size:11px;font-weight:bold;">Color Blind:</td>

                        <td colspan="7" style="vertical-align: bottom; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left:-14; ">
                                {{$item->vt_color_blind_test}}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="12" style="padding-top: 5px; text-align: middle; color:black; font-size:10px;">ANY EYE INJURY OR DISEASE? (Specify)</td>
                    </tr>

                    <tr>
                         <td colspan="12" style="vertical-align: bottom; text-align: left; color:black; font-size:10px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->vt_any_eye_injury_disease}}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="14" style="padding-top: 5px; text-align: middle; color:black; font-size:10px;">IS FURTHER EYE EXAMINATION SUGGESTED?</td>
                    </tr>

                    <tr style="width:100%;">

                        <td colspan="5" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                            <div style="display: flex;">
                                @if ($item->vt_further_examination == 'YES')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">YES</div>
                            </div>
                        </td>

                        <td colspan="5" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                            <div style="display: flex;">
                                @if ($item->vt_further_examination == 'NO')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px; padding: 0px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">NO</div>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 3px;"></th>
                    </tr>
                </table>
                <table style="width: 100%; margin:0px; margin-top: 5px; border:1px solid black; border-collapse: separate; border-spacing: 8px 0px;">
                    <tr style="width:100%;">
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                    </tr>
            
                    <tr style="width:100%">
                        <th colspan="20" style="border:1px solid black; text-align:center; width:90%; padding:1px 8px;">
                            <b style="font-size: 12px; font-weight:bold; color:black;">METABOLIC AND NEUROLOGICAL DISORDERS</b>  
                        </th>
                    </tr>
            
                    <tr style="width:100%;">
                        <td colspan="3" style="padding-top: 3px; vertical-align:bottom; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_diabetes == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="padding-top: 3px; vertical-align:bottom; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_diabetes == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="14" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">DIABETES</td>
                    </tr>
    
                    <tr style="width:100%;">

                        <td colspan="9" style="padding-top: 0px; text-align: left; color:black; font-size: 9px; font-weight:normal; font-style: italic;">
                            is it under proper control or medication?
                        </td>

                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_diabetes_treatment == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>

                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_diabetes_treatment == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>

                        <td colspan="5" style="vertical-align: bottom; text-align: left; color:black; font-size:10px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->mn_diabetes_remarks}}
                            </div>
                        </td>
                    </tr>

                    <tr style="width:100%;">

                         <td colspan="15" style="padding-top: 0px; text-align: right; color:black; font-size: 9px; font-weight:normal;">
                         
                        </td>
                        <td colspan="5" style="padding-top: 0px; text-align: center; color:black; font-size: 9px; font-weight:normal;">
                            (Specify)
                        </td>

                    </tr>
    
                    <tr style="width:100%;">

                        <td colspan="3" style="padding-top: 3px; vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_epilepsy == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="padding-top: 3px; vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_epilepsy == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="4" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">EPILEPSY</td>
                        <td colspan="5" style="padding-top: 5px; text-align: left; color:black; font-size: 9px; font-weight:normal; font-style: italic;">
                            Date of last seizure
                        </td>
                        <td colspan="5" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -19px;">
                                @if ($item->mn_epilepsy == '1')
                                {{$item->mn_last_seizure}}
                                @else
                                &nbsp
                                @endif
                            </div>
                       </td>

                    </tr>

                    <tr style="width:100%;">

                        <td colspan="9" style="text-align: left; color:black; font-size: 9px; font-weight:normal; font-style: italic;">
                            is it under proper control or medication?
                        </td>
                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_epilepsy_treatment == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_epilepsy_treatment == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="5" style="vertical-align: bottom; text-align: left; color:black; font-size:10px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->mn_epilepsy_remarks}}
                            </div>
                        </td>
                    </tr>
                    <tr style="width:100%;">

                        <td colspan="15" style="padding-top: 0px; text-align: right; color:black; font-size: 9px; font-weight:normal;">

                        </td>
                        <td colspan="5" style="padding-top: 0px; text-align: center; color:black; font-size: 9px; font-weight:normal;">
                        (Specify)
                        </td>

                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="3" style="padding-top: 3px; vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_sleep_apnea == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="padding-top: 3px; vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_sleep_apnea == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="14" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">SLEEP APNEA</td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="9" style="text-align: left; color:black; font-size: 9px; font-weight:normal; font-style: italic;">
                            is it under medication?
                        </td>
                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_sleepapnea_treatment == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_sleepapnea_treatment == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="5" style="vertical-align: bottom; text-align: left; color:black; font-size:10px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->mn_sleep_apnea_remarks}}
                            </div>
                        </td>
                    </tr>
                    <tr style="width:100%;">

                        <td colspan="15" style="padding-top: 0px; text-align: right; color:black; font-size: 9px; font-weight:normal;">

                        </td>
                        <td colspan="5" style="padding-top: 0px; text-align: center; color:black; font-size: 9px; font-weight:normal;">
                        (Specify)
                        </td>

                    </tr>

                    <tr style="width:100%;">
                        <td colspan="3" style="padding-top: 3px; vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_aggressive_manic == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="padding-top: 3px; vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_aggressive_manic == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="14" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">AGGRESSIVE, MANIC OR DEPRESSIVE ORDER</td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="9" style="text-align: left; color:black; font-size: 9px; font-weight:normal; font-style: italic;">
                            is it under proper control or medication?
                        </td>
                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_mental_treatment == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_mental_treatment == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="5" style="vertical-align: bottom; text-align: left; color:black; font-size:10px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->mn_aggresive_manic_remarks}}
                            </div>
                        </td>
                    </tr>
                    <tr style="width:100%;">

                        <td colspan="15" style="padding-top: 0px; text-align: right; color:black; font-size: 9px; font-weight:normal;">

                        </td>
                        <td colspan="5" style="padding-top: 0px; text-align: center; color:black; font-size: 9px; font-weight:normal;">
                        (Specify)
                        </td>

                    </tr>

                    <tr style="width:100%;">
                        <td colspan="3" style="padding-top: 3px; vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_others == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="padding-top: 3px; vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_others == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="14" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold;">
                            OTHER MEDICAL CONDITION OR IMPAIRMENT WHICH MAY AFFECT ABILITY TO DRIVE SAFELY
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="14" style="vertical-align: bottom; text-align: justify; text-justify:inter-word; color:black; font-size:11px; border-bottom: 1px solid black;"> 
                            @if ($item->mn_others == '1')
                            {{$item->mn_other_medical_condition}}
                            @else
                                &nbsp
                            @endif
                       </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="9" style="text-align: left; color:black; font-size: 9px; font-weight:normal; font-style: italic;">
                            is it under proper control or medication?
                        </td>
                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_other_treatment == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                               <div style="font-size:11px; display:inline-block;">Yes</div>
                            </div>
                        </td>
                        <td colspan="3" style="vertical-align:middle; text-align:left; color:black;"> 
                            <div style="display: flex;">
                                @if ($item->mn_other_treatment == '0')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">No</div>
                            </div>
                        </td>
                        <td colspan="5" style="vertical-align: bottom; text-align: left; color:black; font-size:10px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; ">
                                {{$item->mn_other_medical_condition_remarks}}
                            </div>
                        </td>
                    </tr>
                    <tr style="width:100%;">

                        <td colspan="15" style="padding-top: 0px; text-align: right; color:black; font-size: 9px; font-weight:normal;">

                        </td>
                        <td colspan="5" style="padding-top: 0px; text-align: center; color:black; font-size: 9px; font-weight:normal;">
                        (Specify)
                        </td>

                    </tr>

                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 3px;"></th>
                    </tr>
                </table>
                <table style="width: 100%; margin:0px;">
                    <tr style="width:100%;">
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="4" style="text-align: left; color:black; font-size:11px; font-weight:bold;">PHYSICIAN</td>
                        <td colspan="16" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -19px;">
                              {{$physician_name}}
                            </div>
                       </td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="7" style="text-align: left; color:black; font-size:11px; font-weight:bold;">PRC LICENSE NUMBER</td>
                        <td colspan="13" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -16px;">
                                {{$prc_number}}
                            </div>
                       </td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="5" style="text-align: left; color:black; font-size:11px; font-weight:bold;">PTR NUMBER</td>
                        <td colspan="15" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -20px;">
                              {{$ptr_number}}
                            </div>
                       </td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="4" style="text-align: left; color:black; font-size:11px; font-weight:bold;">ISSUED AT</td>
                        <td colspan="16" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -19px;">
                              {{$clinic_name}}
                            </div>   
                       </td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="5" style="text-align: left; color:black; font-size:11px; font-weight:bold;">CERTIFICATE #</td>
                        <td colspan="16" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -19px;">
                             {{$med_cert_ref_no}}
                            </div>
                       </td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="5" style="text-align: left; color:black; font-size:11px; font-weight:bold;">SIGNATURE</td>
                        <td colspan="16" style="vertical-align: center; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -21px;">
                                &nbsp;
                            </div>
                       </td>
                    </tr>
                </table>
            </td>
            <td colspan="4" style="vertical-align: top; padding:0px;">
                <table style="width: 100%; margin:0px; border:1px solid black; border-collapse: separate; border-spacing: 8px 0px;">
                    <tr style="width:100%;">
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                    </tr>

                    <tr style="width:100%">
                        <th colspan="20" style="border:1px solid black; text-align:center; width:90%; padding:1px 8px;">
                            <b style="font-size: 12px; font-weight:bold; color:black;">AUDITORY TEST</b>  
                        </th>
                    </tr>
            
                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 3px;">&nbsp</th>
                    </tr>

                    <tr style="width:100%;">
                        <td colspan="10" style="padding-top: 5px; text-align: left; color:black; font-size:11px; font-weight:bold">LEFT EAR:</td>
                        <td colspan="10" style="text-align: left; color:black; font-size:11px; font-weight:bold">RIGHT EAR:</td>
                    </tr>
            
                    <tr style="width:100%;">
                        <td colspan="10" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->at_hearing_left == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:13px; display:inline-block;">Normal</div>
                            </div>
                        </td>
                        <td colspan="10" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->at_hearing_right == '1')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:13px; display:inline-block;">Normal</div>
                            </div>
                        </td>
                    </tr>

    
                    <tr style="width:100%;">
                        <td colspan="10" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->at_hearing_right == '2')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:13px; display:inline-block;">Reduced</div>
                            </div>
                        </td>
                        <td colspan="10" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->at_hearing_right == '2')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:13px; display:inline-block;">Reduced</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="10" style="vertical-align:middle; text-align:left; color:black;padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->at_hearing_right == '3')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:13px; display:inline-block;">With hearing aid</div>
                            </div>
                        </td>
                        <td colspan="10" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->at_hearing_right == '3')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:13px; display:inline-block;">With hearing aid</div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 3px;">&nbsp</th>
                    </tr>

                </table>
                <table style="width: 100%; margin:0px; margin-top: 5px; border:1px solid black; border-collapse: separate; border-spacing: 8px 0px;">
                    <tr style="width:100%;">
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                        <th style="width: 5%;padding-top: 5px;"></th>
                    </tr>
            
                    <tr style="width:100%">
                        <th colspan="20" style="border:1px solid black; text-align:center; width:90%; padding:1px 8px;">
                            <b style="font-size: 12px; font-weight:bold; color:black;">ASSESSMENT</b>  
                        </th>
                    </tr>
            
                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 3px;">&nbsp</th>
                    </tr>

                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 5px 0px 0px 0px"> 
                            <div style="display: flex;">
                                @if ($item->exam_assessment == 'Fit')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Fit to drive</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 0px;"> 
                            <div style="display: flex;">
                                @if ($item->exam_assessment == 'Unfit')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Unfit to drive</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="2" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                        </td>
                        <td colspan="18" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->exam_assessment_remarks == 'Permanent')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Permanent</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="2" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                        </td>
                        <td colspan="8" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->exam_assessment_remarks == 'Temporary')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block;">Temporary</div>
                            </div>
                        </td>
                        <td colspan="1" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                <div style="font-size:11px; display:inline-block;">Duration</div>
                            </div>
                        </td>
                        <td colspan="8" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative;">
                                @if ($item->exam_assessment_remarks == 'Temporary')
                                {{$item->exam_duration_remarks}}
                                @else
                                &nbsp
                                @endif
                           
                            </div>
                       </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="2" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                        </td>
                        <td colspan="18" style="vertical-align:middle; text-align:left; color:black; padding-top: 5px;"> 
                            <div style="display: flex;">
                                @if ($item->exam_assessment_remarks == 'Refer')
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:11px; display:inline-block; position: relative; bottom: 2px">Refer to Specialist for further Evaluation</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 3px;">&nbsp</th>
                    </tr>
    
                    <tr style="width:100%">
                        <th colspan="20" style="border:1px solid black; text-align:center; width:90%; padding:1px 8px;">
                            <b style="font-size: 12px; font-weight:bold; color:black;">CONDITIONS</b>  
                        </th>
                    </tr>
            
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 18px 0px 0px 0px;"> 
                            <div style="display: flex;">
                                @if (str_contains($item->exam_conditions, '0') == TRUE)
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:10px; display:inline-block; position: relative; bottom: 2px;">None</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 5px 0px 0px 0px"> 
                            <div style="display: flex;">
                                @if (str_contains($item->exam_conditions, '1') == TRUE)
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:10px; display:inline-block; position: relative; bottom: 2px;">Wear Corrective Lenses</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="2" style="vertical-align:top; text-align:left; color:black; padding: 0px;">
                            @if (str_contains($item->exam_conditions, '2') == TRUE)
                            <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                            @else
                            <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                            @endif
                        </td>
                        <td colspan="18" style="vertical-align:middle; text-align:left; color:black; padding: 5px 0px 0px 0px">
                            <div style="font-size:10px; display:flex; position: relative; bottom: 2px; padding: 0px;">Drive only with special equipment for Upper limbs/Lower Limbs</div>
                        </td>
                    </tr>

                    <tr style="width:100%;">
                        <td colspan="2" style="vertical-align:top; text-align:left; color:black; padding: 0px;">
                            @if (str_contains($item->exam_conditions, '3') == TRUE)
                            <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                            @else
                            <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                            @endif
                        </td>
                        <td colspan="18" style="vertical-align:middle; text-align:left; color:black; padding: 5px 0px 0px 0px">
                            <div style="font-size:10px; display:flex; position: relative; bottom: 2px; padding: 0px;font-size:10px;">Drive Customized Motor Vehicle Only</div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 5px 0px 0px 0px"> 
                            <div style="display: flex;">
                                @if (str_contains($item->exam_conditions, '4') == TRUE)
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:10px; display:inline-block; position: relative; bottom: 2px;">Daylight Driving Only</div>
                            </div>
                        </td>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align:middle; text-align:left; color:black; padding: 5px 0px 0px 0px"> 
                            <div style="display: flex;">
                                @if (str_contains($item->exam_conditions, '5') == TRUE)
                                <img src="{{asset('images/checked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @else
                                <img src="{{asset('images/unchecked-checkbox.png')}}" alt="checkbox_icon" style="position: relative; top: 2px; width:auto; height: 20px;"/>
                                @endif
                                <div style="font-size:10px; display:inline-block; position: relative; bottom: 2px;">Hearing Aid is Required</div>
                            </div>
                        </td>
                    </tr>
            
                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 4px;">&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 4px;">&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="20" style="width: 100%; padding-top: 3px;">&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="20" style="width: 100%;">&nbsp;</th>
                    </tr>
                    
                </table>
                <table style="width: 100%; margin:0px;">
                    <tr style="width:100%;">
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;"></th>
                    </tr>
    
                    <tr style="width:100%;">
                        <td colspan="20" style="text-align: left; color:black; font-size:11px; font-weight:bold;">REMARKS:</td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="20" style="vertical-align: top; text-align: justify; text-justify:inter-word; color:black; font-size:9px; height: 32px;"> 
                            {{$item->pt_remarks}}
                       </td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="6" style="text-align: left; color:black; font-size:11px; font-weight:bold;">DATE ISSUED:</td>
                        <td colspan="14" style="vertical-align: middle; text-align: center; color:black; font-size:11px;"> 
                            <div style=" border-bottom: 1px solid black; position: relative; left: -2;">
                              {{$date_issue}}
                            </div>
                       </td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="20" style="text-align: left; color:black; font-size:11px; font-weight:bold;">THIS MEDICAL CERTIFICATE IS VALID UNTIL</td>
                    </tr>
                    <tr style="width:100%;">
                        <td colspan="8" style="vertical-align: bottom; text-align: center; color:black; font-size:11px; border-bottom: 1px solid black;"> 
                            {{$medical_certificate_validity_}}
                       </td>
                       <td colspan="12" style="text-align: left; color:black; font-size:11px; font-weight:bold;">(60 DAYS FROM DATE ISSUE)</td>
                    </tr>
                </table>
            </td>
        </tr>
        <div style="width: 60%; margin-right: 5px;">
            
        </div>
        
        <div style="width: 40%;">
            
        </div>
        
    </div>
        @endforeach
</body>

</html>
