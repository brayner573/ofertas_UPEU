<?php
include("../includes/head.php");
// Verificar si se proporcionó el ID de la oferta en la URL
if(isset($_GET['id_oferta'])) {
    $id_oferta = $_GET['id_oferta'];
    
    // Aquí puedes incluir el código para mostrar la tabla de usuarios usando el ID de la oferta
    // Por ejemplo, puedes incluir el mismo código PHP que tenías en obtener_usuarios.php
    include("obtener_postulantes.php");
} else {
    // Si no se proporcionó el ID de la oferta, mostrar un mensaje de error o redirigir a otra página
    echo "Error: ID de oferta no especificado.";
}
include("../includes/foot.php");

