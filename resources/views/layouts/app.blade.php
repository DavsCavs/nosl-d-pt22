<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Baltic Car')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(160deg, #0f172a 0%, #1e3a8a 55%, #1d4ed8 100%);
            min-height: 100vh;
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
        }
    </style>
</head>
<body class="font-sans text-gray-100 flex flex-col min-h-screen">

    <nav class="bg-blue-900 border-b border-blue-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h10z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 16l2-8h2l2 8"/>
                    </svg>
                    <span class="text-white font-bold text-xl tracking-tight">My Baltic Car</span>
                </a>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}"
                        class="text-gray-300 hover:text-white transition text-sm font-medium">
                        Sākums
                    </a>
                    <a href="{{ route('cars.index') }}"
                        class="text-gray-300 hover:text-white transition text-sm font-medium">
                        Visi sludinājumi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-blue-900 border-t border-blue-800 py-8 mt-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} My Baltic Car
            </p>
        </div>
    </footer>

</body>
</html>
