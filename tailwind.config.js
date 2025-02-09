/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'gradient': 'gradient 15s ease infinite',
                'float': 'float 6s ease-in-out infinite',
                'float-delay': 'float 6s ease-in-out 3s infinite',
                'float-delay-2': 'float 6s ease-in-out 4s infinite',
                'width': 'width 1s ease-out forwards',
                'shine': 'shine 8s linear infinite',
                'bounce': 'bounce 1s infinite',
            },
            keyframes: {
                gradient: {
                    '0%, 100%': {
                        'background-position': '0% 50%'
                    },
                    '50%': {
                        'background-position': '100% 50%'
                    }
                },
                float: {
                    '0%, 100%': {
                        transform: 'translateY(0)'
                    },
                    '50%': {
                        transform: 'translateY(-10px)'
                    }
                },
                width: {
                    'from': {
                        width: '0'
                    },
                    'to': {
                        width: '6rem'
                    }
                },
                shine: {
                    '0%': {
                        'background-position': '200% center'
                    },
                    '100%': {
                        'background-position': '-200% center'
                    }
                }
            },
            backgroundSize: {
                '300%': '300% 300%',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ],
}
