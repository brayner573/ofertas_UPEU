<?php
include("config.php");

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir archivo de conexión a la base de datos
include_once("conectar.php");

// Establecer conexión
$conexion = conectar();

// Inicializar variable para el nombre de la empresa
$nombre_empresa = "";

// Verificar si el usuario ha iniciado sesión y tiene el rol de empresa (rol = 2)
if (isset($_SESSION["SESION_ID_USUARIO"]) && $_SESSION["SESION_ROL"] == '2') {
    $id_usuario = $_SESSION["SESION_ID_USUARIO"];
    
    // Obtener el nombre de la empresa a la que está asignado el usuario
    $sql = "SELECT e.razon_social 
            FROM empresa e 
            INNER JOIN usuarios u ON e.id = u.id_empresa 
            WHERE u.id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre_empresa = $fila['razon_social'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Bolsa Laboral</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo RUTAGENERAL; ?>themplates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo RUTAGENERAL; ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for jQuery UI -->
    <link href="<?php echo RUTAGENERAL; ?>js/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="<?php echo RUTAGENERAL; ?>js/jquery-ui.theme.css" rel="stylesheet">

    <!-- Bootstrap icons and custom styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Custom CSS para cambiar colores -->
    <style>
        .sidebar {
            background-color: #6c757d; /* Color gris */
        }
        .nav-item .nav-link {
            color: white;
        }
        .nav-item .nav-link:hover {
            background-color: #5a6268; /* Un tono más oscuro de gris */
        }
        .sidebar-brand-text {
            color: white;
        }
        .topbar {
            background-color: #f8f9fa; /* Mantener la barra superior clara */
        }
        .navbar-light .navbar-nav .nav-link {
            color: #343a40;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="<?php echo RUTAGENERAL; ?>themplates/img/portafolio.png" alt="" width="30px" style="margin-right: 5px;">
                </div>
                <div class="sidebar-brand-text mx-1">Bolsa Laboral</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Inicio -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Nav Item - Ofertas Laborales -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/mostrar_ofertas.php">
                    <i class="bi bi-person-add"></i>
                    <span>Ofertas Laborales</span></a>
            </li>
            
            <!-- Nueva opción para Mis Postulaciones (Solo para postulantes - Rol 3) -->
            <?php if (isset($_SESSION["SESION_ROL"]) && $_SESSION["SESION_ROL"] == '3') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/mis_postulaciones.php">
                        <i class="bi bi-file-earmark-check"></i>
                        <span>Mis Postulaciones</span>
                    </a>
                </li>
            <?php } ?>

            <!-- Opciones adicionales según el rol -->
            <?php if (!isset($_SESSION["SESION_NOMBRES"]) || (isset($_SESSION["SESION_ROL"]) && $_SESSION["SESION_ROL"] == '1')) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/registro_usuarios.php">
                    <i class="bi bi-person-add"></i>
                    <span>Registrar usuario</span></a>
            </li>
            <?php } ?>

            <!-- Opciones para Empresa (Rol 2) -->
            <?php if (isset($_SESSION["SESION_ROL"]) && $_SESSION["SESION_ROL"] == '2') { ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/registrar_oferta.php">
                    <i class="bi bi-building-add"></i>
                    <span>Registrar Oferta Laboral</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/listar_ofertas.php">
                        <i class="bi bi-building-add"></i>
                        <span>Listar Ofertas</span></a>
                </li>
            <?php } ?>

            <!-- Opciones adicionales para Administrador (Rol 1) -->
            <?php if(isset($_SESSION["SESION_ROL"]) && $_SESSION["SESION_ROL"]=='1'){ ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/listar_usuarios.php">
                    <i class="bi bi-person"></i>
                    <span>Listar Usuarios</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/listar_empresas.php">
                    <i class="bi bi-building"></i>
                    <span>Listar Empresas</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/registrar_oferta.php">
                    <i class="bi bi-building-add"></i>
                    <span>Registrar Oferta Laboral</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/listar_ofertas.php">
                    <i class="bi bi-building-add"></i>
                    <span>Listar Ofertas</span></a>
            </li>
            <?php } ?>

            <!-- Configuración del perfil -->
            <?php if(isset($_SESSION['SESION_NOMBRES'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/perfil.php">
                    <i class="bi bi-building"></i>
                    <span>Configuración</span></a>
            </li>
            <?php } ?>

            <!-- Cerrar sesión -->
            <?php if(!isset($_SESSION["SESION_NOMBRES"])){ ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/form_login.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Iniciar Sesión</span></a>
            </li>
            <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/logout.php">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Cerrar Sesión</span></a>
            </li>
            <?php } ?>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow d-flex flex-row-reverse">
                    <div class="d-none d-sm-inline-block mr-2">
                    <?php
                        if(isset($_SESSION['SESION_NOMBRES'])) {
                            echo "Bienvenido " . $_SESSION['SESION_NOMBRES'] . " " . $_SESSION['SESION_APELLIDOS'];
                            if ($_SESSION["SESION_ROL"] == '2' && !empty($nombre_empresa)) {
                                echo " (" . $nombre_empresa . ")";
                            }
                        } else {
                            echo "Inicie sesión";
                        }
                    ?>
                    </div>
                </nav>
                <!-- End of Topbar -->
