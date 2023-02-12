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
                    <img src="{{ asset('/images/badge.png') }}" class="h-6 mr-3 sm:h-7" />
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
                <img src="{{ asset('/images/badge.png') }}" class="h-6 mr-3 sm:h-7" />
                <span class="self-center font-semibold whitespace-nowrap ">TaskBoard</span>
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
                <span class="font-semibold text-gray-600 mt-5">Projects</span>
                <hr>
                <a href="{!!url('/projects')!!}"
                    class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700  hover:text-blue-600 hover:bg-gray-200">
                    Projects
                </a>
            </li>
            <li>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#createProjectForm" aria-expanded="false" aria-controls="createProjectForm">
                    <i class="fas fa-plus"></i>
                </button>                
                <!-- Form to create a new project -->
                <div class="collapse" id="createProjectForm">
                    <div class="card card-body">
                        <form action="{{ route('projects.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Project Name" name="project_name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Project</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- @end Menu Above Medium Screen -->