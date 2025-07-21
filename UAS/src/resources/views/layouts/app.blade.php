<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Skincareku' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css">
    @livewireStyles
</head>
<body class="bg-gradient-to-b from-purple-50 to-white min-h-screen">
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div>
                <a href="/" class="text-2xl font-bold text-purple-700 tracking-tight">Skincareku</a>
            </div>
            <nav class="space-x-6">
                <a href="/" class="text-gray-700 hover:text-purple-700 font-medium">Home</a>
                <a href="/about" class="text-gray-700 hover:text-purple-700 font-medium">About</a>
                <a href="/products" class="text-gray-700 hover:text-purple-700 font-medium">Show Product</a>
            </nav>
        </div>
    </header>
    <main class="py-8 min-h-[70vh]">
        {{ $slot }}
    </main>
    <footer class="bg-white border-t mt-10 py-4 text-center text-gray-500">
        &copy; 2025 Skincareku. All rights reserved.
    </footer>
    @livewireScripts
</body>
</html>

