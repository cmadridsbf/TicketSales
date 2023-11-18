<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?> ">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>    
        </a>

        <a href="/admin/ponentes" class="dashboard__enlace <?php echo pagina_actual('/ponentes') ? 'dashboard__enlace--actual' : ''; ?> ">
            <i class="fa-solid fa-microphone dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Ponentes
            </span>    
        </a>

        <a href="/admin/eventos" class="dashboard__enlace <?php echo pagina_actual('/eventos') ? 'dashboard__enlace--actual' : ''; ?> ">
            <i class="fa-solid fa-calendar dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Eventos
            </span>    
        </a>

        <a href="/admin/registrados" class="dashboard__enlace <?php echo pagina_actual('/registrados') ? 'dashboard__enlace--actual' : ''; ?> ">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Registrados
            </span>    
        </a>
        <a href="/admin/regalos" class="dashboard__enlace <?php echo pagina_actual('/regalos') ? 'dashboard__enlace--actual' : ''; ?> ">
            <i class="fa-solid fa-gift dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Regalos
            </span>    
        </a>
        <a href="/admin/informes" class="dashboard__enlace <?php echo pagina_actual('/informes') ? 'dashboard__enlace--actual' : ''; ?> ">
            <i class="fa-solid fa-print dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Informes
            </span>    
        </a>
        <a href="/admin/escaner" class="dashboard__enlace <?php echo pagina_actual('/escaner') ? 'dashboard__enlace--actual' : ''; ?> ">
            <i class="fa-solid fa-qrcode dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Escáner
            </span>    
        </a>
        
        <a href="/admin/backup" class="dashboard__enlace <?php echo pagina_actual('/Copia_de_Seguridad') ? 'dashboard__enlace--actual' : ''; ?> ">
            <i class="fa-solid fa-database dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Respaldo
            </span>    
        </a>
    </nav>
</aside>