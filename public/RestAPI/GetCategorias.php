<?php
// Incluye el archivo de conexión a la base de datos
require_once('connection.php');

// Consulta SQL para seleccionar todas las categorías
$sql = "SELECT * FROM categorias";

try {
    // Preparar la consulta
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados en un arreglo asociativo
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($results);
} catch (PDOException $e) {
    die("Error al obtener datos de categorías: " . $e->getMessage());
}
?>
