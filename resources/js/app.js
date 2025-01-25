import './bootstrap';
import Alpine from 'alpinejs'

// Wait for Echo to be initialized
document.addEventListener('DOMContentLoaded', () => {
    window.Echo = window.Echo;
    console.log('Echo initialized:', window.Echo);
});

window.Alpine = Alpine
Alpine.start()
