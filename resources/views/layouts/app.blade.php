<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'POS Management System'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800">

    <div class="min-h-screen">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Optional Page Heading -->
        @isset($header)
            <header class="bg-white border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{ $slot ?? '' }}

            @yield('content')

        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-200 bg-white mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} POS Management System.
                All rights reserved.
            </div>
        </footer>

    </div>

</body>
</html>
