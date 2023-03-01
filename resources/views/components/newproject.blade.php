<div class="flex justify-center">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="add-button">
        +
    </button>
</div>
<div class="mt-4" id="form-container" style="display: none;">
    <form class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label class="block font-bold mb-2" for="task-name">
                Task Name
            </label>
            <input class="border border-gray-400 p-2 w-full" id="task-name" type="text" placeholder="Enter task name">
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2" for="task-description">
                Task Description
            </label>
            <textarea class="border border-gray-400 p-2 w-full" id="task-description" rows="4"
                placeholder="Enter task description"></textarea>
        </div>
        <div class="flex justify-end">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                Submit
            </button>
        </div>
    </form>
</div>