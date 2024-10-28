@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'New Transaction')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('js/new_trans.js') }}"></script>
    @if (session('fail'))
        <script>
            $(document).ready(function() {
                toastr['error']('{{ session('fail') }}', 'Error');
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            $(document).ready(function() {
                toastr['info']('{{ session('info') }}', 'Success');
            });
        </script>
    @endif

@endsection

@section('content')
    <div class="col-sm-12 mb-4">
        {{-- <h4 class="fw-semi-bold py-3 mb-4">
            <span class="text-muted">New Trans Page | </span>
        </h4> --}}
        <div id="wizard-validation" class="bs-stepper horizontal-wizard-example mt-2">
            <div class="bs-stepper-header">
                <div class="step" data-target="#step1">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">Applicant Details</span>
                            <span class="bs-stepper-subtitle">Setup Applicant Details</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#step2">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Physical Exam</span>
                            <span class="bs-stepper-subtitle">Add Physical Exam info</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#step3">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Visual and Audio Test</span>
                            <span class="bs-stepper-subtitle">Visual and Audio Test</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#step4">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Metabolic and Neurological Test</span>
                            <span class="bs-stepper-subtitle">Metabolic and Neurological Test</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#step5">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Assessment and Condition</span>
                            <span class="bs-stepper-subtitle">Final Assessment and Condition</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#step6">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Preview</span>
                            <span class="bs-stepper-subtitle">Check Inputs</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <div class="progress w-100" style="height: 20px; margin: 0 50px;"> <!-- Add margin here -->
                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressbar" role="progressbar"
                        style="width: 1;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <input type="hidden" name="user_id" id="user_id" value="{{ Session('LoggedUser')->user_id }}">
            <input type="hidden" name="clinic_id" id="clinic_id" value="{{ Session('data_clinic')->clinic_id }}">

            <div class="bs-stepper-content">
                <div id="step1" class="content">
                    <div class="content-header">
                        <h6 class="mb-0">Applicant Information</h6>
                        <small>Enter Your Applicant Information.</small>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-3 my-2">

                        <div class="embed-responsive embed-responsive-1by1 mb-1 bg-slate-900">
                            <img src="{{ asset('images/default.png') }}" id="picture_1" class="bg-secondary"
                                alt="default.png" height="100%" width="50%" />
                        </div>
                        <button id="select" class="btn btn-primary w-50" data-toggle="modal" data-target="#camera">
                            Open Camera
                        </button>

                    </div>
                    <form id="new_trans_form" onSubmit="return false">
                        @csrf
                        <input id="base_64" type="hidden" name="base_64" value="" />
                        <div class="row g-3 mb-2">
                            <div class="col-sm-12 col-xl-4">
                                <label class="form-label" for="firstname">First Name</label>
                                <input type="text" id="firstname" name="firstname" class="form-control"
                                    placeholder="First Name" />
                            </div>
                            <div class="col-sm-12 col-xl-4">
                                <label class="form-label" for="middlename">Middle Name</label>
                                <input type="text" id="middlename" name="middlename" class="form-control"
                                    placeholder="Middle Name" />
                            </div>
                            <div class="col-sm-12 col-xl-4">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input type="text" id="lastname" name="lastname" class="form-control"
                                    placeholder="Last Name" />
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="Address" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control flatpickr-date" id="birthday"
                                    placeholder="YYYY-MM-DD" name="birthday" aria-describedby="birthday"
                                    value="" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="age">Age</label>
                                <input type="number" id="age" class="form-control" name="age"
                                    placeholder="Age" readonly />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="nationality">Nationality</label>
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
                                    <option value="GBR">British(United Kingdom of Great Britain and Northern Ireland)
                                    </option>
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
                                    <option value="BIH">Citizen of Bosnia and Herzegovina(Bosnia and Herzegovina)
                                    </option>
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
                                    <option selected value="PHL">Filipino(Philippines)</option>
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
                            <div class="col-sm-12 col-xl-3">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="select2 form-contol hide-search">
                                    <option selected disabled>Select Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="civilstatus">Civil Status</label>
                                <select name="civilstatus" id="civilstatus" class="select2 form-contol hide-search">
                                    <option selected disabled>Select Civil Status</option>
                                    <option value="M">Married</option>
                                    <option value="P">Separated</option>
                                    <option value="S">Single</option>
                                    <option value="W">Widower</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label for="occupation">Occupation</label>
                                <input type="text" id="occupation" class="form-control" name="occupation"
                                    placeholder="Occupation" />
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label class="form-label" for="purpose">Purpose</label>
                                <select name="purpose" id="purpose" class="select2 form-contol hide-search">
                                    <option selected value="0" disabled>Select Purpose</option>
                                    @foreach ($purpose as $item)
                                        <option value="{{ $item->purpose_code }}">{{ $item->purpose_description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label class="form-label" for="license_no">License No.</label>
                                <input type="text" id="license_no" class="form-control" name="license_no"
                                    placeholder="License No." />
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label for="lto_client_id">LTO client ID</label>
                                <input type="text" id="lto_client_id" class="form-control" name="lto_client_id"
                                    placeholder="LTO client ID" />
                            </div>
                        </div>
                    </form>

                    <div class="col-sm-12 d-flex justify-content-between mt-2">
                        <button class="btn btn-label-secondary btn-prev" disabled>
                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <div class="">
                            <button class="btn btn-success btn-danger" id="cancel_1"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Cancel</span>
                                <i class="ti ti-x"></i></button>
                            <button class="btn btn-success btn-success" id="save_1"><span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Save</span>
                                <i class="ti ti-device-floppy"></i></button>
                            <button class="btn btn-primary btn-next" id="next_1"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                <div id="step2" class="content">
                    <div class="content-header">
                        <h6 class="mb-0">Physical Exam</h6>
                        <small>Enter Physical Exam Information.</small>
                    </div>
                    <form id="physical_trans_form" onSubmit="return false">
                        <div class="row g-3 mb-2">
                            {{-- <div class="col-sm-12 col-xl-3">
                                  <label class="form-label" for="firstname">Height (cm)</label>
                                  <input type="text" id="firstname" name="firstname"
                                      class="form-control" placeholder="John" />
                              </div>
                              <div class="col-sm-12 col-xl-3">
                                  <label class="form-label" for="lastname">Weight (KG)</label>
                                  <input type="text" id="" name="" class="form-control"
                                      placeholder="Doe" />
                              </div> --}}
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="height">Height (CM)</label>
                                <input type="text" id="height" name="height" class="form-control"
                                    placeholder="Height (CM)" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="weight">Weight (KG)</label>
                                <input type="text" id="weight" name="weight" class="form-control"
                                    placeholder="Weight (KG)" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="bmi">Body Mass Index (BMI)</label>
                                <input type="text" id="bmi" class="form-control" name="bmi"
                                    placeholder="BMI" />
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="blood_pressure">Blood Pressure(mmHg)</label>
                                <div class="row">

                                    <div class="col-6">
                                        <input type="text" id="mm" class="form-control" name="mm"
                                            placeholder="mm" />
                                    </div>

                                    <div class="col-6">
                                        <input type="text" id="hg" class="form-control" name="hg"
                                            placeholder="Hg" />
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-3">
                                <div class="row">
                                    <div class="col-sm-12 col-xl-7 m-0">
                                        <label class="form-label" for="body_temperature">Body Temperature</label>
                                        <input type="text" id="body_temperature" class="form-control m-0"
                                            name="body_temperature" placeholder="Body Temperature" />
                                    </div>
                                    <div class="col-sm-12 col-xl-5 m-0">
                                        <label class="form-label" for="scale_temperature">Scale of
                                            Temperature</label>
                                        <input type="text" id="scale_temperature" name="scale_temperature m-0"
                                            class="form-control" value="celcius(°C)" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="pulse_rate">Pulse Rate</label>
                                <input type="text" id="pulse_rate" name="pulse_rate" class="form-control"
                                    placeholder="Pulse Rate">
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="respiratory_rate">Respiratory Rate</label>
                                <input type="text" id="respiratory_rate" name="respiratory_rate" class="form-control"
                                    placeholder="Respiratory Rate">
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="blood_type">Blood Type</label>
                                <select name="blood_type" id="blood_type" class="select2 form-control hide-search">
                                    <option selected disabled>Select Blood Type</option>
                                    @foreach ($blood_type as $item)
                                        <option value="{{ $item->blood_type }}">{{ $item->blood_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="upper_extremities_left">Upper Extremities
                                    Left</label>
                                <select name="upper_extremities_left" id="upper_extremities_left"
                                    class="select2 form-control hide-search">
                                    <option selected disabled>Select-</option>
                                    <option value="1">Normal</option>
                                    <option value="2">With disability</option>
                                    <option value="3">With special equipment</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="upper_extremities_right">Upper Extremities
                                    Right</label>
                                <select name="upper_extremities_right" id="upper_extremities_right"
                                    class="select2 form-control hide-search">
                                    <option selected disabled>Select-</option>
                                    <option value="1">Normal</option>
                                    <option value="2">With disability</option>
                                    <option value="3">With special equipment</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Lower Extremities Left</label>
                                <select name="lower_extremities_left" id="lower_extremities_left"
                                    class="select2 form-control hide-search">
                                    <option selected disabled>Select-</option>
                                    <option value="1">Normal</option>
                                    <option value="2">With disability</option>
                                    <option value="3">With special equipment</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-3">
                                <label class="form-label" for="">Lower Extremities Right</label>
                                <select name="lower_extremities_right" id="lower_extremities_right"
                                    class="select2 form-control hide-search">
                                    <option selected disabled>Select-</option>
                                    <option value="1">Normal</option>
                                    <option value="2">With disability</option>
                                    <option value="3">With special equipment</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label for="form-label">General Physique</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="disability1" name="disability"
                                            class="form-check-input" value="normal" />
                                        <label class="form-label" for="disability1">Normal</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="disability2" name="disability"
                                            class="form-check-input" value="WithDisability" />
                                        <label class="form-label mb-1" for="disability2">With
                                            Disability (Please Specify) </label>
                                        <input type="text" id="txtdisability" class="form-control visually-hidden"
                                            name="txtdisability" placeholder="Specify Disability" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <label class="form-label" for="disease">Contagious Disease</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="disease1" name="disease" class="form-check-input"
                                            value="none" />
                                        <label class="form-label" for="disease1">None</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="disease2" name="disease" class="form-check-input"
                                            value="with_disease" />
                                        <label class="form-label mb-1" for="disease2">With Disease (Please
                                            Specify)</label>
                                        <input type="text" id="txtdisease" class="form-control visually-hidden"
                                            name="txtdisease" placeholder="Specify Disease" />
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                    <div class="col-sm-12 d-flex justify-content-between mt-2">
                        <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <div class="">

                            <button class="btn btn-success btn-danger" id="cancel_2"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Cancel</span>
                                <i class="ti ti-x"></i></button>
                            <button class="btn btn-success btn-success" id="save_2"><span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Save</span>
                                <i class="ti ti-device-floppy"></i></button>
                            <button class="btn btn-primary btn-next" id="next_2"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                <div id="step3" class="content">
                    <div class="row">
                        <h5 class="m-0">Visual Tests</h5>
                        <h6 class="fw-normal mb-1" id="color_blind_result">Ishihara Test Result: -/6</h6>
                        <div class="col-lg-12 col-xl-2 mb-3">
                            <button id="ishihara" type="button" class="btn btn-primary w-90 my-1 ishihara">
                                <i class="ti ti-eye me-2 font-medium-4"></i> Take Ishihara Test
                            </button>
                        </div>
                    </div>
                    <form id="visual_hearing_trans_form" onSubmit="return false">
                        @csrf
                        <div class="row g-3 mb-2">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="eye_color" class="form-label">Eye Color</label>
                                <select name="eye_color" id="eye_color" class="select2 form-control hide-search">
                                    <option selected disabled>Select Eye Color</option>
                                    <option value="1">Black</option>
                                    <option value="2">Brown</option>
                                    <option value="3">Other</option>
                                    <option value="4">Blue</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="snellen_bailey_lovie_left" class="form-label">Left Eye:
                                    Snellen/Bailey-Lovie</label>
                                <input type="text" id="snellen_bailey_lovie_left" class="form-control"
                                    name="snellen_bailey_lovie_left" placeholder="Left Eye: Snellen/Bailey-Lovie" />
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="snellen_bailey_lovie_right" class="form-label">Right Eye:
                                    Snellen/Bailey-Lovie</label>
                                <input type="text" id="snellen_bailey_lovie_right" class="form-control"
                                    name="snellen_bailey_lovie_right" placeholder="Right Eye: Snellen/Bailey-Lovie" />
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <label for="disease" class="form-label">With Corrective Lens Left:</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="corrective_lens_left1" name="corrective_lens_left"
                                            class="form-check-input" value="1" />
                                        <label class="form-label" for="corrective_lens_left1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="corrective_lens_left2" name="corrective_lens_left"
                                            class="form-check-input" value="0" />
                                        <label class="form-label mb-1" for="corrective_lens_left2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <label for="corrective_lens_right" class="form-label">With Corrective Lens Right:</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="corrective_lens_right1" name="corrective_lens_right"
                                            class="form-check-input" value="1" />
                                        <label class="form-label" for="corrective_lens_right1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="corrective_lens_right2" name="corrective_lens_right"
                                            class="form-check-input" value="0" />
                                        <label class="form-label mb-1" for="corrective_lens_right2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <label for="color_blind_left" class="form-label">Color Blind Left:</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="color_blind_left1" name="color_blind_left"
                                            class="form-check-input" value="1" />
                                        <label class="form-label" for="color_blind_left1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="color_blind_left2" name="color_blind_left"
                                            class="form-check-input" value="0" />
                                        <label class="form-label mb-1" for="color_blind_left2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <label for="color_blind_right" class="form-label">Color Blind Right:</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="color_blind_right1" name="color_blind_right"
                                            class="form-check-input" value="1" />
                                        <label class="form-label" for="color_blind_right1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="color_blind_right2" name="color_blind_right"
                                            class="form-check-input" value="0" />
                                        <label class="form-label mb-1" for="color_blind_right2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                                <label for="glare_contrast_sensitivity_without_lense_right" class="form-label">Right Eye:
                                    Without Lenses</label>
                                <input type="text" id="glare_contrast_sensitivity_without_lense_right"
                                    class="form-control" name="glare_contrast_sensitivity_without_lense_right"
                                    placeholder="Right Eye " />
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                                <label for="glare_contrast_sensitivity_without_lense_left" class="form-label">Left Eye:
                                    Without Lenses</label>
                                <input type="text" id="glare_contrast_sensitivity_without_lense_left"
                                    class="form-control" name="glare_contrast_sensitivity_without_lense_left"
                                    placeholder="Left Eye" />
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                                <label for="glare_contrast_sensitivity_with_corrective_right" class="form-label">Right
                                    Eye: With Corrective or Contact Lenses</label>
                                <input type="text" id="glare_contrast_sensitivity_with_corrective_right"
                                    class="form-control" name="glare_contrast_sensitivity_with_corrective_right"
                                    placeholder="Right Eye" />
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                                <label for="glare_contrast_sensitivity_with_corrective_left" class="form-label">Left Eye:
                                    With Corrective or Contact Lenses</label>
                                <input type="text" id="glare_contrast_sensitivity_with_corrective_left"
                                    class="form-control" name="glare_contrast_sensitivity_with_corrective_left"
                                    placeholder="Left Eye" />
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="color_blind_test" class="form-label">Color Blind Test:</label>
                                <input type="text" id="color_blind_test" class="form-control" name="color_blind_test"
                                    placeholder="Color Blind Test" />
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="eye_injury" class="form-label">Any Eye Injury or Disease? (Specify)</label>
                                <input type="text" id="eye_injury" class="form-control" name="eye_injury"
                                    placeholder="" />
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <label for="examination_suggested" class="form-label">Is Further Eye Examination
                                    Suggested:</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="examination_suggested1" name="examination_suggested"
                                            class="form-check-input" value="YES" />
                                        <label class="form-label" for="examination_suggested1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="examination_suggested2" name="examination_suggested"
                                            class="form-check-input" value="NO" selected />
                                        <label class="form-label mb-1" for="examination_suggested2">No</label>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <h5 class="mb-0">Hearing Test</h5>
                                <h6 class="fw-normal mb-1" id="hearing_result"></h6>
                                <div class="col-lg-12 col-xl-2 mb-3">
                                    <button type="button" class="btn btn-primary w-90 my-1 hearing">
                                        <i class="ti ti-ear me-2 font-medium-4"></i> Take Hearing Test
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="hearing_left" class="form-label">Left Ear Hearing</label>
                                <select name="hearing_left" id="hearing_left" class="select2 form-control hide-search">
                                    <option selected disabled>Select-</option>
                                    <option value="1">Normal</option>
                                    <option value="2">Reduced</option>
                                    <option value="3">With Hearing Aid</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="hearing_right" class="form-label">Left Ear Hearing</label>
                                <select name="hearing_right" id="hearing_right" class="select2 form-control hide-search">
                                    <option selected disabled>Select-</option>
                                    <option value="1">Normal</option>
                                    <option value="2">Reduced</option>
                                    <option value="3">With Hearing Aid</option>
                                </select>
                            </div>

                        </div>
                    </form>
                    <div class="col-sm-12 d-flex justify-content-between mt-2">
                        <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <div class="">

                            <button class="btn btn-success btn-danger" id="cancel_3"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Cancel</span>
                                <i class="ti ti-x"></i></button>
                            <button class="btn btn-success btn-success" id="save_3"><span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Save</span>
                                <i class="ti ti-device-floppy"></i></button>
                            <button class="btn btn-primary btn-next" id="next_3"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i></button>
                        </div>
                    </div>

                </div>

                <div id="step4" class="content">
                    <div class="content-header mb-3">
                        <h6 class="mb-0">Metabolic and Neurological Test</h6>
                        <small>Enter Metabolic and Neurological Test Information.</small>
                    </div>
                    <form id="metabolic_neurological_exam_form" onSubmit="return false">
                        <div class="row g-3 mb-2">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="epilepsy">Epilepsy:</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="epilepsy1" name="epilepsy" class="form-check-input"
                                            value="1" />
                                        <label class="form-label" for="epilepsy1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="epilepsy2" name="epilepsy" class="form-check-input"
                                            value="0" />
                                        <label class="form-label mb-1" for="epilepsy2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="visually-hidden" id="div_epilepsy_treatment">
                                    <label for="epilepsy_treatment">Epilepsy Treatment:</label>
                                    <div class="select">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="epilepsy_treatment1" name="epilepsy_treatment"
                                                class="form-check-input" value="1" />
                                            <label class="form-label" for="epilepsy_treatment1">Yes (Please
                                                Specify)</label>
                                            <input type="text" id="txt_epilepsy_treatment"
                                                class="form-control visually-hidden mt-1" name="txt_epilepsy_treatment"
                                                placeholder="" />
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="epilepsy_treatment2" name="epilepsy_treatment"
                                                class="form-check-input" value="0" />
                                            <label class="form-label mb-1" for="epilepsy_treatment2">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div id="div_last_seizure" class="visually-hidden">
                                    <label for="last_seizure" class="form-label">Last Seizure(Indicate Date)</label>
                                    <input type="text" id="last_seizure" class="form-control mt-4"
                                        name="last_seizure" placeholder="Last Seizure" />
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="diabetes">Diabetes:</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="diabetes1" name="diabetes" class="form-check-input"
                                            value="1" />
                                        <label class="form-label" for="diabetes1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="diabetes2" name="diabetes" class="form-check-input"
                                            value="0" />
                                        <label class="form-label mb-1" for="diabetes2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="visually-hidden" id="div_diabetes_treatment">

                                    <label for="diabetes_treatment">Diabetes Treatment:</label>
                                    <div class="select">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="diabetes_treatment1" name="diabetes_treatment"
                                                class="form-check-input" value="1" />
                                            <label class="form-label" for="diabetes_treatment1">Yes (Please
                                                Specify)</label>
                                            <input type="text" id="txt_diabetes_treatment"
                                                class="form-control visually-hidden mt-1" name="txt_diabetes_treatment"
                                                placeholder="" />
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="diabetes_treatment2" name="diabetes_treatment"
                                                class="form-check-input" value="0" />
                                            <label class="form-label mb-1" for="diabetes_treatment2">No</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="sleepapnea" class="form-label">Sleep Apnea</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="sleepapnea1" name="sleepapnea"
                                            class="form-check-input" value="1" />
                                        <label class="form-label" for="sleepapnea1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="sleepapnea2" name="sleepapnea"
                                            class="form-check-input" value="0" />
                                        <label class="form-label mb-1" for="sleepapnea2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="visually-hidden" id="div_sleepapnea_treatment">
                                    <label for="epilepsy_treatment">Sleep Apnea Treatment:</label>
                                    <div class="select">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="sleepapnea_treatment1"
                                                name="sleepapnea_treatment" class="form-check-input" value="1" />
                                            <label class="form-label" for="sleepapnea_treatment1">Yes (Please
                                                Specify)</label>
                                            <input type="text" id="txt_sleepapnea_treatment"
                                                class="form-control visually-hidden" name="txt_sleepapnea_treatment"
                                                placeholder="" />
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="sleepapnea_treatment2"
                                                name="sleepapnea_treatment" class="form-check-input" value="0" />
                                            <label class="form-label mb-1" for="sleepapnea_treatment2">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-6">
                                <label for="mental">Aggressive, Manic or Depressive Order:</label>
                                <div class="select">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="mental1" name="mental" class="form-check-input"
                                            value="1" />
                                        <label class="form-label" for="mental1">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="mental2" name="mental" class="form-check-input"
                                            value="0" />
                                        <label class="form-label mb-1" for="mental2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-6">
                                <div class="form-group">
                                    <div class="visually-hidden" id="div_mental_treatment">
                                        <label for="mental_treatment">Mental Treatment:</label>
                                        <div class="select">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="mental_treatment1" name="mental_treatment"
                                                    class="form-check-input" value="1" />
                                                <label class="form-label" for="mental_treatment1">Yes (Please
                                                    Specify)</label>
                                                <input type="text" id="txt_mental_treatment"
                                                    class="form-control visually-hidden" name="txt_mental_treatment"
                                                    placeholder="" />
                                            </div>

                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="mental_treatment2" name="mental_treatment"
                                                    class="form-check-input" value="0" />
                                                <label class="form-label mb-1" for="mental_treatment2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-6">
                                <div class="form-group">
                                    <label for="other">Other Medical condition:</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="other1" name="other" class="form-check-input"
                                            value="1" />
                                        <label class="form-label mb-1" for="other1">Yes (Please
                                            Specify)</label>
                                        <input type="text" id="other_medical_condition"
                                            class="form-control visually-hidden" name="other_medical_condition"
                                            placeholder="Specify other condition" />
                                    </div>

                                    <div class="select">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="other2" name="other"
                                                class="form-check-input" value="0" />
                                            <label class="form-label" for="other2">Normal</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-6">
                                <div class="form-group">
                                    <div class="visually-hidden" id="div_other_treatment">
                                        <label for="other_treatment">Is it under proper treatment or
                                            medication:</label>
                                        <div class="select">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="other_treatment1" name="other_treatment"
                                                    class="form-check-input" value="1" />
                                                <label class="form-label mb-1" for="other_treatment1">Yes (Please
                                                    Specify)</label>
                                                <input type="text" id="txt_other_treatment"
                                                    class="form-control visually-hidden" name="txt_other_treatment"
                                                    placeholder="" />
                                            </div>

                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="other_treatment2" name="other_treatment"
                                                    class="form-check-input" value="0" />
                                                <label class="form-label mb-1" for="other_treatment2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-12 d-flex justify-content-between mt-2">
                        <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <div class="">
                            <button class="btn btn-success btn-danger" id="cancel_4"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Cancel</span>
                                <i class="ti ti-x"></i></button>
                            <button class="btn btn-success btn-success" id="save_4"><span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Save</span>
                                <i class="ti ti-device-floppy"></i></button>
                            <button class="btn btn-primary btn-next" id="next_4"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                <div id="step5" class="content">
                    <div class="content-header mb-3">
                        <h6 class="mb-0">Assessment and Condition</h6>
                        <small>Final Assessment and Condtion</small>
                    </div>
                    <form id="assessment_condition_form" onSubmit="return false">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <h4 class="mb-1">Assessment</h4>
                                    <div class="select">
                                        <div class="custom-control custom-radio mb-25">
                                            <input type="radio" id="assessment1" name="assessment"
                                                class="form-check-input" value="Fit" />
                                            <label class="form-label" for="assessment1">Fit to drive</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="assessment2" name="assessment"
                                                class="form-check-input" value="Unfit" />
                                            <label class="form-label" for="assessment2">Unfit to drive</label>

                                            <div class="form-group mt-1">
                                                <div class="select visually-hidden" id="div_assessment_status">

                                                    <div class="custom-control custom-radio mb-25">
                                                        <input type="radio" id="assessment_status1"
                                                            name="assessment_status" class="form-check-input"
                                                            value="Permanent" />
                                                        <label class="form-label"
                                                            for="assessment_status1">Permanent</label>
                                                    </div>

                                                    <div class="custom-control custom-radio mb-25">
                                                        <input type="radio" id="assessment_status2"
                                                            name="assessment_status" class="form-check-input"
                                                            value="Temporary" />
                                                        <label class="form-label" for="assessment_status2">Temporary
                                                            (Please Specify Duration)</label>
                                                        <input type="text" id="assessment_temporary_duration"
                                                            class="form-control" name="assessment_temporary_duration"
                                                            placeholder="..." />
                                                    </div>

                                                    <div class="custom-control custom-radio mb-25">
                                                        <input type="radio" id="assessment_status3"
                                                            name="assessment_status" class="form-check-input"
                                                            value="Refer" />
                                                        <label class="form-label" for="assessment_status3">Refer to
                                                            Specialist for further
                                                            evalution</label>
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
                                        <input type="checkbox" class="form-check-input conditions" id="conditions1"
                                            name="conditions" value="0" />
                                        <label class="form-label" for="conditions1">None</label>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="form-check-input conditions" id="conditions2"
                                            name="conditions" value="1" />
                                        <label class="form-label" for="conditions2">Drive only with corrective
                                            lens</label>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="form-check-input conditions" id="conditions3"
                                            name="conditions" value="2" />
                                        <label class="form-label" for="conditions3">Drive only with special
                                            equipment for upper limbs</label>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="form-check-input conditions" id="conditions4"
                                            name="conditions" value="3" />
                                        <label class="form-label" for="conditions4">Drive only with special
                                            equipment for lower limbs</label>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="form-check-input conditions" id="conditions5"
                                            name="conditions" value="4" />
                                        <label class="form-label" for="conditions5">Drive only during
                                            daylight</label>
                                    </div>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input conditions" id="conditions6"
                                            name="conditions" value="5" />
                                        <label class="form-label" for="conditions6">Drive only with hearing
                                            aid</label>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <h4 for="remarks" class="">Remarks</h4>
                                <textarea class="form-control" id="remarks" name="remarks" rows="5"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-12 d-flex justify-content-between mt-2">
                        <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <div class="">
                            <button class="btn btn-success btn-danger" id="cancel_6"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Cancel</span>
                                <i class="ti ti-x"></i></button>
                            <button class="btn btn-success btn-success" id="save_6"><span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Save</span>
                                <i class="ti ti-device-floppy"></i></button>
                            <button class="btn btn-primary btn-next" id="next_6"> <span
                                    class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="content" id="step6">
                    <div class="content-header mb-3">
                        <h6 class="mb-0">Preview</h6>
                        <small>Preview Inputs</small>
                    </div>

                    <style>
                        .alternating-rows li:nth-child(odd) {
                            background-color: #f8f9fa;
                            /* Light gray for odd rows */
                            padding: 8px;
                        }

                        .alternating-rows li:nth-child(even) {
                            background-color: #ffffff;
                            /* White for even rows */
                            padding: 8px;
                        }
                    </style>
                    <form class="form form-vertical" id="preview_form" method="POST" action="">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <h5 class="card-header mb-3">APPLICANT INFORMATION</h5>
                                <ul class="list-unstyled alternating-rows">
                                    <li class="row">
                                        <strong class="col-6">FIRST NAME:</strong>
                                        <span class="col-6" id="pv_firstname"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">MIDDLE NAME:</strong>
                                        <span class="col-6" id="pv_middlname"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">LAST NAME:</strong>
                                        <span class="col-6" id="pv_surname"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">BIRTHDAY:</strong>
                                        <span class="col-6" id="pv_bday"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">ADDRESS:</strong>
                                        <span class="col-6" id="pv_address"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">GENDER:</strong>
                                        <span class="col-6" id="pv_gender"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">NATIONALITY:</strong>
                                        <span class="col-6" id="pv_nationality"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">CIVIL STATUS:</strong>
                                        <span class="col-6" id="pv_civil_status"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">OCCUPATION:</strong>
                                        <span class="col-6" id="pv_occupation">
                                        </span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">LICENSE NO:</strong>
                                        <span class="col-6" id="pv_license_no"></span>
                                    </li>
                                    <li class="row">
                                        <strong class="col-6">PURPOSE:</strong>
                                        <span class="col-6" id="pv_purpose"></span>
                                    </li>
                                </ul>
                            </div>
                            <!-- Image Section -->
                            <!-- Image Section -->
                            <div class="col-12 col-lg-4 d-flex align-items-start justify-content-center">
                                <img src="{{ asset('images/default.png') }}" alt="User Image"
                                    class="img-fluid rounded shadow w-100 border" id="picture_2" />
                            </div>
                            <hr>


                            <div class="col-12">
                                <h5 class="card-header mb-3">PHYSICAL EXAMINTATION</h5>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <ul class="list-unstyled alternating-rows">

                                            <li class="row">
                                                <strong class="col-6">HEIGHT:</strong>
                                                <span class="col-6" id="pv_height"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">WEIGHT:</strong>
                                                <span class="col-6" id="pv_weight"></span>
                                            </li>


                                            <li class="row">
                                                <strong class="col-6">BLOOD PRESSURE:</strong>
                                                <span class="col-6" id="pv_bloodpressure"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">BLOOD TYPE:</strong>
                                                <span class="col-6" id="pv_bloodtype"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">PULSE RATE:</strong>
                                                <span class="col-6" id="pv_pulserate"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">BODY TEMPERATURE:</strong>
                                                <span class="col-6" id="pv_bodytemperature"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">RESPIRATORY RATE:</strong>
                                                <span class="col-6" id="pv_respiratory_rate"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">GENERAL PHYSIQUE:</strong>
                                                <span class="col-6" id="pv_generalphysique"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">CONTAGIOUS DISEASE:</strong>
                                                <span class="col-6" id="pv_contagiousdisease"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">UPPER EXTREMITIES
                                                    RIGHT:</strong>
                                                <span class="col-6" id="pv_upperextremities_right"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">UPPER EXTREMITIES
                                                    LEFT:</strong>
                                                <span class="col-6" id="pv_upperextremities_left"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">LOWER EXTREMITIES
                                                    RIGHT:</strong>
                                                <span class="col-6" id="pv_lowerextremities_right"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">LOWER EXTREMITIES
                                                    LEFT:</strong>
                                                <span class="col-6" id="pv_lowerextremities_left"></span>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">

                                <h5 class="card-header mb-3">METABOLIC TEST</h5>
                                <div class="row">
                                    <div class="col-xl-12 ">
                                        <ul class="list-unstyled alternating-rows">
                                            <li class="row">
                                                <strong class="col-6">EPILEPSY:</strong>
                                                <span class="col-6" id="pv_epilepsy"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">EPILEPSY TREATMENT:</strong>
                                                <span class="col-6" id="pv_epilepsytreatment"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">LAST SEIZURE</strong>
                                                <span class="col-6" id="pv_lastseizure"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">DIABETES</strong>
                                                <span class="col-6" id="pv_diabetes"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">DIABETES TREATMENT</strong>
                                                <span class="col-6" id="pv_diabetestreatment"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">SLEEP APNEA:</strong>
                                                <span class="col-6" id="pv_sleep_apnea"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">SLEEP APNEA
                                                    TREATMENT:</strong>
                                                <span class="col-6" id="pv_sleep_apneatreatment"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">AGGRESIVE, MANIC OR
                                                    DEPRESSIVE ORDER:</strong>
                                                <span class="col-6" id="pv_aggressive_manic"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">MENTAL TREATMENT:</strong>
                                                <span class="col-6" id="pv_mentaltreatment"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">OTHER MEDICAL
                                                    CONDITION:</strong>
                                                <span class="col-6" id="pv_others"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">WHAT MEDICAL
                                                    CONDITION:</strong>
                                                <span class="col-6" id="pv_other_medical_condition"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">OTHER MEDICAL CONDITION
                                                    TREATMENT:</strong>
                                                <span class="col-6" id="pv_other_treatment"></span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <h5 class="card-header mb-3">VISUAL TEST</h5>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <ul class="list-unstyled alternating-rows">
                                            {{-- <li class="row">
                                                    <strong class="col-6">Rec No:</strong>
                                                    <span class="col-6"
                                                        id="pv_recno">recno }}</span>
                                                </li> --}}
                                            <li class="row">
                                                <strong class="col-6">EYE COLOR:</strong>
                                                <span class="col-6" id="pv_eyecolor"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">LEFT EYE:
                                                    SNELLEN/BAILEY-LOVIE:</strong>
                                                <span class="col-6" id="pv_snellen_bailey_lovie_left"></span>
                                            </li>


                                            <li class="row">
                                                <strong class="col-6">RIGHT EYE:
                                                    SNELLEN/BAILEY-LOVIE:</strong>
                                                <span class="col-6" id="pv_snellen_bailey_lovie_right"></span>
                                                </span>
                                            </li>

                                            <li class="row">
                                                <strong class="col-6">WITH CORRECTIVE LENS
                                                    (LEFT):</strong>
                                                <span class="col-6" id="pv_snellen_with_correct_left"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">WITH CORRECTIVE LENS
                                                    (RIGHT):</strong>
                                                <span class="col-6" id="pv_snellen_with_correct_right"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">COLOR BLIND (LEFT):</strong>
                                                <span class="col-6" id="pv_color_blind_left"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">COLOR BLIND
                                                    (RIGHT):</strong>
                                                <span class="col-6" id="pv_color_blind_right"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">GLARE/CONTRAST SENSITVITY
                                                    FUNCTION:</strong>
                                                <span class="col-6" id=""></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">WITHOUT LENSES RIGHT
                                                    EYE:</strong>
                                                <span class="col-6"
                                                    id="pv_glare_contrast_sensitivity_without_lense_right"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">WITHOUT LENSES LEFT
                                                    EYE:</strong>
                                                <span class="col-6"
                                                    id="pv_glare_contrast_sensitivity_without_lense_left"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">WITHOUT CORRECTIVE OR
                                                    CONTRAST LENSES RIGHT
                                                    EYE:</strong>
                                                <span class="col-6"
                                                    id="pv_glare_contrast_sensitivity_with_corrective_right"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">WITHOUT CORRECTIVE OR
                                                    CONTRAST LENSES LEFT
                                                    EYE:</strong>
                                                <span class="col-6"
                                                    id="pv_glare_contrast_sensitivity_with_corrective_left"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">COLOR BLIND TEST:</strong>
                                                <span class="col-6" id="pv_color_blind_test"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">ANY EYE INJURY OR DISEASE
                                                    (SPECIFY):</strong>
                                                <span class="col-6" id="pv_eye_injury"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">IS FURTHER EYE EXAMINATION
                                                    SUGGESTED:</strong>
                                                <span class="col-6" id="pv_examination_suggested"></span>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <h5 class="card-header mb-3">AUDITORY TEST</h5>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <ul class="list-unstyled alternating-rows">
                                            <li class="row">
                                                <strong class="col-6">RIGHT EAR:</strong>
                                                <span class="col-6" id="pv_hearing_right"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">LEFT EAR:</strong>
                                                <span class="col-6" id="pv_hearing_left"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <h5 class="card-header mb-3">ASSESSMENT AND CONDITION</h5>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <ul class="list-unstyled alternating-rows">
                                            <li class="row">
                                                <strong class="col-6">ASSESSMENT:</strong>
                                                <span class="col-6" id="pv_exam_assessment"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">ASSESSMENT STATUS:</strong>
                                                <span class="col-6" id="pv_assessment_status"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">CONDITIONS:</strong>
                                                <span class="col-6" id="pv_exam_conditions"></span>
                                            </li>
                                            <li class="row">
                                                <strong class="col-6">REMARKS:</strong>
                                                <span class="col-6" id="pv_remarks"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </form>
                    <div class="col-sm-12 d-flex justify-content-between mt-2">
                        <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <div class="">

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
        </div>
        <div class="col-12 mt-4 text-end">
            <a href="{{ route('main_page', Session('data_clinic')->clinic_id) }}" class="btn btn-outline-primary load">
                <i class="ti ti-corner-down-left mr-1"></i>Go Back
            </a>
        </div>

    </div>


    {{-- modals --}}
    <div class="modal fade text-left" id="camera" data-backdrop="static" tabindex="-2" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Capture Image</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-4by3">
                            <video width="100%" height="100%" autoplay="true" id="video"></video>
                        </div>
                        <button id="capture" type="button" class="btn btn-primary w-100 my-1"> <i
                                class="ti ti-camera" class="font-medium-4"></i></i></button>
                        <button id="recapture" name="recapture" type="button"
                            class="btn btn-warning w-100 my-1">RECAPTURE</button>
                        <canvas id="canvas" style="width:100%; height:auto;" class="visually-hidden"></canvas>
                        <!-- <button id="saveImg" type="button" class="btn btn-primary w-100 mt-1 hidden" data-dismiss="modal" aria-label="Close">Save</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade text-left" id="ishihara_modal" data-backdrop="static" tabindex="-3" role="dialog"
        aria-labelledby="ishihara_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">
                        <b>Look at the pictures below, and identify the number that you see in the corresponding boxes.</b>

                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <div class="modal-body" id="bio_modal_body">

                    <div class="row p-1 d-flex justify-content-center">

                        <div class="col-12 col-md-3 p-1 mx-2 m-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">

                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_1_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_1" id="ishahara_1"
                                value="{{ asset('images/1-1.png') }}" />
                            <!-- <p id="ishahara_label_1" name="ishahara_label_1"></p>     -->
                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_1_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_1_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_2_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_2" id="ishahara_2"
                                value="{{ asset('images/1-2.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_2_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_2_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_3_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_3" id="ishahara_3"
                                value="{{ asset('images/1-3.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_3_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_3_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_4_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_4" id="ishahara_4"
                                value="{{ asset('images/1-4.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_4_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_4_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_5_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_5" id="ishahara_5"
                                value="{{ asset('images/1-5.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_5_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_5_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_6_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_6" id="ishahara_6"
                                value="{{ asset('images/1-6.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_2_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_2_fail"
                                name="">FAIL</button>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirm_ishihara">Confirm</button>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade text-left" id="ishihara_modal" data-backdrop="static" tabindex="-3" role="dialog"
        aria-labelledby="ishihara_modal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document"> <!-- Changed to modal-xl -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <b>Look at the pictures below, and identify the number that you see in the corresponding boxes.</b>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bio_modal_body">
                    <div class="row p-1 d-flex justify-content-center">
                        <div class="col-12 col-md-3 p-1 mx-2 m-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">

                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_1_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_1" id="ishahara_1"
                                value="{{ asset('images/1-1.png') }}" />
                            <!-- <p id="ishahara_label_1" name="ishahara_label_1"></p>     -->
                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_1_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_1_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_2_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_2" id="ishahara_2"
                                value="{{ asset('images/1-2.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_2_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_2_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_3_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_3" id="ishahara_3"
                                value="{{ asset('images/1-3.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_3_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_3_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_4_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_4" id="ishahara_4"
                                value="{{ asset('images/1-4.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_4_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_4_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_5_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_5" id="ishahara_5"
                                value="{{ asset('images/1-5.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_5_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_5_fail"
                                name="">FAIL</button>

                        </div>

                        <div class="col-12 col-md-3 p-1 mx-2 my-1"
                            style = "background:#f8f8f8;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="">
                            <div class="embed-responsive-1by1">
                                <img src="" id="ishahara_picture_6_viewer" style = "cursor:pointer"
                                    class="bg-secondary" alt="default.png" height="100%" width="100%" />
                            </div>

                            <input type="hidden" class="form-control" name="ishahara_6" id="ishahara_6"
                                value="{{ asset('images/1-6.png') }}" />

                            <button type="button" class="btn btn-outline-success w-100 my-2" id="btn_picture_6_pass"
                                name="">PASS</button>
                            <button type="button" class="btn btn-outline-danger w-100" id="btn_picture_6_fail"
                                name="">FAIL</button>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirm_ishihara">Confirm</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade text-left" id="picture_modal" data-backdrop="static" tabindex="-3" role="dialog"
        aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <!-- <button type="button" class="btn btn-primary float-left" id="show_answer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <i data-feather="eye" class="mr-1"></i>Show Answer
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </button> -->

                    <input type="hidden" id = "ishihara_value_answer" value = "0">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body" id="picture_modal_body">
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset('images/default.png') }}" id="ishahara_picture_1"
                                class="bg-secondary mb-1" alt="default.png" height="100%" width="100%" />
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

    <div class="modal fade text-left" id="hearing_modal" data-backdrop="static" tabindex="-3" role="dialog"
        aria-labelledby="hearing_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel6">
                        Hearing Test
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bio_modal_body">
                    <div class="row p-2 d-flex justify-content-center">

                        <input type="hidden" id="bothvalue" value="{{ asset('images/audio/1.mp3') }}">
                        <input type="hidden" id="leftvalue" value="{{ asset('images/audio/1-l.mp3') }}">
                        <input type="hidden" id="rightvalue" value="{{ asset('images/audio/1-r.mp3') }}">

                        <audio id="myAudio-both">
                            <source src="" type="audio/mpeg">
                        </audio>

                        <audio id="myAudio_left">
                            <source src="" type="audio/mpeg">
                        </audio>

                        <audio id="myAudio_right">
                            <source src="" type="audio/mpeg">
                        </audio>

                        <div class="col-12 p-2 mb-5"
                            style="background:#f8f8f8; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="row">
                                <h4 class="text-center">
                                    Left & Right Ear Test
                                </h4>

                                <div class="col-12 mb-2">
                                    <button type="button" class="btn btn-sm btn-outline-success w-100"
                                        id="btn_hearing_left_right">
                                        <i data-feather="play-circle" class="ti ti-player-play me-2"></i>Play Sound
                                    </button>
                                </div>

                                <div class="col-12 mb-2 d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-dark"
                                        id="btn_hearing_left_right_answer" value="show">
                                        Show Answer
                                    </button>
                                    <h4 id="hearing_left_right_answer" class=""></h4>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-success w-100"
                                        id="btn_hearing_left_right_pass">PASS</button>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-danger w-100"
                                        id="btn_hearing_left_right_fail">FAIL</button>
                                </div>
                            </div>
                        </div>

                        <!-- Left Ear Test Section -->
                        <div class="col-12 p-2 mb-2"
                            style="background:#f8f8f8; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="row">
                                <h4 class="text-center">
                                    Left Ear Test
                                </h4>

                                <div class="col-12 mb-2 me-2">
                                    <button type="button" class="btn btn-sm btn-outline-success w-100"
                                        id="btn_hearing_left_1">
                                        <i data-feather="play-circle" class="ti ti-player-play me-2"></i>Play Sound
                                    </button>
                                </div>

                                <div class="col-12 mb-2 d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-dark" id="btn_hearing_left_1_answer"
                                        value="show">
                                        Show Answer
                                    </button>
                                    <h4 id="btn_hearing_left_1_answer" class=""></h4>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-success w-100"
                                        id="btn_hearing_left_1_pass">PASS</button>
                                </div>

                                <div class="col-6 mb-2">
                                    <button type="button" class="btn btn-outline-danger w-100"
                                        id="btn_hearing_left_1_fail">FAIL</button>
                                </div>
                            </div>
                        </div>

                        <!-- Right Ear Test Section -->
                        <div class="col-12 p-2 mb-2"
                            style="background:#f8f8f8; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="row">
                                <h4 class="text-center">
                                    Right Ear Test
                                </h4>

                                <div class="col-12 mb-2">
                                    <button type="button" class="btn btn-sm btn-outline-success w-100"
                                        id="btn_hearing_right_1">
                                        <i data-feather="play-circle" class="ti ti-player-play me-2"></i>Play Sound
                                    </button>
                                </div>

                                <div class="col-12 mb-2 d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-dark" id="btn_hearing_right_1_answer"
                                        value="show">
                                        Show Answer
                                    </button>
                                    <h4 id="btn_hearing_right_1_answer" class=""></h4>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-success w-100"
                                        id="btn_hearing_right_1_pass">PASS</button>
                                </div>

                                <div class="col-6 mb-2">
                                    <button type="button" class="btn btn-outline-danger w-100"
                                        id="btn_hearing_right_1_fail">FAIL</button>
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



@endsection
