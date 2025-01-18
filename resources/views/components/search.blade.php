<div class="w-1/3">
    <form action="{{ route('tasks.index') }}" method="GET" class="relative">
        <input type="text" name="search" placeholder="Search tasks..." value="{{ request('search') }}"
            class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="absolute right-3 top-2.5 text-gray-500">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>