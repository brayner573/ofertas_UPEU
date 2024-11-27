<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

// Verificar si la sesión está activa y evitar llamar session_start() más de una vez
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['SESION_ID_USUARIO'])) {
    header("Location: form_login.php");
    exit();
}

$id_rol = $_SESSION["SESION_ROL"]; // Guardar el rol para verificar si es empresa o admin

?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">

    <!-- Título principal -->
    <div class="d-flex justify-content-between mb-4">
        <h1 class="display-6">Lista de Ofertas Laborales</h1>
        <!-- Mostrar botón "Nueva Oferta" solo si es empresa -->
        <?php if ($id_rol == 2) { ?>
            <a href="crear_oferta.php" class="btn btn-primary">Nueva Oferta</a>
        <?php } ?>
        <!-- Botón para generar PDF -->
        <a href="generar_reporte_ofertas.php" class="btn btn-success">Generar Reporte PDF</a>
    </div>

    <!-- Consulta de ofertas laborales -->
    <?php
    // Tanto admin como empresa verán todas las ofertas
    $sql = "SELECT * FROM oferta_laboral";

    $resultado = $conexion->query($sql);

    if ($resultado === false) {
        echo "<div class='alert alert-danger'>Error en la consulta: " . $conexion->error . "</div>";
    } else {
        if ($resultado->num_rows > 0) {
            echo "<table class='table table-striped table-hover'>";
            echo "<thead class='table-dark'><tr><th>Título</th><th>Descripción</th><th>Fecha Publicación</th><th>Fecha Cierre</th><th>Remuneración</th><th>Ubicación</th><th>Tipo</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";

            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['titulo']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['descripcion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['fecha_publicacion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['fecha_cierre']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['remuneracion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['ubicacion']) . "</td>";
                echo "<td>" . ucfirst(htmlspecialchars($fila['tipo'])) . "</td>";
                echo "<td>";
                ?>
                <!-- Botones de acciones -->
                <div class="btn-group" role="group">
                    <!-- Editar oferta (solo si es empresa o admin) -->
                    <?php if ($id_rol == 1 || $id_rol == 2) { ?>
                        <button type="button" class="btn btn-outline-warning" onclick="editarOferta('<?php echo $fila['id']; ?>')">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                        <button type="button" class="btn btn-outline-danger" onclick="eliminarOferta(<?php echo $fila['id']; ?>)">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    <?php } ?>
                    <!-- Ver postulantes -->
                    <a href="informacion_postulantes.php?id_oferta=<?php echo $fila['id']; ?>" class="btn btn-outline-success">
                        <i class="bi bi-clipboard-check"></i> Ver Postulantes
                    </a>
                </div>
                <?php
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<div class='alert alert-info'>No se encontraron ofertas laborales.</div>";
        }
    }

    $conexion->close();
    ?>

</div>
<!-- End Page Content -->

<?php
include("../includes/foot.php");
?>

<!-- JavaScript -->
<script>
    function editarOferta(id) {
        location.href = "editar_oferta.php?id=" + id;
    }

    function eliminarOferta(id) {
        if (confirm('¿Estás seguro de que quieres eliminar esta oferta?')) {
            window.location.href = "eliminar_oferta.php?id=" + id;
        }
    }
</script>
