<?php

include("../includes/conectar.php");

$conexion = conectar();



//Recibimos datos del formulario
$razon_social = $_POST['txt_razon_social'];
$ruc = $_POST['txt_ruc'];
$correo = $_POST['txt_correo'];
$direccion = $_POST['txt_direccion'];
$telefono = $_POST['txt_telefono'];

/*
    echo "DNI recibido: ".$dni;
    echo "nombres recibido: ".$nombres;
    echo "apellidos recibido: ".$apellidos;
    echo "direccion recibido: ".$direccion;
    echo "telefono recibido: ".$telefono;
    */
//conexion a la DB
//gurdamos datos en tabla usuarios



$sql = "INSERT INTO empresa (razon_social,ruc,correo,direccion,telefono) VALUES('$razon_social','$ruc','$correo','$direccion','$telefono') ";

mysqli_query($conexion, $sql) or die("Error al guardar.");

header("location: listar_empresas.php");
