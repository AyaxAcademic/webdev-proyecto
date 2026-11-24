<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Blog Personal</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --verde-petroleo: #002B36;
            --verde-petroleo-hover: #004050;
        }

        body {
            background-color: #f8f9fa;
        }
        .bg-custom-green {
            background-color: var(--verde-petroleo) !important;
        }

        .text-custom-green {
            color: var(--verde-petroleo) !important;
        }

        .btn-custom-green {
            background-color: var(--verde-petroleo);
            border-color: var(--verde-petroleo);
            color: #ffffff;
        }

        .btn-custom-green:hover {
            background-color: var(--verde-petroleo-hover);
            border-color: var(--verde-petroleo-hover);
            color: #ffffff;
        }

        .blog-header {
            border-bottom: 1px solid #e5e5e5;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación superior -->
    <header class="bg-custom-green text-white py-3 mb-4 shadow-sm">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <span class="fs-4 fw-bold">Bitácora Dev</span>
            </a>
            <nav class="nav">
                <a class="nav-link text-white active" href="#">Inicio</a>
                <a class="nav-link text-white-50" href="#">Artículos</a>
                <a class="nav-link text-white-50" href="#">Sobre mí</a>
            </nav>
        </div>
    </header>

    <!-- Contenedor Principal -->
    <main class="container">
        
        <!-- Banner / Artículo Destacado (Estilo plantilla Blog de Bootstrap) -->
        <div class="p-4 p-md-5 mb-4 rounded text-white bg-custom-green shadow">
            <div class="col-lg-8 px-0">
                <h1 class="display-5 fst-italic">Bienvenido a mi espacio personal</h1>
                <p class="lead my-3">Un lugar para documentar mi aprendizaje en desarrollo web, compartir ideas y experimentar con código limpio.</p>
                <p class="lead mb-0"><a href="#articulos" class="text-white fw-bold text-decoration-underline">Explorar entradas...</a></p>
            </div>
        </div>

        <!-- Sección de Artículos + Barra Lateral -->
        <div class="row g-5" id="articulos">
            
            <!-- Columna Principal: Lista de Posts (Aquí conectaremos el CRUD después) -->
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                    <h3 class="fst-italic mb-0 text-custom-green">Publicaciones Recientes</h3>
                    <!-- Botón preparado para el futuro CRUD -->
                    <button class="btn btn-custom-green btn-sm">+ Nueva Entrada</button>
                </div>

                <!-- Ejemplo de Post 1 -->
                <article class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <span class="badge bg-custom-green mb-2">Desarrollo Web</span>
                        <h2 class="card-title h4 fw-bold text-custom-green">Iniciando mi primer proyecto con Bootstrap</h2>
                        <p class="text-muted small mb-3">24 de Noviembre, 2026 • Por Desarrollador Junior</p>
                        <p class="card-text">Hoy comenzamos a estructurar la base visual de nuestro blog. Elegimos una paleta sobria y profesional utilizando el sistema de grillas de Bootstrap 5.</p>
                        <a href="#" class="btn btn-outline-dark btn-sm">Leer más</a>
                    </div>
                </article>

                <!-- Ejemplo de Post 2 -->
                <article class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <span class="badge bg-secondary mb-2">Notas</span>
                        <h2 class="card-title h4 fw-bold text-custom-green">¿Por qué aprender SQLite?</h2>
                        <p class="text-muted small mb-3">20 de Noviembre, 2026 • Por Desarrollador Junior</p>
                        <p class="card-text">SQLite es ligero, rápido y no requiere configurar un servidor complejo, lo que lo hace ideal para proyectos personales y prototipos funcionales.</p>
                        <a href="#" class="btn btn-outline-dark btn-sm">Leer más</a>
                    </div>
                </article>
            </div>

            <!-- Barra Lateral (Sidebar) -->
            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-white rounded shadow-sm border">
                        <h4 class="fst-italic text-custom-green">Acerca de</h4>
                        <p class="mb-0 text-muted">Hola, soy un desarrollador web junior construyendo este blog paso a paso con HTML, CSS, Bootstrap, JS y SQLite.</p>
                    </div>

                    <div class="p-4 bg-white rounded shadow-sm border">
                        <h4 class="fst-italic text-custom-green">Categorías</h4>
                        <ol class="list-unstyled mb-0">
                            <li><a href="#" class="text-custom-green text-decoration-none">HTML & CSS</a></li>
                            <li><a href="#" class="text-custom-green text-decoration-none">JavaScript</a></li>
                            <li><a href="#" class="text-custom-green text-decoration-none">Bases de Datos</a></li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Pie de página -->
    <footer class="py-4 mt-5 bg-white border-top text-center text-muted">
        <div class="container">
            <p class="mb-0">Blog Personal &copy; 2026 - Construido paso a paso.</p>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>