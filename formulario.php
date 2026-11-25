<?php
require_once 'config/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$entrada = [
    'id' => '',
    'titulo' => '',
    'categoria' => 'Desarrollo Web',
    'resumen' => '',
    'contenido' => ''
];

// Si viene un ID por URL, cargamos los datos para modo Edición
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM entradas WHERE id = ?");
    $stmt->execute([$id]);
    $registro = $stmt->fetch();
    if ($registro) {
        $entrada = $registro;
    }
}

include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-custom-green text-white py-3">
                <h1 class="h4 mb-0">
                    <i class="bi <?= $id ? 'bi-pencil-square' : 'bi-plus-circle' ?> me-2"></i>
                    <?= $id ? 'Editar Publicación' : 'Nueva Publicación' ?>
                </h1>
            </div>
            <div class="card-body p-4">
                <form id="formEntrada" action="formulario.php<?= $id ? '?id=' . $id : '' ?>" method="POST" novalidate>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($entrada['id']) ?>">

                    <div class="mb-3">
                        <label for="titulo" class="form-label fw-bold text-custom-green">Título del artículo *</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" 
                               value="<?= htmlspecialchars($entrada['titulo']) ?>" 
                               placeholder="Ej. Aprendiendo consultas preparadas en PDO" required>
                        <div class="invalid-feedback">El título es obligatorio (mínimo 5 caracteres).</div>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label fw-bold text-custom-green">Categoría *</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <?php
                            $opciones = ['Desarrollo Web', 'Frontend', 'Backend & PHP', 'Bases de Datos', 'Notas Personales'];
                            foreach ($opciones as $op):
                            ?>
                                <option value="<?= $op ?>" <?= $entrada['categoria'] === $op ? 'selected' : '' ?>>
                                    <?= $op ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="resumen" class="form-label fw-bold text-custom-green">Resumen breve *</label>
                        <textarea class="form-control" id="resumen" name="resumen" rows="2" 
                                  placeholder="Un párrafo corto que aparecerá en la tarjeta principal..." required><?= htmlspecialchars($entrada['resumen']) ?></textarea>
                        <div class="invalid-feedback">Escribe un resumen breve (mínimo 10 caracteres).</div>
                    </div>

                    <div class="mb-4">
                        <label for="contenido" class="form-label fw-bold text-custom-green">Contenido completo *</label>
                        <textarea class="form-control" id="contenido" name="contenido" rows="7" 
                                  placeholder="Desarrolla aquí el contenido completo de tu entrada..." required><?= htmlspecialchars($entrada['contenido']) ?></textarea>
                        <div class="invalid-feedback">El contenido del artículo no puede estar vacío (mínimo 20 caracteres).</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-custom-green px-4">
                            <i class="bi bi-save me-1"></i> <?= $id ? 'Actualizar Entrada' : 'Publicar Entrada' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>