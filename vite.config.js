import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/magiamgia.js',
                'resources/js/reatimeGhe.js'
            ],
            refresh: true,
        }),
    ],
});