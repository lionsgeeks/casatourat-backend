import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{js,jsx,ts,tsx}',
    ],

    theme: {
        extend: {
            colors: {
                // Back-compat
                alpha: "#1221af",

                // Theme tokens (from resources/css/app.css)
                primary: 'rgb(var(--primary) / <alpha-value>)',
                'primary-foreground': 'rgb(var(--primary-foreground) / <alpha-value>)',
                background: 'rgb(var(--background) / <alpha-value>)',
                foreground: 'rgb(var(--foreground) / <alpha-value>)',
                muted: 'rgb(var(--muted) / <alpha-value>)',
                border: 'rgb(var(--border) / <alpha-value>)',
                card: 'rgb(var(--card) / <alpha-value>)',
                ring: 'rgb(var(--ring) / <alpha-value>)',
            },
        },
    },

    plugins: [forms],
};
