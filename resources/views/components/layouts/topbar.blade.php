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
    <div class="flex items-center"><div
            x-data="notificationSystem()"
            x-init="$nextTick(() => init())"
            class="relative"
        >
            <button 
                @click="showNotifications = !showNotifications" 
                type="button"
                class="text-gray-500 p-2 rounded-full hover:text-blue-600 hover:bg-gray-200 cursor-pointer mr-4 relative"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                    <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                    <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                </svg>
                <template x-if="unreadCount > 0">
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full" x-text="unreadCount"></span>
                </template>
            </button>

            <div 
                x-show="showNotifications"
                x-transition
                @click.away="showNotifications = false"
                style="display: none;"
                class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-50 max-h-96 overflow-y-auto"
            >
                <div x-show="notifications.length === 0" class="px-4 py-2 text-sm text-gray-500">
                    No notifications
                </div>
                
                <template x-for="notification in notifications" :key="notification.id">
                    <div 
                        class="px-4 py-2 hover:bg-gray-50 cursor-pointer" 
                        :class="{ 'opacity-50': notification.read_at }"
                        @click="!notification.read_at && markAsRead(notification.id)"
                    >
                        <p class="text-sm font-medium text-gray-900" x-text="`Task Due Soon: ${notification.data.task_title}`"></p>
                        <p class="text-xs text-gray-500" x-text="`Project: ${notification.data.project_name}`"></p>
                        <p class="text-xs text-gray-500" x-text="`Due: ${new Date(notification.data.due_date).toLocaleString()}`"></p>
                    </div>
                </template>
            </div>
        </div>

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

<script>
function notificationSystem() {
    return {
        showNotifications: false,
        notifications: @json(auth()->user()->notifications()->latest()->get()),
        unreadCount: {{ auth()->user()->unreadNotifications->count() }},
        
        init() {
            console.log('Initializing notifications system');
            console.log('Initial notifications:', this.notifications);
            
            if (window.Echo) {
                window.Echo.private(`App.Models.User.{{ auth()->id() }}`)
                    .notification((notification) => {
                        console.log('New notification received:', notification);
                        this.notifications.unshift(notification);
                        this.unreadCount++;
                    });
            } else {
                console.error('Echo is not initialized');
            }
        },
        
        async markAsRead(notificationId) {
            try {
                const response = await fetch(`/notifications/${notificationId}/mark-as-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                });
                
                if (response.ok) {
                    this.notifications = this.notifications.map(notification => {
                        if (notification.id === notificationId) {
                            notification.read_at = new Date().toISOString();
                            this.unreadCount = Math.max(0, this.unreadCount - 1);
                        }
                        return notification;
                    });
                }
            } catch (error) {
                console.error('Error marking notification as read:', error);
            }
        }
    }
}
</script>