<?php
$usuarioId = $_GET['usuarioId'];



    // Utiliza las credenciales de la base de datos definidas previamente
    include 'connection.php'; // Asegúrate de que este archivo se incluya correctamente

    try {
        // Preparar la consulta para obtener el ID del registro
        $stmtRegistro = $pdo->prepare("SELECT id FROM registros WHERE usuario_id = :usuarioId LIMIT 1");
        $stmtRegistro->execute(['usuarioId' => $usuarioId]);

        // Comprobar si se encontró el registro
        if ($stmtRegistro->rowCount() > 0) {
            $registro = $stmtRegistro->fetch(PDO::FETCH_ASSOC);
            $registroId = $registro['id'];

            // Preparar la consulta para contar los eventos relacionados con el registro
            $stmtEventos = $pdo->prepare("SELECT COUNT(*) AS cantidad FROM eventos_registros WHERE registro_id = :registroId");
            $stmtEventos->execute(['registroId' => $registroId]);

            // Obtener la cantidad de eventos
            $eventos = $stmtEventos->fetch(PDO::FETCH_ASSOC);
            $cantidadEventos = $eventos['cantidad'];

            // Devolver true si hay eventos, false de lo contrario
            echo json_encode([$cantidadEventos > 0]);
        } else {
            // No se encontró el registro para el usuarioId proporcionado
            echo json_encode([false]);
        }
    } catch (PDOException $e) {
        // En caso de error, devolver el mensaje de error
            echo json_encode(['error' => $e->getMessage()]);
    }



?>
