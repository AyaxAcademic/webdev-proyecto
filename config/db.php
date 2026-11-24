<?php
// config/db.php

$dbDir = __DIR__ . '/../database';
if (!is_dir($dbDir)) {
    mkdir($dbDir, 0777, true);
}

$dbPath = $dbDir . '/blog.sqlite';

try {
    // Conexión a SQLite mediante PDO
    $pdo = new PDO("sqlite:" . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Creación de la tabla principal si no existe
    $sqlCreate = "CREATE TABLE IF NOT EXISTS entradas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo TEXT NOT NULL,
        categoria TEXT NOT NULL,
        resumen TEXT NOT NULL,
        contenido TEXT NOT NULL,
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sqlCreate);

    // Insertar 2 entradas de muestra solo si la tabla está completamente vacía
    $count = $pdo->query("SELECT COUNT(*) FROM entradas")->fetchColumn();
    if ($count == 0) {
        $stmt = $pdo->prepare("INSERT INTO entradas (titulo, categoria, resumen, contenido) VALUES (?, ?, ?, ?)");
        
        $stmt->execute([
            'Iniciando mi primer proyecto web con PHP y SQLite',
            'Desarrollo Web',
            'Configurando la arquitectura multipágina con Bootstrap 5, PHP PDO y persistencia ligera en SQLite.',
            "Hoy dimos el primer gran paso en nuestro proyecto final.\n\nElegimos SQLite porque nos permite almacenar todos los registros del blog en un único archivo portátil sin complicaciones de configuración, integrado directamente con PHP mediante PDO.\n\nEn las siguientes iteraciones conectaremos el formulario para crear, editar y eliminar entradas en tiempo real."
        ]);

        $stmt->execute([
            '¿Por qué usar HTML5 semántico y Bootstrap?',
            'Frontend',
            'La importancia de estructurar correctamente el contenido y mantener consistencia visual en todo el sitio.',
            "El uso de etiquetas semánticas como header, main, article y footer no solo mejora el orden de nuestro código, sino que facilita el mantenimiento.\n\nCombinado con el sistema de grillas de Bootstrap 5, logramos que el blog se adapte perfectamente tanto a pantallas de escritorio como a dispositivos móviles."
        ]);
    }

} catch (PDOException $e) {
    die("Error de conexión con la base de datos SQLite: " . $e->getMessage());
}
?>