<div class="2xl:hidden lg:block">
    <div @click="sidemenu = false"
        class="fixed inset-0 z-30 bg-gray-600 opacity-0 pointer-events-none transition-opacity ease-linear duration-300"
        :class="{'opacity-75 pointer-events-auto': sidemenu, 'opacity-0 pointer-events-none': !sidemenu}">
    </div>

    <!-- Small Screen Menu -->
    <div class="fixed inset-y-0 left-0 flex flex-col z-40 max-w-xs w-full bg-white transform ease-in-out duration-300 -translate-x-full"
        :class="{'translate-x-0': sidemenu, '-translate-x-full': !sidemenu}">

        <!-- Brand Logo / Name -->
        <div class="flex items-center px-6 py-3 h-16">
            <div class="text-2xl font-bold tracking-tight text-gray-800">
                <a href="/" class="flex items-center pt-4 mb-5">
                    <img src="{{ asset('/images/badge.png') }}" class="h-8 mr-3 sm:h-7" />
                    <span class="self-center font-semibold whitespace-nowrap ">TaskBoard</span>
                </a>
            </div>
        </div>
        <!-- @end Brand Logo / Name -->

        <div class="px-4 py-2 flex-1 h-0 overflow-y-auto">
            {{-- small sc navbar --}}
            <ul>
                <li>
                    <a href="{!! url('/') !!}"
                        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <rect x="4" y="4" width="6" height="6" rx="1" />
                            <rect x="14" y="4" width="6" height="6" rx="1" />
                            <rect x="4" y="14" width="6" height="6" rx="1" />
                            <rect x="14" y="14" width="6" height="6" rx="1" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{!! url('/tasks') !!}"
                        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700  hover:text-blue-600 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <circle cx="12" cy="12" r="9" />
                            <polyline points="12 7 12 12 9 15" />
                        </svg>
                        Tasks
                    </a>
                </li>

                <li>
                    <a href="{!! url('/tags') !!}"
                        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700  hover:text-blue-600 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <path
                                d="M16 6h3a 1 1 0 011 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                            <line x1="8" y1="8" x2="12" y2="8" />
                            <line x1="8" y1="12" x2="12" y2="12" />
                            <line x1="8" y1="16" x2="12" y2="16" />
                        </svg>
                        Tags
                    </a>
                </li>

            </ul>
        </div>

    </div>
    <!-- @end Small Screen Menu -->
</div>


<!-- Menu Above Medium Screen -->
<div class="bg-white w-64 min-h-screen overflow-y-auto hidden 2xl:block lg:hidden shadow relative z-30">

    <!-- Brand Logo / Name -->
    <div class="flex items-center px-6 py-3 h-16">
        <div class="text-2xl font-bold tracking-tight text-gray-800">
            <a href="/" class="flex items-center pt-4 mb-5">
                <img src="{{ asset('/images/badge.png') }}" class="h-9 mr-3 sm:h-7" />
                <span class="self-center font-semibold whitespace-nowrap text-lg mt-4">TaskBoard</span>
            </a>
        </div>
    </div>
    <!-- @end Brand Logo / Name -->

    <div class="px-4 py-2">
        {{-- bigger sc nav --}}
        <ul>
            <li>
                <a href="{!! url('/') !!}"
                    class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700  hover:text-blue-600 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <rect x="4" y="4" width="6" height="6" rx="1" />
                        <rect x="14" y="4" width="6" height="6" rx="1" />
                        <rect x="4" y="14" width="6" height="6" rx="1" />
                        <rect x="14" y="14" width="6" height="6" rx="1" />
                    </svg>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{!! url('/tasks') !!}"
                    class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700  hover:text-blue-600 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="12" cy="12" r="9" />
                        <polyline points="12 7 12 12 9 15" />
                    </svg>
                    Tasks
                </a>
            </li>

            <li>
                <a href="{!! url('/tags') !!}"
                    class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700  hover:text-blue-600 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <path
                            d="M16 6h3a 1 1 0 011 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                        <line x1="8" y1="8" x2="12" y2="8" />
                        <line x1="8" y1="12" x2="12" y2="12" />
                        <line x1="8" y1="16" x2="12" y2="16" />
                    </svg>
                    Tags
                </a>
            </li>
            <li>
                <button
                    class="font-medium text-gray-700  hover:text-blue-600 bg-gray-100 hover:bg-gray-200 py-1 px-2 rounded flex justify-between w-full"
                    id="add-button">
                    <span>
                        Create a new project
                    </span>
                    <span>
                        <i class="fas fa-plus"></i>
                    </span>
                </button>

                <div id="form-container" class="hidden" class="w-full">
                    <form action="/projects/create" method="POST" class="w-full" onchange="this.form.submit()">
                        @csrf
                        <input type="text" name="name" value="{{old('name')}}" id="name" placeholder="New Project"
                            class="w-full border-2 rounded p-1 border-blue-400 outline-none mt-3" required>
                    </form>
                </div>
            </li>
            <li>
                <h1 class="mt-5 px-2 py-2 rounded-lg flex items-center font-medium text-lg text-gray-700">All Projects</h1>
                <hr class="mb-2">
                @if($projects)
                    @foreach($projects as $project)
                    <div
                        class="flex justify-between items-center bg-gray-100 p-2 mb-2 rounded border-2 border-transparent font-medium text-gray-700 hover:bg-gray-200">
                        {{-- <a href="/projects/{{ $project['id'] }}/tasks">
                            <div class="">
                                <p class="text-gray-900 whitespace-no-wrap text-base font-semibold">
                                    {{ $project->name }}
                                </p>
                            </div>
                        </a> --}}
                        <div x-data="{dropdownMenu: false}" class="relative">
                            <!-- Dropdown toggle button -->
                            <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2  rounded-md w-full">
                                <span class=""> {{ $project->name }} </span>
                            </button>
                            <!-- Dropdown list -->
                            <div x-show="dropdownMenu"
                                class="relative right-0 py-2 mt-2 bg-gray-100 rounded-md shadow-xl w-full">
                                <a href="/projects/{{$project['id']}}/tasks"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400 hover:text-white">
                                    Tasks
                                </a>
                                {{-- <a href="/projects/{{$project->id}}/members"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400 hover:text-white">
                                    Members
                                </a>  --}}
                            </div>
                        </div>
                        <div class="flex gap-1 ">
                            <button class="edit-button rounded p-1 text-blue-600 hover:text-white hover:bg-blue-600">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form action="/projects/{{ $project['id']}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="rounded p-1 text-red-600 hover:text-white hover:bg-red-700 duration-300">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="edit-form" style="display: none;">
                        <form action="/projects/{{$project['id']}}/updated" method="POST">
                            @csrf
                            @method('PATCH')
                            <input class="w-full bg-gray-100  mb-3 p-1 rounded h-11 border-2 border-gray-700" type="text"
                                placeholder="Project Name" name="name" value="{{old('name', $project['name'])}}" required>
                        </form>
                    </div>
                    @endforeach
                @endif
            </li>
        </ul>
    </div>
</div>
<!-- @end Menu Above Medium Screen -->
<script>
    const addButton = document.getElementById('add-button');
    const formContainer = document.getElementById('form-container');

    addButton.addEventListener('click', function() {
    formContainer.classList.toggle('hidden');
    });
    const editButtons = document.querySelectorAll('.edit-button');
    const editForms = document.querySelectorAll('.edit-form');

    editButtons.forEach((button, index) => {
    button.addEventListener('click', function() {
        editForms[index].style.display = editForms[index].style.display === 'none' ? 'block' : 'none';
        });
    });
</script>