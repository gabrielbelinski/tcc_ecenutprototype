/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./formkit.theme.mjs",
    '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    '../../storage/framework/views/*.php',
    "../**/*.blade.php",
    "./resources/**/*.js",  // More specific path to your JS files
    "./resources/**/*.vue", // More specific path to your Vue files
  ],
  darkMode: 'class',
  theme: {
    extend: {
      backgroundImage:{
        'fundo-cenut': "url('/storage/app/public/background.jpeg')",
      },
    },
  },
  plugins: [],
}