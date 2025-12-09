<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auto Marketplace')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            min-height: 100vh;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="font-sans text-gray-100 flex flex-col min-h-screen">

    {{-- Navigācija --}}
    <nav class="bg-white/10 backdrop-blur-md shadow-md p-4 flex justify-between items-center">
        <a href="/" class="text-white font-bold text-xl">My Baltic Car</a>
        <a href="{{ route('cars.index') }}" class="text-gray-200 hover:text-white">Visi auto</a>
    </nav>

    {{-- Lapas saturs --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white/10 backdrop-blur-md p-4 text-center text-sm text-gray-300">
        © {{ date('Y') }} My Baltic Car
    </footer>

</body>
</html>
