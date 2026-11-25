<?php
// Detectamos el archivo actual para resaltar el enlace activo en el menú
$paginaActual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nebula de Cristal - Blog Personal</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (útil para botones de editar/eliminar) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <header class="bg-custom-green text-white py-3 mb-4 shadow-sm">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <i class="bi bi-stars fs-4 me-2" style="color: #3E899C;"></i>
                <span class="fs-4 fw-bold">Nebula de Cristal</span>
            </a>
            <nav class="nav nav-pills">
                <a class="nav-link <?= $paginaActual === 'index.php' ? 'active bg-custom-mid fw-bold' : 'text-white-50' ?>" href="index.php">Inicio</a>
                <a class="nav-link <?= $paginaActual === 'formulario.php' ? 'active bg-custom-mid fw-bold' : 'text-white-50' ?>" href="formulario.php">+ Nueva Entrada</a>
                <a class="nav-link <?= $paginaActual === 'acerca.php' ? 'active bg-custom-mid fw-bold' : 'text-white-50' ?>" href="acerca.php">Sobre el Blog</a>
            </nav>
        </div>
    </header>

    <main class="container">