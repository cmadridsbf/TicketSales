<?php
// Incluir archivo de conexión a la base de datos
include_once 'connection.php';

// Recoger los parámetros de la URL
$fechaInicio = isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : die();
$fechaFin = isset($_GET['fechaFin']) ? $_GET['fechaFin'] : die();
$idPaquete = isset($_GET['idpaquete']) ? $_GET['idpaquete'] : die();

// Preparar la consulta SQL
$query = "SELECT u.nombre, u.apellido, p.nombre AS paquete, rg.nombre AS regalo, 
                 DATE_FORMAT(r.fecha_compra, '%d de %M de %Y') as fecha_compra_formateada
          FROM registros r
          INNER JOIN usuarios u ON r.usuario_id = u.id
          INNER JOIN paquetes p ON r.paquete_id = p.id
          INNER JOIN regalos rg ON r.regalo_id = rg.id
          WHERE r.paquete_id = :idPaquete AND r.fecha_compra BETWEEN :fechaInicio AND :fechaFin";

// Preparar la declaración
$stmt = $pdo->prepare($query);

// Vincular los parámetros
$stmt->bindParam(':fechaInicio', $fechaInicio);
$stmt->bindParam(':fechaFin', $fechaFin);
$stmt->bindParam(':idPaquete', $idPaquete);

// Ejecutar la consulta
$stmt->execute();

// Comprobar si hay resultados
if($stmt->rowCount() > 0){
    // Inicializar el array de resultados
    $registrosArray = array();

    // Recorrer los resultados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $registro_item = array(
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'paquete' => $row['paquete'],
            'regalo' => $row['regalo'],
            'fecha_compra' => $row['fecha_compra_formateada']
        );

        array_push($registrosArray, $registro_item);
    }

    // Devolver los resultados en formato JSON
    echo json_encode($registrosArray);
} else{
    // No se encontraron registros
    echo json_encode(array('mensaje' => 'No se encontraron registros.'));
}
?>
