@extends('layouts/contentLayoutMaster')

@section('title', 'Saved Transaction')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/previewclientinfo.css') }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('content')
<section id="registration" class="pb-1">

<!-- <div class="my-1 p-1 d-flex flex-row-reverse" id="timer_div">
  <h1 class="m-0" id="timer">{{$count}}</h1>
</div> -->

  <div class="bs-stepper horizontal-wizard-example px-1">
    <div class="bs-stepper-header hidden">

        <div class="step" data-target="#applicant_info">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">1</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Applicant Info</span>
              {{-- <span class="bs-stepper-subtitle">Setup Account Details</span> --}}
            </span>
          </button>
        </div>          
        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>

        <div class="step" data-target="#physical_exam">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">2</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Physical Exam</span>
              {{-- <span class="bs-stepper-subtitle">Add Social Links</span> --}}
            </span>
          </button>
        </div>
        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>

        <div class="step" data-target="#visual_hearing_exam">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">3</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Visual & Hearing Test</span>
              {{-- <span class="bs-stepper-subtitle">Add Social Links</span> --}}
            </span>
          </button>
        </div>

        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
        <div class="step" data-target="#metabolic_neurological_exam">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">4</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">METABOLIC AND NEUROLOGICAL DISORDERS</span>
              {{-- <span class="bs-stepper-subtitle">Add Social Links</span> --}}
            </span>
          </button>
        </div>

        <!-- <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
        <div class="step" data-target="#health_history">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">5</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">COMPLETE HEALTH HISTORY</span>
              {{-- <span class="bs-stepper-subtitle">Add Social Links</span> --}}
            </span>
          </button>
        </div> -->

        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
        <div class="step" data-target="#assessment_condition">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">6</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">ASSESSMENT AND CONDITIONS</span>
              {{-- <span class="bs-stepper-subtitle">Add Social Links</span> --}}
            </span>
          </button>
        </div>

        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>    
        <div class="step" data-target="#preview">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">7</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Preview</span>
              {{-- <span class="bs-stepper-subtitle">Add Social Links</span> --}}
            </span>
          </button>
        </div>

    </div>
   
    <input type="hidden" name="user_id" id="user_id" value="{{Session('LoggedUser')->user_id}}">
    <input type="hidden" name="clinic_id" id="clinic_id" value="{{Session('data_clinic')->clinic_id}}">
    <input type="hidden" name="data_test_physical_completed" id="data_test_physical_completed" value="{{$test_physical_completed}}">
    <input type="hidden" name="data_test_visual_actuity_completed" id="data_test_visual_actuity_completed" value="{{$test_visual_actuity_completed}}">
    <input type="hidden" name="data_test_hearing_auditory_completed" id="data_test_hearing_auditory_completed" value="{{$test_hearing_auditory_completed}}">
    <input type="hidden" name="data_test_metabolic_neurological_completed" id="data_test_metabolic_neurological_completed" value="{{$test_metabolic_neurological_completed}}">
    <input type="hidden" name="data_test_health_history_completed" id="data_test_health_history_completed" value="{{$test_health_history_completed}}">
    <input type="hidden" name="data_is_final" id="data_is_final" value="{{$is_final}}">
    <input type="hidden" name="data_is_ltms_uploaded" id="data_is_ltms_uploaded" value="{{$is_ltms_uploaded}}">
    

    <div class="bs-stepper-content">

      <div class="progress m-2" style="height: 40px;">
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="progressbar" role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">1% Progress</div>
      </div>


        <div id="applicant_info" class="content">

          <form class="form form-vertical" id="saveTransForm" method="POST" action="">
            @csrf
            <input type="hidden" name="trans_no" id="trans_no" value="{{$trans_no}}">
            <div class="row mb-25">
              <div class="content-header col-12">
                <h3 class="my-1">Applicant Information</h3>
              </div>
              <div class="col-12 col-md-2">
                  <div class="embed-responsive-1by1">
                    <img
                      src="{{asset('images/default.png')}}"
                      id="picture_1"
                      class="bg-secondary"
                      alt="default.png"
                      height="100%"
                      width="100%"
                    />
                  </div>
                  <label id="select" class="btn btn-primary my-25 w-100" data-toggle="modal" data-target="#camera">Open Camera</label>
                    {{-- <input type="file" name="file" id="file" hidden accept="image/png, image/jpeg, image/jpg" /> --}}
                  {{-- <button id="reset" type="reset" class="btn btn-outline-secondary col-12 mb-2">Reset</button> --}}
                  <input id="base_64" type="hidden" name="base_64" id="base_64" value=""/>
              </div>
            </div>
            <div class="row">

              
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="firstname">First name</label>
                  <input
                    type="text"
                    id="firstname"
                    class="form-control"
                    name="firstname"
                    placeholder="First name"
                  />
                </div>
              </div>

              
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="middlename">Middle Name</label>
                  <input
                    type="text"
                    id="middlename"
                    class="form-control"
                    name="middlename"
                    placeholder="Middle name"
                  />
                </div>
              </div>

              
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input
                    type="text"
                    id="lastname"
                    class="form-control"
                    name="lastname"
                    placeholder="Last name"
                  />
                </div>
              </div>

              <div class="col-12 col-md-10">
                <div class="form-group">
                  <label for="address">Address</label>
                  <input
                    type="text"
                    id="address"
                    class="form-control"
                    name="address"
                    placeholder="Address"
                  />
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label class="form-label" for="birthday">Birthday</label>
                  <input
                    type="date"
                    class="form-control flatpickr-basic"
                    id="birthday"
                    placeholder="YYYY-MM-DD"
                    name="birthday"
                    aria-describedby="birthday"
                    value=""
                  />
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="age">Age</label>
                  <input
                    type="number"
                    id="age"
                    class="form-control"
                    name="age"
                    placeholder="Age"
                    readonly
                  />
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="nationality">Nationality</label>
                  <select name="nationality" id="nationality" class="select2 form-contol hide-search">
                    <option selected disabled>Select Nationality</option>
                    <option value="AFG">Afghan(Afghanistan)</option>
                    <option value="ALB">Albanian(Albania)</option>
                    <option value="DZA">Algerian(Algeria)</option>
                    <option value="ASM">American(American Samoa)</option>
                    <option value="USA">American(United States of America)</option>
                    <option value="AND">Andorran(Andorra)</option>
                    <option value="AGO">Angolan(Angola)</option>
                    <option value="AIA">Anguillan(Anguilla)</option>
                    <option value="ARG">Argentine(Argentina)</option>
                    <option value="ARM">Armenian(Armenia)</option>
                    <option value="ABW">Aruban(Aruba)</option>
                    <option value="AUS">Australian(Australia)</option>
                    <option value="AUT">Austrian(Austria)</option>
                    <option value="AZE">Azerbaijani(Azerbaijan)</option>
                    <option value="BHS">Bahamian(Bahamas)</option>
                    <option value="BHR">Bahraini(Bahrain)</option>
                    <option value="BGD">Bangladeshi(Bangladesh)</option>
                    <option value="BRB">Barbadian(Barbados)</option>
                    <option value="BLR">Belarusian(Belarus)</option>
                    <option value="BEL">Belgian(Belgium)</option>
                    <option value="BLZ">Belizean(Belize)</option>
                    <option value="BEN">Beninese(Benin)</option>
                    <option value="BMU">Bermudian(Bermuda)</option>
                    <option value="BTN">Bhutanese(Bhutan)</option>
                    <option value="BOL">Bolivian(Bolivia)</option>
                    <option value="BWA">Botswanan(Botswana)</option>
                    <option value="BRA">Brazilian(Brazil)</option>
                    <option value="VGB">British Virgin Islander(British Virgin Islands)</option>
                    <option value="GBR">British(United Kingdom of Great Britain and Northern Ireland)</option>
                    <option value="BRN">Bruneian(Brunei Darussalam)</option>
                    <option value="BGR">Bulgarian(Bulgaria)</option>
                    <option value="BFA">Burkinan(Burkina Faso)</option>
                    <option value="BDI">Burundian(Burundi)</option>
                    <option value="KHM">Cambodian(Cambodia)</option>
                    <option value="CMR">Cameroonian(Cameroon)</option>
                    <option value="CAN">Canadian(Canada)</option>
                    <option value="CPV">Cape Verdean(Cape Verde)</option>
                    <option value="CYM">Cayman Islander(Cayman Islands)</option>
                    <option value="CAF">Central African(Central African Republic)</option>
                    <option value="TCD">Chadian(Chad)</option>
                    <option value="GGY">Channel Islander(Guernsey)</option>
                    <option value="JEY">Channel Islander(Jersey)</option>
                    <option value="CHL">Chilean(Chile)</option>
                    <option value="CHN">Chinese(China)</option>
                    <option value="CXR">Christmas Islander(Christmas Island)</option>
                    <option value="ATG">Citizen of Antigua and Barbuda(Antigua and Barbuda)</option>
                    <option value="BIH">Citizen of Bosnia and Herzegovina(Bosnia and Herzegovina)</option>
                    <option value="GNB">Citizen of Guinea-Bissau(Guinea-Bissau)</option>
                    <option value="KIR">Citizen of Kiribati(Kiribati)</option>
                    <option value="SYC">Citizen of Seychelles(Seychelles)</option>
                    <option value="VUT">Citizen of Vanuatu(Vanuatu)</option>
                    <option value="DOM">Citizen of the Dominican Republic(Dominican Republic)</option>
                    <option value="CCK">Cocos Islander(Cocos (Keeling) Islands)</option>
                    <option value="COL">Colombian(Colombia)</option>
                    <option value="COM">Comoran(Comoros)</option>
                    <option value="COG">Congolese(Congo)</option>
                    <option value="COD">Congolese(Democratic Republic of Congo)</option>
                    <option value="COK">Cook Islander(Cook Islands)</option>
                    <option value="CRI">Costa Rican(Costa Rica)</option>
                    <option value="HRV">Croatian(Croatia)</option>
                    <option value="CUB">Cuban(Cuba)</option>
                    <option value="CUW">Curacaoan(Curaçao)</option>
                    <option value="CYP">Cypriot(Cyprus)</option>
                    <option value="CZE">Czech(Czechia)</option>
                    <option value="DNK">Danish(Denmark)</option>
                    <option value="DJI">Djiboutian(Djibouti)</option>
                    <option value="DMA">Dominican(Dominica)</option>
                    <option value="NLD">Dutch(Netherlands)</option>
                    <option value="TLS">East Timorese(East Timor)</option>
                    <option value="ECU">Ecuadorean(Ecuador)</option>
                    <option value="EGY">Egyptian(Egypt)</option>
                    <option value="ARE">Emirati(United Arab Emirates)</option>
                    <option value="GNQ">Equatorial Guinean(Equatorial Guinea)</option>
                    <option value="ERI">Eritrean(Eritrea)</option>
                    <option value="EST">Estonian(Estonia)</option>
                    <option value="ETH">Ethiopian(Ethiopia)</option>
                    <option value="FLK">Falkland Islander(Falkland Islands)</option>
                    <option value="FRO">Faroese(Faroe Islands)</option>
                    <option value="FJI">Fijian(Fiji)</option>
                    <option value="PHL">Filipino(Philippines)</option>
                    <option value="FIN">Finnish(Finland)</option>
                    <option value="ALA">Finnish(Åland Islands)</option>
                    <option value="PYF">French Polynesian(French Polynesia)</option>
                    <option value="FRA">French(France)</option>
                    <option value="SPM">French(Saint Pierre and Miquelon)</option>
                    <option value="GAB">Gabonese(Gabon)</option>
                    <option value="GMB">Gambian(Gambia)</option>
                    <option value="GEO">Georgian(Georgia)</option>
                    <option value="DEU">German(Germany)</option>
                    <option value="GHA">Ghanaian(Ghana)</option>
                    <option value="GIB">Gibraltarian(Gibraltar)</option>
                    <option value="GRC">Greek(Greece)</option>
                    <option value="GRL">Greenlandic(Greenland)</option>
                    <option value="GRD">Grenadian(Grenada)</option>
                    <option value="GUM">Guamanian(Guam)</option>
                    <option value="GTM">Guatemalan(Guatemala)</option>
                    <option value="GIN">Guinean(Guinea)</option>
                    <option value="GUY">Guyanese(Guyana)</option>
                    <option value="HTI">Haitian(Haiti)</option>
                    <option value="HND">Honduran(Honduras)</option>
                    <option value="HKG">Hong Konger(Hong Kong)</option>
                    <option value="HUN">Hungarian(Hungary)</option>
                    <option value="ISL">Icelandic(Iceland)</option>
                    <option value="IND">Indian(India)</option>
                    <option value="IDN">Indonesian(Indonesia)</option>
                    <option value="IRN">Iranian(Iran)</option>
                    <option value="IRQ">Iraqi(Iraq)</option>
                    <option value="IRL">Irish(Ireland)</option>
                    <option value="ISR">Israeli(Israel)</option>
                    <option value="ITA">Italian(Italy)</option>
                    <option value="CIV">Ivoirian(Côte d'Ivoire)</option>
                    <option value="JAM">Jamaican(Jamaica)</option>
                    <option value="JPN">Japanese(Japan)</option>
                    <option value="JOR">Jordanian(Jordan)</option>
                    <option value="KAZ">Kazakh(Kazakhstan)</option>
                    <option value="KEN">Kenyan(Kenya)</option>
                    <option value="KNA">Kittitian(Saint Kitts and Nevis)</option>
                    <option value="KOR">Korean(Korea)</option>
                    <option value="KWT">Kuwaiti(Kuwait)</option>
                    <option value="KGZ">Kyrgyz(Kyrgyzstan)</option>
                    <option value="LAO">Lao(Laos)</option>
                    <option value="LVA">Latvian(Latvia)</option>
                    <option value="LBN">Lebanese(Lebanon)</option>
                    <option value="LBR">Liberian(Liberia)</option>
                    <option value="LBY">Libyan(Libya)</option>
                    <option value="LTU">Lithuanian(Lithuania)</option>
                    <option value="LUX">Luxembourger(Luxembourg)</option>
                    <option value="MAC">Macanese(Macau)</option>
                    <option value="MKD">Macedonian(Macedonia)</option>
                    <option value="MDG">Malagasy(Madagascar)</option>
                    <option value="MWI">Malawian(Malawi)</option>
                    <option value="MYS">Malaysian(Malaysia)</option>
                    <option value="MDV">Maldivian(Maldives)</option>
                    <option value="MLI">Malian(Mali)</option>
                    <option value="MLT">Maltese(Malta)</option>
                    <option value="IMN">Manx(Isle of Man)</option>
                    <option value="MHL">Marshallese(Marshall Islands)</option>
                    <option value="MTQ">Martiniquais(Martinique)</option>
                    <option value="MRT">Mauritanian(Mauritania)</option>
                    <option value="MUS">Mauritian(Mauritius)</option>
                    <option value="MEX">Mexican(Mexico)</option>
                    <option value="FSM">Micronesian(Micronesia)</option>
                    <option value="MDA">Moldovan(Moldova)</option>
                    <option value="MNG">Mongolian(Mongolia)</option>
                    <option value="MNE">Montenegrin(Montenegro)</option>
                    <option value="MSR">Montserratian(Montserrat)</option>
                    <option value="MAR">Moroccan(Morocco)</option>
                    <option value="LSO">Mosotho(Lesotho)</option>
                    <option value="MOZ">Mozambican(Mozambique)</option>
                    <option value="NAM">Namibian(Namibia)</option>
                    <option value="NRU">Nauruan(Nauru)</option>
                    <option value="NPL">Nepalese(Nepal)</option>
                    <option value="NCL">New Caledonian(New Caledonia)</option>
                    <option value="NZL">New Zealander(New Zealand)</option>
                    <option value="NIC">Nicaraguan(Nicaragua)</option>
                    <option value="NGA">Nigerian(Nigeria)</option>
                    <option value="NER">Nigerien(Niger)</option>
                    <option value="NIU">Niuean(Niue)</option>
                    <option value="NFK">Norfolk Islander(Norfolk Island)</option>
                    <option value="PRK">North Korean(North Korea)</option>
                    <option value="NOR">Norwegian(Norway)</option>
                    <option value="OMN">Omani(Oman)</option>
                    <option value="PAK">Pakistani(Pakistan)</option>
                    <option value="PLW">Palauan(Palau)</option>
                    <option value="PSE">Palestinian(Palestine)</option>
                    <option value="PAN">Panamanian(Panama)</option>
                    <option value="PNG">Papua New Guinean(Papua New Guinea)</option>
                    <option value="PRY">Paraguayan(Paraguay)</option>
                    <option value="PER">Peruvian(Peru)</option>
                    <option value="POL">Polish(Poland)</option>
                    <option value="PRT">Portuguese(Portugal)</option>
                    <option value="PRI">Puerto Rican(Puerto Rico)</option>
                    <option value="QAT">Qatari(Qatar)</option>
                    <option value="ROU">Romanian(Romania)</option>
                    <option value="RUS">Russian(Russia)</option>
                    <option value="RWA">Rwandan(Rwanda)</option>
                    <option value="ESH">Sahrawi(Western Sahara)</option>
                    <option value="SHN">Saint Helenian(Saint Helena)</option>
                    <option value="LCA">Saint Lucian(Saint Lucia)</option>
                    <option value="SLV">Salvadorean(El Salvador)</option>
                    <option value="WSM">Samoan(Samoa)</option>
                    <option value="STP">Sao Tomean(Sao Tome and Principe)</option>
                    <option value="SAU">Saudi Arabian(Saudi Arabia)</option>
                    <option value="SEN">Senegalese(Senegal)</option>
                    <option value="SRB">Serbian(Serbia)</option>
                    <option value="SLE">Sierra Leonean(Sierra Leone)</option>
                    <option value="SGP">Singaporean(Singapore)</option>
                    <option value="SVK">Slovak(Slovakia)</option>
                    <option value="SVN">Slovenian(Slovenia)</option>
                    <option value="SLB">Solomon Islander(Solomon Islands)</option>
                    <option value="SOM">Somali(Somalia)</option>
                    <option value="ZAF">South African(South Africa)</option>
                    <option value="SSD">South Sudanese(South Sudan)</option>
                    <option value="ESP">Spanish(Spain)</option>
                    <option value="LKA">Sri Lankan(Sri Lanka)</option>
                    <option value="SDN">Sudanese(Sudan)</option>
                    <option value="SUR">Surinamese(Suriname)</option>
                    <option value="SWZ">Swazi(Swaziland)</option>
                    <option value="SWE">Swedish(Sweden)</option>
                    <option value="CHE">Swiss(Switzerland)</option>
                    <option value="SYR">Syrian(Syria)</option>
                    <option value="TWN">Taiwanese(Taiwan)</option>
                    <option value="TJK">Tajik(Tajikistan)</option>
                    <option value="TZA">Tanzanian(Tanzania)</option>
                    <option value="THA">Thai(Thailand)</option>
                    <option value="TGO">Togolese(Togo)</option>
                    <option value="TON">Tongan(Tonga)</option>
                    <option value="TTO">Trinidadian(Trinidad and Tobago)</option>
                    <option value="TUN">Tunisian(Tunisia)</option>
                    <option value="TUR">Turkish(Turkey)</option>
                    <option value="TKM">Turkmen(Turkmenistan)</option>
                    <option value="TCA">Turks and Caicos Islander(Turks and Caicos Islands)</option>
                    <option value="TUV">Tuvaluan(Tuvalu)</option>
                    <option value="UGA">Ugandan(Uganda)</option>
                    <option value="UKR">Ukrainian(Ukraine)</option>
                    <option value="URY">Uruguayan(Uruguay)</option>
                    <option value="UZB">Uzbek(Uzbekistan)</option>
                    <option value="VEN">Venezuelan(Venezuela)</option>
                    <option value="VNM">Vietnamese(Vietnam)</option>
                    <option value="VCT">Vincentian(Saint Vincent and the Grenadines)</option>
                    <option value="VIR">Virgin Islander(Virgin Islands (U.S.))</option>
                    <option value="WLF">Wallisian(Wallis and Futuna)</option>
                    <option value="YEM">Yemeni(Yemen)</option>
                    <option value="ZMB">Zambian(Zambia)</option>
                    <option value="ZWE">Zimbabwean(Zimbabwe)</option>
                  </select>
                </div>
              </div>

              <div class="col-12 col-md-2">
                <div class="form-group">
                  <label for="gender">Gender</label>
                  <select name="gender" id="gender" class="select2 form-contol hide-search">
                    <option selected disabled>Select Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
                </div>
              </div> 

              <div class="col-12 col-md-2">
                <div class="form-group">
                  <label for="civilstatus">Civil Status</label>
                  <select name="civilstatus" id="civilstatus" class="select2 form-contol hide-search">
                    <option selected disabled>Select Civil Status</option>
                    <option value="M">Married</option>
                    <option value="P">Separated</option>
                    <option value="S">Single</option>
                    <option value="W">Widower</option>
                  </select>
                </div>
              </div> 

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="occupation">Occupation</label>
                  <input
                    type="text"
                    id="occupation"
                    class="form-control"
                    name="occupation"
                    placeholder="Occupation"
                  />
                </div>
              </div>  

              <!-- <div class="col-12 col-md-2">
                <div class="form-group">
                  <label for="licenseType">License Type</label>
                  <select name="licenseType" id="licenseType" class="select2 form-contol hide-search">
                    <option selected disabled>Select License Type</option>
                    <option value="Student-Driver's Permit">Student-Driver's Permit</option>
                    <option value="Nonprofessional">Nonprofessional</option>
                    <option value="Professional">Professional</option>
                    <option value="Conductor's Licence">Conductor's Licence</option>
                  </select>
                </div>
              </div> 

              <div class="col-12 col-md-2">
                <div class="form-group">
                  <label for="newRenewal">New or Renewal</label>
                  <select name="newRenewal" id="newRenewal" class="select2 form-contol hide-search">
                    <option selected disabled>New or Renewal</option>
                    <option value="Renewal">Renewal</option>
                    <option value="New">New</option>
                  </select>
                </div>
              </div>  -->
              
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="purpose">Purpose</label>
                  <select name="purpose" id="purpose" class="select2 form-contol hide-search">
                    <option selected value="0" disabled>Select Purpose</option>
                    @foreach ($purpose as $item)
                    <option value="{{$item->purpose_code}}">{{$item->purpose_description}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="license_no">License No.</label>
                  <input
                    type="text"
                    id="license_no"
                    class="form-control"
                    name="license_no"
                    placeholder="License No."
                  />
                </div>
              </div> 

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="lto_client_id">LTO client ID</label>
                  <input
                    type="text"
                    id="lto_client_id"
                    class="form-control"
                    name="lto_client_id"
                    placeholder="LTO client ID"
                  />
                </div>
              </div> 

            </div>

              
          </form>
          <div class="col-12 mt-1">
            <button class="mr-1 btn btn-outline-secondary btn-prev" disabled>
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary float-right" id="next_1">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-success float-right" id="save_1">
              <span class="align-middle d-sm-inline-block d-none">Save</span>
              <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-danger float-right" id="cancel_1">
              <span class="align-middle d-sm-inline-block d-none">Cancel</span>
              <i data-feather="x" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>

        <div id="physical_exam" class="content">

          <form class="form form-vertical" id="save_physical_trans_form" method="POST" action="">
            @csrf
            <input type="hidden" name="trans_no" id="trans_no" value="{{$trans_no}}">
            <div class="row mb-25">
              <div class="content-header col-12">
                <h3 class="my-1">Physical Exam</h3>
              </div>
              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="height">Height(CENTIMETERS)</label>
                  <input
                    type="text"
                    id="height"
                    class="form-control"
                    name="height"
                    placeholder="Height"
                  />
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="weight">Weight(KILOGRAMS)</label>
                  <input
                    type="text"
                    id="weight"
                    class="form-control"
                    name="weight"
                    placeholder="Weight"
                  />
                </div>
              </div>
                    
              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="bmi">Body Mass Index (BMI)</label>
                  <input
                    type="text"
                    id="bmi"
                    class="form-control"
                    name="bmi"
                    placeholder="BMI"
                  />
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">

                  <label for="blood_pressure">Blood Pressure(mmHg)</label>
                  <div class="row">

                    <div class="col-6">
                    <input
                    type="text"
                    id="mm"
                    class="form-control"
                    name="mm"
                    placeholder="mm"
                  />             
                    </div>

                    <div class="col-6">
                    <input
                    type="text"
                    id="hg"
                    class="form-control"
                    name="hg"
                    placeholder="Hg"
                  />
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">             
                  <div class="row">

                    <div class="col-6">
                      <label for="body_temperature">Body Temperature</label>
                      <input
                        type="text"
                        id="body_temperature"
                        class="form-control"
                        name="body_temperature"
                        placeholder="Body Temperature"
                      />
                    </div>

                    <div class="col-6">
                      <label for="scale_temperature">Scale of Temperature</label>
                      <input
                        type="text"
                        id="scale_temperature"
                        class="form-control"
                        name="scale_temperature"
                        value="celcius(°C)"
                      />
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="pulse_rate">Pulse rate</label>
                  <input
                    type="text"
                    id="pulse_rate"
                    class="form-control"
                    name="pulse_rate"
                    placeholder="Pulse rate"
                  />
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="respiratory_rate">Respiratory rate</label>
                  <input
                    type="text"
                    id="respiratory_rate"
                    class="form-control"
                    name="respiratory_rate"
                    placeholder="Respiratory rate"
                  />
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <div class="select">
                    <label for="blood_type" class="form-label">Blood Type</label>
                    <select name="blood_type" id="blood_type" class="select2 form-control hide-search">
                      <option selected disabled>Select Blood Type</option>
                      @foreach ($blood_type as $item)
                      <option value="{{$item->blood_type}}">{{$item->blood_type}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-md-3">
                <div class="form-group">
                  <div class="select">
                    <label for="upper_extremities_left">Upper Extremities Left</label>
                    <select name="upper_extremities_left" id="upper_extremities_left" class="select2 form-control hide-search">
                      <option selected disabled>Select-</option>
                      <option value="1">normal</option>
                      <option value="2">With disability</option>
                      <option value="3">With special equipment</option>
                    </select>
                  </div>
                </div>
              </div> 

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <div class="select">
                    <label for="upper_extremities_right">Upper Extremities Right</label>
                    <select name="upper_extremities_right" id="upper_extremities_right" class="select2 form-control hide-search">
                      <option selected disabled>Select-</option>
                      <option value="1">normal</option>
                      <option value="2">With disability</option>
                      <option value="3">With special equipment</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-3">
                <div class="form-group">
                  <div class="select">
                    <label for="lower_extremities_left">Lower Extremities Left</label>
                    <select name="lower_extremities_left" id="lower_extremities_left" class="select2 form-control hide-search">
                      <option selected disabled>Select-</option>
                      <option value="1">normal</option>
                      <option value="2">With disability</option>
                      <option value="3">With special equipment</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-3 ">
                <div class="form-group">
                  <div class="select">
                    <label for="lower_extremities_right">Lower Extremities Right</label>
                    <select name="lower_extremities_right" id="lower_extremities_right" class="select2 form-control hide-search">
                      <option selected disabled>Select-</option>
                      <option value="1">normal</option>
                      <option value="2">With disability</option>
                      <option value="3">With special equipment</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="disability">General Physique</label>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="disability1" name="disability" class="custom-control-input" value="normal"/>
                      <label class="custom-control-label" for="disability1">Normal</label>
                    </div>

                    <div class="custom-control custom-radio">
                      <input type="radio" id="disability2" name="disability" class="custom-control-input" value="WithDisability"/>
                      <label class="custom-control-label mb-1" for="disability2">With Disability, Pls Specify</label>
                      <input
                      type="text"
                      id="txtdisability"
                      class="form-control hidden"
                      name="txtdisability"
                      placeholder="Specify Disability"/>
                    </div>
                  </div>
                </div> 
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="disease">Contagious Disease</label>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="disease1" name="disease" class="custom-control-input" value="none"/>
                      <label class="custom-control-label" for="disease1">None</label>
                    </div>

                    <div class="custom-control custom-radio">
                      <input type="radio" id="disease2" name="disease" class="custom-control-input" value="with_disease"/>
                      <label class="custom-control-label mb-1" for="disease2">With Disease, Pls Specify</label>
                      <input
                      type="text"
                      id="txtdisease"
                      class="form-control hidden"
                      name="txtdisease"
                      placeholder="Specify Disease"/>
                    </div>
                 </div>
                </div> 
              </div>

            </div>
            
        
          </form>
          <div class="col-12 mt-1">
            <button class="mr-1 btn btn-outline-secondary btn-prev" >
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary float-right" id="next_2">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-success float-right" id="save_2">
              <span class="align-middle d-sm-inline-block d-none">Save</span>
              <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-danger float-right" id="cancel_2">
              <span class="align-middle d-sm-inline-block d-none">Cancel</span>
              <i data-feather="x" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>

        <div id="visual_hearing_exam" class="content">

        <div class="col-12 m-0 p-0">
          <button type="button" class="btn btn-sm btn-primary mr-25 ishihara d-inline">
            <i data-feather="eye" class="mr-25"></i>Take Ishihara Test
          </button>
          <h4 class ="d-inline p-0 m-0" id="color_blind_result">Result:</h4>
        </div>

          <form class="form form-vertical" id="save_visual_hearing_trans_form" method="POST" action="">
            @csrf
            <input type="hidden" name="trans_no" id="trans_no" value="{{$trans_no}}">
              <div class="row mb-25">
                <div class="content-header col-12">
                  <h3 class="my-1">Visual Test</h3>
                </div>

                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <div class="select">
                      <label for="eye_color" class="form-label">Eye Color</label>
                      <select name="eye_color" id="eye_color" class="select2 form-control hide-search">
                        <option selected disabled>Select Eye Color</option>
                        <option value="1">Black</option>
                        <option value="2">Brown</option>
                        <option value="3">Other</option>
                        <option value="4">Blue</option>
                      </select>
                    </div>
                  </div>
                </div> 
                          
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="snellen_bailey_lovie_left">Left Eye: Snellen/Bailey-Lovie</label>
                    <input
                      type="text"
                      id="snellen_bailey_lovie_left"
                      class="form-control"
                      name="snellen_bailey_lovie_left"
                      placeholder="Left Eye: Snellen/Bailey-Lovie"
                    />
                  </div>
                </div>
              
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="snellen_bailey_lovie_right">Right Eye: Snellen/Bailey-Lovie</label>
                    <input
                      type="text"
                      id="snellen_bailey_lovie_right"
                      class="form-control"
                      name="snellen_bailey_lovie_right"
                      placeholder="Right Eye: Snellen/Bailey-Lovie"
                    />
                  </div>
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="disease">With Corrective Lens Left:</label>
                    <div class="select">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="corrective_lens_left1" name="corrective_lens_left" class="custom-control-input" value="1"/>
                        <label class="custom-control-label" for="corrective_lens_left1">Yes</label>
                      </div>

                      <div class="custom-control custom-radio">
                        <input type="radio" id="corrective_lens_left2" name="corrective_lens_left" class="custom-control-input" value="0"/>
                        <label class="custom-control-label mb-1" for="corrective_lens_left2">No</label>
                      </div>
                  </div>
                  </div> 
                </div>
              
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="corrective_lens_right">With Corrective Lens Right:</label>
                    <div class="select">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="corrective_lens_right1" name="corrective_lens_right" class="custom-control-input" value="1"/>
                        <label class="custom-control-label" for="corrective_lens_right1">Yes</label>
                      </div>

                      <div class="custom-control custom-radio">
                        <input type="radio" id="corrective_lens_right2" name="corrective_lens_right" class="custom-control-input" value="0"/>
                        <label class="custom-control-label mb-1" for="corrective_lens_right2">No</label>
                      </div>
                  </div>
                  </div> 
                </div>
             
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="color_blind_left">Color Blind Left:</label>
                    <div class="select">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="color_blind_left1" name="color_blind_left" class="custom-control-input" value="1"/>
                        <label class="custom-control-label" for="color_blind_left1">Yes</label>
                      </div>

                      <div class="custom-control custom-radio">
                        <input type="radio" id="color_blind_left2" name="color_blind_left" class="custom-control-input" value="0"/>
                        <label class="custom-control-label mb-1" for="color_blind_left2">No</label>
                      </div>
                  </div>
                  </div> 
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="color_blind_right">Color Blind Right:</label>
                    <div class="select">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="color_blind_right1" name="color_blind_right" class="custom-control-input" value="1"/>
                        <label class="custom-control-label" for="color_blind_right1">Yes</label>
                      </div>

                      <div class="custom-control custom-radio">
                        <input type="radio" id="color_blind_right2" name="color_blind_right" class="custom-control-input" value="0"/>
                        <label class="custom-control-label mb-1" for="color_blind_right2">No</label>
                      </div>
                  </div>
                  </div> 
                </div>

                <div class="col-12 col-md-12">
                  <h5 class="mb-1">Glare/Contrast Sensitivity Function</h5>
                  <div class="row">

                    <div class="col-12 col-md-3">
                      <div class="form-group">
                        <label for="glare_contrast_sensitivity_without_lense_right">Right Eye: Without Lenses</label>
                        <input
                          type="text"
                          id="glare_contrast_sensitivity_without_lense_right"
                          class="form-control"
                          name="glare_contrast_sensitivity_without_lense_right"
                          placeholder="Right Eye "
                        />
                      </div>
                    </div>

                    <div class="col-12 col-md-3">
                      <div class="form-group">
                        <label for="glare_contrast_sensitivity_without_lense_left">Left Eye: Without Lenses</label>
                        <input
                          type="text"
                          id="glare_contrast_sensitivity_without_lense_left"
                          class="form-control"
                          name="glare_contrast_sensitivity_without_lense_left"
                          placeholder="Left Eye"
                        />
                      </div>
                    </div>

                    <div class="col-12 col-md-3">
                      <div class="form-group">
                        <label for="glare_contrast_sensitivity_with_corrective_right">Right Eye: With Corrective or Contact Lenses</label>
                        <input
                          type="text"
                          id="glare_contrast_sensitivity_with_corrective_right"
                          class="form-control"
                          name="glare_contrast_sensitivity_with_corrective_right"
                          placeholder="Right Eye"
                        />
                      </div>
                    </div>

                    <div class="col-12 col-md-3">
                      <div class="form-group">
                        <label for="glare_contrast_sensitivity_with_corrective_left">Left Eye: With Corrective or Contact Lenses</label>
                        <input
                          type="text"
                          id="glare_contrast_sensitivity_with_corrective_left"
                          class="form-control"
                          name="glare_contrast_sensitivity_with_corrective_left"
                          placeholder="Left Eye"
                        />
                      </div>
                    </div>

                  </div>
                </div>                        

                <div class="col-12">
                  <hr>
                </div>

                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="color_blind_test">Color Blind Test:</label>
                    <input
                      type="text"
                      id="color_blind_test"
                      class="form-control"
                      name="color_blind_test"
                      placeholder="Color Blind Test"
                    />
                  </div>
                </div>

                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="eye_injury">Any Eye Injury or Disease? (Specify)</label>
                    <input
                      type="text"
                      id="eye_injury"
                      class="form-control"
                      name="eye_injury"
                      placeholder=""
                    />
                  </div>
                </div>

                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="examination_suggested">Is Further Eye Examination Suggested:</label>
                    <div class="select">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="examination_suggested1" name="examination_suggested" class="custom-control-input" value="YES"/>
                        <label class="custom-control-label" for="examination_suggested1">Yes</label>
                      </div>

                      <div class="custom-control custom-radio">
                        <input type="radio" id="examination_suggested2" name="examination_suggested" class="custom-control-input" value="NO" selected/>
                        <label class="custom-control-label mb-1" for="examination_suggested2">No</label>
                      </div>
                  </div>
                  </div> 
                </div>

                <div class="content-header col-12">
                    <h3 class="my-1">Auditory Test</h3>
                </div>

                <div class="col-12 mb-1">
                  <button type="button" class="btn btn-sm btn-primary mr-25 hearing d-inline">
                  <i data-feather="headphones" class="mr-25"></i>Take Hearing Test
                  </button>
                  <h4 class ="d-inline p-0 m-0" id="hearing_result">Hearing Test Result:</h4>
                </div>

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <div class="select">
                      <label for="hearing_left" class="form-label">Left Ear Hearing</label>
                      <select name="hearing_left" id="hearing_left" class="select2 form-control hide-search">
                        <option selected disabled>Select-</option>
                        <option value="1">Normal</option>
                        <option value="2">Reduced</option>
                        <option value="3">With Hearing Aid</option>
                      </select>
                    </div>
                  </div>
                </div> 

                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <div class="select">
                      <label for="hearing_right" class="form-label">Left Ear Hearing</label>
                      <select name="hearing_right" id="hearing_right" class="select2 form-control hide-search">
                        <option selected disabled>Select-</option>
                        <option value="1">Normal</option>
                        <option value="2">Reduced</option>
                        <option value="3">With Hearing Aid</option>
                      </select>
                    </div>
                  </div>
                </div> 
                

            </div>
      
          </form>
          <div class="col-12 mt-1">
            <button class="mr-1 btn btn-outline-secondary btn-prev" >
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary float-right" id="next_3">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-success float-right" id="save_3">
              <span class="align-middle d-sm-inline-block d-none">Save</span>
              <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-danger float-right" id="cancel_3">
              <span class="align-middle d-sm-inline-block d-none">Cancel</span>
              <i data-feather="x" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>

        <div id="metabolic_neurological_exam" class="content">

          <form class="form form-vertical" id="save_metabolic_neurological_exam_form" method="POST" action="">
            @csrf
            <input type="hidden" name="trans_no" id="trans_no" value="{{$trans_no}}">
            <div class="row mb-25">
              <div class="content-header col-12">
                <h3 class="my-1">Metabolic and Neurological Disorders Test</h3>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="epilepsy">Epilepsy:</label>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="epilepsy1" name="epilepsy" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="epilepsy1">Yes</label>
                    </div>

                    <div class="custom-control custom-radio">
                      <input type="radio" id="epilepsy2" name="epilepsy" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="epilepsy2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                  <div id="div_epilepsy_treatment" class="hidden">
                    <div class="form-group">
                      <label for="epilepsy_treatment">Epilepsy Treatment:</label>
                      <div class="select">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="epilepsy_treatment1" name="epilepsy_treatment" class="custom-control-input" value="1"/>
                          <label class="custom-control-label" for="epilepsy_treatment1">Yes, Pls Specify</label>
                          <input
                          type="text"
                          id="txt_epilepsy_treatment"
                          class="form-control"
                          name="txt_epilepsy_treatment"
                          placeholder="..."/>
                        </div>
      
                        <div class="custom-control custom-radio">
                          <input type="radio" id="epilepsy_treatment2" name="epilepsy_treatment" class="custom-control-input" value="0"/>
                          <label class="custom-control-label mb-1" for="epilepsy_treatment2">No</label>
                        </div>
                    </div>
                    </div>
                  </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                <div id="div_last_seizure" class="hidden">
                  <label for="last_seizure">Last Seizure(Indicate Date)</label>
                  <input
                    type="text"
                    id="last_seizure"
                    class="form-control"
                    name="last_seizure"
                    placeholder="last_seizure"
                  />
                </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="diabetes">Diabetes:</label>
                  <div class="select">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="diabetes1" name="diabetes" class="custom-control-input" value="1"/>
                        <label class="custom-control-label" for="diabetes1">Yes</label>
                      </div>

                      <div class="custom-control custom-radio">
                        <input type="radio" id="diabetes2" name="diabetes" class="custom-control-input" value="0"/>
                        <label class="custom-control-label mb-1" for="diabetes2">No</label>
                      </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <div class="hidden" id="div_diabetes_treatment">
                    <label for="diabetes_treatment">Diabetes Treatment:</label>
                      <div class="select">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="diabetes_treatment1" name="diabetes_treatment" class="custom-control-input" value="1"/>
                          <label class="custom-control-label" for="diabetes_treatment1">Yes, Pls Specify</label>
                          <input
                          type="text"
                          id="txt_diabetes_treatment"
                          class="form-control"
                          name="txt_diabetes_treatment"
                          placeholder="..."/>
                        </div>
      
                        <div class="custom-control custom-radio">
                          <input type="radio" id="diabetes_treatment2" name="diabetes_treatment" class="custom-control-input" value="0"/>
                          <label class="custom-control-label mb-1" for="diabetes_treatment2">No</label>
                        </div>
                  </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="sleepapnea">Sleep Apnea:</label>
                      <div class="select">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="sleepapnea1" name="sleepapnea" class="custom-control-input" value="1"/>
                          <label class="custom-control-label" for="sleepapnea1">Yes</label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" id="sleepapnea2" name="sleepapnea" class="custom-control-input" value="0"/>
                          <label class="custom-control-label mb-1" for="sleepapnea2">No</label>
                        </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <div class="hidden" id="div_sleepapnea_treatment">
                    <label for="epilepsy_treatment">Sleep Apnea Treatment:</label>
                      <div class="select">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="sleepapnea_treatment1" name="sleepapnea_treatment" class="custom-control-input" value="1"/>
                          <label class="custom-control-label" for="sleepapnea_treatment1">Yes, Pls Specify</label>
                          <input
                          type="text"
                          id="txt_sleepapnea_treatment"
                          class="form-control"
                          name="txt_sleepapnea_treatment"
                          placeholder="..."/>
                        </div>
      
                        <div class="custom-control custom-radio">
                          <input type="radio" id="sleepapnea_treatment2" name="sleepapnea_treatment" class="custom-control-input" value="0"/>
                          <label class="custom-control-label mb-1" for="sleepapnea_treatment2">No</label>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="mental">Aggressive, Manic or Depressive Order:</label>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="mental1" name="mental" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="mental1">Yes</label>
                    </div>

                    <div class="custom-control custom-radio">
                      <input type="radio" id="mental2" name="mental" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="mental2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                    <div class="hidden" id="div_mental_treatment">
                      <label for="mental_treatment">Mental Treatment:</label>
                      <div class="select">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="mental_treatment1" name="mental_treatment" class="custom-control-input" value="1"/>
                          <label class="custom-control-label" for="mental_treatment1">Yes, Pls Specify</label>
                          <input
                          type="text"
                          id="txt_mental_treatment"
                          class="form-control"
                          name="txt_mental_treatment"
                          placeholder="..."/>
                        </div>
      
                        <div class="custom-control custom-radio">
                          <input type="radio" id="mental_treatment2" name="mental_treatment" class="custom-control-input" value="0"/>
                          <label class="custom-control-label mb-1" for="mental_treatment2">No</label>
                        </div>
                    </div>
                    </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="other">Other Medical condition:</label>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="other1" name="other" class="custom-control-input" value="1"/>
                    <label class="custom-control-label mb-1" for="other1">Yes, Pls Specify:</label>
                    <input
                      type="text"
                      id="other_medical_condition"
                      class="form-control hidden"
                      name="other_medical_condition"
                      placeholder="Specify other condition"/>
                  </div>

                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="other2" name="other" class="custom-control-input" value="0"/>
                      <label class="custom-control-label" for="other2">Normal</label>
                    </div>

                </div>
                </div> 
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                    <div class="hidden" id="div_other_treatment">
                      <label for="other_treatment">Is it under proper treatment or medication:</label>
                      <div class="select">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="other_treatment1" name="other_treatment" class="custom-control-input" value="1"/>
                          <label class="custom-control-label" for="other_treatment1">Yes, Pls Specify</label>
                          <input
                          type="text"
                          id="txt_other_treatment"
                          class="form-control"
                          name="txt_other_treatment"
                          placeholder="..."/>
                        </div>
      
                        <div class="custom-control custom-radio">
                          <input type="radio" id="other_treatment2" name="other_treatment" class="custom-control-input" value="0"/>
                          <label class="custom-control-label mb-1" for="other_treatment2">No</label>
                        </div>
                    </div>
                    </div>
                </div>
              </div>

            </div>
      
          </form>
          <div class="col-12 mt-1">
            <button class="mr-1 btn btn-outline-secondary btn-prev" >
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary float-right" id="next_4">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-success float-right" id="save_4">
              <span class="align-middle d-sm-inline-block d-none">Save</span>
              <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-danger float-right" id="cancel_4">
              <span class="align-middle d-sm-inline-block d-none">Cancel</span>
              <i data-feather="x" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>

        <!-- <div id="health_history" class="content">  
          
          <div class="row mb-1">

            <div class="col-xl-4 col-lg-6 mb-1">
              <div class="row">
                <div class="col-1 border rounded p-0 pb-50 pt-50 bg-success text-light">
                  <p class="m-0 text-center"><i data-feather="check" class="font-large-1 m-0"></i></p>
                </div>
                <div class="col p-0 pl-1 align-self-center">
                  <h4 class="p-0 m-0">Applicant Info<i data-feather="chevron-right" class="font-medium-5 ml-2"></i></h4>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 mb-1">
              <div class="row">
                <div class="col-1 border rounded p-0 pb-50 pt-50 bg-success text-light">
                  <p class="m-0 text-center"><i data-feather="check" class="font-large-1 m-0"></i></p>
                </div>
                <div class="col p-0 pl-1 align-self-center">
                  <h4 class="p-0 m-0">Physical Exam<i data-feather="chevron-right" class="font-medium-5 ml-2"></i></h4>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 mb-1">
              <div class="row">
                <div class="col-1 border rounded p-0 pb-50 pt-50 bg-success text-light">
                  <p class="m-0 text-center"><i data-feather="check" class="font-large-1 m-0"></i></p>
                </div>
                <div class="col p-0 pl-1 align-self-center">
                  <h4 class="p-0 m-0">Visual & Hearing Test<i data-feather="chevron-right" class="font-medium-5 ml-2"></i></h4>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 mb-1">
              <div class="row">
                <div class="col-1 border rounded p-0 pb-50 pt-50 bg-success text-light">
                  <p class="m-0 text-center"><i data-feather="check" class="font-large-1 m-0"></i></p>
                </div>
                <div class="col p-0 pl-1 align-self-center">
                  <h4 class="p-0 m-0">Metabolic & Neurological Disorders<i data-feather="chevron-right" class="font-medium-5 ml-2"></i></h4>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 mb-1">
              <div class="row">
              <div class="col-1 border rounded p-0 pb-50 pt-50 bg-success text-light">
                <p class="m-0 text-center">5</p>
              </div>
              <div class="col p-0 pl-1 align-self-center">
                <h4 class="p-0 m-0">Complete Health History<i data-feather="chevron-right" class="font-medium-5 ml-2"></i></h4>
              </div>
              </div>
            </div>

            @if ($is_final == 1)       
              <div class="col-xl-4 col-lg-6 mb-1">
                <div class="row">
                  <div class="col-1 border rounded p-0 pb-50 pt-50 bg-success text-light">
                    <p class="m-0 text-center"><i data-feather="check" class="font-large-1 m-0"></i></p>
                  </div>
                  <div class="col p-0 pl-1 align-self-center">
                    <h4 class="p-0 m-0">Assessment and Condition<i data-feather="chevron-right" class="font-medium-5 ml-2"></i></h4>
                  </div>
                </div>
              </div>
            @else
              <div class="col-xl-4 col-lg-6 mb-1">
                <div class="row">
                  <div class="col-1 border rounded p-0 pb-50 pt-50 pb-1" style="background:#f4f3fe">
                    <p class="m-0 mx-auto text-center">6</p>
                  </div>
                <div class="col p-0 pl-1 align-self-center">
                  <h4 class="p-0 m-0">Assessment and Condition<i data-feather="chevron-right" class="font-medium-5 ml-2"></i></h4>
                </div>
          
                </div>
              </div>
            @endif

        
            <div class="col-xl-4 col-lg-6 mb-1">
              <div class="row">
                <div class="col-1 border rounded p-0 pb-50 pt-50 pb-1" style="background:#f4f3fe">
                  <p class="m-0 mx-auto text-center">7</p>
                </div>
              <div class="col p-0 pl-1 align-self-center">
                <h4 class="p-0 m-0">Preview</i></h4>
              </div>
        
              </div>
            </div>
        
          </div>
          
          <form class="form form-vertical" id="health_history_form" method="POST" action="">
            @csrf
            <input type="hidden" name="trans_no" id="trans_no" value="{{$trans_no}}">
            <div class="row mb-25">
              <div class="content-header col-12">
                <h3 class="my-1">Complete Health History</h3>
              </div>
      
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Head, neck, spinal injury, disorders or illnesses</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="head_neck_spinal_injury_disorders1" name="head_neck_spinal_injury_disorders" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="head_neck_spinal_injury_disorders1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="head_neck_spinal_injury_disorders_remarks"
                    class="form-control my-1 hidden"
                    name="head_neck_spinal_injury_disorders_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="head_neck_spinal_injury_disorders2" name="head_neck_spinal_injury_disorders" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="head_neck_spinal_injury_disorders2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Seizure, convulsions, or epilepsy</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="seizure_convulsions1" name="seizure_convulsions" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="seizure_convulsions1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="seizure_convulsions_remarks"
                    class="form-control my-1 hidden"
                    name="seizure_convulsions_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="seizure_convulsions2" name="seizure_convulsions" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="seizure_convulsions2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Dizziness, fainting, or frequent headaches</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="dizziness_fainting1" name="dizziness_fainting" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="dizziness_fainting1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="dizziness_fainting_remarks"
                    class="form-control my-1 hidden"
                    name="dizziness_fainting_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="dizziness_fainting2" name="dizziness_fainting" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="dizziness_fainting2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Eye problem (except corrective lenses)</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="eye_problem1" name="eye_problem" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="eye_problem1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="eye_problem_remarks"
                    class="form-control my-1 hidden"
                    name="eye_problem_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="eye_problem2" name="eye_problem" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="eye_problem2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Hearing or ear problems</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="hearing1" name="hearing" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="hearing1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="hearing_remarks"
                    class="form-control my-1 hidden"
                    name="hearing_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="hearing2" name="hearing" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="hearing2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Hypertension or other cardiovascular disease</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="hypertension1" name="hypertension" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="hypertension1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="hypertension_remarks"
                    class="form-control my-1 hidden"
                    name="hypertension_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="hypertension2" name="hypertension" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="hypertension2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Heart attack, stroke or paralysis</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="heart_attack_stroke1" name="heart_attack_stroke" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="heart_attack_stroke1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="heart_attack_stroke_remarks"
                    class="form-control my-1 hidden"
                    name="heart_attack_stroke_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="heart_attack_stroke2" name="heart_attack_stroke" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="heart_attack_stroke2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Lung disease (include tuberculosis or asthma)</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="lung_disease1" name="lung_disease" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="lung_disease1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="lung_disease_remarks"
                    class="form-control my-1 hidden"
                    name="lung_disease_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="lung_disease2" name="lung_disease" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="lung_disease2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Hyperacidity, ulcer, or digestive problems</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="hyper_acidity_ulcer1" name="hyper_acidity_ulcer" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="hyper_acidity_ulcer1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="hyper_acidity_ulcer_remarks"
                    class="form-control my-1 hidden"
                    name="hyper_acidity_ulcer_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="hyper_acidity_ulcer2" name="hyper_acidity_ulcer" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="hyper_acidity_ulcer2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Diabetis or high blood sugar</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="diabetes_1" name="diabetes_" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="diabetes_1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="diabetes_remarks_"
                    class="form-control my-1 hidden"
                    name="diabetes_remarks_"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="diabetes_2" name="diabetes_" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="diabetes_2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Kidney disease, stones, blood in urine or dialysis</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="kidney_disease_stones_blood_in_urine1" name="kidney_disease_stones_blood_in_urine" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="kidney_disease_stones_blood_in_urine1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="kidney_disease_stones_blood_in_urine_remarks"
                    class="form-control my-1 hidden"
                    name="kidney_disease_stones_blood_in_urine_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="kidney_disease_stones_blood_in_urine2" name="kidney_disease_stones_blood_in_urine" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="kidney_disease_stones_blood_in_urine2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Muscular disease</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="muscular_disease1" name="muscular_disease" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="muscular_disease1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="muscular_disease_remarks"
                    class="form-control my-1 hidden"
                    name="muscular_disease_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="muscular_disease2" name="muscular_disease" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="muscular_disease2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Sleep disorders including sleep apnea</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="sleep_disorders_sleep_apnea1" name="sleep_disorders_sleep_apnea" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="sleep_disorders_sleep_apnea1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="sleep_disorders_sleep_apnea_remarks"
                    class="form-control my-1 hidden"
                    name="sleep_disorders_sleep_apnea_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="sleep_disorders_sleep_apnea2" name="sleep_disorders_sleep_apnea" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="sleep_disorders_sleep_apnea2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Nervous or psychiatric disorder including PTSD</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="nervous_psychiatric1" name="nervous_psychiatric" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="nervous_psychiatric1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="nervous_psychiatric_remarks"
                    class="form-control my-1 hidden"
                    name="nervous_psychiatric_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="nervous_psychiatric2" name="nervous_psychiatric" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="nervous_psychiatric2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Anger management issues</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="anger_management_issues1" name="anger_management_issues" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="anger_management_issues1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="anger_management_issues_remarks"
                    class="form-control my-1 hidden"
                    name="anger_management_issues_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="anger_management_issues2" name="anger_management_issues" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="anger_management_issues2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Regular or frequent alcohol/drug use</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="regular_frequent_alcohol_drug1" name="regular_frequent_alcohol_drug" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="regular_frequent_alcohol_drug1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="regular_frequent_alcohol_drug_remarks"
                    class="form-control my-1 hidden"
                    name="regular_frequent_alcohol_drug_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="regular_frequent_alcohol_drug2" name="regular_frequent_alcohol_drug" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="regular_frequent_alcohol_drug2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Involved in a motor vehicle accident while driving</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="involved_mv_accident_while_driving1" name="involved_mv_accident_while_driving" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="involved_mv_accident_while_driving1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="involved_mv_accident_while_driving_remarks"
                    class="form-control my-1 hidden"
                    name="involved_mv_accident_while_driving_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="involved_mv_accident_while_driving2" name="involved_mv_accident_while_driving" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="involved_mv_accident_while_driving2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Any major illness, injury or operation</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="any_major_illness_injury_operation1" name="any_major_illness_injury_operation" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="any_major_illness_injury_operation1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="any_major_illness_injury_operation_remarks"
                    class="form-control my-1 hidden"
                    name="any_major_illness_injury_operation_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="any_major_illness_injury_operation2" name="any_major_illness_injury_operation" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="any_major_illness_injury_operation2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Any permanent impairment</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="any_permanent_impairment1" name="any_permanent_impairment" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="any_permanent_impairment1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="any_permanent_impairment_remarks"
                    class="form-control my-1 hidden"
                    name="any_permanent_impairment_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="any_permanent_impairment2" name="any_permanent_impairment" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="any_permanent_impairment2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Other disorders or disease</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="other_disorders1" name="other_disorders" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="other_disorders1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="other_disorders_remarks"
                    class="form-control my-1 hidden"
                    name="other_disorders_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="other_disorders2" name="other_disorders" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="other_disorders2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="content-header col-12">
                <h3 class="my-1">PRESENT CONDITION/S AND TREATMENT</h3>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <h5>Are you experiencing any adverse symtom/s that need medical attention? if yes, explain why.</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="presently_experiencing_need_medical_attention1" name="presently_experiencing_need_medical_attention" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="presently_experiencing_need_medical_attention1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="presently_experiencing_need_medical_attention_remarks"
                    class="form-control my-1 hidden"
                    name="presently_experiencing_need_medical_attention_remarks"
                    placeholder="Explain for yes answer"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="presently_experiencing_need_medical_attention2" name="presently_experiencing_need_medical_attention" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="presently_experiencing_need_medical_attention2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <h5>Have you been hospitalized within the last five (5) years?</h5>
                  <div class="select">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="hospitalized_last_five_years1" name="hospitalized_last_five_years" class="custom-control-input" value="1"/>
                      <label class="custom-control-label" for="hospitalized_last_five_years1">Yes</label>
                    </div> 
                    <input
                    type="text"
                    id="hospitalized_last_five_years_remarks"
                    class="form-control my-1 hidden"
                    name="hospitalized_last_five_years_remarks"
                    placeholder="if Yes, state reason:"
                  />
                    <div class="custom-control custom-radio">
                      <input type="radio" id="hospitalized_last_five_years2" name="hospitalized_last_five_years" class="custom-control-input" value="0"/>
                      <label class="custom-control-label mb-1" for="hospitalized_last_five_years2">No</label>
                    </div>
                </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>How often do you see a physician?</h5>
                  <input
                    type="text"
                    id="often_physician"
                    class="form-control"
                    name="often_physician"
                    placeholder=""
                  />
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Date of last examination by a physician</h5>
                  <input
                    type="text"
                    id="date_last_examination_physician"
                    class="form-control"
                    name="date_last_examination_physician"
                    placeholder=""
                  />
                </div>
              </div>


              <div class="col-12 col-md-4">
                <div class="form-group">
                  <h5>Date of last confinement (if applicable)</h5>
                  <input
                    type="text"
                    id="date_last_confinement"
                    class="form-control"
                    name="date_last_confinement"
                    placeholder=""
                  />
                </div>
              </div>

            </div>
      
          </form>
          <div class="col-12 mt-1">
            <button class="mr-1 btn btn-outline-secondary btn-prev" >
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary float-right" id="next_5">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-success float-right" id="save_5">
              <span class="align-middle d-sm-inline-block d-none">Save</span>
              <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-danger float-right" id="cancel_5">
              <span class="align-middle d-sm-inline-block d-none">Cancel</span>
              <i data-feather="x" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div> -->

        <div id="assessment_condition" class="content">

          <form class="form form-vertical" id="save_assessment_condition_form" method="POST" action="">
            @csrf
            <input type="hidden" name="trans_no" id="trans_no" value="{{$trans_no}}">
            <div class="row mb-25">
              <div class="content-header col-12">
                <h3 class="my-1">Assessment and Condition</h3>
              </div>
  
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <h4 class="mb-1">Assessment</h4>
                  <div class="select">
                        <div class="custom-control custom-radio mb-25">
                          <input type="radio" id="assessment1" name="assessment" class="custom-control-input" value="Fit"/>
                          <label class="custom-control-label" for="assessment1">Fit to drive</label>
                        </div>
      
                        <div class="custom-control custom-radio">
                          <input type="radio" id="assessment2" name="assessment" class="custom-control-input" value="Unfit"/>
                          <label class="custom-control-label" for="assessment2">Unfit to drive</label>
                          
                          <div class="form-group mt-1">
                              <div class="select hidden" id="div_assessment_status">

                                <div class="custom-control custom-radio mb-25">
                                  <input type="radio" id="assessment_status1" name="assessment_status" class="custom-control-input" value="Permanent"/>
                                  <label class="custom-control-label" for="assessment_status1">Permanent</label>
                                </div>
              
                                <div class="custom-control custom-radio mb-25">
                                  <input type="radio" id="assessment_status2" name="assessment_status" class="custom-control-input" value="Temporary"/>
                                  <label class="custom-control-label" for="assessment_status2">Temporary, Pls Specify Duration</label>
                                  <input
                                  type="text"
                                  id="assessment_temporary_duration"
                                  class="form-control"
                                  name="assessment_temporary_duration"
                                  placeholder="..."/>
                                </div>
                                
                                <div class="custom-control custom-radio mb-25">
                                  <input type="radio" id="assessment_status3" name="assessment_status" class="custom-control-input" value="Refer"/>
                                  <label class="custom-control-label" for="assessment_status3">Refer to Specialist for further evalution</label>
                                </div> 

                              </div>
                            </div>

                        </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group" id="div_condition">
                  <h4 class="mb-1">Condition</h4>

                  <div class="custom-control custom-checkbox mb-1">
                    <input type="checkbox" class="custom-control-input conditions" id="conditions1" name="conditions" value="0"/>
                    <label class="custom-control-label" for="conditions1">None</label>
                  </div>

                  <div class="custom-control custom-checkbox mb-1">
                    <input type="checkbox" class="custom-control-input conditions" id="conditions2" name="conditions" value="1"/>
                    <label class="custom-control-label" for="conditions2">Drive only with corrective lens</label>
                  </div>

                  <div class="custom-control custom-checkbox mb-1">
                    <input type="checkbox" class="custom-control-input conditions" id="conditions3" name="conditions" value="2"/>
                    <label class="custom-control-label" for="conditions3">Drive only with special equipment for upper limbs</label>
                  </div>

                  <div class="custom-control custom-checkbox mb-1">
                    <input type="checkbox" class="custom-control-input conditions" id="conditions4" name="conditions" value="3"/>
                    <label class="custom-control-label" for="conditions4">Drive only with special equipment for lower limbs</label>
                  </div>

                  <div class="custom-control custom-checkbox mb-1">
                    <input type="checkbox" class="custom-control-input conditions" id="conditions5" name="conditions" value="4"/>
                    <label class="custom-control-label" for="conditions5">Drive only during daylight</label>
                  </div>

                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input conditions" id="conditions6" name="conditions" value="5"/>
                    <label class="custom-control-label" for="conditions6">Drive only with hearing aid</label>
                  </div>
                  
                </div>
              </div>

              <div class="col-12 col-md-5 col-lg-12">
                <div class="form-group">
                  <h4 class="mb-1">Remarks</h4>
                  <textarea class="form-control" id="remarks" name="remarks" rows="5"></textarea>
                </div>
              </div>

            </div>
      
          </form>
          <div class="col-12 mt-1">
            <button class="mr-1 btn btn-outline-secondary btn-prev" >
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary float-right" id="next_6">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-success float-right" id="save_6">
              <span class="align-middle d-sm-inline-block d-none">Save</span>
              <i data-feather="save" class="align-middle ml-sm-25 ml-0"></i>
            </button>
            <button class="mr-1 btn btn-danger float-right" id="cancel_6">
              <span class="align-middle d-sm-inline-block d-none">Cancel</span>
              <i data-feather="x" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>

        <div id="preview" class="content">

          <form class="form form-vertical" id="preview_form" method="POST" action="">
            @csrf
            <div class="row mb-25">

              <div class="col-12 col-md-12 col-lg-12 px-5">
                <div class="row">

                  <div class="col-12 col-md-12 col-lg-6 m-1">
                    <div class="row">
      
                      <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                        <h3>Applicant Information</h3>
                      </div>
                          
                      <div class="col-12 col-md-12 col-lg-12">
                        <div class="row">

                              <div class="col-md-6 col-lg-6 container-text">
                                <h5>FIRST NAME :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text">
                               <p id="pv_firstname" name="pv_firstname"></p>        
                              </div>                                

                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <h5 class="m-0 py-1 pr-1">MIDDLE NAME :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <p class="m-0 py-1 pr-1" id="pv_middlname" name="pv_middlname"></p>       
                              </div>

                              <div class="col-md-6 col-lg-6 container-text">
                                <h5 class="m-0 py-1 pr-1">SURNAME :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text">
                                <p class="m-0 py-1 pr-1" id="pv_surname" name="pv_surname"></p>      
                              </div>

                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <h5 class="m-0 py-1 pr-1">BIRTHDAY :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text bggrey">
                               <p class="m-0 py-1 pr-1" id="pv_bday" name="pv_bday"></p>        
                              </div>

                              <div class="col-md-6 col-lg-6 container-text">
                                <h5 class="m-0 py-1 pr-1">ADDRESS :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text" style="">
                                <p class="m-0 py-1 pr-1" id="pv_address" name="pv_address"></p>        
                              </div>

                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <h5 class="m-0 py-1 pr-1">GENDER :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <p class="m-0 py-1 pr-1" id="pv_gender" name="pv_gender"></p>        
                              </div>

                              <div class="col-md-6 col-lg-6 container-text">
                                <h5 class="m-0 py-1 pr-1">NATIONALITY :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text">
                                <p class="m-0 py-1 pr-1" id="pv_nationality" name="pv_nationality"></p>         
                              </div>

                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <h5 class="m-0 py-1 pr-1"> CIVIL STATUS :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <p class="m-0 py-1 pr-1" id="pv_civil_status" name="pv_civil_status"></p>        
                              </div>                                 

                              <div class="col-md-6 col-lg-6 container-text">
                                <h5 class="m-0 py-1 pr-1"> OCCUPATION :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text">
                                <p class="m-0 py-1 pr-1" id="pv_occupation" name="pv_occupation"></p>        
                              </div> 

                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <h5 class="m-0 py-1 pr-1"> LICENSE NO :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text bggrey">
                                <p class="m-0 py-1 pr-1" id="pv_license_no" name="pv_license_no"></p>       
                              </div> 

                              <div class="col-md-6 col-lg-6 container-text">
                                <h5 class="m-0 py-1 pr-1" > PURPOSE :</h5>   
                              </div>
                              <div class="col-md-6 col-lg-6 container-text">
                                <p class="m-0 py-1 pr-1" id="pv_purpose" name="pv_purpose"></p>         
                              </div> 

                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="col-12 col-md-12 col-lg-5 m-1">
                    <div class="row">
      
                      <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                        <h3>Applicant Picture</h3>
                      </div>
                          
                      <div class="col-12 col-md-12 col-lg-12 px-5">
                        <div class="row">

                          <div class="col embed-responsive-1by1 p-1" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <img
                              src="{{asset('images/default.png')}}"
                              id="picture_2"
                              class="bg-secondary"
                              alt="default.png"
                              width="100%"
                            />
                          </div> 

                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="col-12 col-md-12 col-lg-6 m-1">
                    <div class="row">
      
                    <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                        <h3>Physical Examination</h3>
                      </div>

                      <div class="col-12 col-md-12 col-lg-12">
                        <div class="row">

                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="pr-1">HEIGHT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="pr-1" id="pv_height" name="pv_height"></p>             
                          </div>
                        
                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">WEIGHT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_weight" name="pv_weight"></p>             
                          </div>
            
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">BLOOD PRESSURE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_bloodpressure" name="pv_bloodpressure"></p>             
                          </div>
            
                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">BLOOD TYPE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_bloodtype" name="pv_bloodtype"></p>             
                          </div>

                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">PULSE RATE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_pulserate" name="pv_pulserate"></p>             
                         </div>

                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">BODY TEMPERATURE:</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1"id="pv_bodytemperature" name="pv_bodytemperature"></p>             
                          </div>
                          
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">RESPIRATORY RATE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_respiratory_rate" name="pv_respiratory_rate"></p>             
                          </div>

                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">GENERAL PHYSIQUE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_generalphysique" name="pv_generalphysiquee"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">CONTAGIOUS DISEASE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_contagiousdisease" name="pv_contagiousdisease"></p>             
                          </div>                      

                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">UPPER EXTREMITIES RIGHT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_upperextremities_right" name="pv_upperextremities_right"></p>             
                          </div>
          
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">UPPER EXTREMITIES LEFT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_upperextremities_left" name="pv_upperextremities_left"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">LOWER EXTREMITIES RIGHT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_lowerextremities_right" name="pv_lowerextremities_right"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">LOWER EXTREMITIES LEFT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_lowerextremities_left" name="pv_lowerextremities_left"></p>             
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                  
                  <div class="col-12 col-md-12 col-lg-5 m-1">
                    <div class="row">

                      <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                        <h3>Metabolic Test</h3>
                      </div>

                      <div class="col-12 col-md-12 col-lg-12">
                        <div class="row">

                          <div class="col-md-6 col-lg-8 container-text">
                            <h5>EPILEPSY :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text">
                            <p id="pv_epilepsy" name="pv_epilepsy"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-8 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">EPILEPSY TREATMENT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_epilepsytreatment" name="pv_epilepsytreatment"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-8 container-text">
                            <h5 class="m-0 py-1 pr-1">LAST SEIZURE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_lastseizure" name="pv_lastseizure"></p>             
                          </div>
            
                          <div class="col-md-6 col-lg-8 container-text bggrey">
                           <h5 class="m-0 py-1 pr-1">DIABETES :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_diabetes" name="pv_diabetes"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-8 container-text">
                            <h5 class="m-0 py-1 pr-1">DIABETES TREATMENT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_diabetestreatment" name="pv_diabetestreatment"></p>             
                          </div>

                          <div class="col-md-6 col-lg-8 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">SLEEP APNEA :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_sleep_apnea" name="pv_sleep_apnea"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-8 container-text">
                            <h5 class="m-0 py-1 pr-1">SLEEP APNEA TREATMENT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_sleep_apneatreatment" name="pv_sleep_apneatreatment"></p>             
                          </div>

                          <div class="col-md-6 col-lg-8 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">AGGRESSIVE, MANIC OR DEPRESSIVE ORDER :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_aggressive_manic" name="pv_aggressive_manic"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-8 container-text">
                            <h5 class="m-0 py-1 pr-1">MENTAL TREATMENT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_mentaltreatment" name="pv_epilepsytreatment"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-8 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">OTHER MEDICAL CONDITION :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_others" name="pv_others"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-8 container-text">
                            <h5 class="m-0 py-1 pr-1">WHAT MEDICAL CONDITION :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_other_medical_condition" name="pv_other_medical_condition"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-8 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">OTHER MEDICAL CONDITION TREATMENT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-4 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_other_treatment" name="pv_other_treatment"></p>             
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>             

                  <div class="col-12 col-md-12 col-lg-6 m-1">
                    <div class="row">

                      <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                        <h3>Visual Test</h3>
                      </div>

                      <div class="col-12 col-md-12 col-lg-12">
                        <div class="row">

                          <div class="col-md-6 col-lg-10 container-text">
                            <h5>EYE COLOR :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p id="pv_eyecolor" name="pv_eyecolor"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">LEFT EYE: SNELLEN/BAILEY-LOVIE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_snellen_bailey_lovie_left" name="pv_snellen_bailey_lovie_left"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">RIGHT EYE: SNELLEN/BAILEY-LOVIE :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_snellen_bailey_lovie_right" name="pv_snellen_bailey_lovie_right"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">WITH CORRECTIVE LENS-LEFT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_snellen_with_correct_left" name="pv_snellen_with_correct_left"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">WITH CORRECTIVE LENS-RIGHT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_snellen_with_correct_right" name="pv_snellen_with_correct_right"></p>             
                          </div>

                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">COLOR BLIND-LEFT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_color_blind_left" name="pv_color_blind_left"></p>             
                          </div>
              
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">COLOR BLIND-RIGHT :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_color_blind_right" name="pv_color_blind_right"></p>             
                          </div>
                                                 
                          <div class="col-md-12 col-lg-12 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">Glare/Contrast Sensitivity Function</h5>   
                          </div>

                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">Without Lenses Right Eye:</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_glare_contrast_sensitivity_without_lense_right" name="pv_glare_contrast_sensitivity_without_lense_right"></p>             
                          </div>

                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">Without Lenses Left Eye:</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_glare_contrast_sensitivity_without_lense_left" name="pv_glare_contrast_sensitivity_without_lense_left"></p>             
                          </div>
                         
                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">Without Corrective or Contact Lenses Right Eye:</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_glare_contrast_sensitivity_with_corrective_right" name="pv_glare_contrast_sensitivity_with_corrective_right"></p>             
                          </div>

                          <div class="col-md-6 col-lg-10 container-text">
                            <h5 class="m-0 py-1 pr-1">Without Corrective or Contact Lenses Left Eye:</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text">
                            <p class="m-0 py-1 pr-1" id="pv_glare_contrast_sensitivity_with_corrective_left" name="pv_glare_contrast_sensitivity_with_corrective_left"></p>             
                          </div>
                          
                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">Color Blind Test :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_color_blind_test" name="pv_color_blind_test"></p>             
                          </div>

                          <div class="col-md-6 col-lg-10 container-text ">
                            <h5 class="m-0 py-1 pr-1">Any Eye Injury or Disease?(Specify) :</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text ">
                            <p class="m-0 py-1 pr-1" id="pv_eye_injury" name="pv_eye_injury"></p>             
                          </div>

                          <div class="col-md-6 col-lg-10 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">Is Further eye examination suggested:</h5>   
                          </div>
                          <div class="col-md-6 col-lg-2 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_examination_suggested" name="pv_examination_suggested"></p>             
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="col-12 col-md-12 col-lg-5 m-1">
                    <div class="row">

                      <div class="content-header col-12 p-1 m-0 mb-1 container-header">
                        <h3>Auditory Test</h3>
                      </div>

                      <div class="col-md-6 col-lg-10 container-text">
                        <h5 class="m-0 py-1 pr-1">RIGHT EAR :</h5>   
                      </div>
                      <div class="col-md-6 col-lg-2 container-text">
                        <p class="m-0 py-1 pr-1" id="pv_hearing_right" name="pv_hearing_right"></p>             
                      </div>

                      <div class="col-md-6 col-lg-10 container-text bggrey">
                        <h5 class="m-0 py-1 pr-1">LEFT EAR :</h5>   
                      </div>
                      <div class="col-md-6 col-lg-2 container-text bggrey">
                        <p class="m-0 py-1 pr-1" id="pv_hearing_left" name="pv_hearing_left"></p>             
                      </div>

                      <div class="content-header col-12 p-1 m-0 my-1 container-header">
                        <h3>Assesment and Condition</h3>
                      </div>

                      <div class="col-md-12 col-lg-12">
                        <div class="row">

                          <div class="col-md-6 col-lg-6 container-text">
                            <h5>ASSESSMENT  :</h5>     
                          </div>                                   
                          <div class="col-md-6 col-lg-6 container-text">
                           <p id="pv_exam_assessment" name="pv_exam_assessment"></p>         
                          </div>
                          
                          <div class="col-md-6 col-lg-6 container-text bggrey">
                            <h5 class="m-0 py-1 pr-1">ASSESSMENT STATUS :</h5>      
                          </div>                                   
                          <div class="col-md-6 col-lg-6 container-text bggrey">
                            <p class="m-0 py-1 pr-1" id="pv_assessment_status" name="pv_assessment_status"></p>         
                          </div>

                          <div class="col-md-6 col-lg-6 container-text">
                            <h5 class="m-0 py-1 pr-1">CONDITIONS :</h5>     
                          </div>                                   
                          <div class="col-md-6 col-lg-6 container-text">
                           <p class="m-0 py-1 pr-1" id="pv_exam_conditions" name="pv_exam_conditions"></p>         
                          </div>

                          <div class="col-md-6 col-lg-6 container-text bggrey">
                           <h5 class="m-0 py-1 pr-1" class="text-uppercase">REMARKS :</h5>  
                          </div>                                   
                          <div class="col-md-6 col-lg-6 container-text bggrey">
                           <p class="m-0 py-1 pr-1" id="pv_remarks" name="pv_remarks"></p>          
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              </div>

            </div>
          </form>

          <div class="col-12 mt-1">
            <button class="mr-1 btn btn-outline-secondary btn-prev" >
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary float-right" id="verify">
              <span class="align-middle d-sm-inline-block d-none">Verify</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>

            <button class="mr-1 btn btn-danger float-right" id="cancel_7">
              <span class="align-middle d-sm-inline-block d-none">Cancel</span>
              <i data-feather="x" class="align-middle ml-sm-25 ml-0"></i>
            </button>
         </div>
         
        </div>

    </div>  
  </div>

  <div class="modal fade text-left" data-backdrop="static" id="camera" tabindex="-2"  role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel1">Capture Image</h4>
          <button type="button" class="close text-danger" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
            <div class="embed-responsive embed-responsive-4by3">
              <video width="100%" height="100%" autoplay="true" id="video"></video>
            </div>
            <button id="capture" type="button" class="btn btn-primary w-100 my-1"><i data-feather="camera" class="font-medium-4"></i></button>
            <button id="recapture" name="recapture" type="button" class="btn btn-warning w-100 my-1">RECAPTURE</button>
            <canvas id="canvas" style="width:100%; height:auto;" class="hidden"></canvas>
            <!-- <button id="saveImg" type="button" class="btn btn-primary w-100 mt-1 hidden" data-dismiss="modal" aria-label="Close">Save</button> -->
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left" id="ishihara_modal" data-backdrop="static" tabindex="-3" role="dialog" aria-labelledby="ishihara_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="">
        <b>Look at the pictures below, and identify the number that you see in the corresponding boxes.</b>
  
      </h4>
          <button type="button" class="close text-danger" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="bio_modal_body">

          <div class="row p-1 d-flex justify-content-center">
            
            <div class="col-12 col-md-3 p-1 mx-2 my-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;"  id=""> 
             
              <div class="embed-responsive-1by1">
                  <img
                    src=""
                    id="ishahara_picture_1_viewer"
                    style = "cursor:pointer"
                    class="bg-secondary"
                    alt="default.png"
                    height="100%"
                    width="100%"
                  />
              </div>
            
              <input type="hidden" class="form-control" name="ishahara_1" id="ishahara_1" value="{{asset('images/1-1.png')}}"/>
              <!-- <p id="ishahara_label_1" name="ishahara_label_1"></p>     -->

              
               <div class="row p-1">
                  <button type="button" class="btn btn-outline-success col-12 text-center mb-50" id="btn_picture_1_pass" name="">PASS</button>                               
                  <button type="button" class="btn btn-outline-danger col-12 text-center m-0" id="btn_picture_1_fail" name="">FAIL</button>
                </div>

            </div>

            <div class="col-12 col-md-3 p-1 mx-2 my-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                <div class="embed-responsive-1by1">
                  <img
                    src=""
                    id="ishahara_picture_2_viewer"
                    style = "cursor:pointer"
                    class="bg-secondary"
                    alt="default.png"
                    height="100%"
                    width="100%"
                  />
                </div>

                <input type="hidden" class="form-control" name="ishahara_2" id="ishahara_2" value="{{asset('images/1-2.png')}}"/>

                <div class="row p-1">
                  <button type="button" class="btn btn-outline-success col-12 text-center mb-50" id="btn_picture_2_pass" name="">PASS</button>                               
                  <button type="button" class="btn btn-outline-danger col-12 text-center m-0" id="btn_picture_2_fail" name="">FAIL</button>
                </div>

            </div>
            
            <div class="col-12 col-md-3 p-1 mx-2 my-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
              <div class="embed-responsive-1by1">
                  <img
                    src=""
                    id="ishahara_picture_3_viewer"
                    style = "cursor:pointer"
                    class="bg-secondary"
                    alt="default.png"
                    height="100%"
                    width="100%"
                  />
                </div>
  
              <input type="hidden" class="form-control" name="ishahara_3" id="ishahara_3" value="{{asset('images/1-3.png')}}"/>

              <div class="row p-1">
                  <button type="button" class="btn btn-outline-success col-12 text-center mb-50" id="btn_picture_3_pass" name="">PASS</button>                               
                  <button type="button" class="btn btn-outline-danger col-12 text-center m-0" id="btn_picture_3_fail" name="">FAIL</button>
              </div>

            </div>

            <div class="col-12 col-md-3 p-1 mx-2 my-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
              <div class="embed-responsive-1by1">
                  <img
                    src=""
                    id="ishahara_picture_4_viewer"
                    style = "cursor:pointer"
                    class="bg-secondary"
                    alt="default.png"
                    height="100%"
                    width="100%"
                  />
              </div>

              <input type="hidden" class="form-control" name="ishahara_4" id="ishahara_4" value="{{asset('images/1-4.png')}}"/>

              <div class="row p-1">
                  <button type="button" class="btn btn-outline-success col-12 text-center mb-50" id="btn_picture_4_pass" name="">PASS</button>                               
                  <button type="button" class="btn btn-outline-danger col-12 text-center m-0" id="btn_picture_4_fail" name="">FAIL</button>
              </div>

            </div>

            <div class="col-12 col-md-3 p-1 mx-2 my-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
              <div class="embed-responsive-1by1">
                  <img
                    src=""
                    id="ishahara_picture_5_viewer"
                    style = "cursor:pointer"
                    class="bg-secondary"
                    alt="default.png"
                    height="100%"
                    width="100%"
                  />
                </div>
  
                <input type="hidden" class="form-control" name="ishahara_5" id="ishahara_5" value="{{asset('images/1-5.png')}}"/>

                <div class="row p-1">
                  <button type="button" class="btn btn-outline-success col-12 text-center mb-50" id="btn_picture_5_pass" name="">PASS</button>                               
                  <button type="button" class="btn btn-outline-danger col-12 text-center m-0" id="btn_picture_5_fail" name="">FAIL</button>
                </div>

            </div>

            <div class="col-12 col-md-3 p-1 mx-2 my-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
              <div class="embed-responsive-1by1">
                  <img
                    src=""
                    id="ishahara_picture_6_viewer"
                    style = "cursor:pointer"
                    class="bg-secondary"
                    alt="default.png"
                    height="100%"
                    width="100%"
                  />
                </div>
        
                <input type="hidden" class="form-control" name="ishahara_6" id="ishahara_6" value="{{asset('images/1-6.png')}}"/>

                <div class="row p-1">
                  <button type="button" class="btn btn-outline-success col-12 text-center mb-50" id="btn_picture_6_pass" name="">PASS</button>                               
                  <button type="button" class="btn btn-outline-danger col-12 text-center m-0" id="btn_picture_6_fail" name="">FAIL</button>
                </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="confirm_ishihara">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left" id="picture_modal" data-backdrop="static" tabindex="-3" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <!-- <button type="button" class="btn btn-primary float-left" id="show_answer">
           <i data-feather="eye" class="mr-1"></i>Show Answer
          </button> -->

          <input type="hidden" id = "ishihara_value_answer" value = "0">

          <button type="button" class="close text-danger" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      
        </div>
        <div class="modal-body" id="picture_modal_body">
            <div class="row">
              <div class="col-12">
                <img
                src="{{asset('images/default.png')}}"
                id="ishahara_picture_1"
                class="bg-secondary mb-1"
                alt="default.png"
                height="100%"
                width="100%"
                />
              </div>
            </div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_bio" >Cancel</button>
          <button type="button" class="btn btn-success" id="confirm"> Confirm</button>
        </div> -->
      </div>
    </div>
  </div>

  <div class="modal fade text-left" id="hearing_modal" data-backdrop="static" tabindex="-3" role="dialog" aria-labelledby="hearing_modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel6"></b>
  
        </h4> 
          <button type="button" class="close text-danger" data-dismiss="modal" id="close_hearing" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="bio_modal_body">

          <div class="row p-1 d-flex justify-content-center">

          <input type="hidden"  id="bothvalue" value = "{{asset('images/audio/1.mp3')}}">
          <input type="hidden"  id="leftvalue" value = "{{asset('images/audio/1-l.mp3')}}">
          <input type="hidden"  id="rightvalue" value = "{{asset('images/audio/1-r.mp3')}}">
          
            <audio id="myAudio-both">
              <source src="" type="audio/mpeg">
            </audio>

            <audio id="myAudio_left">
              <source src="" type="audio/mpeg">
            </audio>

            <audio id="myAudio_right">
              <source src="" type="audio/mpeg">
            </audio>
          
            <div class="col-12 col-lg-12 col-md-12 col-xl-12 p-1 m-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="row">

                <h4 class="mx-auto p-0" id=""></b>
                   Left & Right Ear Test</b>
                </h4> 

                <div class="col-12 mb-1">  
                  <button type="button" class="btn btn-sm btn-outline-success w-100" id="btn_hearing_left_right">
                    <i data-feather="play-circle" class="mr-25"></i>Play Sound
                  </button>
                </div>

                <div class="col-12 mb-1">  
                  <button type="button" class="btn btn-sm btn-outline-dark w-20 d-inline mr-50 " id="btn_hearing_left_right_answer" value = "show">
                    Show Answer 
                  </button>
                  <h4 class="mx-auto py-1 d-inline" id="hearing_left_right_answer">
            
                  </h4>
                </div>

                <div class="col-6 col-lg-6 col-md-6 col-xl-6">  
                  <button type="button" class="btn btn-outline-success col-12 text-center mb-50" id="btn_hearing_left_right_pass" name="">PASS</button>                                       
                </div>

                <div class="col-6 col-lg-6 col-md-6 col-xl-6">                                
                  <button type="button" class="btn btn-outline-danger col-12 text-center m-0" id="btn_hearing_left_right_fail" name="">FAIL</button>         
                </div>

              </div>
            </div> 

            <div class="col-12 col-lg-5 col-md-5 col-xl-5 p-1 m-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="row">

                <h4 class="mx-auto p-0" id=""></b>
                   Left Ear Test</b>
                </h4> 

                <div class="col-12 mb-1">  
                  <button type="button" class="btn btn-sm btn-outline-success w-100" id="btn_hearing_left_1">
                    <i data-feather="play-circle" class="mr-25"></i>Play Sound
                  </button>
                </div>

                <div class="col-12 mb-1">  
                  <button type="button" class="btn btn-sm btn-outline-dark w-100 mb-50" id="btn_hearing_left_1_answer" value = "show">
                    Show Answer 
                  </button>
                  <h4 class="mx-auto p-0 m-0 px-auto" id="hearing_left_1_answer"></h4>
                </div>

                <div class="col-6 col-lg-6 col-md-6 col-xl-6">  
                  <button type="button" class="btn btn btn-outline-success col-12 text-center mb-50" id="btn_hearing_left_1_pass" name="">PASS</button>                                       
                </div>

                <div class="col-6 col-lg-6 col-md-6 col-xl-6">                                
                  <button type="button" class="btn btn btn-outline-danger text-center m-0" id="btn_hearing_left_1_fail" name="">FAIL</button>         
                </div>

              </div>
            </div>         
            
            <div class="col-12 col-lg-5 col-md-5 col-xl-5 p-1 m-1" style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="row">

                <h4 class="mx-auto p-0" id=""></b>
                   Right Ear Test #1</b>
                </h4>

                <div class="col-12 mb-1">  
                  <button type="button" class="btn btn-sm btn-outline-success w-100" id="btn_hearing_right_1">
                     <i data-feather="play-circle" class="mr-25"></i>Play Sound
                  </button>
                </div>

                <div class="col-12 mb-1">  
                  <button type="button" class="btn btn-sm btn-outline-dark w-100 mb-50" id="btn_hearing_right_1_answer" value = "show">
                    Show Answer 
                  </button>
                  <h4 class="mx-auto p-0 m-0" id="hearing_right_1_answer"></h4>
                </div>

                <div class="col-6 col-lg-6 col-md-6 col-xl-6">  
                  <button type="button" class="btn btn btn-outline-success col-12 text-center mb-50" id="btn_hearing_right_1_pass" name="">PASS</button>                                       
                </div>

                <div class="col-6 col-lg-6 col-md-6 col-xl-6">                                
                  <button type="button" class="btn btn btn-outline-danger col-12 text-center m-0" id="btn_hearing_right_1_fail" name="">FAIL</button>         
                </div>

              </div>
            </div>
    
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="next_sound">Confirm</button>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade text-left" id="biometrics_modal" tabindex="-3" role="dialog" aria-labelledby="myModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel6">Biometrics Verification for Instructor</h4>
          {{-- <button type="button" class="close" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body" id="bio_modal_body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_bio" >Cancel</button>
          <button type="button" class="btn btn-success" id="confirm"> Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left" id="biometrics_modal2" tabindex="-3" role="dialog" aria-labelledby="myModalLabel7" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel7">Biometrics Verification for Administrator</h4>
          {{-- <button type="button" class="close" data-dismiss="modal" id="close_cam" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body" id="bio_modal_body2">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_bio2" >Cancel</button>
          <button type="button" class="btn btn-success" id="verify2" >Verify</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>

@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/continue_trans.js') }}"></script>
@endsection
