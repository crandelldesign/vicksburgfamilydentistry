// Defining base pathes
var basePaths = {
    bower: './bower_components/',
    node: './node_modules/',
    dev: './public/vendor/'
};


// browser-sync watched files
// automatically reloads the page when files changed
var browserSyncWatchFiles = [
    './public/css/*.min.css',
    './public/js/*.min.js',
    './**/*.php'
];


// browser-sync options
// see: https://www.browsersync.io/docs/options/
var browserSyncOptions = {
    proxy: "localhost/",
    notify: false
};


// Defining requirements
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var cssnano = require('gulp-cssnano');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var ignore = require('gulp-ignore');
var rimraf = require('gulp-rimraf');
var clone = require('gulp-clone');
var merge = require('gulp-merge');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var del = require('del');
var cleanCSS = require('gulp-clean-css');


// Run:
// gulp sass + cssnano + rename
// Prepare the min.css for production (with 2 pipes to be sure that "theme.css" == "theme.min.css")
gulp.task('scss-for-prod', function() {
    var source =  gulp.src('./sass/*.scss')
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sass());

    var pipe1 = source.pipe(clone())
        .pipe(sourcemaps.write(undefined, { sourceRoot: null }))
        .pipe(gulp.dest('./css'))
        .pipe(rename('custom-editor-style.css'))


    var pipe2 = source.pipe(clone())
        .pipe(minify-css())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./css'));

    return merge(pipe1, pipe2);
});


// Run:
// gulp sourcemaps + sass + reload(browserSync)
// Prepare the child-theme.css for the development environment
gulp.task('scss-for-dev', function() {
    gulp.src('./public/sass/*.scss')
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sass())
        .pipe(sourcemaps.write(undefined, { sourceRoot: null }))
        .pipe(gulp.dest('./public/css'))
});

gulp.task('watch-scss', ['browser-sync'], function () {
    gulp.watch('./public/sass/**/*.scss', ['scss-for-dev']);
});


// Run:
// gulp sass
// Compiles SCSS files in CSS
gulp.task('sass', ['minify-css'], function () {
    var stream = gulp.src('./public/sass/*.scss')
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sass())
        .pipe(gulp.dest('./public/css'))
        .pipe(rename('theme.min.css'))
    return stream;
});


// Run:
// gulp watch
// Starts watcher. Watcher runs gulp sass task on changes
gulp.task('watch', function () {
    gulp.watch('./public/sass/**/*.scss', ['sass']);
    gulp.watch('./public/css/theme.css', ['minify-css']);
    gulp.watch([basePaths.dev + 'js/**/*.js','js/**/*.js','!js/theme.js','!js/theme.min.js'], ['scripts']);

    //Inside the watch task.
    gulp.watch('./img/**', ['imagemin'])
});

// Run:
// gulp imagemin
// Running image optimizing task
gulp.task('imagemin', function(){
    gulp.src('img/src/**')
    .pipe(imagemin())
    .pipe(gulp.dest('img'))
});


// Run:
// gulp cssnano
// Minifies CSS files
gulp.task('cssnano', function(){
  return gulp.src('./public/css/theme.css')
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano({discardComments: {removeAll: true}}))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./public/css/'))
});

gulp.task('minify-css', function() {
  return gulp.src('./public/css/theme.css')
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./public/css/'));
});

gulp.task('cleancss', function() {
  return gulp.src('./css/*.min.css', { read: false }) // much faster
    .pipe(ignore('theme.css'))
    .pipe(rimraf());
});


// Run:
// gulp browser-sync
// Starts browser-sync task for starting the server.
gulp.task('browser-sync', function() {
    browserSync.init(browserSyncWatchFiles, browserSyncOptions);
});


// Run:
// gulp watch-bs
// Starts watcher with browser-sync. Browser-sync reloads page automatically on your browser
gulp.task('watch-bs', ['browser-sync', 'watch', 'minify-css', 'scripts'], function () { });


// Run:
// gulp scripts.
// Uglifies and concat all JS files into one
gulp.task('scripts', function() {
    var scripts = [

        // JQuery
        basePaths.dev + 'js/jquery/jquery.js',

        // BS3
        basePaths.dev + 'js/bootstrap/bootstrap.js',

        // AOS
        basePaths.dev + 'js/aos/aos.js',

        // Global JS
        './public/js/src/global.js'
    ];
  gulp.src(scripts)
    .pipe(concat('theme.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./public/js/'));

  gulp.src(scripts)
    .pipe(concat('theme.js'))
    .pipe(gulp.dest('./public/js/'));
});

// Deleting any file inside the /src folder
gulp.task('clean-source', function () {
  return del(['public/vendor/**/*',]);
});

// Run:
// gulp copy-assets.
// Copy all needed dependency assets files from bower_component assets to themes /js, /scss and /fonts folder. Run this task after bower install or bower update

////////////////// All Bootstrap SASS  Assets /////////////////////////
gulp.task('copy-assets', ['clean-source'], function() {

////////////////// All Bootstrap 3 Assets /////////////////////////
// Copy all Bootstrap JS files
    var stream = gulp.src(basePaths.node + 'bootstrap-sass/assets/javascripts/**/*.js')
       .pipe(gulp.dest(basePaths.dev + '/js/bootstrap'));


// Copy all Bootstrap SCSS files
    gulp.src(basePaths.node + 'bootstrap-sass/assets/stylesheets/**/*.scss')
       .pipe(gulp.dest(basePaths.dev + '/sass/bootstrap'));

////////////////// End Bootstrap 3 Assets /////////////////////////

// Copy all Font Awesome Fonts
    gulp.src(basePaths.node + 'font-awesome/fonts/**/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./public/fonts'));

// Copy all Font Awesome SCSS files
    gulp.src(basePaths.node + 'font-awesome/scss/*.scss')
        .pipe(gulp.dest(basePaths.dev + '/sass/fontawesome'));

// Copy jQuery
    gulp.src(basePaths.node + 'jquery/dist/*.js')
        .pipe(gulp.dest(basePaths.dev + '/js/jquery'));

// Copy AOS
    gulp.src(basePaths.node + 'aos/dist/**/*.js')
       .pipe(gulp.dest(basePaths.dev + '/js/aos'));
    gulp.src(basePaths.node + 'aos/src/sass/**/*.scss')
       .pipe(gulp.dest(basePaths.dev + '/sass/aos'));

    return stream;
});


// Run
// gulp dist
// Copies the files to the /dist folder for distributon as simple theme
gulp.task('dist', ['clean-dist'], function() {
    gulp.src(['**/*','!bower_components','!bower_components/**','!node_modules','!node_modules/**','!public/vendor','!public/vendor/**','!dist','!dist/**','!dist-product','!dist-product/**','!sass','!sass/**','!readme.txt','!readme.md','!package.json','!gulpfile.js','!CHANGELOG.md','!.travis.yml','!jshintignore', '!codesniffer.ruleset.xml', '*'])
    .pipe(gulp.dest('dist/'))
});

// Deleting any file inside the /src folder
gulp.task('clean-dist', function () {
  return del(['dist/**/*',]);
});

// Run
// gulp dist-product
// Copies the files to the /dist-prod folder for distributon as theme with all assets
gulp.task('dist-product', ['clean-dist-product'], function() {
    gulp.src(['**/*','!bower_components','!bower_components/**','!node_modules','!node_modules/**','!dist','!dist/**','!dist-product','!dist-product/**', '*'])
    .pipe(gulp.dest('dist-product/'))
});

// Deleting any file inside the /src folder
gulp.task('clean-dist-product', function () {
  return del(['dist-product/**/*',]);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['sass', 'minify-css', 'scripts', 'imagemin']);
