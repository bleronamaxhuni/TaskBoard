<div class="px-4 md:px-8 py-1 h-14 flex justify-between items-center shadow-sm bg-white">
    <div class="flex items-center w-2/3">
        <div class="p-2 rounded-full hover:bg-gray-200 cursor-pointer 2xl:hidden lg:block"
            @click="sidemenu = !sidemenu">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                <line x1="4" y1="6" x2="20" y2="6" />
                <line x1="4" y1="12" x2="20" y2="12" />
                <line x1="4" y1="18" x2="20" y2="18" />
            </svg>
        </div>
    </div>
    <div class="flex items-center">
        <a href="#" class="text-gray-500 p-2 rounded-full hover:text-blue-600 hover:bg-gray-200 cursor-pointer mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
            </svg>
        </a>

        <div class="relative" x-data="{ open: false }" x-cloak>
            <div @click="open = !open"
                class="cursor-pointer font-bold w-48 h-10 bg-blue-200 text-blue-600 flex items-center justify-center rounded-full">
                {{ Auth::user()->name}}
            </div>

            <div x-show.transition="open" @click.away="open = false"
                class="absolute top-0 mt-12 right-0 w-48 bg-white py-2 shadow-md border border-gray-100 rounded-lg z-40 p-3">
                <a href="{!! url('/profile') !!}"
                    class="text-base font-normal text-gray-900 cursor-pointer mb-1 p-1"
                    >
                    <i class="fa-sharp fa-solid fa-gear"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap text-base ">Account Settings</span>
                </a>
                <form method="post" action="{{ route('logout') }}" class="">
                    @csrf
                    <button type="submit"
                        class="text-base font-normal text-gray-900 cursor-pointer p-1"
                        role="menuitem" tabindex="-1">
                        <i
                            class="fa-solid fa-right-from-bracket"></i>
                        <span class="flex-1 ml-3 whitespace-nowrap text-base ">Log out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>