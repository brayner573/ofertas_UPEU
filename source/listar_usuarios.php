<?php
session_start();
include("../includes/conectar.php");
$conexion = conectar();

// Verificar si el usuario está logueado
if (!isset($_SESSION['SESION_ID_USUARIO'])) {
    header("Location: form_login.php");
    exit();
}

include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid mt-5">

    <!-- Título central -->
    <div class="text-center mb-4">
        <h1 class="display-5">Lista de Usuarios</h1>
    </div>

    <!-- Filtros y barra de búsqueda -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <label for="rol" class="form-label me-2">Filtrar por rol:</label>
                <select id="rol" class="form-select" onchange="filtrarUsuarios()">
                    <option value="todos">Todos los roles</option>
                    <option value="1">Administrador</option>
                    <option value="2">Empresario</option>
                    <option value="3">Postulante</option>
                    <option value="0">No Asignados</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <input class="form-control" id="myInput" type="text" placeholder="Buscar usuario...">
        </div>
    </div>

    <?php
    $sql = "SELECT * FROM usuarios";
    $registros = mysqli_query($conexion, $sql);

    echo "<table id='myTable' class='table table-striped table-hover'>";
    echo "<thead class='table-dark'><tr>";
    echo "<th>Nombres</th>";
    echo "<th>Apellidos</th>";
    echo "<th>DNI</th>";
    echo "<th>Dirección</th>";
    echo "<th>Teléfono</th>";
    echo "<th>RUC Empresa</th>";
    echo "<th>Autorizado</th>";
    echo "<th>Rol</th>";
    echo "<th>Acciones</th>";
    echo "</tr></thead><tbody>";

    while ($fila = mysqli_fetch_array($registros)) {
        echo "<tr>";
        echo "<td>" . $fila['nombres'] . "</td>";
        echo "<td>" . $fila['apellidos'] . "</td>";
        echo "<td>" . $fila['dni'] . "</td>";
        echo "<td>" . $fila['direccion'] . "</td>";
        echo "<td>" . $fila['telefono'] . "</td>";

        $id_empresa = $fila['id_empresa'];
        $razon_social = '';
        if ($id_empresa !== NULL) {
            $sql_empresa = "SELECT razon_social FROM empresa WHERE id = $id_empresa";
            $resultado_empresa = mysqli_query($conexion, $sql_empresa);

            if ($resultado_empresa && mysqli_num_rows($resultado_empresa) > 0) {
                $fila_empresa = mysqli_fetch_array($resultado_empresa);
                $razon_social = $fila_empresa['razon_social'];
            } else {
                $razon_social = 'No asignado';
            }
        }
        echo "<td>" . $razon_social . "</td>";

        echo "<td>" . ($fila['estado_asignacion'] == 1 ? "Sí" : "No") . "</td>";

        if ($fila['id_rol'] == '1') {
            echo "<td>Administrador</td>";
        } elseif ($fila['id_rol'] == '2') {
            echo "<td>Empresario</td>";
        } elseif ($fila['id_rol'] == '3') {
            echo "<td>Postulante</td>";
        } else {
            echo "<td>No asignado</td>";
        }

        echo "<td>";
        ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-warning" onclick="editarUsuario('<?php echo $fila['id']; ?>')">
                <i class="bi bi-pencil"></i> Editar
            </button>
            <button type="button" class="btn btn-outline-danger" onclick="eliminarUsuario(<?php echo $fila['id']; ?>)">
                <i class="bi bi-trash"></i> Eliminar
            </button>
            <button type="button" class="btn btn-outline-<?php echo $fila['estado_asignacion'] == 1 ? 'danger' : 'success'; ?>" 
                    onclick="cambiarEstadoUsuario('<?php echo $fila['id']; ?>', <?php echo $fila['estado_asignacion']; ?>)">
                <i class="bi bi-person-check-fill"></i> <?php echo $fila['estado_asignacion'] == 1 ? 'Desautorizar' : 'Autorizar'; ?>
            </button>
        </div>
        <?php
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    ?>

</div>
<!-- /.container-fluid -->

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

function editarUsuario(id) {
    location.href = "editar_usuario.php?id=" + id;
}

function eliminarUsuario(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
        window.location.href = "eliminar_usuario.php?id=" + id;
    }
}

function cambiarEstadoUsuario(id, estado) {
    var confirmacion = (estado == 1) ? '¿Estás seguro de que quieres desautorizar este usuario?' : '¿Estás seguro de que quieres autorizar este usuario?';
    if (confirm(confirmacion)) {
        location.href = "cambiar_estado_usuario.php?id=" + id + "&estado=" + estado;
    }
}

function filtrarUsuarios() {
    var rolSeleccionado = document.getElementById("rol").value;
    var url = "filtrar_usuarios.php?rol=" + rolSeleccionado;
    window.location.href = url;
}
</script>
