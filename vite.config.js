import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: 'build',
            publicDirectory: 'public',
            hotFile: 'public/hot',
            valetTls: null,
            detectTls: null,
            ssr: null,
            ssrOutputDirectory: 'bootstrap/ssr',
            transformOnServe: (code) => code,
            options: {
                preload: {
                    css: false
                }
            }
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
    },
});