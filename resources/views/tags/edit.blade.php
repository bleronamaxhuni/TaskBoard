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
    <x-layouts.sidebar></x-layouts.sidebar>


    <div class="text-center">
        @if (Session::has('message'))
        {{Session::get('message')}}
        @endif
    </div>
    <div class="ml-72 w-10/12 px-4 py-9 p-4 sm:px-8">
        <h1 class="text-3xl font-bold">Edit Tag</h1>
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg">
                    <table class="min-w-full leading-normal">
                        <x-layouts.edit-tag :tag=$tag></x-layouts.edit-tag>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>