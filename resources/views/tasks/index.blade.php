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
        @if (Session::has('error'))
        {{Session::get('error')}}
        @endif
    </div>

    <div x-data="{ sidemenu: false }" class="h-screen flex overflow-hidden" x-cloak
        @keydown.window.escape="sidemenu = false">
        <x-layouts.sidebar :projects=$projects></x-layouts.sidebar>
        <div class="flex-1 flex-col relative z-0 overflow-y-auto">
            <x-layouts.topbar></x-layouts.topbar>
            <div class="md:max-w-6xl md:mx-auto px-4 py-8">
                <div class="py-4 lg:mt-12 lg:w-full">
                    <div class="flex w-full justify-between py-9">
                        <h1 class="text-3xl font-bold">Tasks</h1>
                        <x-search></x-search>
                    </div>
                    <x-newtask :priorities="$priorities" :tags="$tags" :projects="$projects"></x-newtask>
                </div>
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden mt-10">
                    <table class="min-w-full leading-normal bg-white">
                        <x-layouts.tabletitles></x-layouts.tabletitles>
                        <tbody>
                            @forelse($tasks as $task)
                            <tr class="border-b border-gray-200">
                                <td
                                    class="px-5 py-5 bg-white text-sm flex justify-center md:grid md:grid-cols-2 md:justify-items-center gap-2 h-full">
                                    <form action="/tasks/{{ $task['id'] }}/favorite" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit">
                                            <i
                                                class="fa-solid fa-star {{ $task->favorite ? 'favorite' : 'unfavorite' }}"></i>
                                        </button>
                                    </form>
                                </td>
                                <td  class="px-5 py-5 bg-white text-sm">
                                    <span>{{ $task->project->name }}</span>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <div class="flex">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $task->task_title }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{$task->task_description}}</p>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <p
                                        class="whitespace-no-wrap text-sm focus:outline-none leading-none  rounded text-center">
                                        <span class="px-3 py-2
                                        @if ($task->priority == 'High')
                                            high
                                            @elseif ($task->priority == 'Medium')
                                            medium
                                            @elseif ($task->priority == 'Low')
                                            low
                                            @elseif ($task->priority == 'Urgent')
                                            urgent
                                        @endif">
                                            {{$task->priority}}
                                        </span>
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 bg-white text-sm flex justify-center md:grid md:grid-cols-2 md:justify-items-center gap-2 h-full">
                                    <form method="POST" action="/tasks/{{ $task['id'] }}/progress">
                                        @csrf
                                        <option class="hidden" value="" disabled selected>{{old('progress',
                                            $task['progress'])}}</option>
                                        <select name="progress" class="progress p-1 rounded font-semibold
                                        @if ($task->progress === 'to do')
                                            todo
                                            @elseif ($task->progress === 'doing')
                                            doing
                                            @elseif ($task->progress === 'done')
                                            done
                                        @endif" onchange="this.form.submit()">
                                            <option value="to do" {{ $task->progress === 'to do' ? 'selected' : '' }}>To
                                                do</option>
                                            <option value="doing" {{ $task->progress === 'doing' ? 'selected' : ''
                                                }}>Doing</option>
                                            <option value="done" {{ $task->progress === 'done' ? 'selected' : '' }}>Done
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <p class="whitespace-no-wrap text-sm focus:outline-none leading-none  text-center">
                                        <span>
                                            @foreach ($task->tags as $tag)
                                            <span
                                                class="text-black bg-gray-300 p-2 border-2 border-gray-300  rounded-2xl">{{
                                                $tag->name }}</span>
                                            @endforeach
                                        </span>
                                    </p>                                
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    @if($task->due_date != null)
                                    <p class="whitespace-no-wrap text-sm focus:outline-none leading-none  text-center">
                                        @if ($task->due_date)
                                        <span class="text-red-400 bg-red-50 p-2 border-2  rounded border-red-300">
                                            {{ $task->due_date?->format('d/m/Y') }}</span>
                                        @endif
                                    </p>
                                    @endif
                                </td>

                                {{-- <td class="px-5 py-5 bg-white text-sm text-center">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                        <form action="/tasks/{{ $task['id'] }}/completed" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            @if ($task->completed_at == null)
                                            <button type="submit" class="p-2 rounded bg-red-300 text-red-900">Not
                                                Completed</button>
                                            @else
                                            <button type="submit"
                                                class="p-2 rounded bg-green-300 text-green-900">Completed</button>
                                            @endif
                                        </form>
                                    </span>
                                </td> --}}
                                <td
                                    class="px-5 py-5 bg-white text-sm flex justify-center md:grid md:grid-cols-2 md:justify-items-center gap-2 h-full">
                                    <button
                                        class="rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300"><a
                                            href="/tasks/{{ $task['id'] }}/edit"><i
                                                class="fa-solid fa-pen-to-square"></i> <span
                                                class="md:hidden">Edit</span></a>
                                    </button>
                                    <form action="/tasks/{{ $task['id'] }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="rounded-lg px-4 py-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300"
                                            onclick="deleteFunction();"> <i class="fa-solid fa-trash"></i> <input
                                                type="submit" name="" value="Delete" class="md:hidden">
                                        </button>
                                    </form>
                                </td>
                                @empty
                                <td class="px-5 py-5 text-bold">Task Not Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="flex flex-row w-full justify-center bg-white p-3">
                        {{ $tasks->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function dropdown() {
            return {
                options: [],
                selected: [],
                show: false,
                open() { this.show = true },
                close() { this.show = false },
                isOpen() { return this.show === true },
                select(index, event) {

                    if (!this.options[index].selected) {

                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);

                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
                },
                remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);


                },
                loadOptions() {
                    const options = document.getElementById('select').options;
                    for (let i = 0; i < options.length; i++) {
                        this.options.push({
                            value: options[i].value,
                            text: options[i].innerText,
                            selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                        });
                    }


                },
                selectedValues(){
                    return this.selected.map((option)=>{
                        return this.options[option].value;
                    })
                }
            }
        }
    </script>
</body>

</html>