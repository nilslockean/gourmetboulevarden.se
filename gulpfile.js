const gulp = require('gulp'),
	del = require('del'),
	pump = require('pump'),
	babel = require('gulp-babel'),
	uglify = require('gulp-uglify'),
	sourcemaps = require('gulp-sourcemaps'),
	jshint = require('gulp-jshint'),
	sass = require('gulp-sass'),
	cleanhtml = require('gulp-cleanhtml'),
	ftp = require('vinyl-ftp')

// Clear dist folder
gulp.task('clear', () =>
  del(['dist'])
)

// Copy static files to dist folder
gulp.task('copy', () =>
  gulp.src(['src/**/*', '!src/**/*.html', '!src/**/*.sass', '!src/**/*.js'])
		.pipe(gulp.dest('dist'))
)

// Copy and compress HTML files
gulp.task('html', () =>
	gulp.src('src/**/*.html')
		.pipe(cleanhtml())
		.pipe(gulp.dest('dist'))
)

// Run scripts through JSHint
gulp.task('jshint', () =>
	gulp.src('src/**/*.js')
		.pipe(jshint({
      esversion: 6, // Prefer ES6
      asi: true // Don't bother with semicolons
    }))
		.pipe(jshint.reporter('default'))
)

// Uglify scripts with sourcemaps
gulp.task('scripts', ['jshint'], () =>
	pump([
		gulp.src('src/**/*.js'),
    sourcemaps.init(),
    babel({presets: ['env']}),
    uglify(),
    sourcemaps.write('.'),
    gulp.dest('dist')
	])
)

// Compile, minify and copy SASS
gulp.task('styles', () =>
	gulp.src('src/**/*.sass')
		.pipe(sass({
			outputStyle: 'compressed'
		}).on('error', sass.logError))
		.pipe(gulp.dest('src'))
)

const defaults = ['copy', 'html', 'scripts', 'styles']

// Run all tasks after build directory has been cleaned
gulp.task('default', ['clear'], () => {
  gulp.start(defaults.concat('watch'))
})

gulp.task('build', defaults)

// Magic watch task <3
gulp.task('watch', () => {
  gulp.watch(['src/**/*', '!src/**/*.html', '!src/**/*.sass'], ['copy'])
  gulp.watch('src/**/*.html', ['html'])
  gulp.watch('src/**/*.js', ['scripts'])
  gulp.watch('src/**/*.sass', ['styles'])
})

// FTP Upload
gulp.task('deploy', ['copy', 'html', 'scripts', 'styles'], () => {
	const conn = ftp.create({
		host: 'ftpcluster.loopia.se',
		user: 'gourmetboulevarden.se',
		password: 'ENTER_PASSWORD'
	})

	const globs = ['dist/**/*', '!dist/**/*.map']
	const options = {
		base: 'dist',
		buffer: false
	}

	return gulp.src(globs, options)
		.pipe( conn.newer('/') ) // only upload newer files
		.pipe( conn.dest('/') )
})
