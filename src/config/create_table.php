<?php
require_once './DBHelper.php';

function createTable(DBHelper $dbHelper, string $tableName, string $createStatement) {
    try {
        $dbHelper->createTable($tableName, $createStatement);
        echo "Tabla '$tableName' creada exitosamente.\n";
    } catch (Exception $e) {
        echo "Error al crear la tabla '$tableName': " . $e->getMessage() . "\n";
    }
}

// Ejemplo de uso
$dbHelper = new DBHelper();

$tablesToCreate = [
    // 'categoria' => "
    //     id SERIAL PRIMARY KEY,
    //     descripcion VARCHAR(255) NOT NULL
    // ",
    'producto' => "
        codigo SERIAL PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        preciocompra DECIMAL(10, 2) NOT NULL,
        preciodeventa DECIMAL(10, 2) NOT NULL,
        tipoproducto VARCHAR(50) NOT NULL,
        estado VARCHAR(50) NOT NULL
    "
    // Añadir más tablas aquí
    // 'otra_tabla' => "
    //     id SERIAL PRIMARY KEY,
    //     nombre VARCHAR(100) NOT NULL,
    //     descripcion TEXT
    // "
];

foreach ($tablesToCreate as $tableName => $createStatement) {
    createTable($dbHelper, $tableName, $createStatement);
}
?>
