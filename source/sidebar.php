<?php
session_start();
$rol = $_SESSION["SESION_ROL"];  // Verificamos el rol del usuario

// Menú solo para empresas
if ($rol == 2) {  // Si el rol es empresa
    ?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="sidebar-brand-text mx-3">BOLSA LABORAL</div>
        </a>

        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-home"></i>
                <span>Inicio</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="ofertas_laborales.php">
                <i class="fas fa-fw fa-briefcase"></i>
                <span>Ofertas Laborales</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="registrar_oferta.php">
                <i class="fas fa-fw fa-plus"></i>
                <span>Registrar Oferta Laboral</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="listar_ofertas.php">
                <i class="fas fa-fw fa-list"></i>
                <span>Listar Ofertas</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="configuracion.php">
                <i class="fas fa-fw fa-cog"></i>
                <span>Configuración</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Cerrar Sesión</span></a>
        </li>
    </ul>
    <?php
}
?>
