import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: "#4A90E2",
                    "hover-dark": "#3A78B3",
                    "hover-medium": "#6DA9E3",
                    "hover-light": "#A3C8EF",
                    focus: "#4F9ED8",
                },
                secondary: "#A3D5FF",
                accent: "#FFB7C5",
                highlight: "#FFE081",
                neutral: "#2E3A59",
                text: "#333333",
                background: "#F8F8F8",
                success: {
                    DEFAULT: "#10B981",
                    hover: "#059669",
                },
                delete: {
                    DEFAULT: "#EF4444",
                    hover: "#DC2626",
                },
                discard: {
                    DEFAULT: "#6B7280",
                    hover: "#4B5563",
                },
            },
        },
    },

    plugins: [require("daisyui")],

    daisyui: {
        darkTheme: false,
    },
};
