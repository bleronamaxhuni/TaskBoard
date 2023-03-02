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

<body class="relative bg-gray-100 h-full">
    <div class="text-center">
        @if (Session::has('message'))
        {{Session::get('message')}}
        @endif
    </div>
    <div x-data="{ sidemenu: false }" class="h-screen flex overflow-hidden" x-cloak
    @keydown.window.escape="sidemenu = false">
    <x-layouts.sidebar :projects="$projects"></x-layouts.sidebar>
    <div class="flex-1 flex-col relative z-0 overflow-y-auto">
        <x-layouts.topbar></x-layouts.topbar>
        <div class="md:max-w-6xl md:mx-auto px-4 py-8">
            <div class="py-4 lg:mt-12 lg:w-full">
                <div class="flex w-full justify-between py-9">
                    <h1 class="text-3xl font-bold">Edit Task</h1>
                </div>
            </div>
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <x-layouts.edit-tag :tag="$tag"></x-layouts.edit-tag>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>