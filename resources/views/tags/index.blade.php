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
</head>

<body class="relative bg-gray-100 h-auto">
    <div class="text-center">
        @if (Session::has('message'))
        {{Session::get('message')}}
        @endif
    </div>


    <x-layouts.sidebar></x-layouts.sidebar>

    <div class="ml-72 p-4  lg:ml-0 lg:mt-12 lg:w-full">
        <div class="flex w-full justify-between py-9">
            <h1 class="text-3xl font-bold">Tags</h1>
        </div>
    </div>

    <div class="ml-72 w-10/12 px-4 lg:ml-0 lg:w-full">
        <div class="py-8">
            <div class="flex justify-center w-full mb-10">
                <form action="/tags/create" method="POST" class="w-8/12 flex border-2 border-transparent rounded-lg text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-white shadow-sm" >
                    @csrf
                    <input type="text" name="name" value="{{old('name')}}" id="name" placeholder="New Tag" class="w-10/12 relative flex-auto block  px-3 py-1.5 text-base font-normal text-gray-700 bg-clip-padding  focus:border-blue-600 focus:outline-none " required>
                    <button type="submit"
                    class="btn inline-block px-4 py-2  bg-blue-500 text-white rounded-lg focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                    type="button">Create</button> 
                </form>
            </div>
            <table  class="min-w-full leading-normal bg-white">
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
                    @foreach($tags as $tag)
                    <tr class="border-b border-gray-200">
                        <td class="px-5 py-5 bg-white text-sm">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $tag->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 bg-white text-sm text-center">
                            <form action="/tags/{{ $tag['id'] }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="rounded-lg px-4 py-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300"><i
                                        class="fa-solid fa-trash"></i> <input type="submit" name=""
                                        value="Delete" class="md:hidden">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>