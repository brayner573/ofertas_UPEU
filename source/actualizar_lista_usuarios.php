<?php
include("../includes/conectar.php");

$conexion = conectar();

echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">';

$sql_usuarios = "SELECT * FROM usuarios";
$registros_usuarios = mysqli_query($conexion, $sql_usuarios);

$html_lista_usuarios = '
<div class="container-fluid d-flex justify-content-center">
    <div class="col-md-8">
        <h1 class="text-center mb-4">Lista de Usuarios</h1>
        <div class="list-group">';
        
while ($fila_user = mysqli_fetch_array($registros_usuarios)) {
    $html_lista_usuarios .= '
    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">';
    $html_lista_usuarios .= '<span>' . $fila_user['dni'] . ' - ' . $fila_user['nombres'] . ' ' . $fila_user['apellidos'] . '</span>';

    if ($fila_user['id_empresa'] !== NULL) {
        // Si ya está asignado, mostrar una alerta visual
        $html_lista_usuarios .= '<span class="badge badge-danger">Ya asignado</span>';
    } else {
        // Si no está asignado, mostrar el botón para asignar
        $html_lista_usuarios .= '<button onclick="asignarUsuario(' . $fila_user['id'] . ')" class="btn btn-primary btn-sm">Asignar</button>';
    }
    $html_lista_usuarios .= '</a>';
}
$html_lista_usuarios .= '
        </div>
    </div>
</div>';

echo $html_lista_usuarios;
?>

<script>
function asignarUsuario(idUsuario) {
    alert('Asignar usuario con ID: ' + idUsuario);
    // Aquí puedes agregar la lógica para asignar el usuario usando AJAX o redirigiendo a otra página.
}
</script>
