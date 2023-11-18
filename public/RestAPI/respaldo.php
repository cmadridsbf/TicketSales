<?php
include 'connection.php'; // Incluye el archivo de conexión a la base de datos

// Verifica si se proporcionó una clave de autenticación (para mayor seguridad)
//if (isset($_GET['api_key']) && $_GET['api_key'] === 'tu_clave_de_autenticacion') {
    try {
        // Nombre del archivo de respaldo
        $backupFileName = 'respaldo.sql';

        // Comando para realizar la copia de seguridad de la base de datos
        $command = "mysqldump -h " . DB_HOST . " -u " . DB_USER . " -p" . DB_PASS . " " . DB_NAME . " > " . $backupFileName;
        exec($command);

        // Verifica si el archivo de respaldo se creó correctamente
        if (file_exists($backupFileName)) {
            // Descarga el archivo de respaldo
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $backupFileName . '"');
            readfile($backupFileName);
            unlink($backupFileName); // Elimina el archivo después de descargarlo
        } else {
            echo "Error al crear el archivo de respaldo";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
//} else {    echo "Acceso no autorizado";}
?>
