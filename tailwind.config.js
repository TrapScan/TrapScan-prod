const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    darkMode: 'class',
    theme: {

        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'caribbean-green': {
                    DEFAULT: '#0ED9A3',
                    '50': '#A5F9E3',
                    '100': '#92F8DD',
                    '200': '#6CF6D1',
                    '300': '#46F3C5',
                    '400': '#1FF1B9',
                    '500': '#0ED9A3',
                    '600': '#0BA47B',
                    '700': '#077054',
                    '800': '#043B2C',
                    '900': '#000605'
                },
                'spring-wood': {
                    DEFAULT: '#FAF9F6',
                    '50': '#FFFFFF',
                    '100': '#FFFFFF',
                    '200': '#FFFFFF',
                    '300': '#FFFFFF',
                    '400': '#FFFFFF',
                    '500': '#FAF9F6',
                    '600': '#E6E1D2',
                    '700': '#D2C9AE',
                    '800': '#BEB18A',
                    '900': '#AA9966'
                },
                'jelly-bean': {  DEFAULT: '#286EA2',  '50': '#9BC6E6',  '100': '#8BBDE2',  '200': '#6AAADA',  '300': '#4998D2',  '400': '#3084C3',  '500': '#286EA2',  '600': '#1D4F75',  '700': '#123148',  '800': '#07121B',  '900': '#000000'},
                'mirage': {
                    DEFAULT: '#101A23',
                    '50': '#4A78A1',
                    '100': '#436D93',
                    '200': '#365877',
                    '300': '#2A445B',
                    '400': '#1D2F3F',
                    '500': '#101A23',
                    '600': '#000000',
                    '700': '#000000',
                    '800': '#000000',
                    '900': '#000000'
                },
                'wild-sand': {
                    DEFAULT: '#F5F5F5',
                    '50': '#FFFFFF',
                    '100': '#FFFFFF',
                    '200': '#FFFFFF',
                    '300': '#FFFFFF',
                    '400': '#FFFFFF',
                    '500': '#F5F5F5',
                    '600': '#D9D9D9',
                    '700': '#BDBDBD',
                    '800': '#A1A1A1',
                    '900': '#858585'
                },
                'athens-gray': {
                    DEFAULT: '#F2F5F7',
                    '50': '#FFFFFF',
                    '100': '#FFFFFF',
                    '200': '#FFFFFF',
                    '300': '#FFFFFF',
                    '400': '#FFFFFF',
                    '500': '#F2F5F7',
                    '600': '#CFDAE2',
                    '700': '#ADC0CC',
                    '800': '#8AA5B7',
                    '900': '#678AA2'
                },
                'cod-gray': {
                    DEFAULT: '#1E1E1E',
                    '50': '#7A7A7A',
                    '100': '#707070',
                    '200': '#5B5B5B',
                    '300': '#474747',
                    '400': '#323232',
                    '500': '#1E1E1E',
                    '600': '#020202',
                    '700': '#000000',
                    '800': '#000000',
                    '900': '#000000'
                },
                'bay-of-many': {
                    DEFAULT: '#222E7D',
                    '50': '#7B88DB',
                    '100': '#6B7AD7',
                    '200': '#4B5DCE',
                    '300': '#3346BD',
                    '400': '#2B3A9D',
                    '500': '#222E7D',
                    '600': '#161E51',
                    '700': '#0A0E25',
                    '800': '#000000',
                    '900': '#000000'
                },
                'white-lilac': {
                    DEFAULT: '#EFF0FA',
                    '50': '#FFFFFF',
                    '100': '#FFFFFF',
                    '200': '#FFFFFF',
                    '300': '#FFFFFF',
                    '400': '#FFFFFF',
                    '500': '#EFF0FA',
                    '600': '#C4C8ED',
                    '700': '#9AA0DF',
                    '800': '#6F78D2',
                    '900': '#4450C5'
                },
                'niagara': {
                    DEFAULT: '#0AB587',
                    '50': '#7FF8D7',
                    '100': '#6BF7D1',
                    '200': '#45F5C5',
                    '300': '#1EF3B9',
                    '400': '#0CDCA4',
                    '500': '#0AB587',
                    '600': '#07805F',
                    '700': '#044B38',
                    '800': '#011610',
                    '900': '#000000'
                },
                'mystic': {
                    DEFAULT: '#E3E9EE',
                    '50': '#FFFFFF',
                    '100': '#FFFFFF',
                    '200': '#FFFFFF',
                    '300': '#FFFFFF',
                    '400': '#FCFDFD',
                    '500': '#E3E9EE',
                    '600': '#C0CED9',
                    '700': '#9DB2C4',
                    '800': '#7A97AE',
                    '900': '#5B7B96'
                },
                'bali-hai': {
                    DEFAULT: '#849DAE',
                    '50': '#F3F5F7',
                    '100': '#E6EBEF',
                    '200': '#CED8DF',
                    '300': '#B5C4CE',
                    '400': '#9DB1BE',
                    '500': '#849DAE',
                    '600': '#638297',
                    '700': '#4D6575',
                    '800': '#374853',
                    '900': '#202A31'
                },
                'limeade': {
                    DEFAULT: '#31A700',
                    '50': '#CFFFBB',
                    '100': '#BAFF9D',
                    '200': '#8EFF60',
                    '300': '#63FF22',
                    '400': '#43E400',
                    '500': '#31A700',
                    '600': '#288800',
                    '700': '#1F6A00',
                    '800': '#164B00',
                    '900': '#0D2D00'
                },
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ],
};
