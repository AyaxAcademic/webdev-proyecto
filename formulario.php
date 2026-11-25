<?php
require_once 'config/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$errores = [];
$entrada = [
    'id' => '',
    'titulo' => '',
    'categoria' => 'El dia de hoy...',
    'resumen' => '',
    'contenido' => ''
];

// Si viene un ID por URL (GET), cargamos los datos actuales para editar
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM entradas WHERE id = ?");
    $stmt->execute([$id]);
    $registro = $stmt->fetch();
    if ($registro) {
        $entrada = $registro;
    } else {
        header('Location: index.php');
        exit;
    }
}

// Procesamiento del formulario al enviar por POST (Create o Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPost = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $titulo = trim($_POST['titulo'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $resumen = trim($_POST['resumen'] ?? '');
    $contenido = trim($_POST['contenido'] ?? '');

    // Repoblamos $entrada por si hay errores de validación y hay que volver a mostrar lo escrito
    $entrada = [
        'id' => $idPost ?: '',
        'titulo' => $titulo,
        'categoria' => $categoria,
        'resumen' => $resumen,
        'contenido' => $contenido
    ];

    // Validación del lado del servidor
    if (mb_strlen($titulo) < 5) {
        $errores[] = 'El título debe tener al menos 5 caracteres.';
    }
    if ($categoria === '') {
        $errores[] = 'Debes seleccionar una categoría.';
    }
    if (mb_strlen($resumen) < 10) {
        $errores[] = 'El resumen debe tener al menos 10 caracteres.';
    }
    if (mb_strlen($contenido) < 20) {
        $errores[] = 'El contenido debe tener al menos 20 caracteres.';
    }

    if (empty($errores)) {
        if ($idPost) {
            // UPDATE: Actualizar registro existente
            $stmt = $pdo->prepare("UPDATE entradas SET titulo = ?, categoria = ?, resumen = ?, contenido = ? WHERE id = ?");
            $stmt->execute([$titulo, $categoria, $resumen, $contenido, $idPost]);
            $mensaje = '¡La publicación se actualizó correctamente!';
        } else {
            // CREATE: Insertar nuevo registro
            $stmt = $pdo->prepare("INSERT INTO entradas (titulo, categoria, resumen, contenido) VALUES (?, ?, ?, ?)");
            $stmt->execute([$titulo, $categoria, $resumen, $contenido]);
            $mensaje = '¡Nueva publicación creada con éxito!';
        }

        header('Location: index.php?mensaje=' . urlencode($mensaje));
        exit;
    }
}

include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-custom-green text-white py-3">
                <h1 class="h4 mb-0">
                    <i class="bi <?= $entrada['id'] ? 'bi-pencil-square' : 'bi-plus-circle' ?> me-2"></i>
                    <?= $entrada['id'] ? 'Editar Publicación' : 'Nueva Publicación' ?>
                </h1>
            </div>
            <div class="card-body p-4">

                <!-- Alertas de error si falla validación en servidor -->
                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form id="formEntrada" action="formulario.php<?= $entrada['id'] ? '?id=' . $entrada['id'] : '' ?>" method="POST" novalidate>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($entrada['id']) ?>">

                    <div class="mb-3">
                        <label for="titulo" class="form-label fw-bold text-custom-green">Título del artículo *</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" 
                               value="<?= htmlspecialchars($entrada['titulo']) ?>" 
                               placeholder="Sobre que quieres hablar hoy?" required>
                        <div class="invalid-feedback">El título es obligatorio (mínimo 5 caracteres).</div>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label fw-bold text-custom-green">Categoría *</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <?php
                            $opciones = ['El día de hoy...', 'Viajes y experiencias', 'Hobbies', 'Lecturas y reflexiones', 'Recomendaciones', 'Actualizaciones y noticias', 'Otros'];
                            foreach ($opciones as $op):
                            ?>
                                <option value="<?= $op ?>" <?= $entrada['categoria'] === $op ? 'selected' : '' ?>>
                                    <?= $op ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="resumen" class="form-label fw-bold text-custom-green">Resumen breve *</label>
                            <small id="contadorResumen" class="text-muted">0 caracteres</small>
                        </div>
                        <textarea class="form-control" id="resumen" name="resumen" rows="2" 
                                  placeholder="Un párrafo corto que aparecerá en la tarjeta principal..." required><?= htmlspecialchars($entrada['resumen']) ?></textarea>
                        <div class="invalid-feedback">Escribe un resumen breve (mínimo 10 caracteres).</div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label for="contenido" class="form-label fw-bold text-custom-green">Contenido completo *</label>
                            <small id="contadorContenido" class="text-muted">0 caracteres</small>
                        </div>
                        <textarea class="form-control" id="contenido" name="contenido" rows="7" 
                                  placeholder="Desarrolla aquí el contenido completo de tu entrada..." required><?= htmlspecialchars($entrada['contenido']) ?></textarea>
                        <div class="invalid-feedback">El contenido del artículo no puede estar vacío (mínimo 20 caracteres).</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-custom-green px-4">
                            <i class="bi bi-save me-1"></i> <?= $entrada['id'] ? 'Actualizar Entrada' : 'Publicar Entrada' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>