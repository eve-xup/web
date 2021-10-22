let mix = require('laravel-mix')

mix.postCss('src/Styles/app.css', 'src/resources/css/web.css', [
    require('tailwindcss'),
]);