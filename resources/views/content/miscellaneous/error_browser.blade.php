@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/LayoutMaster')

@section('title', 'Error 404')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-misc.css')) }}">
@endsection
@section('content')
<!-- Error page-->
<div class="misc-wrapper">

  <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
      <h2 class="mb-1">Browser Error</h2>
      <p class="mb-2">Oops! 😖 mozilla firefox browser required.</p>

      @if($configData['theme'] === 'dark')
      <img class="img-fluid" src="{{asset('images/error.png')}}" alt="Error page" />
      @else
      <img class="img-fluid" src="{{asset('images/error.png')}}" alt="Error page" />
      @endif
    </div>
  </div>
</div>
<!-- / Error page-->
@endsection
