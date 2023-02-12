<tbody>
    <thead>
        <tr>
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
            {{-- <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Status
            </th> --}}
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Tags
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
    <tr>
        <form action="/tasks/{{$task['id']}}" method="POST">
            @csrf
            @method('PATCH')
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <input class="w-full bg-gray-100 mt-[11px] mb-3 p-2 rounded-sm h-11" type="text" placeholder="Task Name"
                    name="task_title" value="{{old('task_title', $task['task_title'])}}" required>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <textarea class="w-full bg-gray-100 mt-[16px] mb-3 p-2 rounded-sm h-11 resize-none" type="text"
                    name="task_description" required> {{old('task_description', $task['task_description'])}}</textarea>
            </td>
            <td class="px-5 py-5 bg-white text-sm">
                <select id="priority" name="priority" class="w-full bg-gray-200 p-2 mt-2 mb-3 rounded-sm">
                    <option class="hidden" value="" disabled selected>{{old('priority', $task['priority'])}}</option>
                    @foreach ($priorities as $priority)
                    <option value="{{$priority}}">{{ $priority }}</option>
                    @endforeach
                </select>
            </td>
            {{-- <td
                class="px-5 py-5 bg-white text-sm flex justify-center md:grid md:grid-cols-2 md:justify-items-center gap-2 h-full">
                <form method="POST" action="/tasks/{{ $task['id'] }}/progress">
                    @csrf
                    <option class="hidden" value="" disabled selected>{{old('progress', $task['progress'])}}</option>
                    <select name="progress" class="progress p-1 rounded font-semibold
                                        @if ($task->progress === 'to do')
                                            todo
                                            @elseif ($task->progress === 'doing')
                                            doing
                                            @elseif ($task->progress === 'done')
                                            done
                                        @endif" onchange="this.form.submit()">
                        <option value="to do" {{ $task->progress === 'to do' ? 'selected' : '' }}>To do</option>
                        <option value="doing" {{ $task->progress === 'doing' ? 'selected' : '' }}>Doing</option>
                        <option value="done" {{ $task->progress === 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </form>
            </td> --}}
            <td class="px-5 py-5 bg-white text-sm">
                <select multiple="multiple" name="tags[]">
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $task->tags->pluck('id')->toArray()) ?
                        'selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <input type="date" name="due_date" id="due_date"
                    value="{{ old('due_date', $task['due_date']->format('Y-m-d'))}}">
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700">Update
                    Task</button>
            </td>
        </form>
    </tr>
</tbody>