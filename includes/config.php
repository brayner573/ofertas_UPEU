<?php
// Constante para la ruta de nuestro sistema
if (!defined("RUTAGENERAL")) {
    define("RUTAGENERAL", "http://localhost/bolsa_laboral/");
}

// Constantes para conectar a la DB
if (!defined("USUARIO")) {
    define("USUARIO", "root");  // Cambia "root" por tu usuario de MySQL
}
if (!defined("PASSWORD")) {
    define("PASSWORD", "");  // Cambia "" por tu contraseña de MySQL
}
if (!defined("HOST")) {
    define("HOST", "localhost");
}
if (!defined("NOMBREBD")) {
    define("NOMBREBD", "sistema_laboral");  // Cambia "sistema_laboral" si tienes otro nombre de base de datos
}
?>
