<div x-data="{ showModal : false }"
    x-init="$watch('showModal', (value) => document.body.classList.toggle('overflow-hidden', value))">
    <!-- Button -->
    <button @click="showModal = !showModal"
        class="rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">
        <i class="fa-solid fa-pen-to-square"></i> <span class="md:hidden">Edit</span>
    </button>

    <!-- Modal Background -->
    <div x-show="showModal"
        class="fixed text-gray-500 flex items-center justify-center z-50 bg-black bg-opacity-40 top-0 left-0 right-0 bottom-0"
        x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <!-- Modal -->
        <div x-show="showModal" class="fixed bg-white rounded-xl shadow-2xl p-4  w-5/12" @click.away="showModal = false"
            x-transition:enter="transition ease duration-100 transform"
            x-transition:enter-start="opacity-0 scale-90 translate-y-1"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease duration-100 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-1">
            <div class="py-4">
                <!-- Title -->
                <div class="w-full font-medium block text-xl mb-10">Edit "{{$task->task_title}}"
                </div>
                <!-- Some beer ? -->
                <form action="/tasks/{{$task['id']}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label for="task_title" class="font-bold mb-1 text-gray-700 block">Title</label>
                    <input type="text" name="task_title" value="{{old('task_title', $task['task_title'])}}"
                        id="task_title" required
                        class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                    <label for="task_description" class="font-bold mb-1 text-gray-700 block">Description</label>
                    <textarea
                        class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200"
                        type="text" name="task_description" required> {{old('task_description', $task['task_description'])}}
                </textarea>
                    <label for="tags" class="font-bold mb-1 text-gray-700 block">Tags</label>
                    <select multiple="multiple" name="tags[]"
                        class="w-full p-2 mt-2 mb-3  pl-4 pr-4 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $task->tags->pluck('id')->toArray()) ?
                            'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mb-5 w-full">
                            <div class="relative">
                                <label for="due_date" class="font-bold mb-1 text-gray-700 block">Due Date</label>
                                <input type="date" name="due_date" id="due_date"
                                    value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                                    class="w-full p-2 mt-2 mb-3 pl-4 pr-4 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                            </div>
                        </div>
                        <div class="mb-5 w-full">
                            <label for="priority" class="font-bold mb-1 text-gray-700 block">Select
                                priority</label>
                            <div class="relative">
                                <select id="priority" name="priority"
                                    class="w-full p-2 mt-2 mb-3  pl-4 pr-4 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                                    <option class="hidden" value="" disabled selected>{{old('priority',
                                        $task['priority'])}}</option>
                                    @foreach ($priorities as $priority)
                                    <option value="{{$priority}}">{{ $priority }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="py-3 flex justify-between gap-6">
                        <button @click="showModal = !showModal" type="button"
                            class="w-full rounded-lg px-4 py-2 bg-gray-500 text-white hover:bg-gray-600 duration-300">
                            Cancel
                        </button>
                        <button @click="showModal = !showModal" type="submit"
                            class="w-full rounded-lg px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 duration-300">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>