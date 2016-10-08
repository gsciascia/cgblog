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


    gulp.src("vendor/bower_components/bootbox.js/bootbox.js")
        .pipe(gulp.dest("resources/assets/backend/plugins/bootbox/"));


    gulp.src("vendor/bower_components/AdminLTE/plugins/datepicker/**/*/")
        .pipe(gulp.dest("resources/assets/backend/plugins/datepicker/"));

    gulp.src("vendor/bower_components/AdminLTE/plugins/timepicker/**/*/")
        .pipe(gulp.dest("resources/assets/backend/plugins/timepicker/"));
});

elixir(function(mix) {
    // the source file is for default set to /resource/assets/css/
    mix.styles([
        '../backend/bootstrap/css/bootstrap.css',
        '../backend/thema/AdminLTE.css',
        '../backend/thema/skins/skin-blue.css',
        '../backend/thema/skins/skin-blue.css',
        '../backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', // wysihtml5 bootstrap CSS
        '../backend/plugins/datepicker/datepicker3.css', //
        '../backend/plugins/timepicker/bootstrap-timepicker.min.css', //
    ],'public/backend-assets/css/all.css')


        .scripts([
            'plugins/jQuery/jquery-2.2.3.min.js', // Jquery needs first
            'bootstrap/js/bootstrap.js',
            'plugins/slimScroll/jquery.slimscroll.js',
            'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', // wysihtml5 bootstrap CSS
            'plugins/bootbox/bootbox.js', // bootbox
            'plugins/datepicker/bootstrap-datepicker.js',
            'plugins/timepicker/bootstrap-timepicker.min.js',
            'js/app.min.js',
            'js/main.js'
        ],'public/backend-assets/js/all.js','./resources/assets/backend/')
});



/**
 * Front end gulp Task
 *
 */


var browserSync = require('browser-sync').create();
// Requires the gulp-sass and autoprefix  plugin
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cssnano = require('gulp-cssnano');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');


// the defaults task that are call
gulp.task('frontendDev', ['watch','browserSync','styles','scripts'], function() {});




// Gulp watch these files and please do something :)
gulp.task('watch', ['browserSync'],function(){
    // Watch changes in sass folder
    gulp.watch('resources/assets/blog/scss/**/*.scss', ['styles']);
    // Reloads the browser whenever HTML or JS files change
    gulp.watch('resources/views/layouts/**/*.php', browserSync.reload);


})


gulp.task('styles', function () {
    return gulp.src('resources/assets/blog/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 3 versions'],
            cascade: false
        }))
        .pipe(cssnano())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('public/blog-assets/css/'))
        .pipe(browserSync.reload({
            stream: true
        }))
});


gulp.task('scripts', function() {
    return gulp.src(['resources/assets/blog/js/jquery.js', 'resources/assets/blog/js/main.js'])
        .pipe(concat('all.js'))
      //  .uglify()
        .pipe(gulp.dest('public/blog-assets/js/'))
        .pipe(browserSync.reload({
            stream: true
        }))
});


// Live reload for our app folder
gulp.task('browserSync', function() {
    browserSync.init({
        proxy: "cgblog.dev"
    });
});




// Gulp watch these files and please do something :)
gulp.task('copyFileFrontend',function(){

    // Load bootstrap file
    gulp.src("vendor/bower_components/jquery/dist/jquery.js")
        .pipe(gulp.dest("resources/assets/blog/js/"));


})