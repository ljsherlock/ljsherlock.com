const gulp = require('gulp');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');

gulp.task('sass:build', function() {
	gulp.src('./style.scss')
		.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
		.pipe(postcss([ autoprefixer({ browsers: ['> 5%', 'IE 9'] }) ]))
		.pipe(rename({ suffix: '.min' }))
		.pipe(gulp.dest('./css'));
});


gulp.task('sass:dev', function() {
	gulp.src('./style.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(postcss([ autoprefixer({ browsers: ['> 5%', 'IE 9'] }) ]))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./css'));
})


gulp.task('sass:watch', ['sass:dev'], function() {
	gulp.watch(['./style.scss', './sass/**/*.scss'], ['sass:dev']);
});

gulp.task('default', ['sass:watch']);
gulp.task('build', ['sass:build']);