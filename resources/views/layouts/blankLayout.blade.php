@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
    $configData = Helper::appClasses();

    /* Display elements */
    $customizerHidden = $customizerHidden ?? '';

@endphp

@extends('layouts/commonMaster')


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
    <!-- Content -->
    @yield('content')
    <!--/ Content -->
@endsection
