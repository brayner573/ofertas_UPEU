<?php
include("../includes/conectar.php");
$conexion = conectar();
?>
<div class="container-fluid d-flex justify-content-center">
  <div class="col-md-10">
    <?php
    if (isset($_GET['id_oferta']) && is_numeric($_GET['id_oferta'])) {
        $id_oferta = $_GET['id_oferta'];

        // Para fines de seguridad, asegúrate de escapar cualquier dato que provenga de la URL.
        echo "<script> var idOferta = " . intval($id_oferta) . ";</script>";

        $query = "SELECT u.id, u.nombres, u.apellidos, u.dni, u.telefono, u.direccion, u.ruta_cv 
                  FROM postulaciones p 
                  INNER JOIN usuarios u ON p.id_usuario = u.id 
                  WHERE p.id_oferta = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $id_oferta);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            ?>
            <h1 class="text-center mb-4">Información de Postulantes</h1>
            <?php
            // Construye la tabla de usuarios
            echo "<table class='table table-bordered table-hover'>";
            echo "<thead class='thead-dark'><tr><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Teléfono</th><th>Dirección</th><th>CV</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nombres']) . "</td>";
                echo "<td>" . htmlspecialchars($row['apellidos']) . "</td>";
                echo "<td>" . htmlspecialchars($row['dni']) . "</td>";
                echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
                echo "<td>" . htmlspecialchars($row['direccion']) . "</td>";

                // Botón desplegable para "Ver" y "Descargar" el CV
                echo "<td>
                        <div class='btn-group'>
                          <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Opciones
                          </button>
                          <div class='dropdown-menu'>
                            <a class='dropdown-item' href='" . htmlspecialchars($row['ruta_cv']) . "' target='_blank'>Ver CV</a>
                            <a class='dropdown-item' href='" . htmlspecialchars($row['ruta_cv']) . "' download>Descargar CV</a>
                          </div>
                        </div>
                      </td>";

                // Botones Aceptar y Descalificar
                echo "<td>";
                echo "<button class='btn btn-success btn-sm mr-2' onclick='calificarUsuario(" . intval($row['id']) . ", idOferta, true)'>Aceptar</button>";
                echo "<button class='btn btn-danger btn-sm' onclick='descalificarUsuario(" . intval($row['id']) . ", idOferta)'>Descalificar</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<div class='alert alert-info text-center'>No hay usuarios que hayan postulado a esta oferta.</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger text-center'>Error: ID de oferta no especificado o no válido.</div>";
    }
    ?>
  </div>
</div>

<script>
// Función para calificar un usuario (aceptar)
function calificarUsuario(idUsuario, idOferta, aceptado) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "calificar_usuario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Usuario aceptado correctamente');
                actualizarEstadoUsuario(idUsuario, 'Aceptado');
            } else {
                alert('Error: ' + response.message);
            }
        }
    };
    xhr.send("idUsuario=" + idUsuario + "&idOferta=" + idOferta + "&aceptado=" + aceptado);
}

// Función para descalificar un usuario
function descalificarUsuario(idUsuario, idOferta) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "descalificar_usuario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Usuario descalificado correctamente');
                actualizarEstadoUsuario(idUsuario, 'Descalificado');
            } else {
                alert('Error: ' + response.message);
            }
        }
    };
    xhr.send("idUsuario=" + idUsuario + "&idOferta=" + idOferta);
}

// Función reutilizable para actualizar el estado del usuario en la interfaz
function actualizarEstadoUsuario(idUsuario, nuevoEstado) {
    var row = document.querySelector('button[onclick="calificarUsuario(' + idUsuario + ', ' + idOferta + ', true)"]').parentElement.parentElement;
    row.querySelector('td:nth-child(7)').innerHTML = '<button class="btn btn-secondary btn-sm" disabled>' + nuevoEstado + '</button>';
}
</script>
