const path = require('path');

const gulp         = require( 'gulp' );

const webpack = require('webpack-stream');

// CSS related plugins
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require( 'gulp-autoprefixer' );
const minifycss    = require( 'gulp-uglifycss' );

// JS related plugins
const concat       = require( 'gulp-concat' );
const uglify       = require( 'gulp-uglify' );
const babelify     = require( 'babelify' );
const browserify   = require( 'browserify' );
const source       = require( 'vinyl-source-stream' );
const buffer       = require( 'vinyl-buffer' );
const stripDebug   = require( 'gulp-strip-debug' );

// Utility plugins
const rename       = require( 'gulp-rename' );
const sourcemaps   = require( 'gulp-sourcemaps' );
const notify       = require( 'gulp-notify' );
const plumber      = require( 'gulp-plumber' );
const options      = require( 'gulp-options' );
const gulpif       = require( 'gulp-if' );
const cleancss     = require('gulp-clean-css');

const del = require('del')

// Browers related plugins
const browserSync  = require( 'browser-sync' ).create();
const reload       = browserSync.reload;

const paths = {
	styles: {
		src: [ './src/scss/mystyle.scss', './src/scss/form.scss', './src/scss/slider.scss', './src/scss/auth.scss' ],
		dest: './assets/'
	},
	scripts: {
		src: './src/js/',
		dest: './assets/'
	},
	mapURL: './'
};

function clean() {
	return del([ 'assets' ]);
}

function styles() {
	return gulp.src(paths.styles.src)
		.pipe( sourcemaps.init() )
		.pipe( sass({
			outputStyle: 'compressed'
		}) )
		.on( 'error', console.error.bind( console ) )
		.pipe( autoprefixer() )
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // удаляем все комментарии из кода
		.pipe(sourcemaps.write(paths.mapURL))
		.pipe( gulp.dest( paths.styles.dest ) )
		.pipe( browserSync.stream() );
}

function scripts() {
	return gulp.src(paths.scripts.src + '*.js')
		.pipe(
			webpack({
				mode: 'development',
				entry: {
					myscript: './src/js/myscript.js',
					form: './src/js/form.js',
					slider: './src/js/slider.js',
					auth: './src/js/auth.js',
				},
				output: {
					filename: '[name].js',
					path: path.resolve(__dirname, 'dist'),
				},
				// optimization: {
				// 	splitChunks: {
				// 		chunks: 'all',
				// 	},
				// },
			})
		)
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe( uglify() )
		.pipe(sourcemaps.write('.'))
		.pipe( gulp.dest( paths.scripts.dest ) )
}

const build = gulp.series(clean, gulp.parallel(styles, scripts));

function watch() {
	gulp.watch(paths.scripts.src, gulp.series(scripts, reload));
	gulp.watch(paths.styles.src, gulp.series(styles, reload));
}

exports.watch = watch;
exports.build = build;

exports.default = build;