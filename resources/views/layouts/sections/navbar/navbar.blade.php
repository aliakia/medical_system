@php
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = $navbarDetached ?? '';
@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-primary"
        id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-primary" id="layout-navbar">
        <div class="{{ $containerNav }}">
@endif

@if (isset($navbarFull))
    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">

        <a class="app-brand-link gap-2" href="{{ route('main_page', Session('data_clinic')->clinic_id) }}">
            <img src="{{ asset('images\Medical Raw.jpg') }}" height="40" width="40" alt=""
                class="align-self-center flex-1">
            <h2 class="brand-text ml-1 mb-0 text-white align-self-center">Medicus</h2>
        </a>
    </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
        <a class="navbar-brand d-flex" href="{{ route('main_page', Session('data_clinic')->clinic_id) }}">
            <img src="{{ asset('images\Medical Raw.jpg') }}" height="40" width="40" alt=""
                class="align-self-center flex-1">
            <h2 class="brand-text ml-1 mb-0 text-white align-self-center">Medicus</h2>
        </a>
    </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    @if (!isset($menuHorizontal))
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0 fw-bold">
                Driving School Back Office Module
            </div>
        </div>
        <!-- /Search -->
    @endif

    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <li class="nav-item text-end me-2">
            <span class="fw-bold d-block text-white">
                {{ Session('LoggedUser')->full_name }}
            </span>
            <small class="badge badge-sm bg-label-success" style="font-size: 0.65rem; padding: 0.25rem 0.5rem;">
                {{-- {{Session('LoggedUser')->user_type}} --}}
                Physician
            </small>

        </li>

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown ml-3">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="{{ Session('LoggedUser')->pic1 }}" alt="avatar" class="rounded-circle me-2">
                    {{-- @if (Session('logged_in')->pic_id1 == '')
                    <img class="rounded-circle me-2" src="{{ asset('images/default.png') }}" alt="avatar">
                @else
                    <img class="rounded-circle me-2" src="{{ Session('logged_in')->pic_id1 }}" alt="avatar">
                @endif --}}
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">



                <a class="dropdown-item load" href="{{ route('logout_user', Session('data_clinic')->clinic_id) }}">
                    <i class="mr-50" data-feather="power"></i> Logout
                </a>
                <a class="dropdown-item load"
                    href="{{ route('physician_account_setting', Session('data_clinic')->clinic_id) }}">
                    <i class="mr-50" data-feather="settings"></i> Account Settings
                </a>
            </ul>
        </li>
        <!--/ User -->
    </ul>
</div>

<!-- Search Small Screens -->
<div class="navbar-search-wrapper search-input-wrapper {{ isset($menuHorizontal) ? $containerNav : '' }} d-none">
    <input type="text" class="form-control search-input {{ isset($menuHorizontal) ? '' : $containerNav }} border-0"
        placeholder="Search..." aria-label="Search...">
    <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
</div>
@if (isset($navbarDetached) && $navbarDetached == '')
    </div>
@endif
</nav>
<!-- / Navbar -->
