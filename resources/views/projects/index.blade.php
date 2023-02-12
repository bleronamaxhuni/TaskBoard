<!DOCTYPE html>
<html lang="en">
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
    <script src="/js/customscript.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
</head>

<body class="relative bg-gray-100 h-auto">
    <div x-data="{ sidemenu: false }" class="h-screen flex overflow-hidden" x-cloak
        @keydown.window.escape="sidemenu = false">
        <x-layouts.sidebar></x-layouts.sidebar>
        <div class="flex-1 flex-col relative z-0 overflow-y-auto">
            <x-layouts.topbar></x-layouts.topbar>
            <div class="md:max-w-6xl md:mx-auto px-4 py-8">
                <div class="flex w-full justify-between py-9">
                    <h1 class="text-3xl font-bold">Projects</h1>
                </div>
                <div class="pt-4">
                    <div class="flex justify-end w-full mb-5">
                        <form action="/projects/create" method="POST"
                            class="w-5/12 flex border-2 border-transparent rounded-lg text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-white shadow-sm">
                            @csrf
                            <input type="text" name="name" value="{{old('name')}}" id="name" placeholder="New Project"
                                class="w-10/12 relative flex-auto block  px-3 py-1.5 text-base font-normal text-gray-700 bg-clip-padding  focus:border-blue-600 focus:outline-none "
                                required>
                            <button type="submit"
                                class="btn inline-block px-4 py-2  bg-blue-500 text-white rounded-lg focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                                type="button">Create</button>
                        </form>
                    </div>
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden mt-10">
                        <table class="min-w-full leading-normal bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50  text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr class="border-b border-gray-200">
                                    <td class="px-5 py-5 bg-white text-sm">
                                        <div class="flex">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $project->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 bg-white text-sm flex justify-center md:grid md:grid-cols-2 md:justify-items-center gap-2 h-full">
                                        <button
                                            class="rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300"><a
                                                href=""><i class="fa-solid fa-pen-to-square"></i> <span
                                                    class="md:hidden">Edit</span></a>
                                        </button>
            
                                        <form action="/projects/{{ $project['id'] }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="rounded-lg px-4 py-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300"><i
                                                    class="fa-solid fa-trash"></i> <input type="submit" name="" value="Delete"
                                                    class="md:hidden">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</body>
</html>