<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    @vite('resources/css/app.css')
    <script src="/js/customscript.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="relative bg-gray-100 h-auto">
    <x-layouts.flash-message />
    
    <div x-data="{ sidemenu: false }" class="h-screen flex overflow-hidden" x-cloak @keydown.window.escape="sidemenu = false">
        <x-layouts.sidebar :projects="$projects" />
        
        <div class="flex-1 flex-col relative z-0 overflow-y-auto">
            <x-layouts.topbar />
            
            <div class="md:max-w-6xl md:mx-auto px-4 py-8">
                @yield('content')
            </div>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>