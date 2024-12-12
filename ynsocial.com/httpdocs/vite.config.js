import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import copy from 'vite-plugin-copy'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/assets/frontend/css/app.css', 'resources/assets/frontend/js/app.js'],
            refresh: true,
        }),
        copy({
            targets: [
                {
                    src: 'resources/assets/admin/**/*',
                    dest: 'public/assets/admin'
                }
            ],
            hook: 'writeBundle' // This ensures the files are copied after the build process is complete
        }),
    ],
});
