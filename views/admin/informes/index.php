<?php
session_start();

if (empty($_SESSION['id'])) {
    header('Location: /'); // Asegúrate de que esta sea la URL correcta
    exit(); // Termina la ejecución del script después de la redirección
}
?>
<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    <button id="añadirPonenteBtn" class="dashboard__boton">
        <i class="fa-solid fa-file"></i>
            Usuarios
    </button>
</div>


<h3 class="dashboard__heading">Graficos</h3>
<div class="dashboard__informe">
    <canvas id="informes-grafica" width="400" height="400"></canvas>
</div> 
