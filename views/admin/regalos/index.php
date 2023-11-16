<?php
session_start();

if (empty($_SESSION['id'])) {
    header('Location: /'); // Asegúrate de que esta sea la URL correcta
    exit(); // Termina la ejecución del script después de la redirección
}
?>
<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__grafica">
    <canvas id="regalos-grafica" width="400" height="400"></canvas>
</div>