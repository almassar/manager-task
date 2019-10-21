const mix = require('laravel-mix');
let pathBuild = 'public/build/developer';

mix.extract(['vue', 'jquery', 'bootstrap-datepicker', '@fortawesome/fontawesome-free/js/all']);

if (mix.inProduction()) {
    pathBuild = 'public/build';
}

mix.js('resources/js/app.js',   pathBuild);

mix.sass('resources/sass/vendor.scss', pathBuild).options({processCssUrls: false});
mix.sass('resources/sass/app.scss',    pathBuild).options({processCssUrls: false});

mix.browserSync({
    proxy: 'localhost/manager.pbt.kz/public'
});

/*
if (mix.inProduction()) {
    mix.version();
}*/
