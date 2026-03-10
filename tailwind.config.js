import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                forest: '#1a3a2a',
                moss: '#2d5a3d',
                leaf: '#4a9e6b',
                lime: '#7ecb5f',
                spring: '#b8e994',
                cream: '#f5f0e8',
                muted: '#4a6355',
            },
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                heading: ['Playfair Display', ...defaultTheme.fontFamily.serif],
                body: ['DM Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
