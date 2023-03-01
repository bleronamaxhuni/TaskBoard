<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="relative bg-gray-100 h-auto">
    <div x-data="{ sidemenu: false }" class="h-screen flex overflow-hidden" x-cloak
        @keydown.window.escape="sidemenu = false">
        @php
            $projects = \App\Models\Projects::all();
        @endphp
        <x-layouts.sidebar :projects=$projects></x-layouts.sidebar>
        <x-dashboard></x-dashboard>
    </div>
</body>
</html>