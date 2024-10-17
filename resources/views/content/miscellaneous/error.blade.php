@php
    $configData = Helper::appClasses();
@endphp
@extends('layouts/LayoutMaster')

@section('title', 'Error 404')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset('css/base/pages/page-misc.css') }}">
@endsection
@section('content')
    <!-- Error page-->
    <div class="misc-wrapper">

        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">Clinic Not Found 🕵🏻‍♀️</h2>
                <p class="mb-2">Oops! 😖 The requested Clinic Id was not found on this server.</p>

                @if ($configData['theme'] === 'dark')
                    <img class="img-fluid" src="{{ asset('images/pages/error-dark.svg') }}" alt="Error page" />
                @else
                    <img class="img-fluid" src="{{ asset('images/pages/error.svg') }}" alt="Error page" />
                @endif
            </div>
        </div>
    </div>
    <!-- / Error page-->
@endsection
