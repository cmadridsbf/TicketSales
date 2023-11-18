<?php
session_start();

if (empty($_SESSION['id'])) {
    header('Location: /'); // Asegúrate de que esta sea la URL correcta
    exit(); // Termina la ejecución del script después de la redirección
}
?>
<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<!-- <img src="https://ticketsales.store/qrTicketSales.jpeg" style="width:300px; height:300px;" alt="Código QR de ejemplo"> -->
<div class=dashboard__contenedorBotonesReporte>
    <div id="reader" style="width:500px; height:500px;"></div>
</div>
<div class=dashboard__contenedorBotonesReporte>
    <div class="dashboard__contenedor-boton">
        <button id="btnQr" class="dashboard__boton dashboard__informebtn">
            <i class="fa-solid fa-code"></i>
                Ingresar token manualmente
        </button>
    </div>
</div>