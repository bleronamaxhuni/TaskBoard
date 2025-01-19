@extends('layouts.master')

@section('content')
    <div class="flex w-full justify-between py-9">
        <h1 class="text-3xl font-bold">Tasks</h1>
        <x-search />
    </div>

    <x-newtask :priorities="$priorities" :tags="$tags" :projects="$projects"></x-newtask>

    <div class="flex flex-nowrap gap-6 mt-10 min-h-[calc(100vh-200px)] overflow-x-auto pb-6">
        <!-- To Do Column -->
        <div class="flex-1 min-w-[350px] bg-gray-50 rounded-lg p-4">
            <h2 class="font-semibold text-gray-700 mb-4 flex items-center">
                <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                TO DO
            </h2>
            <div class="task-column space-y-3" data-status="to do">
                @foreach ($tasks->where('progress', 'to do') as $task)
                    <div class="task-card bg-white p-4 rounded-lg shadow-sm border border-gray-200 cursor-move relative group"
                        data-task-id="{{ $task->id }}">
                        <div class="absolute top-2 right-2">
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="text-gray-500 hover:text-gray-900 px-[14px] py-[6px] pb-[3px]">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1">
                                        <button @click="$dispatch('open-edit-modal', { task: {
                                            id: {{ $task->id }},
                                            task_title: '{{ $task->task_title }}',
                                            task_description: '{{ $task->task_description }}',
                                            priority: '{{ $task->priority }}',
                                            due_date: '{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}',
                                            tags: {{ json_encode($task->tags->pluck('id')) }}
                                        } })"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </button>

                                        <button
                                            @click="if (confirm('Are you sure you want to delete this task?')) { 
                                                    document.getElementById('delete-task-{{ $task->id }}').submit(); 
                                                }"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                            <i class="fas fa-trash-alt mr-2"></i> Delete
                                        </button>
                                    </div>
                                </div>

                                <!-- Hidden Delete Form -->
                                <form id="delete-task-{{ $task->id }}" action="{{ route('tasks.destroy', $task) }}"
                                    method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>

                        <div class="flex items-start mb-2">
                            <span class="text-sm font-medium text-gray-900">{{ $task->project->name }}</span>
                            <form action="{{ route('tasks.toggle-favorite', $task) }}" method="POST" class="ml-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="focus:outline-none">
                                    <i
                                        class="fa-solid fa-star {{ $task->favorite ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                </button>
                            </form>
                        </div>
                        <h3 class="font-medium mb-2">{{ $task->task_title }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($task->task_description, 50) }}</p>

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

                            @if ($task->due_date)
                                <span class="text-xs text-red-600">
                                    {{ $task->due_date->format('d/m/Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Doing Column -->
        <div class="flex-1 min-w-[350px] bg-gray-50 rounded-lg p-4">
            <h2 class="font-semibold text-gray-700 mb-4 flex items-center">
                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                DOING
            </h2>
            <div class="task-column space-y-3" data-status="doing">
                @foreach ($tasks->where('progress', 'doing') as $task)
                    <div class="task-card bg-white p-4 rounded-lg shadow-sm border border-gray-200 cursor-move relative group"
                        data-task-id="{{ $task->id }}">
                        
                        <div class="absolute top-2 right-2">
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="text-gray-500 hover:text-gray-900 px-[14px] py-[6px] pb-[3px]">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1">
                                        <button @click="$dispatch('open-edit-modal', { task: {
                                            id: {{ $task->id }},
                                            task_title: '{{ $task->task_title }}',
                                            task_description: '{{ $task->task_description }}',
                                            priority: '{{ $task->priority }}',
                                            due_date: '{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}',
                                            tags: {{ json_encode($task->tags->pluck('id')) }}
                                        } })"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </button>

                                        <button
                                            @click="if (confirm('Are you sure you want to delete this task?')) { 
                                                    document.getElementById('delete-task-{{ $task->id }}').submit(); 
                                                }"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                            <i class="fas fa-trash-alt mr-2"></i> Delete
                                        </button>
                                    </div>
                                </div>

                                <!-- Hidden Delete Form -->
                                <form id="delete-task-{{ $task->id }}" action="{{ route('tasks.destroy', $task) }}"
                                    method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>


                        <div class="flex items-start mb-2">
                            <span class="text-sm font-medium text-gray-900">{{ $task->project->name }}</span>
                            <form action="{{ route('tasks.toggle-favorite', $task) }}" method="POST" class="ml-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="focus:outline-none">
                                    <i
                                        class="fa-solid fa-star {{ $task->favorite ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                </button>
                            </form>
                        </div>
                        <h3 class="font-medium mb-2">{{ $task->task_title }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($task->task_description, 50) }}</p>

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

                            @if ($task->due_date)
                                <span class="text-xs text-red-600">
                                    {{ $task->due_date->format('d/m/Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Done Column -->
        <div class="flex-1 min-w-[350px] bg-gray-50 rounded-lg p-4">
            <h2 class="font-semibold text-gray-700 mb-4 flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                DONE
            </h2>
            <div class="task-column space-y-3" data-status="done">
                @foreach ($tasks->where('progress', 'done') as $task)
                    <div class="task-card bg-white p-4 rounded-lg shadow-sm border border-gray-200 cursor-move relative group"
                        data-task-id="{{ $task->id }}">
                        <div class="absolute top-2 right-2">
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="text-gray-500 hover:text-gray-900 px-[14px] py-[6px] pb-[3px]">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1">
                                        <button @click="$dispatch('open-edit-modal', { task: {
                                            id: {{ $task->id }},
                                            task_title: '{{ $task->task_title }}',
                                            task_description: '{{ $task->task_description }}',
                                            priority: '{{ $task->priority }}',
                                            due_date: '{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}',
                                            tags: {{ json_encode($task->tags->pluck('id')) }}
                                        } })"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </button>

                                        <button
                                            @click="if (confirm('Are you sure you want to delete this task?')) { 
                                                    document.getElementById('delete-task-{{ $task->id }}').submit(); 
                                                }"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                            <i class="fas fa-trash-alt mr-2"></i> Delete
                                        </button>
                                    </div>
                                </div>

                                <!-- Hidden Delete Form -->
                                <form id="delete-task-{{ $task->id }}" action="{{ route('tasks.destroy', $task) }}"
                                    method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>

                        <div class="flex items-start mb-2">
                            <span class="text-sm font-medium text-gray-900">{{ $task->project->name }}</span>
                            <form action="{{ route('tasks.toggle-favorite', $task) }}" method="POST" class="ml-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="focus:outline-none">
                                    <i
                                        class="fa-solid fa-star {{ $task->favorite ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                </button>
                            </form>
                        </div>
                        <h3 class="font-medium mb-2">{{ $task->task_title }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($task->task_description, 50) }}</p>

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

                            @if ($task->due_date)
                                <span class="text-xs text-red-600">
                                    {{ $task->due_date->format('d/m/Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div x-data="{
            showEditModal: false,
            taskId: null,
            taskTitle: '',
            taskDescription: '',
            taskPriority: '',
            taskDueDate: '',
            taskTags: [],
            loadTask(task) {
                this.taskId = task.id;
                this.taskTitle = task.task_title;
                this.taskDescription = task.task_description;
                this.taskPriority = task.priority || '';
                this.taskDueDate = task.due_date || '';
                this.taskTags = task.tags || [];
            }
        }" 
        x-on:open-edit-modal.window="showEditModal = true; loadTask($event.detail.task)"
        x-show="showEditModal" 
        class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        
            <!-- Modal Backdrop -->
            <div class="fixed inset-0 bg-black opacity-50"></div>
        
            <!-- Modal Content -->
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6" @click.away="showEditModal = false">
        
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium">Edit Task</h3>
                        <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
        
                    <!-- Edit Form -->
                    <form :action="'/tasks/' + taskId" method="POST">
                        @csrf
                        @method('PATCH')
        
                        <div class="py-4">
                            <!-- Title -->
                            <label for="task_title" class="font-bold mb-1 text-gray-700 block">Title</label>
                            <input type="text" id="task_title" name="task_title" x-model="taskTitle" required
                                class="w-full p-2 mt-2 mb-3 pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
        
                            <!-- Description -->
                            <label for="task_description" class="font-bold mb-1 text-gray-700 block">Description</label>
                            <textarea id="task_description" name="task_description" x-model="taskDescription" required
                                class="w-full p-2 mt-2 mb-3 pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200"></textarea>
        
                            <!-- Tags -->
                            <label for="tags" class="font-bold mb-1 text-gray-700 block">Tags</label>
                            <select multiple="multiple" name="tags[]" id="tags"
                                class="w-full p-2 mt-2 mb-3 pl-4 pr-4 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                                @foreach ($tags as $tag)
                                    <option :selected="taskTags.includes({{ $tag->id }})" value="{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
        
                            <!-- Due Date and Priority -->
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label for="due_date" class="font-bold mb-1 text-gray-700 block">Due Date</label>
                                    <input type="date" id="due_date" name="due_date" x-model="taskDueDate"
                                        class="w-full p-2 mt-2 mb-3 pl-4 pr-4 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                                </div>
        
                                <div>
                                    <label for="priority" class="font-bold mb-1 text-gray-700 block">Priority</label>
                                    <select id="priority" name="priority" x-model="taskPriority"
                                        class="w-full p-2 mt-2 mb-3 pl-4 pr-4 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                                        <option value="" disabled>Select priority</option>
                                        @foreach ($priorities as $priority)
                                            <option value="{{ $priority }}">{{ $priority }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <!-- Buttons -->
                            <div class="py-3 flex justify-between gap-6">
                                <button type="button" @click="showEditModal = false"
                                    class="w-full rounded-lg px-4 py-2 bg-gray-500 text-white hover:bg-gray-600 duration-300">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="w-full rounded-lg px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 duration-300">
                                    Update Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            function dropdown() {
                return {
                    options: [],
                    selected: [],
                    show: false,
                    open() {
                        this.show = true
                    },
                    close() {
                        this.show = false
                    },
                    isOpen() {
                        return this.show === true
                    },
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
                                selected: options[i].getAttribute('selected') != null ? options[i].getAttribute(
                                    'selected') : false
                            });
                        }


                    },
                    selectedValues() {
                        return this.selected.map((option) => {
                            return this.options[option].value;
                        })
                    }
                }
            }
            document.addEventListener('DOMContentLoaded', function() {
                const columns = document.querySelectorAll('.task-column');
                columns.forEach(column => {
                    new Sortable(column, {
                        group: 'tasks',
                        animation: 150,
                        onEnd: function(evt) {
                            const taskId = evt.item.dataset.taskId;
                            const newStatus = evt.to.dataset.status;

                            fetch(`/tasks/${taskId}/progress`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    progress: newStatus
                                })
                            }).catch(error => {
                                console.error('Error:', error);
                                evt.from.appendChild(evt.item);
                            });
                        }
                    });
                });
            });
        </script>
    @endpush

    <style>
        .task-column {
            min-height: 200px;
        }

        .task-card {
            transition: transform 0.2s ease;
        }

        .task-card:hover {
            transform: translateY(-2px);
        }

        .sortable-ghost {
            opacity: 0.5;
        }
    </style>
@endsection
