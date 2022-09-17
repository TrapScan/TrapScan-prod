import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
const path = require('path');
import viteCompression from 'vite-plugin-compression';

export default defineConfig({
    plugins: [
        viteCompression(),
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
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
            ziggy: path.resolve('vendor/tightenco/ziggy/src/js'),
        },
        css: {
            devSourcemap: true,
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
        sourcemap: true,
        rollupOptions: {
            external: 'ziggy'
        }
    },
});
