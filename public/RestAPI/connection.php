<?php

// Define las credenciales de la base de datos
define('DB_HOST', 'ticketsales.store');
define('DB_USER', 'u934629380_useticketsales');
define('DB_PASS', '5ja771U0Np9gx9Akr2o2');
define('DB_NAME', 'u934629380_dbticketsales');

// Intenta establecer una conexión a la base de datos
try {

    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    // Configura PDO para reportar errores en excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Configura la codificación de caracteres a UTF-8
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
