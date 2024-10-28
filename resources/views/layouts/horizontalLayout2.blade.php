@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/commonMaster2')
@php

    $menuHorizontal = true;
    $navbarFull = true;

    /* Display elements */
    $isNavbar = $isNavbar ?? true;
    $isMenu = $isMenu ?? true;
    $isFlex = $isFlex ?? false;
    $isFooter = $isFooter ?? true;
    $customizerHidden = $customizerHidden ?? '';
    $pricingModal = $pricingModal ?? false;

    /* HTML Classes */
    $menuFixed = isset($configData['menuFixed']) ? $configData['menuFixed'] : '';
    $navbarFixed = isset($configData['navbarFixed']) ? $configData['navbarFixed'] : '';
    $footerFixed = isset($configData['footerFixed']) ? $configData['footerFixed'] : '';
    $menuCollapsed = isset($configData['menuCollapsed']) ? $configData['menuCollapsed'] : '';

    /* Content classes */
    $container = $container ?? 'container-fluid';
    $containerNav = $containerNav ?? 'container-fluid';

@endphp

@section('layoutContent')
<div id="loader" class="loaders visually-hidden w-100 h-100 position-fixed text-center"
style="background-color: rgb(38, 60, 152); /* Fallback color */
background-color: rgba(38, 60, 152, 0.5); /* Black w/opacity/see-through */
backdrop-filter: blur(3px);
z-index:5000;
">
<div class="position-absolute top-50 start-50 translate-middle">
    <div id="loading" class="sk-bounce sk-white m-auto" style="width: 5rem; height: 5rem;" role="status">
        <div class="sk-bounce-dot"></div>
        <div class="sk-bounce-dot"></div>
    </div>
    <h3 class="text-white fw-bold text-center mt-5">Loading ...</h3>
</div>
</div>
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">

            <!-- BEGIN: Navbar-->
            @if ($isNavbar)
                @include('layouts/sections/navbar/navbar2')
            @endif
            <!-- END: Navbar-->


            <!-- Layout page -->
            <div class="layout-page">

                {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}
                {{-- <x-banner /> --}}

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    {{-- @if ($isMenu)
                        @include('layouts/sections/menu/horizontalMenu')
                    @endif --}}

                    <!-- Content -->
                    @if ($isFlex)
                        <div class="{{ $container }} d-flex align-items-stretch flex-grow-1 p-0">
                        @else
                            <div class="{{ $container }} flex-grow-1 container-p-y">
                    @endif

                    @yield('content')

                    <!-- pricingModal -->
                    @if ($pricingModal)
                        @include('_partials/_modals/modal-pricing')
                    @endif
                    <!--/ pricingModal -->
                </div>
                <!-- / Content -->

                <!-- Footer -->
                @if ($isFooter)
                    @include('layouts/sections/footer/footer')
                @endif
                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!--/ Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- / Layout Container -->

    @if ($isMenu)
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    @endif
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection
