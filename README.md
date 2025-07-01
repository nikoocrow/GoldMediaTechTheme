# 🎨 GoldMediaTechTheme - Prueba Técnica

## ⚡ Descripción
**GoldMediaTechTheme** es un theme personalizado desarrollado específicamente para **prueba técnica laboral**. Diseñado para demostrar conocimientos en desarrollo WordPress, integración con plugins personalizados y mejores prácticas de desarrollo frontend.

**Nombre del Theme:** GoldMediaTechTheme  
**Propósito:** Demostración de habilidades técnicas  
**Estado:** Desarrollo/Testing  
**Compatibilidad:** WordPress 5.0+  
**Autor:** Gold Media Tech

## 🏢 Información de la Empresa

**Gold Media Tech** - Desarrollo de soluciones digitales  
**Proyecto:** Prueba técnica para evaluación de habilidades  
**Enfoque:** Demostración de competencias en WordPress y tecnologías web

### 🎯 Objetivos de Evaluación
- **Desarrollo de themes** personalizados
- **Integración con plugins** propios
- **Mejores prácticas** de WordPress
- **Responsive design** y UX/UI
- **Integración con APIs** externas (Google Maps)
- **Código limpio** y documentado

## ⚙️ Sistema de Build con Gulp

### 🔧 Configuración de Gulp

#### package.json
```json
{
  "name": "goldmediatechtheme",
  "version": "1.0.0",
  "description": "Theme personalizado para prueba técnica",
  "main": "gulpfile.js",
  "scripts": {
    "build": "gulp build",
    "dev": "gulp dev", 
    "watch": "gulp watch",
    "clean": "gulp clean"
  },
  "devDependencies": {
    "gulp": "^4.0.2",
    "gulp-sass": "^5.1.0",
    "gulp-uglify": "^3.0.2",
    "gulp-clean-css": "^4.3.0",
    "gulp-rename": "^2.0.0",
    "gulp-sourcemaps": "^3.0.0",
    "gulp-autoprefixer": "^8.0.0",
    "gulp-imagemin": "^8.0.0",
    "gulp-watch": "^5.0.1",
    "sass": "^1.54.0"
  }
}
```

#### gulpfile.js (configuración principal)
```javascript
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const uglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const imagemin = require('gulp-imagemin');

// Rutas de archivos
const paths = {
  scss: 'src/scss/**/*.scss',
  js: 'src/js/**/*.js',
  images: 'src/images/**/*',
  css: 'assets/css/',
  jsOutput: 'assets/js/',
  imagesOutput: 'assets/images/'
};

// Compilar SCSS
function compileSCSS() {
  return gulp.src(paths.scss)
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.css))
    .pipe(cleanCSS())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.css));
}

// Minificar JavaScript
function minifyJS() {
  return gulp.src(paths.js)
    .pipe(sourcemaps.init())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.jsOutput))
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.jsOutput));
}

// Optimizar imágenes
function optimizeImages() {
  return gulp.src(paths.images)
    .pipe(imagemin())
    .pipe(gulp.dest(paths.imagesOutput));
}

// Watch task
function watchFiles() {
  gulp.watch(paths.scss, compileSCSS);
  gulp.watch(paths.js, minifyJS);
  gulp.watch(paths.images, optimizeImages);
}

// Tareas públicas
exports.scss = compileSCSS;
exports.js = minifyJS;
exports.images = optimizeImages;
exports.watch = watchFiles;
exports.build = gulp.parallel(compileSCSS, minifyJS, optimizeImages);
exports.dev = gulp.series(exports.build, watchFiles);
exports.default = exports.build;
```

### 🚀 Comandos de Desarrollo

```bash
# Instalar dependencias
npm install

# Compilar todo para producción (archivos minificados)
npm run build

# Compilar para desarrollo (con sourcemaps)
npm run dev

# Watch mode - recompila automáticamente al detectar cambios
npm run watch

# Limpiar archivos compilados
npm run clean
```

### 📁 Flujo de Trabajo

1. **Desarrollo** - Escribir código en `/src/`
2. **Compilación** - Gulp procesa y minifica archivos
3. **Salida** - Archivos listos van a `/assets/`
4. **WordPress** - Carga archivos según `WP_DEBUG`

### ⚡ Beneficios del Build System

- **Minificación automática** de CSS y JavaScript
- **Autoprefixer** para compatibilidad con navegadores
- **Sourcemaps** para debugging en desarrollo
- **Optimización de imágenes** automática
- **Watch mode** para desarrollo eficiente
- **Separación clara** entre archivos fuente y compilados

---

## 🎯 Objetivos de la Prueba

### 📋 Requisitos Técnicos Demostrados
- ✅ **Integración con plugin personalizado** (Ubicaciones Gold Media Test)
- ✅ **Templates personalizados** para Custom Post Types
- ✅ **Responsive design** con CSS moderno
- ✅ **Integración con Google Maps API**
- ✅ **Optimización para SEO**
- ✅ **Mejores prácticas de WordPress**

### 🛠️ Tecnologías Utilizadas
- **WordPress** - CMS base
- **PHP** - Lógica del theme
- **HTML5/CSS3** - Estructura y estilos
- **JavaScript** - Interactividad
- **Google Maps API** - Mapas interactivos
- **Material Icons** - Iconografía
- **Gulp** - Automatización y minificación de archivos
- **Sass/SCSS** - Preprocesador CSS (opcional)
- **NPM** - Gestión de dependencias

---

## 📁 Estructura del Theme

```
goldmediatechtheme/
├── style.css (archivo principal del theme)
├── index.php (template principal)
├── functions.php (funciones del theme)
├── header.php (cabecera)
├── footer.php (pie de página)
├── sidebar.php (barra lateral)
├── single.php (posts individuales)
├── page.php (páginas)
├── archive.php (archivo general)
├── 404.php (página de error)
├── search.php (resultados de búsqueda)
│
├── Templates específicos para plugin:
├── archive-ubicaciones.php (archivo de ubicaciones)
├── single-ubicaciones.php (ubicación individual)
├── page-mapa.php (página de mapa)
│
├── assets/ (archivos compilados/minificados)
│   ├── css/
│   │   ├── main.min.css (CSS principal minificado)
│   │   └── responsive.min.css (responsive minificado)
│   ├── js/
│   │   ├── main.min.js (JavaScript principal minificado)
│   │   └── maps.min.js (funcionalidades de mapas minificado)
│   └── images/
│       └── (imágenes optimizadas)
│
├── src/ (archivos fuente para desarrollo)
│   ├── scss/
│   │   ├── main.scss (estilos principales)
│   │   ├── responsive.scss (responsive design)
│   │   ├── variables.scss (variables CSS/SCSS)
│   │   └── components/ (componentes modulares)
│   └── js/
│       ├── main.js (JavaScript sin minificar)
│       └── maps.js (funcionalidades de mapas)
│
├── Build tools:
├── gulpfile.js (configuración de Gulp)
├── package.json (dependencias de NPM)
├── package-lock.json (lock de dependencias)
│
└── inc/
    ├── theme-setup.php (configuración del theme)
    ├── enqueue-scripts.php (carga de CSS/JS)
    ├── customizer.php (personalización)
    └── template-functions.php (funciones auxiliares)
```

---

## 🚀 Instalación y Configuración

### 📦 Instalación del Theme
1. **Subir archivos** a `/wp-content/themes/goldmediatechtheme/`
2. **Instalar dependencias** de desarrollo (opcional):
   ```bash
   npm install
   ```
3. **Ejecutar Gulp** para compilar assets (desarrollo):
   ```bash
   npm run build    # Compilación para producción
   npm run dev      # Compilación para desarrollo
   npm run watch    # Watch mode para desarrollo
   ```
4. **Activar theme** desde `Apariencia > Themes` en WordPress admin
5. **Instalar plugin** "Ubicaciones Gold Media Test" (requerido)
6. **Configurar API Key** de Google Maps en plugin

### ⚙️ Configuración Inicial
1. **Menús de navegación:**
   - Crear menú principal en `Apariencia > Menús`
   - Asignar a ubicación "Menú Principal"

2. **Widgets:**
   - Configurar widgets en `Apariencia > Widgets`
   - Áreas disponibles: Sidebar, Footer

3. **Customizer:**
   - Personalizar colores, tipografías y layout
   - Acceder desde `Apariencia > Personalizar`

---

## 🎨 Características del Design

### 🌈 Paleta de Colores
```css
/* Variables CSS principales */
:root {
    --primary-color: #1B1B1B;      /* Negro principal */
    --secondary-color: #64646A;    /* Gris secundario */
    --accent-color: #007cba;       /* Azul de acento */
    --success-color: #EEEFF1;      /* Gris claro */
    --white-color: #FFFFFF;        /* Blanco */
    --text-color: #333333;         /* Texto principal */
    --light-gray: #F3F4F5;         /* Gris muy claro */
}
```

### 📱 Responsive Design
- **Mobile First** - Diseño que inicia desde móvil
- **Breakpoints estándar:**
  - Mobile: 320px - 767px
  - Tablet: 768px - 1024px  
  - Desktop: 1025px+
- **Grid flexibles** para adaptación automática
- **Imágenes responsivas** con `srcset`

### 🎯 Elementos de UI
- **Botones consistentes** con hover effects
- **Cards responsivas** para contenido
- **Formularios estilizados** con validación visual
- **Material Icons** para iconografía coherente
- **Animaciones sutiles** con CSS transitions

---

## 🗺️ Integración con Plugin de Ubicaciones

### 📄 Templates Personalizados

#### `archive-ubicaciones.php`
- **Lista de ubicaciones** con filtros
- **Mapa general** con todas las ubicaciones
- **Cards de ubicación** con información clave
- **Paginación estilizada**
- **Sistema de búsqueda** integrado

#### `single-ubicaciones.php`  
- **Mapa individual** de la ubicación
- **Información completa** de contacto
- **Galería de imágenes** (si disponible)
- **Formulario de contacto** modal
- **Botón de "Cómo llegar"** a Google Maps

#### `page-mapa.php`
- **Página dedicada** para mapa general
- **Filtros avanzados** por categoría
- **Vista de lista/mapa** intercambiable

### 🎨 Estilos Integrados
- **Variables CSS compartidas** entre theme y plugin
- **Consistencia visual** en todos los elementos
- **Responsive design** en mapas y formularios
- **Material Icons** para iconografía uniforme

---

## 🔧 Funcionalidades del Theme

### 📋 Funciones Principales (functions.php)
```php
/**
 * Theme Name: GoldMediaTechTheme
 * Description: Theme personalizado para prueba técnica
 * Version: 1.0.0
 * Author: Gold Media Tech
 */

// Configuración básica del theme
function goldmediatech_theme_setup() {
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para títulos dinámicos
    add_theme_support('title-tag');
    
    // Soporte para menús de navegación
    register_nav_menus(array(
        'primary' => 'Menú Principal',
        'footer' => 'Menú Footer'
    ));
    
    // Soporte para widgets
    add_theme_support('widgets');
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 
        'gallery', 'caption'
    ));
}
add_action('after_setup_theme', 'goldmediatech_theme_setup');
```

### 🎨 Carga de Assets
```php
function goldmediatech_enqueue_scripts() {
    // Determinar si usar archivos minificados o no
    $suffix = (defined('WP_DEBUG') && WP_DEBUG) ? '' : '.min';
    
    // CSS principal
    wp_enqueue_style('goldmediatech-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('goldmediatech-main', 
        get_template_directory_uri() . "/assets/css/main{$suffix}.css", 
        array(), '1.0.0'
    );
    
    // JavaScript
    wp_enqueue_script('goldmediatech-main', 
        get_template_directory_uri() . "/assets/js/main{$suffix}.js", 
        array('jquery'), '1.0.0', true
    );
    
    // Material Icons (compatible con plugin)
    wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
    
    // Integración con plugin de ubicaciones
    if (is_singular('ubicaciones') || is_post_type_archive('ubicaciones')) {
        wp_enqueue_script('goldmediatech-maps', 
            get_template_directory_uri() . "/assets/js/maps{$suffix}.js", 
            array('jquery'), '1.0.0', true
        );
    }
}
add_action('wp_enqueue_scripts', 'goldmediatech_enqueue_scripts');
```

### 🔧 Customizer Options
- **Colores del sitio** (primario, secundario, texto)
- **Tipografías** (títulos, texto, botones)
- **Layout options** (sidebar, full-width)
- **Footer configuration** (texto, links sociales)

---

## 📱 Templates y Páginas

### 🏠 Página de Inicio
- **Hero section** con call-to-action
- **Sección de ubicaciones** destacadas
- **Mapa interactivo** con ubicaciones principales
- **Sección "Acerca de"**
- **Formulario de contacto** general

### 📄 Páginas Internas
- **Layout consistente** en todas las páginas
- **Breadcrumbs** para navegación
- **Sidebar configurable** según tipo de contenido
- **Share buttons** en posts
- **Navegación entre posts** relacionados

### 🔍 Página de Búsqueda
- **Resultados organizados** por tipo de contenido
- **Filtros por categoría** y fecha
- **Vista de grid/lista** intercambiable
- **Sin resultados** con sugerencias

---

## ⚡ Optimización y Performance

### 🚀 Mejoras de Velocidad
- **CSS/JS minificados** automáticamente con Gulp
- **Autoprefixer** para compatibilidad de navegadores
- **Sourcemaps** en desarrollo para debugging
- **Lazy loading** de imágenes
- **Carga condicional** de scripts según página
- **Optimización de consultas** a base de datos
- **Imágenes optimizadas** con gulp-imagemin
- **Archivos comprimidos** en producción vs desarrollo

### 📱 SEO y Accesibilidad
- **Schema markup** para ubicaciones
- **Alt tags** en todas las imágenes
- **Headings jerárquicos** (h1, h2, h3...)
- **ARIA labels** en elementos interactivos
- **Contraste de colores** accesible

### 🔒 Seguridad
- **Escape de datos** en todos los outputs
- **Nonces** en formularios
- **Sanitización** de inputs
- **Validación** del lado del servidor

---

## 🧪 Testing y QA

### 📋 Checklist de Pruebas
- ✅ **Responsive design** en diferentes dispositivos
- ✅ **Compatibilidad** con navegadores (Chrome, Firefox, Safari, Edge)
- ✅ **Funcionalidad de mapas** en todos los templates
- ✅ **Formularios de contacto** funcionando correctamente
- ✅ **Validación W3C** de HTML/CSS
- ✅ **Accesibilidad** básica (contraste, teclado)
- ✅ **Performance** con PageSpeed Insights

### 🐛 Debugging
- **WP_DEBUG activ
