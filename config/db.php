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
            'El primer post en Nebula de Cristal',
            'Actualizaciones y noticias',
            'Te voy a ser sincero Baki, extraño MySpace (aunque ni siquiera lo usé lmao). Así que cree un blog para llenar ese vacio! Quien sabe, chance y revivimos los foros con esta cosa.',
            "La verdad es que hay algo sobre el antiguo internet que me ha llamado desde siempre. Claramente no fui un usuario del mismo, pero ver lo que otras personas han documentado (principalmente en YouTube) me hace añorar tiempos que no me corresponden. \n\n Asi que, vamos a hacer que me correspondan! Aunque ya no esten en su auge, y probablemente no se vuelva un proyecto particularmente más grande que mi órbita cercana de amigos y conocidos, nada perdemos haciendo el intento. \n\n Así que bienvenidos al show, recuerden reclamarme cuando vean que no subo nada y así ambos ganamos. \n\n En el mejor de los casos, se vuelve popular y lo sigo trabajando y creamos MySpace 2 pero nada más con mis amigos, en el peor de los casos es un diario digital que seguramente no se me pierda tan facil como uno físico."
        ]);

        $stmt->execute([
            'Preparando todo para mi viaje a Puebla',
            'Viajes y experiencias',
            'Tras el grandísimo FOMO que me dió no estar en el Corona Capital la semana pasada, toca prepararnos para ir al Tecate Comuna.',
            "Todo este fin de semana, mi feed de Instagram estuvo lleno de fotos y videos del Corona Capital, y he de decir que por primera vez en mucho tiempo sentí a lo que el internauta veinteañero promedio le llama FOMO. \n\n No tanto por el show ni los artistas, sino por el hecho de que Julian Casablancas de The Strokes se ha reportado A TIEMPO al escenario y hasta rumores hay de que estaba SOBRIO ? ! ? ! \n\n Así que bueno, ya me lo perdí, nada que hacer pero tampoco me voy a quedar con las ganas: el Tecate Comuna se aplroxima este fin de semana y es el evento para el que yo había estado preparándome desde hace un par de meses. \n\n No he comprado outfits nuevos, pero ya tenemos los boletos del avión, el festival y el hotel, así que solo queda esperar a que llegue el jueves (lo cual no es NADA de tiempo en lo absoluto) y caer en una crisis cuando José Madero y Enjambre estén tocando al mismo tiempo y no pueda decidir a cuál ir. \n\n En fin, ya les contaré cómo me fue, y si me da el tiempo, subiré fotos y videos de lo que vaya pasando en el viaje. \n\n P.S: Donaciones para cervezas siempre son bienvenidas."
        ]);
    }

} catch (PDOException $e) {
    die("Error de conexión con la base de datos SQLite: " . $e->getMessage());
}
?>