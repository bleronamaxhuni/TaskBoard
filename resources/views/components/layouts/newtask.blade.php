<div class="flex w-full justify-end ml-[-35px] lg:ml-0">
    <button class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700" onclick="toggleModal()">New
        Task</button>
</div>
<div class="flex w-full justify-end ml-[-35px] lg:ml-0">
    <div class="overflow-y-auto top-0 w-8/12 lg:w-full bg-white p-8 rounded-lg hidden shadow-lg shadow-gray-300 bg-white mt-4"
        id="modal">
        <form action="/tasks/create" method="POST">
            @csrf
            <input type="text" placeholder="Task Name" name="task_title" value="{{old('task_title')}}" required
                class="w-full bg-gray-200 p-2 mt-2 mb-3 rounded-sm">
            <textarea type="text" placeholder="Task Description" name="task_description"
                value="{{old('task_description')}}" required
                class="w-full bg-gray-200 p-2 mt-2 mb-3 rounded-sm resize-none"></textarea>
                <input type="date" name="due_date" value="{{old('due_date')}}"
                class="w-full bg-gray-200 p-2 mt-2 mb-3 rounded-sm">
            <div class="py-3 flex justify-between">
                <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
                    onclick="toggleModal()">Cancel</button>
                <button type="submit"
                    class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2">Create</button>
            </div>
        </form>
    </div>
</div>