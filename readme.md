# Nebula de Cristal — Blog Personal

**Nebula de Cristal** es una aplicación web tipo blog personal diseñada para registrar, organizar y compartir relatos cotidianos, reflexiones, viajes y experiencias de vida. El proyecto integra desarrollo frontend responsivo, interactividad en el cliente y persistencia de datos relacional mediante operaciones CRUD completas.

---

## Características Principales

- **Arquitectura Multipágina:** Navegación fluida entre 4 vistas independientes (`index.php`, `detalle.php`, `formulario.php` y `acerca.php`) con componentes compartidos (`header.php` y `footer.php`).
- **Operaciones CRUD Completas:**
  - **Crear (Create):** Formulario para redactar nuevas publicaciones asignándoles título, categoría, resumen y contenido completo.
  - **Leer (Read):** Listado dinámico de artículos ordenados cronológicamente, filtrado por categorías y vista individual de lectura.
  - **Actualizar (Update):** Edición de publicaciones existentes precargando sus datos actuales desde la base de datos.
  - **Eliminar (Delete):** Borrado seguro mediante peticiones `POST` con cuadro de confirmación previo.
- **Interactividad y Validación en Cliente:** Validación en tiempo real de longitud mínima, contadores dinámicos de caracteres, confirmaciones interactivas y alertas auto-descartables mediante JavaScript.
- **Diseño Responsivo y Consistente:** Maquetación adaptable a dispositivos móviles y escritorio utilizando Bootstrap 5 y una paleta personalizada en verde petróleo (`#002B36`).

---

## Tecnologías Utilizadas

- **Estructura:** HTML5 semántico (`<header>`, `<main>`, `<section>`, `<article>`, `<aside>`, `<footer>`).
- **Estilos:** CSS3 personalizado + Bootstrap 5.3 + Bootstrap Icons.
- **Interactividad:** JavaScript (ES6+) con manipulación del DOM y eventos en tiempo real.
- **Backend:** PHP 8+ con extensión PDO y consultas preparadas (prevención de inyección SQL).
- **Base de Datos:** SQLite (`database/blog.sqlite`).
- **Control de Versiones:** Git y GitHub.

---

## Estructura del Proyecto

```
nebula-de-cristal/
├── assets/
│   ├── css/
│   │   └── styles.css      # Paleta de colores y estilos personalizados
│   └── js/
│       └── app.js          # Validaciones, contadores y confirmaciones dinámicas
├── config/
│   └── db.php              # Conexión PDO a SQLite e inicialización de tabla
├── database/
│   └── blog.sqlite         # Base de datos SQLite del proyecto
├── includes/
│   ├── header.php          # Encabezado y barra de navegación compartida
│   └── footer.php          # Pie de página y carga de scripts
├── index.php               # Página principal: listado dinámico y filtro por categoría
├── detalle.php             # Vista individual de lectura de cada publicación
├── formulario.php          # Formulario unificado para crear y editar entradas
├── eliminar.php            # Controlador de eliminación de registros
├── acerca.php              # Información sobre el propósito del blog
└── README.md               # Documentación del proyecto
```

---

## Instrucciones de Ejecución Local

**Requisitos Previos**
- *PHP 8.0* o superior con las extensiones pdo_sqlite y sqlite3 habilitadas en php.ini (incluido en XAMPP, Laragon o instalación independiente de PHP).
- *Un navegador web moderno.*

**PASO #1**
Clona este repositorio o descarga el código fuente:
```git clone https://github.com/AyaxAcademic/webdev-proyecto```

**PASO #2**
Abre una terminal dentro de la carpeta raíz del proyecto y ejecuta:
```php -S localhost:8000```

**PASO #3**
Abre tu navegador y visita ```http://localhost:8000```
Nota: La base de datos se encuentra en `database/blog.sqlite.` En caso de que el archivo no exista, `config/db.php` lo creará y estructurará automáticamente al cargar la aplicación por primera vez.