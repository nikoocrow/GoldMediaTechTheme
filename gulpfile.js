const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const fs = require('fs');
const path = require('path');

// Rutas de archivos
const paths = {
  scss: {
    src: 'src/scss/**/*.scss',
    main: 'src/scss/main.scss',
    dest: 'assets/css/'
  },
  js: {
    src: 'src/js/**/*.js',
    dest: 'assets/js/'
  },
  fonts: {
    src: 'src/fonts/**/*',
    dest: 'assets/fonts/'
  }
};

// Función simple para limpiar directorios
function cleanDirectory(dir) {
  return new Promise((resolve) => {
    if (fs.existsSync(dir)) {
      fs.rmSync(dir, { recursive: true, force: true });
    }
    fs.mkdirSync(dir, { recursive: true });
    resolve();
  });
}

// Tarea para compilar SCSS (solo minificado)
function compileSCSS() {
  return gulp.src(paths.scss.main)
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compressed',
      includePaths: ['node_modules'],
      quietDeps: true,        // Suprimir warnings de dependencias
      verbose: false,         // Reducir verbosidad
      silenceDeprecations: ['legacy-js-api']  // Suprimir específicamente el warning legacy-js-api
    }).on('error', sass.logError))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.scss.dest));
}

// Tarea para JavaScript
function compileJS() {
  return gulp.src(paths.js.src)
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    .pipe(gulp.dest(paths.js.dest))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.js.dest))
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.js.dest));
}

// Tarea para copiar fuentes
function copyFonts() {
  return gulp.src(paths.fonts.src)
    .pipe(gulp.dest(paths.fonts.dest));
}

// Tarea para limpiar archivos CSS
function cleanCSS_Files() {
  return cleanDirectory(paths.scss.dest);
}

// Tarea para limpiar archivos JS
function cleanJS_Files() {
  return cleanDirectory(paths.js.dest);
}

// Función para watch (observar cambios)
function watchFiles() {
  gulp.watch(paths.scss.src, compileSCSS);
  gulp.watch(paths.js.src, compileJS);
  gulp.watch(paths.fonts.src, copyFonts);
  
  console.log('👀 Watching for changes...');
  console.log('📁 SCSS:', paths.scss.src);
  console.log('📁 JS:', paths.js.src);
  console.log('📁 Fonts:', paths.fonts.src);
}

// Tareas públicas
exports.scss = compileSCSS;
exports.js = compileJS;
exports.fonts = copyFonts;
exports.cleanCSS = cleanCSS_Files;
exports.cleanJS = cleanJS_Files;

// Tarea de desarrollo
exports.dev = gulp.series(
  cleanCSS_Files,
  gulp.parallel(compileSCSS, copyFonts),
  watchFiles
);

// Tarea de construcción para producción
exports.build = gulp.series(
  cleanCSS_Files,
  gulp.parallel(compileSCSS, copyFonts)
);

// Tarea por defecto
exports.default = exports.dev;

// Watch simple solo para SCSS
exports.watch = function() {
  gulp.watch(paths.scss.src, compileSCSS);
  console.log('👀 Watching SCSS files for changes...');
};