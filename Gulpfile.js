var gulp = require('gulp'),
    autoprefixer = require('gulp-autoprefixer'),
	livereload = require('gulp-livereload'),
    sass = require('gulp-sass'),
	notify = require('gulp-notify'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	cssmin = require('gulp-cssmin'),
    rename = require('gulp-rename'),
	imagemin = require('gulp-imagemin'),
	del = require('del'),
	moment = require('moment');

gulp.task('sass', function(){
	return gulp.src('assets/sass/**/*.scss')
	    .pipe(sass())
		.pipe(autoprefixer())
    	.pipe(gulp.dest('assets/css/'))
    	.pipe(livereload({ start: true }))
		.pipe(notify({
			onLast: true,
			title: "Sass compiled successfully.",
			message: getFormatDate()
		}));
});

gulp.task('scripts', function() {
	return gulp.src('assets/scripts/scripts.js')
		.pipe(uglify())
		.pipe(gulp.dest('./'))
		.pipe(notify({ message: 'Scripts task complete <%= file.relative %>' }));
});

gulp.task('cssmin', function () {
	gulp.src('assets/css/master.css')
		.pipe(cssmin())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('assets/css'))
		.pipe(notify({ message: 'Successfully minified master.min.css' }));
});

// The files to be watched for minifying. If more dev js files are added this
// will have to be updated.
gulp.task('watch', ['sass', 'scripts'], function() {
	livereload.listen();

	gulp.watch('assets/sass/**/*.scss', ['sass']);
	gulp.watch('assets/scripts/scripts.js', ['scripts', 'minifyScripts']);
	gulp.watch('assets/css/master.css', ['cssmin']);
});

// First combine, then minify all the listed scripts in two files.
// bundle.js - non-minified version for easy look on the size (development)
// bundle.min.js - minified version (production)
gulp.task('minifyScripts', function () {

	// Add separate folders if required.
	gulp.src([
			'assets/scripts/vendor/*.js',
			'assets/scripts/inc/*.js',
			'assets/scripts/scripts.js',
		])
		.pipe(concat('bundle.js'))
		.pipe(gulp.dest('assets/scripts/'))
		.pipe(rename('bundle.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/scripts/'));
});

// What will be run with simply writing "$ gulp"
gulp.task('default', ['sass', 'watch', 'minifyScripts', 'cssmin']);


// Print the current date formatted. Used for the script compile notify messages.
function getFormatDate() {
	var currentTime = moment().format("LTS");

	return currentTime;
}
