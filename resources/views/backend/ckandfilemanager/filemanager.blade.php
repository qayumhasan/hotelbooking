@extends('layouts.admin')
@section('title', 'Add User | '.$seo->meta_title)
@section('content')
  <!-- jQuery and jQuery UI (REQUIRED) -->
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/packages/barryvdh/elfinder/css/elfinder.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/packages/barryvdh/elfinder/css/theme.css') }}">

        <!-- elFinder JS (REQUIRED) -->
        <script src="{{ asset('public/packages/barryvdh/elfinder/js/elfinder.min.js') }}"></script>

        @if($locale)
            <!-- elFinder translation (OPTIONAL) -->
            <script src='{{ asset("public/packages/barryvdh/elfinder/js/i18n/elfinder.$locale.js") }}'></script>
        @endif

        <!-- elFinder initialization (REQUIRED) -->
        <script charset="utf-8">
            // Documentation for client options:
            // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
            $().ready(function() {
                $('#elfinder').elfinder({
                    // set your elFinder options here
                 
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url : '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ asset('/public/sounds') }}'
                });
            });
        </script>
        <div id="elfinder"></div>

@endsection