<?php
// Incluir los archivos necesarios
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

?>
<div class="container-fluid">

    <h1>Lista de usuarios</h1>

    <div class="d-flex justify-content-between">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" for="rol" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
            </svg>
            <select id="rol" onchange="filtrarUsuarios()" style="border: none;">
                <option value="todos">Todos los roles</option>
                <option value="1">Administrador</option>
                <option value="2">Empresario</option>
                <option value="3">Postulante</option>
                <option value="0">No Asignados</option>
            </select>
        </div>

        <div class="pb-2">
            <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
        </div>
    </div>

    <?php
    // Filtrar usuarios según el rol seleccionado
    $rolSeleccionado = $_GET['rol'] ?? 'todos';

    if ($rolSeleccionado === 'todos') {
        $sql = "SELECT * FROM usuarios";
    } else {
        $sql = "SELECT * FROM usuarios WHERE id_rol = ?";
    }

    $stmt = $conexion->prepare($sql);
    if ($rolSeleccionado !== 'todos') {
        $stmt->bind_param('i', $rolSeleccionado);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    echo "<table id='myTable' class='table table-success table-hover'>";
    echo "<thead><tr>";
    echo "<th>Nombres</th>";
    echo "<th>Apellidos</th>";
    echo "<th>DNI</th>";
    echo "<th>Direccion</th>";
    echo "<th>Telefono</th>";
    echo "<th>RUC Empresa</th>";
    echo "<th>Autorizacion</th>";
    echo "<th>Rol</th>";
    echo "<th>Acciones</th>";
    echo "</tr></thead><tbody>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['nombres']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['apellidos']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['dni']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['direccion']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";

        // Consultar la empresa asociada
        $razon_social = 'Sin asignar';
        if (!empty($fila['id_empresa'])) {
            $sql_empresa = "SELECT razon_social FROM empresa WHERE id = ?";
            $stmt_empresa = $conexion->prepare($sql_empresa);
            $stmt_empresa->bind_param('i', $fila['id_empresa']);
            $stmt_empresa->execute();
            $resultado_empresa = $stmt_empresa->get_result();
            if ($empresa = $resultado_empresa->fetch_assoc()) {
                $razon_social = htmlspecialchars($empresa['razon_social']);
            }
        }
        echo "<td>" . $razon_social . "</td>";

        // Estado de autorización
        echo "<td>" . ($fila['id_rol'] == 0 ? "No" : "Si") . "</td>";

        // Mostrar rol
        switch ($fila['id_rol']) {
            case 1:
                echo "<td>Administrador</td>";
                break;
            case 2:
                echo "<td>Empresario</td>";
                break;
            case 3:
                echo "<td>Postulante</td>";
                break;
            default:
                echo "<td>No asignado</td>";
                break;
        }

        // Acciones
        echo "<td>";
        echo "<button type='button' class='btn btn-warning' onclick='editarUsuario(" . $fila['id'] . ")'>Editar</button> ";
        echo "<button type='button' class='btn btn-danger' onclick='eliminarUsuario(" . $fila['id'] . ")'>Eliminar</button> ";
        echo "<button type='button' class='btn btn-success' onclick='autousuario(" . $fila['id'] . ")'>Autorizar</button>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    ?>

</div>

<script>
    function filtrarUsuarios() {
        const rol = document.getElementById('rol').value;
        window.location.href = `?rol=${rol}`;
    }

    // Filtro de búsqueda
    document.getElementById("myInput").addEventListener("keyup", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("#myTable tbody tr");
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });
</script>
