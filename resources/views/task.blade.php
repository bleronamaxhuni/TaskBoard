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
    <x-layouts.sidebar></x-layouts.sidebar>


    <div class="text-center">
        @if (Session::has('message'))
        {{Session::get('message')}}
        @endif
        @if($errors->has('task_title'))
        {{$errors->first('task_title')}}
        @endif
        @if($errors->has('task_description'))
        {{$errors->first('task_description')}}
        @endif
    </div>

    <div class="ml-72 p-4  lg:ml-0 lg:mt-12 lg:w-full">
        <div class="flex w-full justify-between py-9">
            <h1 class="text-3xl font-bold">Tasks</h1>
            <x-layouts.search></x-layouts.search>
        </div>
        <x-layouts.newtask></x-layouts.newtask>
    </div>

    <div class="ml-72 w-10/12 px-4 lg:ml-0 lg:w-full">
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <x-layouts.tabletitles></x-layouts.tabletitles>
                        <tbody>
                            @forelse($tasks as $task)
                            <tr class="border-b border-gray-200">
                                <td class="px-5 py-5 bg-white text-sm">
                                    <div class="flex">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $task->task_title }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ Str::limit($task->task_description,
                                        25) }}</p>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    @if($task->due_date != null)
                                    <p
                                        class="whitespace-no-wrap py-3 px-3 text-sm focus:outline-none leading-none text-red-700 bg-red-100 rounded text-center">
                                        @if ($task->due_date)
                                        <span class="text-red-400">
                                            {{ $task->due_date?->diffForHumans() }}</span>
                                        @endif
                                    </p>
                                    @endif
                                </td>
                                <td class="px-5 py-5 bg-white text-sm text-center">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                        <span
                                            class="p-2 rounded-full @if ($task->completed_at == null) not completed @else completed @endif">
                                            @if ($task->completed_at == null)Not Completed
                                            @else Completed
                                            @endif
                                        </span>
                                    </span>
                                </td>
                                <td
                                    class="px-5 py-5 bg-white text-sm flex justify-center md:grid md:grid-cols-2 md:justify-items-center gap-2">
                                    <button
                                        class="rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300"><a
                                            href="/tasks/{{ $task['id'] }}/edit"><i
                                                class="fa-solid fa-pen-to-square"></i> <span
                                                class="md:hidden">Edit</span></a></button>
                                    <form action="/tasks/{{ $task['id'] }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="rounded-lg px-4 py-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300"><i
                                                class="fa-solid fa-trash"></i> <input type="submit" name=""
                                                value="Delete" class="md:hidden"></button>
                                    </form>
                                </td>
                                @empty
                                <td class="px-5 py-5 text-bold">Task Not Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</body>
</html>