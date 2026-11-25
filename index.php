<?php
require_once 'config/db.php';

// Filtro opcional por categoría desde la barra lateral
$categoriaFiltro = $_GET['categoria'] ?? '';

if ($categoriaFiltro !== '') {
    $stmt = $pdo->prepare("SELECT * FROM entradas WHERE categoria = ? ORDER BY fecha_creacion DESC, id DESC");
    $stmt->execute([$categoriaFiltro]);
} else {
    $stmt = $pdo->query("SELECT * FROM entradas ORDER BY fecha_creacion DESC, id DESC");
}
$entradas = $stmt->fetchAll();

// Obtener lista de categorías distintas para la barra lateral
$categorias = $pdo->query("SELECT DISTINCT categoria FROM entradas ORDER BY categoria ASC")->fetchAll(PDO::FETCH_COLUMN);

include 'includes/header.php';
?>
000s
<!-- Banner Principal -->
<section class="p-4 p-md-5 mb-4 rounded text-white bg-custom-green shadow">
    <div class="col-lg-8 px-0">
        <h1 class="display-5 fst-italic">Bienvenido a mi espacio personal</h1>
        <p class="lead my-3">Bitácora de aprendizaje en desarrollo web construida con HTML5, Bootstrap 5, PHP y SQLite.</p>
        <a href="formulario.php" class="btn btn-light text-custom-green fw-bold">
            <i class="bi bi-plus-circle me-1"></i> Escribir nuevo artículo
        </a>
    </div>
</section>

<!-- Zona de Alertas Dinámicas (la usaremos al crear/editar/eliminar) -->
<?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <?= htmlspecialchars($_GET['mensaje']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
<?php endif; ?>

<div class="row g-5">
    <!-- Columna Principal: Artículos -->
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
            <h2 class="h3 fst-italic mb-0 text-custom-green">
                <?= $categoriaFiltro ? 'Categoría: ' . htmlspecialchars($categoriaFiltro) : 'Publicaciones Recientes' ?>
            </h2>
            <?php if ($categoriaFiltro): ?>
                <a href="index.php" class="btn btn-sm btn-outline-secondary">Ver todas</a>
            <?php endif; ?>
        </div>

        <?php if (empty($entradas)): ?>
            <div class="alert alert-info">
                Aún no hay publicaciones registradas. <a href="formulario.php" class="alert-link">¡Crea la primera aquí!</a>
            </div>
        <?php else: ?>
            <?php foreach ($entradas as $post): ?>
                <article class="card mb-4 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-custom-green"><?= htmlspecialchars($post['categoria']) ?></span>
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i><?= date('d/m/Y H:i', strtotime($post['fecha_creacion'])) ?>
                            </small>
                        </div>
                        <h3 class="card-title h4 fw-bold text-custom-green">
                            <a href="detalle.php?id=<?= $post['id'] ?>" class="text-decoration-none text-custom-green">
                                <?= htmlspecialchars($post['titulo']) ?>
                            </a>
                        </h3>
                        <p class="card-text text-secondary"><?= htmlspecialchars($post['resumen']) ?></p>
                        
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <a href="detalle.php?id=<?= $post['id'] ?>" class="btn btn-custom-green btn-sm">
                                Leer artículo completo <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                            <div>
                                <a href="formulario.php?id=<?= $post['id'] ?>" class="btn btn-outline-secondary btn-sm" title="Editar">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Barra Lateral -->
    <aside class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
            <div class="p-4 mb-3 bg-white rounded shadow-sm border">
                <h4 class="fst-italic text-custom-green">Acerca del Autor</h4>
                <p class="mb-2 text-muted small">Desarrollador web junior construyendo una aplicación CRUD completa con persistencia en SQLite.</p>
                <a href="acerca.php" class="text-custom-green small fw-bold text-decoration-none">Conocer más &rarr;</a>
            </div>

            <div class="p-4 bg-white rounded shadow-sm border">
                <h4 class="fst-italic text-custom-green">Categorías</h4>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1">
                        <a href="index.php" class="text-decoration-none <?= $categoriaFiltro === '' ? 'fw-bold text-custom-green' : 'text-secondary' ?>">
                            Todas las entradas
                        </a>
                    </li>
                    <?php foreach ($categorias as $cat): ?>
                        <li class="mb-1">
                            <a href="index.php?categoria=<?= urlencode($cat) ?>" 
                               class="text-decoration-none <?= $categoriaFiltro === $cat ? 'fw-bold text-custom-green' : 'text-secondary' ?>">
                                • <?= htmlspecialchars($cat) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </aside>
</div>

<?php include 'includes/footer.php'; ?>