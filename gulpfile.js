/* -- load plugins -- */
const { src, dest, watch, series, parallel } = require('gulp');
const sass         = require('gulp-sass');
const cleanCSS     = require('gulp-clean-css');
const sourcemaps   = require('gulp-sourcemaps');
const concat       = require('gulp-concat');
const minify       = require('gulp-minify');
const autoprefixer = require('gulp-autoprefixer');
const del          = require('del');


/* -- functions -- */
function copyJS() {
    return src([])
        .pipe(sourcemaps.init())
        .pipe(concat('scripts.js'))
        .pipe(minify({ ext: { min: '.min.js' } }))
        .pipe(sourcemaps.write('./'))
        .pipe(dest('./dist/vendor/js/'));
}

function copyCSS() {
    return src([])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS({ level: { 1: { all: true, tidySelectors: true } } }))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(concat('styles.css'))
        .pipe(sourcemaps.write('./'))
        .pipe(dest('./dist/vendor/css/'));
}

function copyFonts() {
    return src([])
        .pipe(dest('./dist/fonts/'));
}

function css() {
    return src('./src/scss/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS({ level: { 1: { all: true, tidySelectors: true } } }))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(sourcemaps.write('./'))
        .pipe(dest('./dist/css/'));
}

function js() {
    return src('./src/js/*.js')
        .pipe(sourcemaps.init())
        .pipe(concat('scripts.js'))
        .pipe(minify({ ext: { min: '.min.js' } }))
        .pipe(sourcemaps.write('./'))
        .pipe(dest('./dist/js/'));
}

function clean() {
    return del(['./dist/css/', './dist/js/', './dist/vendor/', './dist/fonts/'], { force: true });
}

function watchFiles() {
    watch('./src/scss/**/*.scss', css);
    watch('./src/js/**/*.js', js);
}

/* -- complex tasks -- */
const build   = series(clean, parallel(css, js));
const develop = series(parallel(watchFiles, css, js));

/* -- export tasks -- */
exports.clean = clean;
exports.build = build;
exports.watch = develop;
exports.default = build;