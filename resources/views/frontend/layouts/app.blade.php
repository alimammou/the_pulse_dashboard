<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <link rel = "icon" href =
    "{{asset("/images/pulse-logo-300x215.jpg")}}"
          type="image/x-icon">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CEM2RDS9CT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-CEM2RDS9CT');
    </script>
    <meta name="description" content="@yield('meta_description', 'Laravel Starter')">
    <meta name="author" content="@yield('meta_author', 'FasTrax Infotech')">
@yield('meta')

{{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
@stack('before-styles')

    <!-- Global stylesheets -->
{{ style(mix('css/frontend.css')) }}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- /global stylesheets -->

</head>

<body>

@include('frontend.includes.header')

{{--@include('includes.partials.messages')--}}
<div class="page-content">

    @include('frontend.includes.sidebar')

@yield('content')
</div>

<!-- Scripts -->
@stack('before-scripts')

{!! script(asset('js/backend/common.js')) !!}
{!! script(mix('js/manifest.js')) !!}
{!! script(mix('js/vendor.js')) !!}
{!! script(mix('js/frontend.js')) !!}
@stack('after-scripts')

@yield('page-script')

</body>
</html>
