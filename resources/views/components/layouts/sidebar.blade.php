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
                        <li class="flex w-full">
                            <a href="{!! url('/tasks') !!}"
                                class="flex items-center p-1 text-base font-normal text-gray-900 cursor-pointer mb-6 rounded  hover:bg-gray-200 w-full">
                            <i
                                    class="fa-solid fa-list-check flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900 "></i>
                                <span class="flex-1 ml-3 whitespace-nowrap font-semibold text-lg ">Tasks</span>
                            </a>
                        </li>
                        <li class="flex w-full">
                            <a href="{!! url('/tags') !!}"
                                class="flex items-center p-1 text-base font-normal text-gray-900 cursor-pointer mb-6 rounded  hover:bg-gray-200 w-full">
                                <i class="fa-solid fa-tag flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap font-semibold text-lg ">Tags</span>
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
                                <i class="fa-solid fa-tag flex-shrink-0 text-gray-500 transition duration-75  group-hover:text-gray-900 "></i>
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