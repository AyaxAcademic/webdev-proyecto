<?php
require_once 'config/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM entradas WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: index.php');
    exit;
}

include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-custom-green">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($post['categoria']) ?></li>
            </ol>
        </nav>

        <article class="bg-dark-surface p-4 p-md-5 rounded shadow-sm border">
            <header class="mb-4 border-bottom pb-3">
                <span class="badge bg-custom-mid mb-2"><?= htmlspecialchars($post['categoria']) ?></span>
                <h1 class="fw-bold text-custom-green mb-2"><?= htmlspecialchars($post['titulo']) ?></h1>
                <p class="text-muted small mb-0">
                    <i class="bi bi-calendar3 me-1"></i> Publicado el <?= date('d/m/Y \a \l\a\s H:i', strtotime($post['fecha_creacion'])) ?>
                </p>
            </header>

            <p class="lead text-secondary fst-italic mb-4">
                <?= htmlspecialchars($post['resumen']) ?>
            </p>

            <div class="fs-5 lh-base text-light" style="white-space: pre-line;">
                <?= htmlspecialchars($post['contenido']) ?>
            </div>

            <footer class="mt-5 pt-3 border-top d-flex justify-content-between align-items-center">
                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Volver al listado
                </a>
                <div class="d-flex gap-2">
                    <a href="formulario.php?id=<?= $post['id'] ?>" class="btn btn-custom-mid">
                        <i class="bi bi-pencil me-1"></i> Editar entrada
                    </a>
                    <form action="eliminar.php" method="POST" class="d-inline form-eliminar" data-titulo="<?= htmlspecialchars($post['titulo']) ?>">
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-trash me-1"></i> Eliminar
                        </button>
                    </form>
                </div>
            </footer>
        </article>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
            </button>
        </form>
    </div>
</footer>
        </article>
    </div>
</div>

<?php include 'includes/footer.php'; ?>