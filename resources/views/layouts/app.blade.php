<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="py-2">{{ $header }}</div>
                    @if (Session::has('notif.success'))
                        <div id="success-notification" class="bg-green-100 mt-2 p-4 relative rounded border border-green-700">
                            <span class="text-green-700">{{ Session::get('notif.success') }}</span>
                            <button type="button" onclick="closeNotification()"
                                class="absolute top-1/2 transform -translate-y-1/2 right-0 mr-4 text-red-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <script>
                            // Display the success notification
                            var successNotification = document.getElementById('success-notification');
                            successNotification.style.display = 'block';

                            // Function to close the success notification
                            function closeNotification() {
                                successNotification.style.display = 'none';
                            }

                            // Hide the success notification after 3 seconds
                            setTimeout(function() {
                                closeNotification();
                            }, 5000);
                        </script>
                    @endif
                </div>
            </header>
        @endif


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
