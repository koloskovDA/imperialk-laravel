import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/oldversion/css/shop.style.css',
                'resources/oldversion/js/app.js',
                'resources/oldversion/js/shop.app.js',
                'resources/oldversion/css/bootstrap.css',
                'resources/oldversion/css/perfect-scrollbar.css',
                'resources/oldversion/css/jquery.nouislider.css',
                'resources/oldversion/css/line-icons.css',
                'resources/oldversion/js/bootstrap.min.js',
                'resources/oldversion/css/header-v5.css',
            ],
            refresh: true,
        }),
    ],
});
