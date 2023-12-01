<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- fontawsom --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- chart --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        {{-- logo --}}
        <link rel="icon" type="icon" href="/icon/logo_app/cash_icon-icons.com_51090.ico"> 
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        {{-- success message --}}
        <page-component :success-message="{{ json_encode(session('success')) }}"></page-component>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js',"resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
