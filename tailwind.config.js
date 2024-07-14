const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './public/css/input.css'
    ],

    theme: {
        container: {
            center: true,
            padding: '16px',
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#14b8a6',
                dark: '#0f172a',
                secondary: '#64748b',
                smoeets: '#98cc3c',
                smooets_2: '#b0ec4c',
              },
              screens: {
                '2xl': '1320px'
              }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
  //npx tailwindcss -i ./public/tailwind/input.css -o ./public/tailwind/output.css --watch
