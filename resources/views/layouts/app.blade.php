<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> | @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;
        }
    </style>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    <link href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.css' rel='stylesheet' />
    <script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/moment@4.3.0/main.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logos/logo-salazar.svg') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <x-jet-banner />

    <div class="lg:flex flex-col lg:flex-row lg:min-h-screen w-full">
        <!-- Sidebar -->
        <x-jet-bar-sidebar />
        <!-- End Sidebar -->

        <div class="w-full">

            <x-navigation-menu />

            <!-- Content Container -->
            <main class="flex-1 relative z-0 overflow-y-auto py-6 focus:outline-none" tabindex="0"
                x-init="$el.focus()">
                @if (isset($header))
                    <div class="max-w-7xl mx-auto pt-3 px-4 sm:px-6 lg:px-8">
                        <!-- Title -->
                        <h1 class="text-lg font-semibold tracking-widest text-gray-900 uppercase dark-mode:text-white">
                            {{ $header }}</h1>
                        <!-- End Title -->
                    </div>
                @endif
                <div>
                    <div class="lg:min-h-96 px-4 sm:px-0">
                        {{ $slot }}
                    </div>
                </div>
            </main>
            <!-- Content Container -->

        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
