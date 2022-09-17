import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
const path = require('path');
import viteCompression from 'vite-plugin-compression';

export default defineConfig({
    plugins: [
        viteCompression(),
        laravel(['resources/js/app.js']),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
        css: {
            devSourcemap: true,
        },
    },
    build: {
        sourcemap: true,

    },
});

