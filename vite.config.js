import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: 'localhost',
        port: 5173, // Vite's default port (can be customized)
        hmr: {
            protocol: 'ws', // WebSocket protocol for HMR
            host: 'localhost', // The host for HMR connection (ensure this is correct)
            port: 5173, // Correct the port to match where Vite is running (5173)
        },
        cors: {
            origin: 'http://localhost:8000', // Allow requests from this origin
            methods: ['GET', 'POST'],
            allowedHeaders: ['Content-Type'],
        },
    },
});
