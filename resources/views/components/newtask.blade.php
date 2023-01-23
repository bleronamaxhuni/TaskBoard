<div class="flex w-full justify-end ml-[-35px] lg:ml-0">
    <button class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700" onclick="toggleModal()">New
        Task</button>
</div>
<div class="flex w-full justify-end ml-[-35px] lg:ml-0">
    <div class="overflow-y-auto top-0 w-8/12 lg:w-full p-8 rounded-lg hidden shadow-lg shadow-gray-300 bg-white mt-4"
        id="modal">
        <form action="/tasks/create" method="POST">
            @csrf
            <label for="task_title" class="font-bold mb-1 text-gray-700 block">Title</label>
            <input type="text" name="task_title" value="{{old('task_title')}}" id="task_title" required
                class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
            <label for="task_description" class="font-bold mb-1 text-gray-700 block">Description</label>
            <textarea type="text" name="task_description" value="{{old('task_description')}}" required
                class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200" id="task_description"></textarea>
            <label class="block">
                <label for="tags" class="font-bold mb-1 text-gray-700 block">Tags</label>
                <select name="tags[]" class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200" multiple>
                    @foreach ($tags as $tag )
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>                        
                    @endforeach
                </select>
            </label>
            <div class="grid grid-cols-2 gap-2">
                <div class="mb-5 w-full">
                    <div class="relative">
                        <label for="due_date" class="font-bold mb-1 text-gray-700 block">Due Date</label>
                        <input type="date" name="due_date" value="{{old('due_date')}}" id="due_date"
                        class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                    </div>
                </div>
                <div class="mb-5 w-full">
                    <label for="priority" class="font-bold mb-1 text-gray-700 block">Select priority</label>
                    <div class="relative">
                        <select id="priority" name="priority"
                            class="w-full p-2 mt-2 mb-3  pl-4 pr-10 pt-3 pb-[10px] leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                            @foreach ($priorities as $priority)
                            <option value="{{$priority}}">{{ $priority }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
                <div class="py-3 flex justify-between">
                    <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
                        onclick="toggleModal()">Cancel</button>
                    <button type="submit"
                        class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2">Create</button>
                </div>
        </form>
    </div>
</div>