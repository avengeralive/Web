var gulp = require('gulp'),
	styles = require('gulp-less'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	minifyCSS = require('gulp-minify-css'),
	csscomb = require('gulp-csscomb'),
	jade = require('gulp-jade'),
	mainBowerFiles = require('main-bower-files'),
	filter = require('gulp-filter'),
	spritesmith = require('gulp.spritesmith'),
	imagemin = require('gulp-imagemin'),
	rimraf = require('rimraf'),
	autoprefixer = require('gulp-autoprefixer'),
	svgSprite = require("gulp-svg-sprites"),
	runSequence = require('run-sequence'),
	pngquant = require('imagemin-pngquant');

gulp.task('styles', function(){
	gulp.src('app/styles/main.less')
		.pipe(styles())
		.pipe(autoprefixer({
			browsers: ['> 1%'],
			cascade: false
		}))
		.pipe(csscomb())
		.pipe(minifyCSS({
			keepBreaks: false
		}))
		.pipe(gulp.dest('dist/css/'));
});

gulp.task('jade', function() {
	gulp.src('app/templates/pages/*.jade')
		.pipe(jade({
			pretty: '\t'
		}))
		.on('error', console.log)
		.pipe(gulp.dest('dist/'));
});

gulp.task('sprite', function () {
	var spriteData = gulp.src('app/images/sprites/*.png').pipe(spritesmith({
		imgName: 'sprite.png',
		cssName: 'sprite.css',
		imgPath: '../img/sprite.png'
	}));
	spriteData.img
		.pipe(imagemin({
			optimizationLevel: 3,
			interlaced: true,
			progressive: true
		}))
		.pipe(gulp.dest('app/images/'));
	spriteData.css.pipe(gulp.dest('app/styles/helpers'));
});

gulp.task('svg', function () {
    return gulp.src(['app/images/svg/*.svg', '!app/images/svg/sprite.svg'])
        .pipe(svgSprite({
        	cssFile: "../styles/helpers/svg.css",
        	svgPath: "../img/svg/sprite.svg",
        	preview: false
        }))
        .pipe(gulp.dest("app/images/"));
});

gulp.task('images', function() {
	gulp.src([
			'app/images/**/*.{png,jpg,jpeg,gif,svg}',
			'!app/images/sprites'
		])
		.pipe(imagemin({
			optimizationLevel: 3,
			interlaced: true,
			progressive: true
		}))
		.pipe(gulp.dest('dist/img'));
});

gulp.task('js', function() {
	var jsFiles = ['app/scripts/*.js'];
	gulp.src(mainBowerFiles()
		.concat(jsFiles))
		.pipe(filter('*.js'))
		.pipe(concat('main.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/js/'));
});

gulp.task('bower-css', function() {
	gulp.src(mainBowerFiles())
		.pipe(filter('*.css'))
		.pipe(concat('bower-plugins.less'))
		.pipe(gulp.dest('app/styles/helpers/'));
});

gulp.task('watch', function() {
	gulp.watch('app/templates/**/*.jade', ['jade']);
	gulp.watch('app/styles/**/*.less', ['styles']);
});

gulp.task('clean', function (cb) {
	rimraf('./dist', cb);
});

gulp.task('build', function() {
	runSequence(
		'clean',
		'jade',
		'sprite',
		'svg',
		'images',
		'js',
		'bower-css',
		'styles'
	);
});