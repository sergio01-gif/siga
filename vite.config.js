import { defineConfig } from 'vite';
import laravel from 'vite-plugin-laravel';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/sass/app.scss', // ou CSS, dependendo do que você está usando
            ],
            refresh: true, // Recarrega o navegador automaticamente
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'), // Resolve o caminho para os arquivos JS
        },
    },
    css: {
        postcss: {
            plugins: [
                require('tailwindcss'),
                require('autoprefixer'), // Adiciona o Autoprefixer para melhorar a compatibilidade
            ],
        },
    },
    build: {
        outDir: 'public/build', // Diretório de saída para os arquivos compilados
        manifest: true,         // Garante que o arquivo manifest.json seja gerado
        rollupOptions: {
            input: {
                app: 'resources/js/app.js', // Defina o ponto de entrada para o seu JS
            },
        },
    },
});
