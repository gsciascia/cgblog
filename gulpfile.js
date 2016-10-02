const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


/**
 * Copy any needed files.
 *
 * Do a 'gulp copyfiles' after bower updates
 */
gulp.task("updateFilesBackend", function() {

    gulp.src("vendor/bower_components/AdminLTE/dist/css/**/*")
        .pipe(gulp.dest("resources/assets/backend/thema/"));

    gulp.src("vendor/bower_components/AdminLTE/dist/js/app.min.js")
        .pipe(gulp.dest("resources/assets/backend/js/app.min.js"));

    // Copy only plugin that I needs


    gulp.src("vendor/bower_components/AdminLTE//bootstrap/**/*")
        .pipe(gulp.dest("resources/assets/backend/bootstrap/"));

    gulp.src("vendor/bower_components/AdminLTE/plugins/jQuery/**/*/")
        .pipe(gulp.dest("resources/assets/backend/plugins/jQuery/"));

    gulp.src("vendor/bower_components/AdminLTE/plugins/bootstrap-wysihtml5/**/*")
        .pipe(gulp.dest("resources/assets/backend/plugins/bootstrap-wysihtml5/"));


    gulp.src("vendor/bower_components/AdminLTE/plugins/slimScroll/**/*")
        .pipe(gulp.dest("resources/assets/backend/plugins/slimScroll/"));

});

elixir(function(mix) {
    // the source file is for default set to /resource/assets/css/
    mix.styles([
        '../backend/bootstrap/css/bootstrap.css',
        '../backend/thema/AdminLTE.css',
        '../backend/thema/skins/skin-blue.css'

    ],'public/backend-assets/css/all.css')


        .scripts([
            'plugins/jQuery/jquery-2.2.3.min.js', // Jquery needs first
            'bootstrap/js/bootstrap.js',
            'plugins/slimScroll/jquery.slimscroll.js', // Jquery needs first
            'js/app.min.js'
        ],'public/backend-assets/js/all.js','./resources/assets/backend/')
});