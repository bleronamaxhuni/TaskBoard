@props(['task', 'priorities', 'tags'])

<tr class="border-b border-gray-200">
    <td class="px-5 py-5 bg-white text-sm text-center">
        <form action="{{ route('tasks.toggle-favorite', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="focus:outline-none">
                <i class="fa-solid fa-star {{ $task->favorite ? 'text-yellow-400' : 'text-gray-300' }}"></i>
            </button>
        </form>
    </td>

    <td class="px-5 py-5 bg-white text-sm">
        <span class="text-gray-900">{{ $task->project->name }}</span>
    </td>

    <td class="px-5 py-5 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $task->task_title }}
        </p>
    </td>

    <td class="px-5 py-5 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ Str::limit($task->task_description, 50) }}
        </p>
    </td>

    <td class="px-5 py-5 bg-white text-sm text-center">
        <span class="px-3 py-1 rounded-full text-sm
            @switch($task->priority)
                @case('Urgent')
                    bg-red-100 text-red-800
                    @break
                @case('High')
                    bg-orange-100 text-orange-800
                    @break
                @case('Medium')
                    bg-yellow-100 text-yellow-800
                    @break
                @default
                    bg-green-100 text-green-800
            @endswitch
        ">
            {{ $task->priority }}
        </span>
    </td>

    <td class="px-5 py-5 bg-white text-sm text-center">
        <form action="{{ route('tasks.update-progress', $task) }}" method="POST">
            @csrf
            <select name="progress" 
                    onchange="this.form.submit()" 
                    class="rounded-lg px-2 py-1 text-sm font-semibold
                    @switch($task->progress)
                        @case('to do')
                            bg-gray-100 text-gray-800
                            @break
                        @case('doing')
                            bg-blue-100 text-blue-800
                            @break
                        @case('done')
                            bg-green-100 text-green-800
                            @break
                    @endswitch
                    ">
                <option value="to do" {{ $task->progress === 'to do' ? 'selected' : '' }}>To Do</option>
                <option value="doing" {{ $task->progress === 'doing' ? 'selected' : '' }}>Doing</option>
                <option value="done" {{ $task->progress === 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </form>
    </td>

    <td class="px-5 py-5 bg-white text-sm text-center">
        <div class="flex flex-wrap gap-1 justify-center">
            @foreach ($task->tags as $tag)
                <span class="px-2 py-1 text-xs bg-gray-200 rounded-full">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>
    </td>

    <td class="px-5 py-5 bg-white text-sm text-center">
        @if($task->due_date != null)
        <p class="whitespace-no-wrap text-sm focus:outline-none leading-none  text-center">
            @if ($task->due_date)
            <span class="text-red-400 bg-red-50 p-2 border-2  rounded border-red-300">
                {{ $task->due_date?->format('d/m/Y') }}</span>
            @endif
        </p>
        @endif
    </td>

    <td class="px-5 py-5 bg-white text-sm">
        <div class="flex justify-center space-x-2">
            <x-layouts.edit-task :task=$task :priorities=$priorities :tags=$tags></x-layouts.edit-task>

            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button
                    class="rounded-lg px-4 py-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300"
                    onclick="deleteFunction();"> <i class="fa-solid fa-trash"></i> <input
                        type="submit" name="" value="Delete" class="md:hidden">
                </button>
            </form>
        </div>
    </td>
</tr>