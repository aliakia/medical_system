@extends('layouts/contentLayoutMaster2')

@section('title', 'Admin Menu Page')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
   <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/pickers/pickadate/pickadate.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">

@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('css/base/pages/dashboard-ecommerce.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/charts/chart-apex.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-pickadate.css') }}">
@endsection

@section('content')
<section id="main_page">

  <div class="row">

        <div class="col-md-4 col-lg-4 col-xl-3 col-12 mb-2">
          <a class="btn btn-outline-primary text-left px-auto py-1 w-100 load" href="{{route('admin_users_management',Session('data_clinic')->clinic_id)}}" id="btn_new_trans">
            <div class="row">
              <div class="col-3 mx-0">
                <div class="avatar bg-light-primary p-1 mr-50">
                  <div class="avatar-content">
                    <i data-feather="users" class="font-large-1"></i>
                  </div>
                </div>
              </div>
              <div class="col-8 py-1">
                <span class="font-weight-bolder h5">SYSTEM USERS</span>
              </div>
            </div>
          </a>
        </div>


        <!-- <div class="col-md-4 col-lg-4 col-xl-3 col-12 mb-2">
          <a class="btn btn-outline-primary text-left px-auto py-1 w-100 load" href="{{route('admin_certificate_list',Session('data_clinic')->clinic_id)}}" id="btn_new_trans">
            <div class="row">
              <div class="col-3 mx-0">
                <div class="avatar bg-light-primary p-1 mr-50">
                  <div class="avatar-content">
                    <i data-feather="award" class="font-large-1"></i>
                  </div>
                </div>
              </div>
              <div class="col-8 py-1">
                <span class="font-weight-bolder h5">CERTIFICATES</span>
              </div>
            </div>
          </a>
        </div> -->


        <div class="col-md-4 col-lg-4 col-xl-3 col-12 mb-2">
          <a class="btn btn-outline-primary text-left px-auto py-1 w-100 load" href="{{route('admin_summary_reports',Session('data_clinic')->clinic_id)}}" id="btn_new_trans">
            <div class="row">
              <div class="col-3 mx-0">
                <div class="avatar bg-light-primary p-1 mr-50">
                  <div class="avatar-content">
                    <i data-feather="activity" class="font-large-1"></i>
                  </div>
                </div>
              </div>
              <div class="col-8 py-1">
                <span class="font-weight-bolder h5">TRANSACTION REPORTS</span>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-md-4 col-lg-4 col-xl-3 col-12 mb-2">
          <a class="btn btn-outline-primary text-left px-auto py-1 w-100 load" href="{{route('admin_generate_logs',Session('data_clinic')->clinic_id)}}" id="btn_new_trans">
            <div class="row">
              <div class="col-3 mx-0">
                <div class="avatar bg-light-primary p-1 mr-50">
                  <div class="avatar-content">
                    <i data-feather="file-text" class="font-large-1"></i>
                  </div>
                </div>
              </div>
              <div class="col-8 py-1">
                <span class="font-weight-bolder h5">USER LOGS</span>
              </div>
            </div>
          </a>
        </div>
   
          <div class="col-md-6 col-lg-4 col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                <div class="header-left">
                  <h5 class="h3">{{$yearly_total}} Uploads</h5>
                  <p class="card-subtitle text-muted mt-25">Yearly Total</p>
                </div>
                <div class="select w-50">
                  <!-- <label for="select_year" class="form-label">Select Active Year</label> -->
                  <select  name="select_year" class="hide-search form-control" id="select_year">
                    <option selected disabled value="">Select Year</option>
                    @foreach($years as $year)
                      <option value="{{$year}}">{{$year}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="card-body">
                <canvas class="bar-chart-ex chartjs" data-height="250"></canvas>
              </div>
            </div>
          </div>

          
           <!-- Horizontal Bar Chart End -->
          <div class="col-md-6 col-lg-4 col-12">
            <div class="card">

              <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                  <h4 class="card-title mb-25">Upload Summary</h4>

                
                <div class="d-flex align-items-center mt-md-0 mt-1 w-100">
                  <i class="font-medium-2" data-feather="calendar"></i>
                  <input
                    type="text"
                    class="form-control flat-picker bg-transparent border-0 shadow-none"
                    placeholder="YYYY-MM-DD"
                    name="select_date"
                    id="select_date"
                  />
                </div>

              </div>

                <div class="card-body">

                  <div class="row mb-1">
                    <div class="col-12 text-left">Total Uploads :</div>
                    <div class="col-6">{{$uploaded_transaction_total}}</div>
                  </div>

                  <div class="row mb-1">
                    <div class="col-12 text-left">Total Pending Transactions :</div>
                    <div class="col-6">{{$pending_transaction_total}}</div>
                  </div>
        
                </div>

            </div>
          </div>

          <div class="col-md-6 col-lg-4 col-12">
            <div class="card">

              <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                  <h4 class="card-title mb-25">Account Status</h4>
              </div>

              <div class="card-body">

                <div class="row mb-1">
                  <div class="col-12 text-left">Max Credit :</div>
                  <div class="col-6">₱ {{$balance[0]->max_credit}}</div>
                </div>

                <div class="row mb-1">
                  <div class="col-12 text-left">Current Balance :</div>
                  <div class="col-6">₱ {{$balance[0]->balance}}</div>
                </div>

              </div>

            </div>
          </div>
          

  </div>
      
    
  
<div class="modal fade text-left" id="add_physician_view" data-backdrop="static" tabindex="-3" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #355f91;">
        <h4 class="modal-title" id="myModalLabel1" style=" color:#ffffff;">ADD PHYSICIAN</h4>
        <button type="button" class="close bg-danger" data-dismiss="modal"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-25">

          <div class="col-12 col-md-7">
           <div class="row">
              <div class="col-4">
                <label for="defaultFormControlInput" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
              </div>

              <div class="col-4">
                <label for="defaultFormControlInput" class="form-label">First Name</label>
                <input type="text" class="form-control" id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
              </div>

              <div class="col-4">
                <label for="defaultFormControlInput" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
              </div>

              <div class="col-12">
                <label for="defaultFormControlInput" class="form-label">Address</label>
                <input type="text" class="form-control" id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
              </div>
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
          
          <div class="col-12 col-md-5 p-1">

              <div class="row">

                <div class="col-12 col-md-6 m-0 p-0" style="border: 1px solid #d8d6de; border-radius:5px;">
                  <div class="col-12 col-md-12 py-1 bg-primary">
                    <h3 class="text-center" style="color:#ffffff">PHYSICIAN PHOTO</h3>
                  </div>
                  <div class="embed-responsive-1by1 m-1">
                    <img
                      src="{{asset('images/default.png')}}"
                      id="picture_1"
                      class="bg-secondary"
                      alt="default.png"
                      height="250"
                      width="100%"/>
                  </div>
                  
                  <div class="mx-1">
                    <label id="select" class="btn btn-primary w-100" data-toggle="modal" data-target="#camera">Open Camera</label>
                  <input id="base_64" type="hidden" name="base_64" value=""/>
                  </div>
                </div>
    
                <div class="col-11 col-md-5 mx-auto mt-1 p-1" style="border: 2px solid #d8d6de; border-radius:20px;">  
                  <h3 class="text-center" style="color:black;">PHYSICIAN BIOMETRICS</h3>
                  <div class="embed-responsive-1by1">
                    <img
                      src="{{asset('images/fingerprint.gif')}}"
                      id="bio_phy"
                      class="bg-secondary"
                      alt="default.png"
                      height="100%"
                      width="100%"
                      style="cursor:pointer;"/>
                  </div>
                  <h3 class="text-center mt-1" style="color:black;">CLICK TO SCAN</h3>
                </div>
              </div>

          </div>

      </div>
    </div>
  </div>
</div>

{{-- camera --}}
<div class="modal fade text-left" id="camera" tabindex="-2" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Capture Image</h4>
        <button type="button" class="close" id="close_cam">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="modal-body">
          <div class="embed-responsive embed-responsive-4by3">
            <video width="100%" height="100%" autoplay="true" id="video"></video>
          </div>
          <button id="capture" type="button" class="btn btn-success w-100 my-1 font-medium-3"><i data-feather="camera" class="font-medium-4 mr-1"></i>CAPTURE</button>
          <button id="retake" type="button" class="btn btn-danger w-100 hidden my-1 font-medium-3"><i data-feather="refresh-cw" class="font-medium-4 mr-1"></i>RETAKE</button>
          <canvas id="canvas" style="width:100%; height:auto;" class="hidden"></canvas>
          <button id="saveImg" type="button" class="btn btn-primary w-100 hidden font-medium-3"><i data-feather="save" class="font-medium-4 mr-1"></i>SAVE</button>
          </div>
      </div>
    </div>
  </div>
</div>

</section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/pickers/pickadate/picker.js') }}"></script>
  <script src="{{ asset('vendors/js/pickers/pickadate/picker.date.js') }}"></script>
  <script src="{{ asset('vendors/js/pickers/pickadate/picker.time.js') }}"></script>
  <script src="{{ asset('vendors/js/pickers/pickadate/legacy.js') }}"></script>
  <script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/webcam.min.js') }}"></script>
  <script src="{{ asset('js/scripts/admin_dashboard.js') }}"></script>
@endsection
@section('page-script')

<script>
    var active_year = "{{Session('active_year')}}";
    var yearlyTrans = "{{$yearly_trans}}";
    var select_date = "{{Session('select_date')}}";
</script>
@endsection
