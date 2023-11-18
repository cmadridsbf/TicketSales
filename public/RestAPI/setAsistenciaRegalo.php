<?php
include 'connection.php'; // Incluye el archivo de conexión a la base de datos

// Verifica si se proporcionó el parámetro 'token' en la solicitud
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    try {
        // Consulta SQL para obtener el paquete_id asociado al token
        $query = "SELECT paquete_id FROM registros WHERE token = :token";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $paquete_id = $row['paquete_id'];

            // Consulta SQL para actualizar registros basados en el token
            $query = "UPDATE registros SET asistencia = 1";

            // Actualiza regalo_reclamado solo si el paquete_id es 1
            if ($paquete_id == 1) {
                $query .= ", regalo_reclamado = 1";
            }

            $query .= " WHERE token = :token";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

            // Verifica si se realizaron actualizaciones
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                $response = [
                    'actualizado' => "1",
                ];
                
            } else {
                $response = [
                    'actualizado' => "0",
                ];
            }
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
