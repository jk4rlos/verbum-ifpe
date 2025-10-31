import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
    },
    build: {
        outDir: 'public/build', // <- arquivos compilados vão para public/build
        emptyOutDir: true,      // <- limpa a pasta antes do build
        manifest: true          // <- necessário para Laravel + Vite
    }
});
