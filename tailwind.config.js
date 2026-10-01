import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // Classes de couleur des statuts définies dans les modèles
        './app/Models/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Charte AutoPrestige : bleu nuit et or
                navy: {
                    50: '#EEF2F8',
                    100: '#D5DEEC',
                    600: '#1C3A6B',
                    700: '#132C55',
                    800: '#0C1F40',
                    900: '#08152C',
                    950: '#050D1C',
                },
                gold: {
                    300: '#F3D27A',
                    400: '#EBC05A',
                    500: '#D9A62E',
                    600: '#B98A1D',
                },
            },
        },
    },

    plugins: [forms],
};
