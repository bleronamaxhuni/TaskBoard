<div class="w-64 fixed inset-y-0 left-0" aria-label="Sidebar">
    <div class="flex flex-no-wrap">
        <div class="w-64 absolute sm:relative bg-gray-50 shadow h-full flex-col justify-between flex lg:hidden">
            <div class="px-3 py-4">
                <div class="h-16 w-full flex items-center">
                    <a href="/" class="flex items-center pl-2.5 mb-5">
                        <img src="{{ asset('/images/badge.png') }}" class="h-6 mr-3 sm:h-7" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap ">TaskBoard</span>
                    </a>
                </div>
                <ul class="space-y-2">
                    <div x-data="{ open: false }" class="relative">
                        <button x-on:click="open = true"
                            class="flex items-center justify-between p-1 text-base font-normal text-gray-900 cursor-pointer mb-1 rounded  hover:bg-gray-200 w-full"
                            type="button">
                            <span class="mr-1 whitespace-nowrap font-semibold text-base ">{{Auth::user()->name}}</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                style="margin-top:3px">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </button>
                        <ul x-show="open" x-on:click.away="open = false"
                            class="bg-gray-50 text-gray-700 rounded shadow-lg relative py-2 mt-1 w-full p-3">
                            <li class="flex w-full">
                                <a href="{!! url('/profile') !!}"
                                    class="flex items-center p-1 text-base font-normal text-gray-900 cursor-pointer mb-1 rounded  hover:bg-gray-200 w-full">
                                    <i
                                        class="fa-solid fa-gear flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900 "></i>
                                    <span class="flex-1 ml-3 whitespace-nowrap font-semibold text-sm">Settings</span>
                                </a>
                            </li>
                            <li class="flex w-full">
                                <form method="post" action="{{ route('logout') }}" class="w-full flex justify-start">
                                    @csrf
                                    <button type="submit"
                                        class="p-1 text-base font-normal text-gray-900 cursor-pointer mb-1 rounded  hover:bg-gray-200 w-full"
                                        role="menuitem" tabindex="-1">
                                        <div class="w-5/12">
                                            <i
                                                class="fa-solid fa-right-from-bracket flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900 "></i>
                                            <span class="flex-1 ml-3 whitespace-nowrap font-semibold text-sm">Log out</span>
                                        </div>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <li class="flex w-full">
                        <a href="{!! url('/tasks') !!}"
                            class="flex items-center p-1 text-base font-normal text-gray-900 cursor-pointer mb-1 rounded  hover:bg-gray-200 w-full">
                            <i
                                class="fa-solid fa-list-check flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900 "></i>
                            <span class="flex-1 ml-3 whitespace-nowrap font-semibold text-base ">Tasks</span>
                        </a>
                    </li>
                    <li class="flex w-full">
                        <a href="{!! url('/tags') !!}"
                            class="flex items-center p-1 text-base font-normal text-gray-900 cursor-pointer mb-1 rounded  hover:bg-gray-200 w-full">
                            <i
                                class="fa-solid fa-tag flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900"></i>
                            <span class="flex-1 ml-3 whitespace-nowrap font-semibold text-base ">Tags</span>
                        </a>
                    </li>
                </ul>
            </div>            
        </div>

        <div class="w-64 z-40 absolute  shadow h-full flex-col justify-between hidden lg:flex transition duration-150 ease-in-out bg-gray-50"
            id="mobile-nav">
            <button aria-label="toggle sidebar" id="openSideBar"
                class="bg-gray-50 absolute right-0  -mr-14 p-5 flex items-center shadow  justify-center cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-800"
                onclick="sidebarHandler(true)">
                <i class="fa-solid fa-bars"></i>
            </button>
            <button aria-label="Close sidebar" id="closeSideBar"
                class="bg-transparent absolute right-0 p-5 flex items-center justify-center cursor-pointer text-white"
                onclick="sidebarHandler(false)">
                <i class="fa-solid fa-xmark text-black text-xl mt-1"></i>
            </button>
            <div class="px-3 py-4">
                <div class="h-16 w-full flex items-center">
                    <a href="/" class="flex items-center pl-2.5 mb-5">
                        <img src="{{ asset('/images/badge.png') }}" class="h-6 mr-3 sm:h-7" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap ">TaskBoard</span>
                    </a>
                </div>
                <ul class="space-y-2">
                    <li class="flex w-full">
                        <a href="{!! url('/tasks') !!}"
                            class="flex items-center p-1 text-base font-normal text-gray-900 cursor-pointer mb-6 rounded hover:bg-gray-200 w-full">
                            <i
                                class="fa-solid fa-list-check flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900 "></i>
                            <span class="flex-1 ml-3 whitespace-nowrap font-semibold text-lg ">Tasks</span>
                        </a>
                    </li>
                    <li class="flex w-full">
                        <a href="{!! url('/tags') !!}"
                            class="flex items-center p-1 text-base font-normal text-gray-900 cursor-pointer mb-6 rounded hover:bg-gray-200 w-full">
                            <i
                                class="fa-solid fa-tag flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900 "></i>
                            <span class="flex-1 ml-3 whitespace-nowrap font-semibold text-lg ">tags</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script>
        var sideBar = document.getElementById("mobile-nav");
            var openSidebar = document.getElementById("openSideBar");
            var closeSidebar = document.getElementById("closeSideBar");
            sideBar.style.transform = "translateX(-260px)";

            function sidebarHandler(flag) {
                if (flag) {
                    sideBar.style.transform = "translateX(0px)";
                    openSidebar.classList.add("hidden");
                    closeSidebar.classList.remove("hidden");
                } else {
                    sideBar.style.transform = "translateX(-260px)";
                    closeSidebar.classList.add("hidden");
                    openSidebar.classList.remove("hidden");
                }
            }
    </script>

</div>
