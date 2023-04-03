var gulp = require('gulp');
var browserSync = require('browser-sync').create();
// var sass = require('gulp-sass');

// gulp.task('sass', function(done) {
//     gulp.src("scr/scss/*.scss")
//         .pipe(sass())
//         .pipe(gulp.dest("scr/css"))
//         .pipe(browserSync.stream());


//     done();
// });

gulp.task('serve', function (done) {

  browserSync.init({
    proxy: "http://hw7.php.top/"
  });

  // gulp.watch("scr/sass/*.sass", gulp.series('sass'));
  gulp.watch([
    "*.*",
    "pages/*.*",
    "js/*.*", 
    "css/*.*",
    "images/*.*"
  ]).on('change', () => {
    browserSync.reload();
    done();
  });


  done();
});

gulp.task('default', gulp.series('serve'));
// gulp.task('default', gulp.series('sass', 'serve'));