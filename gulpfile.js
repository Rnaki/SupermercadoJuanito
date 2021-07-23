var gulp = require('gulp'),
    connect = require('gulp-connect-php'),
    jquery = require('jquery'),
    browserSync = require('browser-sync').create();
    gulp.task('default', function() {
      
    connect.server({}, function (){
        browserSync.init({
          proxy: 'test2.local/index.php',
          port: 81
        });
  gulp.watch('./*.html').on('change', browserSync.reload),
  gulp.watch('assets/css/*.css').on('change', browserSync.reload),
  gulp.watch('assets/js/*.js').on('change', browserSync.reload),
  gulp.watch('*.php').on('change', function () {browserSync.reload()});
  gulp.watch('php/*.php').on('change', function () {browserSync.reload()});
})
    })
