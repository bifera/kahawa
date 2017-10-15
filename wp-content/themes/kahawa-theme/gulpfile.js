var gulp = require('gulp');
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

var input = './scss/style.scss';
var output = './coffee-wp/wp-content/themes/anfrawer';
var outputProd = './coffee-wp/wp-content/themes/anfrawer/prod';

var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'nested',
    sourceComments: 'map'
};

var sassProdOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed'
}

gulp.task('checkJs', function(){
    return gulp.src('./coffee-wp/wp-content/themes/anfrawer/js/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

gulp.task('sass', function(){
    return gulp.src(input)
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions))
    .pipe(sourcemaps.write())
    .pipe(autoprefixer())
    .pipe(gulp.dest(output))
});

gulp.task('sass-prod', function(){
    return gulp.src(input)
    .pipe(sass(sassProdOptions))
    .pipe(autoprefixer())
    .pipe(gulp.dest(outputProd))
});

gulp.task('watch', function(){
    gulp.watch('scss/**/*.scss', ['sass']);
});