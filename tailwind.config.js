import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                // Primary Base - Beige/Cream tones
                primary: {
                    50: '#FEFDFB',
                    100: '#FDF9F3',
                    200: '#FAF0E6',  // Linen - Main background
                    300: '#F5F5DC',  // Beige - Secondary background
                    400: '#EDE8D0',
                    500: '#E5DFC4',
                    600: '#D4CCB0',
                    700: '#C3B99C',
                    800: '#A69F84',
                    900: '#89836C',
                    950: '#6C6854',
                },
                // Secondary/Accent - Carta da Zucchero / Powder Blue
                secondary: {
                    50: '#F4F9FA',
                    100: '#E8F3F5',
                    200: '#D1E7EB',
                    300: '#A4D8D8',  // Carta da Zucchero - Main accent
                    400: '#B0C4DE',  // Light Steel Blue - Alternative accent
                    500: '#8CBDCD',
                    600: '#6BA3B5',
                    700: '#5A8A9C',
                    800: '#4D7383',
                    900: '#425F6C',
                    950: '#2B3F48',
                },
                // Text colors - Dark Grey (soft black)
                content: {
                    DEFAULT: '#2D2D2D',
                    light: '#4A4A4A',
                    muted: '#6B6B6B',
                    subtle: '#9A9A9A',
                },
                // Utility colors for the e-commerce
                success: {
                    50: '#F0FDF4',
                    500: '#22C55E',
                    600: '#16A34A',
                },
                warning: {
                    50: '#FFFBEB',
                    500: '#F59E0B',
                    600: '#D97706',
                },
                danger: {
                    50: '#FEF2F2',
                    500: '#EF4444',
                    600: '#DC2626',
                },
            },
            fontFamily: {
                // Elegant Cursive for Headings/Titles
                display: ['"Great Vibes"', 'cursive'],
                heading: ['"Playfair Display"', 'serif'],
                // Clean Sans-serif for Body Text
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
                body: ['Montserrat', 'Lato', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                // Custom sizes for elegant typography
                'display-sm': ['2rem', { lineHeight: '1.2', letterSpacing: '0.02em' }],
                'display-md': ['2.5rem', { lineHeight: '1.2', letterSpacing: '0.02em' }],
                'display-lg': ['3rem', { lineHeight: '1.1', letterSpacing: '0.02em' }],
                'display-xl': ['4rem', { lineHeight: '1.1', letterSpacing: '0.01em' }],
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
                '112': '28rem',
                '128': '32rem',
            },
            borderRadius: {
                'elegant': '0.375rem',
            },
            boxShadow: {
                'elegant': '0 4px 6px -1px rgba(45, 45, 45, 0.1), 0 2px 4px -1px rgba(45, 45, 45, 0.06)',
                'elegant-lg': '0 10px 15px -3px rgba(45, 45, 45, 0.1), 0 4px 6px -2px rgba(45, 45, 45, 0.05)',
                'card': '0 1px 3px 0 rgba(45, 45, 45, 0.1), 0 1px 2px 0 rgba(45, 45, 45, 0.06)',
            },
            backgroundImage: {
                'gradient-elegant': 'linear-gradient(135deg, #FAF0E6 0%, #F5F5DC 100%)',
                'gradient-accent': 'linear-gradient(135deg, #A4D8D8 0%, #B0C4DE 100%)',
            },
        },
    },

    plugins: [forms],
};
