<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"> --}}


        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        @yield('head')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fontawesome.airidasvideikis.me/all.css" rel="stylesheet">
    </head>
    <body>
        <main>
            <div id="categoryContainer">
                <div id="catLeft">
                    <x-section>
                    </x-section>
                </div>
                <div id="catRight">
                    <div>
                        {{ $slot }}
                    </div>
                </div>

            </div>

        </main>

        @include('layouts.footer')
        @yield('footer')
        @yield('footer_sections')
    </body>
</html>
