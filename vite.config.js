import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss(),
    laravel({
      input: [
        // CSS
        'resources/css/app.css',
        'resources/src/assets/css/styles.css',
        'resources/src/assets/css/custom.css',

        'resources/src/assets/css/vars.css',
        'resources/src/assets/css/fonts.css',
        'resources/src/assets/css/main.css',
        'resources/src/assets/css/rtl.css',
        'resources/src/assets/css/containers.css',
        'resources/src/assets/css/responsive.css',
        'resources/src/assets/libs/material-icon/material-icon.css',
        'resources/src/style.css',

        // JS
        'resources/js/app.js',
        'resources/src/main.js',
        'resources/src/js/home/ui-home.js',
      ],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      "@assets": path.resolve(__dirname, "resources/src/assets"),
      "@src": path.resolve(__dirname, "resources/src"),
      "@images": path.resolve(__dirname, "public/images"),
    },
  },
});
