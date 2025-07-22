/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './**/*.php',
    './**/*.html',
    './src/**/*.js',
    '../../plugins/distpro/**/*.php', // 👈 Add plugin template scanning
    '../../plugins/distcont/**/*.php', // 👈 Add plugin template scanning
  ],
  safelist: [
    'dynamic-font', // Add any dynamic classes you don't want purged
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Outfit', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: '#020617',
        default: '#d30c36',
        'default-hover': '#c20e34',
        secondary: '#1c4058',
        body: '#020f18',
        orange: '#FA812F',
        yellow: '#FAB12F',
        tosca: '#91DDCF',
        maroon: '#CC2B52',
        'blue-light': '#27AAE1',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
};
