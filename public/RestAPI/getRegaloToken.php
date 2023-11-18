<?php
include 'connection.php'; // Incluye el archivo de conexión a la base de datos

// Verifica si se proporcionó el parámetro 'token' en la solicitud
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    try {
        // Prepara la consulta SQL para seleccionar registros basados en el token y asistencia
        $query = "SELECT registros.usuario_id, registros.paquete_id, registros.regalo_id, registros.asistencia, usuarios.nombre, usuarios.apellido 
                  FROM registros 
                  LEFT JOIN usuarios ON registros.usuario_id = usuarios.id
                  WHERE registros.token = :token";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        // Obtiene el resultado de la consulta
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $nombre = $result['nombre'];
            $apellido = $result['apellido'];
            $paquete_id = $result['paquete_id'];
            $regalo_id = $result['regalo_id'];
            $asistencia = $result['asistencia'];

    
                // Lógica para determinar el valor de 'regalo'
                $regalo = "";
                if ($paquete_id == 1) {
                    // Consulta el nombre del regalo relacionado con regalo_id
                    $query = "SELECT nombre FROM regalos WHERE id = :regalo_id";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':regalo_id', $regalo_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $regaloResult = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($regaloResult) {
                        $regalo = $regaloResult['nombre'];
                    }
                } elseif ($paquete_id == 2 || $paquete_id == 3) {
                    $regalo = "No aplica a regalo";
                }

                // Devuelve la respuesta en formato JSON
                $response = [
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'regalo' => $regalo,
                    'ingreso' => $asistencia,
                ];
                echo json_encode($response);
            
        } else {
            echo "Token no encontrado";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Parámetro 'token' no proporcionado";
}
?>
