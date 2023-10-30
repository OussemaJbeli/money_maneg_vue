<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- canves --}}
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        {{-- logo --}}
        <link rel="icon" type="icon" href="/icon/logo_app/cash_icon-icons.com_51090.ico"> 
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        {{-- success message --}}
        <page-component :success-message="{{ json_encode(session('success')) }}"></page-component>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/all.min.css') }}">
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js',"resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
