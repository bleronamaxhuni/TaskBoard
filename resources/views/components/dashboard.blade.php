@php
$currentUserId = Auth::id(); // assuming you're using Laravel's built-in authentication
$tasks = DB::table('tasks')
            ->where('user_id', $currentUserId)
            ->orderBy('favorite')
            ->take(4)
            ->get();
@endphp
<div class="flex-1 flex-col relative z-0 overflow-y-auto">
    <x-layouts.topbar></x-layouts.topbar>
    <div class="md:max-w-6xl md:mx-auto px-4 py-8">
        {{-- <div class="pb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        {{ __(Auth::user()->name .", you're logged in!") }}
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Dashboard</h2>
            <a href="{!!url('/tasks')!!}"> <button
                class="shadow inline-flex items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-4 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Create New Tasks
            </button></a>
        </div>


        <div class="grid grid-cols-4 gap-6 py-5">
            <div class="grid mt-5">
                <a class="transform  hover:scale-105 transition duration-300 shadow-lg rounded-lg intro-y bg-white"
                    href="#">
                    <div class="p-5">
                        <div class="flex justify-between">
                            <i class="fa-solid fa-stopwatch text-3xl ml-1 text-blue-900"></i>
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-3 text-3xl font-bold leading-8">{{ auth()->user()->tasks()->count() }}</div>

                                <div class="mt-1 text-base text-gray-600">Total Tasks</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid mt-5">
                <a class="transform  hover:scale-105 transition duration-300 shadow-lg rounded-lg intro-y bg-white"
                    href="#">
                    <div class="p-5">
                        <div class="flex justify-between">
                            <i class="fa-solid fa-stopwatch text-3xl ml-1 text-blue-900"></i>
                            <div
                                class="bg-green-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                <span class="flex items-center">
                                    @php
                                    $totalTasks = auth()->user()->tasks()->count();
                                    $completedTasks = auth()->user()->tasks()->where('progress', 'done')->count();
                                    $percentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                                    @endphp
                                    <p>{{ $percentage }}%</p>
                                </span>
                            </div>
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-3 text-3xl font-bold leading-8">
                                    @php
                                    $count = App\Models\Task::where('user_id', auth()->id())->where('progress', 'done')->count();
                                    echo $count;
                                    @endphp
                                </div>
                                <div class="mt-1 text-base text-gray-600">Completed Tasks</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid mt-5">
                <a class="transform  hover:scale-105 transition duration-300 shadow-lg rounded-lg intro-y bg-white"
                    href="#">
                    <div class="p-5">
                        <div class="flex justify-between">
                            <i class="fa-solid fa-stopwatch text-3xl ml-1 text-blue-900"></i>
                            <div
                                class="bg-green-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                <span class="flex items-center">
                                    @php
                                        $totalTasks = auth()->user()->tasks()->count();
                                        $completedTasks = auth()->user()->tasks()->where('progress', 'doing')->count();
                                        $percentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                                    @endphp
                                    <p>{{ $percentage }}%</p>
                                </span>
                            </div>
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-3 text-3xl font-bold leading-8">    
                                    @php
                                    $count = App\Models\Task::where('user_id', auth()->id())->where('progress', 'doing')->count();
                                    echo $count;
                                    @endphp
                                </div>
                                <div class="mt-1 text-base text-gray-600">Tasks in progress</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid mt-5">
                <a class="transform  hover:scale-105 transition duration-300 shadow-lg rounded-lg intro-y bg-white"
                    href="#">
                    <div class="p-5">
                        <div class="flex justify-between">
                            <i class="fa-solid fa-stopwatch text-3xl ml-1 text-blue-900"></i>
                            <div
                                class="bg-green-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                <span class="flex items-center">
                                    @php
                                        $totalTasks = auth()->user()->tasks()->count();
                                        $completedTasks = auth()->user()->tasks()->where('progress', 'to do')->count();
                                        $percentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                                    @endphp
                                    <p>{{ $percentage }}%</p>
                                </span>
                            </div>
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-3 text-3xl font-bold leading-8">    
                                    @php
                                    $count = App\Models\Task::where('user_id', auth()->id())->where('progress', 'to do')->count();
                                    echo $count;
                                    @endphp
                                </div>
                                <div class="mt-1 text-base text-gray-600">To Do Tasks</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="flex items-center justify-between mb-4 flex-col">
            <div class="flex w-full justify-between py-4">
                <h2 class="text-xl font-bold text-gray-800">Last Tasks</h2>
                <a href="{!!url('/tasks')!!}" class="text-blue-600 hover:text-blue-500 font-medium">View all</a>
            </div>
            <table class="min-w-full leading-normal bg-white">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Title
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Description
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Priority
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Deadline
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50  text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr class="border-b border-gray-200">
                        <td
                            class="px-5 py-5 bg-white text-sm flex justify-center md:grid md:grid-cols-2 md:justify-items-center gap-2 h-full">
                            <form action="/tasks/{{ $task->id }}/favorite" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">
                                    <i
                                        class="fa-solid fa-star {{ $task->favorite ? 'favorite' : 'unfavorite' }}"></i>
                                </button>
                            </form>
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
                            <form method="POST" action="/tasks/{{ $task->id }}/progress">
                                @csrf
                                <option class="hidden" value="" disabled selected>{{old('progress',
                                    $task->progress)}}</option>
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
                            @if($task->due_date != null)
                                <p class="whitespace-no-wrap text-sm focus:outline-none leading-none text-center">
                                    @php
                                        $dueDate = \DateTime::createFromFormat('Y-m-d H:i:s', $task->due_date);
                                    @endphp
                                    @if ($dueDate instanceof \DateTime)
                                        <span class="text-red-400 bg-red-50 p-2 border-2 rounded border-red-300">
                                            {{ $dueDate->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </p>
                            @endif
                        </td>
                        <td
                            class="px-5 py-5 bg-white text-sm flex justify-center md:grid md:grid-cols-2 md:justify-items-center gap-2 h-full">
                            <button
                                class="rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300"><a
                                    href="/tasks/{{ $task->id }}/edit"><i
                                        class="fa-solid fa-pen-to-square"></i> <span
                                        class="md:hidden">Edit</span></a>
                            </button>
                            <form action="/tasks/{{ $task->id }}" method="POST">
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
        </div>
    </div>
</div>