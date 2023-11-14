/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/***/*.blade.php',
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {},
    colors: {
        'white': '#FFFFFF',
        'azure-radiance': {
            DEFAULT: '#007EFC',
            50: '#CCE6FF',
            100: '#B5DBFF',
            200: '#87C5FF',
            300: '#59AEFF',
            400: '#2B96FF',
            500: '#007EFC',
            600: '#0061C4',
            700: '#00458C',
            800: '#002954',
            900: '#000D1C',
            950: '#000000'
        },
        'alizarin-crimson': {
            DEFAULT: '#DC2626',
            50: '#FCECEC',
            100: '#F8D6D6',
            200: '#F1AAAA',
            300: '#EA7E7E',
            400: '#E35252',
            500: '#DC2626',
            600: '#BB1E1E',
            700: '#981818',
            800: '#751313',
            900: '#520D0D',
            950: '#400A0A'
        },
        'forest-green': {
            DEFAULT: '#2A9F36',
            50: '#D2F3D6',
            100: '#BCEDC1',
            200: '#90E198',
            300: '#63D76E',
            400: '#40C14D',
            500: '#2A9F36',
            600: '#1E7126',
            700: '#164B1C',
            800: '#0E2A11',
            900: '#081109',
            950: '#040E05'
        },
    }
  },
  plugins: [],
}

