<?php
session_start();

if (empty($_SESSION['id'])) {
    header('Location: /'); // Asegúrate de que esta sea la URL correcta
    exit(); // Termina la ejecución del script después de la redirección
}
?>
<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>


<div class="dashboard__contenedorBotonesReporte"> 
    <div class="dashboard__informe">
        <canvas id="informes-grafica-usuarios-confirmados" class="dashboard__barra"></canvas>
    </div> 
    <div class="dashboard__informe">
        <canvas id="informes-grafica-mas-vendido" ></canvas>
    </div> 
</div>


<div class=dashboard__contenedorBotonesReporte>
    <div class="dashboard__contenedor-boton">
        <button id="rptUsuariosRegistrados" class="dashboard__boton dashboard__informebtn">
            <i class="fa-solid fa-file"></i>
                Usuarios Registrados
        </button>
    </div>
    <div class="dashboard__contenedor-boton">
        <button id="rptUsuariosRegistradosConfirmados" class="dashboard__boton dashboard__informebtn">
            <i class="fa-solid fa-file"></i>
                Usuarios Confirmados
        </button>
    </div>
    <div class="dashboard__contenedor-boton">
        <button id="rptRegalosEscogidos" class="dashboard__boton dashboard__informebtn">
            <i class="fa-solid fa-file"></i>
                Regalos Escogidos
        </button>
    </div>
    <div class="dashboard__contenedor-boton">
        <button id="rptPonentes" class="dashboard__boton dashboard__informebtn">
            <i class="fa-solid fa-file"></i>
                Ponentes
        </button>
    </div>
    <div class="dashboard__contenedor-boton">
        <button id="rptConferencias" class="dashboard__boton dashboard__informebtn">
            <i class="fa-solid fa-file"></i>
                Conferencias
        </button>
    </div>

    <div class="dashboard__contenedor-boton">
        <button id="rptBitacora" class="dashboard__boton dashboard__informebtn">
            <i class="fa-solid fa-file"></i>
                Bitácora
        </button>
    </div>
</div>
<!-- <h3 class="dashboard__heading">Graficos</h3> -->
