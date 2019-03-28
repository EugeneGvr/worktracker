<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/app_admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin_popup.css') }}" rel="stylesheet">
</head>
<body>
  <div class = "popup-background"></div>
  @include('admin.parts.toolbar')
  <div class="content">
    <div class="sidebar card"> @include('admin.parts.sidebar')</div>
    <div class="main card">
        @yield('content')
    </div>
  </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
