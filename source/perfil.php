<?php
include("../includes/head.php");
include("../includes/conectar.php");

if (isset($_SESSION['SESION_ID_USUARIO'])) {
    $conexion = conectar();
    $id_usuario = $_SESSION['SESION_ID_USUARIO'];

    // Consulta para obtener los datos del usuario actual
    $sql = "SELECT * FROM usuarios WHERE id = $id_usuario";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        // Calcular el porcentaje de información completada
        $totalCampos = 9;
        $camposCompletados = 0;

        if (!empty($fila["ruta_imagen"])) $camposCompletados++;
        if (!empty($fila["direccion"])) $camposCompletados++;
        if (!empty($fila["telefono"])) $camposCompletados++;
        if (!empty($fila["usuario"])) $camposCompletados++;
        if (!empty($fila["contrasenia"])) $camposCompletados++;
        if (!empty($fila["nombres"])) $camposCompletados++;
        if (!empty($fila["apellidos"])) $camposCompletados++;
        if (!empty($fila["dni"])) $camposCompletados++;
        if (!empty($fila["ruta_cv"])) $camposCompletados++;

        $porcentajeCompletado = ($camposCompletados / $totalCampos) * 100;
        $porcentajeFaltante = 100 - $porcentajeCompletado;

        // Obtener información de la empresa si el usuario tiene rol 2
        $empresa = null;
        if ($fila['id_rol'] == 2 && !empty($fila['id_empresa'])) {
            $sql_empresa = "SELECT * FROM empresa WHERE id = " . $fila['id_empresa'];
            $resultado_empresa = mysqli_query($conexion, $sql_empresa);
            if (mysqli_num_rows($resultado_empresa) > 0) {
                $empresa = mysqli_fetch_assoc($resultado_empresa);
            }
        }
?>

<!-- Zona de Perfil -->
<div class="container-fluid d-flex justify-content-center">
    <div class="col-md-10">
        <h1 class="text-center mb-4">Mi Perfil</h1>
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="position-relative mb-3" id="profile-picture-container" style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; margin: 0 auto; border: 2px solid #ccc;">
                    <img src="<?php echo $fila["ruta_imagen"]; ?>" alt="Imagen de perfil" style="width: 100%; height: auto;">
                </div>
                <p><strong><?php echo $fila["nombres"] . " " . $fila["apellidos"]; ?></strong></p>
                <p><strong>DNI:</strong> <?php echo $fila["dni"]; ?></p>
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editarFotoModal">
                    Editar foto
                </button>
            </div>

            <!-- Modal para editar foto -->
            <div class="modal fade" id="editarFotoModal" tabindex="-1" role="dialog" aria-labelledby="editarFotoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarFotoModalLabel">Editar Foto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="guardar_imagen.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nuevaImagen">Seleccione una nueva imagen:</label>
                                    <input type="file" class="form-control-file" id="nuevaImagen" name="nuevaImagen" accept="image/*">
                                </div>
                                <input type="hidden" name="idUsuario" value="<?php echo $fila['id']; ?>">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Dirección:</strong></td>
                            <td><?php echo $fila["direccion"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Teléfono:</strong></td>
                            <td><?php echo $fila["telefono"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Usuario:</strong></td>
                            <td><?php echo $fila["usuario"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Contraseña:</strong></td>
                            <td>********</td>
                        </tr>
                        <?php if ($empresa) { ?>
                        <tr>
                            <td><strong>Empresa:</strong></td>
                            <td><?php echo $empresa["razon_social"]; ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#subirArchivoModal">
                                    Subir CV
                                </button>
                                <?php if (!empty($fila["ruta_cv"])) { ?>
                                    <!-- Verificar si el archivo es un PDF -->
                                    <?php if (pathinfo($fila["ruta_cv"], PATHINFO_EXTENSION) === 'pdf') { ?>
                                        <div class="mt-3">
                                            <embed src="<?php echo $fila['ruta_cv']; ?>" type="application/pdf" width="100%" height="600px" />
                                            <form action="eliminar_cv.php" method="post" class="mt-2" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este archivo? Esta acción no se puede deshacer.');">
                                                <input type="hidden" name="idUsuario" value="<?php echo $fila['id']; ?>">
                                                <button type="submit" class="btn btn-danger">Eliminar CV</button>
                                            </form>
                                        </div>
                                    <?php } else { ?>
                                        <span class="ml-2"><?php echo basename($fila["ruta_cv"]); ?></span>
                                    <?php } ?>
                                <?php } ?>

                                <!-- Modal para subir archivo -->
                                <div class="modal fade" id="subirArchivoModal" tabindex="-1" role="dialog" aria-labelledby="subirArchivoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="subirArchivoModalLabel">Subir CV</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="guardar_cv.php" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="nuevoDocumento">Seleccione un archivo (solo PDF):</label>
                                                        <input type="file" class="form-control-file" id="nuevoDocumento" name="nuevoDocumento" accept=".pdf" required>
                                                    </div>
                                                    <input type="hidden" name="idUsuario" value="<?php echo $fila['id']; ?>">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="d-flex justify-content-end mb-3">
                            <a href="editar_usuario.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning">Editar Usuario</a>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Gráfico de torta del perfil completado -->
        <div class="mt-4">
            <canvas id="perfilCompletoChart"></canvas>
        </div>

<?php
    } else {
        echo "<div class='alert alert-danger'>No se encontraron datos para este usuario.</div>";
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    // Si no hay sesión iniciada, redireccionar al formulario de inicio de sesión
    header("Location: form_login.php");
    exit;
}
?>

<!-- Fin Zona central del sistema -->

</div>
<!-- /.container-fluid -->

<?php
include("../includes/foot.php");
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuración del gráfico de torta
        var ctx = document.getElementById('perfilCompletoChart').getContext('2d');
        var perfilCompletoChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completado', 'Faltante'],
                datasets: [{
                    data: [<?php echo $porcentajeCompletado; ?>, <?php echo $porcentajeFaltante; ?>],
                    backgroundColor: ['#4CAF50', '#FFC107']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
