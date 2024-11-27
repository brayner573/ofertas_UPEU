<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

// Verificar si la sesión está activa
if (!isset($_SESSION['SESION_ID_USUARIO'])) {
    header("Location: login.php");
    exit();
}

?>

<!-- Begin Page Content -->
<div class="container-fluid mt-5">

    <!-- Título y barra de búsqueda -->
    <div class="d-flex justify-content-between mb-4">
        <h1 class="display-6">Lista de Empresas</h1>
        <div class="w-50">
            <input class="form-control" id="myInput" type="text" placeholder="Buscar empresa...">
        </div>
        <a href="reporte_empresas.php" class="btn btn-success">Generar Reporte PDF</a> <!-- Botón para generar PDF -->
    </div>

    <!-- Tabla de empresas -->
    <?php
    $sql = "SELECT * FROM empresa";
    $registros = mysqli_query($conexion, $sql);

    echo "<table id='myTable' class='table table-striped table-hover'>";
    echo "<thead class='table-dark'><tr>";
    echo "<th>Razón Social</th>";
    echo "<th>RUC</th>";
    echo "<th>Correo</th>";
    echo "<th>Dirección</th>";
    echo "<th>Teléfono</th>";
    echo "<th>Asignación</th>";
    echo "<th>Acciones</th>";
    echo "</tr></thead><tbody>";

    while ($fila = mysqli_fetch_array($registros)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['razon_social']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['ruc']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['correo']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['direccion']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";

        // Verificar si el usuario está asignado a la empresa
        $id_usuario = $fila['id_usuario'];
        $nombre_usuario = '';
        if ($id_usuario !== NULL) {
            $sql_usuario = "SELECT nombres, apellidos FROM usuarios WHERE id = $id_usuario";
            $resultado_usuario = mysqli_query($conexion, $sql_usuario);

            // Verificar si se encontraron datos del usuario
            if ($resultado_usuario && mysqli_num_rows($resultado_usuario) > 0) {
                $fila_usuario = mysqli_fetch_array($resultado_usuario);
                $nombre_usuario = htmlspecialchars($fila_usuario['nombres'] . ' ' . $fila_usuario['apellidos']);
            } else {
                $nombre_usuario = "Usuario no encontrado";
            }
        }

        echo "<td>" . htmlspecialchars($nombre_usuario) . "</td>";

        echo "<td>";
        ?>
        <!-- Botones de acción -->
        <div class="btn-group">
            <button type="button" class="btn btn-outline-warning" onclick="editarEmpresa('<?php echo $fila['id']; ?>')">
                <i class="bi bi-pencil"></i> Editar
            </button>
            <button type="button" class="btn btn-outline-danger" onclick="eliminarEmpresa(<?php echo $fila['id']; ?>)">
                <i class="bi bi-trash"></i> Eliminar
            </button>
            <?php
            if ($fila['id_usuario'] !== NULL) {
                echo "<button type='button' class='btn btn-outline-danger' onclick='quitarUsuario(" . $fila['id'] . ")'><i class='bi bi-building-fill-x'></i> Quitar Usuario</button>";
            } else {
                echo "<button type='button' class='btn btn-outline-success' onclick='Mostrar_usuarios(" . $fila['id'] . ")'><i class='bi bi-building-fill-check'></i> Asignar Usuario</button>";
            }
            ?>
        </div>
    <?php
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    ?>

</div>

<!-- Modal para mostrar lista de usuarios -->
<div id="div_usuarios" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lista de Usuarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                $sql_usuarios = "SELECT * FROM usuarios WHERE id_rol = 3";
                $registros_usuarios = mysqli_query($conexion, $sql_usuarios);

                echo '<ul class="list-group">';
                while ($fila_user = mysqli_fetch_array($registros_usuarios)) {
                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    echo htmlspecialchars($fila_user['dni']) . ' ' . htmlspecialchars($fila_user['nombres']) . ' ' . htmlspecialchars($fila_user['apellidos']);
                    if ($fila_user['id_empresa'] !== NULL) {
                        echo '<span class="badge bg-danger">Ya asignado</span>';
                    } else {
                        echo '<button class="btn btn-primary" onclick="asignarUsuario(' . $fila_user['id'] . ')">Asignar</button>';
                    }
                    echo '</li>';
                }
                echo '</ul>';
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include("../includes/foot.php");
?>

<script>
$(document).ready(function(){
    $("#myInput").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

var ID_EMPRESA;

// Mostrar modal con la lista de usuarios
function Mostrar_usuarios(pid_empresa) {
    ID_EMPRESA = pid_empresa;
    var modal = new bootstrap.Modal(document.getElementById("div_usuarios"));
    modal.show();
}

// Asignar usuario a empresa
function asignarUsuario(id_usuario) {
    if (confirm('¿Estás seguro de que quieres asignar este usuario a la empresa?')) {
        $.ajax({
            type: "POST",
            url: "asignar_usuario.php",
            data: {
                id_empresa: ID_EMPRESA,
                id_usuario: id_usuario
            },
            success: function(response) {
                alert(response); // Mostrar mensaje de confirmación
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error al procesar la solicitud: " + error);
            }
        });
    }
}

// Quitar usuario de empresa
function quitarUsuario(id_empresa) {
    if (confirm('¿Estás seguro de que quieres quitar este usuario de la empresa?')) {
        $.ajax({
            type: "POST",
            url: "quitar_usuario.php",
            data: { id_empresa: id_empresa },
            success: function(response) {
                alert(response); // Mostrar mensaje de confirmación
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error al procesar la solicitud: " + error);
            }
        });
    }
}

// Confirmación para eliminar empresa
function eliminarEmpresa(id_empresa) {
    if (confirm('¿Estás seguro de que quieres eliminar esta empresa y toda la información relacionada?')) {
        $.ajax({
            type: "POST",
            url: "eliminar_empresa.php",
            data: { id_empresa: id_empresa },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error al procesar la solicitud: " + error);
            }
        });
    }
}
</script>
