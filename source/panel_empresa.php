<?php
session_start();

// Verificar si el usuario ha iniciado sesión y es una empresa
if (!isset($_SESSION['SESION_ID_USUARIO']) || $_SESSION["SESION_ROL"] != 2) {
    header("Location: form_login.php");
    exit();
}

// Bienvenida al usuario de empresa
echo "Bienvenido, " . $_SESSION['SESION_NOMBRES'] . " - Panel de Empresa";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Empresa</title>
    <!-- Incluye tus estilos -->
    <link href="../css/estilos.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .panel {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }
        .panel h1 {
            color: #007bff;
        }
        .btn {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-blue {
            background-color: #007bff;
        }
        .btn-yellow {
            background-color: #ffc107;
        }
        .btn-red {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

<div class="panel">
    <h1>Panel de Control para Empresas</h1>
    <p>Bienvenido al panel de control. Desde aquí puedes gestionar tus ofertas laborales y configuraciones de cuenta.</p>

    <!-- Funcionalidades específicas para empresas -->
    <a href="crear_oferta.php" class="btn btn-blue">Crear Nueva Oferta Laboral</a>
    <a href="listar_ofertas.php" class="btn btn-gray">Ver/Editar Ofertas Laborales</a>
    <a href="configuracion.php" class="btn btn-yellow">Configuración de la Cuenta</a>
    <a href="logout.php" class="btn btn-red">Cerrar Sesión</a>
</div>

</body>
</html>
