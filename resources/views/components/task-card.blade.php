<div class="task-card bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-200 border border-gray-200 cursor-move"
    data-task-id="{{ $task->id }}">
    <div class="flex justify-between items-start mb-2">
        <span class="text-sm font-medium text-gray-900">{{ $task->project->name }}</span>
        <div class="flex items-center space-x-2">
            <form action="{{ route('tasks.toggle-favorite', $task) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="focus:outline-none">
                    <i
                        class="fa-solid fa-star {{ $task->favorite ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition-colors duration-200"></i>
                </button>
            </form>
            <div class="relative" x-data="dropdown()">
                <button @click="toggle()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div x-show="open" @click.away="close()"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <button
                        onclick="openEditModal('{{ $task->id }}', '{{ $task->task_title }}', '{{ $task->task_description }}', '{{ $task->priority }}', '{{ $task->due_date }}')"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                    </button>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left"
                            onclick="return confirm('Are you sure you want to delete this task?')">
                            <i class="fa-solid fa-trash mr-2"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h3 class="font-medium mb-2">{{ $task->task_title }}</h3>
    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($task->task_description, 100) }}</p>
    @if ($task->tags->count() > 0)
        <div class="flex -space-x-1 mb-3">
            @foreach ($task->tags as $tag)
                <div
                    class="w-2 h-6 first:rounded-l-full last:rounded-r-full shadow-sm
                    {{ match ($tag->color) {
                        'yellow' => 'bg-yellow-500',
                        'red' => 'bg-red-500',
                        'blue' => 'bg-blue-500',
                        'green' => 'bg-green-500',
                        'orange' => 'bg-orange-500',
                        default => 'bg-gray-500',
                    } }}">
                </div>
            @endforeach
        </div>
    @endif
    <div class="flex justify-between items-center">
        @if ($task->priority)
            <span
                class="px-2 py-1 text-xs rounded-full
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
                @endswitch">
                {{ $task->priority }}
            </span>
        @endif
        @if ($task->due_date)
            <span
                class="text-xs {{ Carbon\Carbon::parse($task->due_date)->isPast() ? 'text-red-600' : 'text-gray-500' }}">
                {{ Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
            </span>
        @endif
    </div>
</div>
