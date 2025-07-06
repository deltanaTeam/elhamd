import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import rtl from 'tailwindcss-rtl';
import daisyui from 'daisyui';
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/src/**/*.js',
    './resources/src/**/*.html',
    './resources/src/assets/**/*.css',
    "./index.html",

    "./src/**/*.{js,ts,jsx,tsx,html}",
    "./resources/views/**/*.blade.php",
    "./components/**/*.{html,php}",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [
    forms,
    rtl(),
    daisyui,
  ],
};
