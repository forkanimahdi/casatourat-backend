import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/js/assign_building_map.js',
                'resources/js/create_circuit_map.js',
                'resources/js/show_circuit_map.js',
                'resources/js/update_circuit_map.js',
                'resources/js/search.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        target: "esnext"
    },
});
