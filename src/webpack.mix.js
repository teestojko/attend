const mix = require('laravel-mix');

mix.js('resources/js/app.tsx', 'public/js')
    .react()
    .postCss('resources/css/app.css', 'public/css',)
    .postCss('resources/js/styles/Sidebar.css', 'public/css')
    .version();

mix.webpackConfig({
    resolve: {
        extensions: ['.tsx', '.ts', '.js', '.jsx', '.json']
    }
});

