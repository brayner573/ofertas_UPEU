<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

// Obtener el término de búsqueda
$query = "";
if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conexion, $_GET['query']);
}

// Definir el número de resultados por página
$resultados_por_pagina = 8;

// Determinar la página actual
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $resultados_por_pagina;

// Consulta para obtener el número total de resultados
$sql_total = "SELECT COUNT(*) AS total FROM oferta_laboral WHERE titulo LIKE '%$query%' OR descripcion LIKE '%$query%'";
$resultado_total = mysqli_query($conexion, $sql_total);
$total_ofertas = mysqli_fetch_assoc($resultado_total)['total'];

// Calcular el número total de páginas
$total_paginas = ceil($total_ofertas / $resultados_por_pagina);

// Consulta para obtener las ofertas laborales filtradas por el término de búsqueda con límite y offset
$sql = "SELECT * FROM oferta_laboral WHERE titulo LIKE '%$query%' OR descripcion LIKE '%$query%' ORDER BY id DESC LIMIT $resultados_por_pagina OFFSET $offset";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="container-fluid mt-4">

    <!-- Título de la página -->
    <h1 class="mb-4">Ofertas Laborales</h1>

    <?php
    // Comprobar si hay resultados
    if (mysqli_num_rows($resultado) > 0) {
        $contador = 0; // Contador para controlar las tarjetas por fila
        echo '<div class="row">'; // Inicia la fila de tarjetas

        while ($fila = mysqli_fetch_assoc($resultado)) {
            // Verificar si la oferta ha vencido
            $fecha_actual = date('Y-m-d');
            $fecha_cierre = $fila['fecha_cierre'];
            $estado_oferta = "Disponible";

            if ($fecha_actual > $fecha_cierre) {
                $estado_oferta = "Vencido";
            } elseif ($fila['limite_postulantes'] <= 0) {
                $estado_oferta = "No hay cupos";
            }

            // Verificar si el usuario está logueado y tiene CV subido
            $cv_subido = "";
            $usuario_logueado = false;
            if (isset($_SESSION['SESION_ID_USUARIO'])) {
                $usuario_logueado = true;
                $id_usuario = $_SESSION["SESION_ID_USUARIO"];
                $query_cv = "SELECT ruta_cv FROM usuarios WHERE id = $id_usuario";
                $resultado_cv = mysqli_query($conexion, $query_cv);
                $cv_subido = mysqli_fetch_assoc($resultado_cv)['ruta_cv'];
            }
    ?>
            <div class="col-lg-3 col-md-6 mb-4"> <!-- Crea una columna de 3 para cada tarjeta (12 columnas en total en un row) -->
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0"><?php echo $fila['titulo']; ?></h5>
                        <span class="badge bg-secondary"><?php echo $estado_oferta; ?></span>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Descripción</h6>
                        <p class="card-text text-truncate"><?php echo $fila['descripcion']; ?></p>
                        <hr>
                        <p><strong>Fecha de Publicación:</strong> <?php echo $fila['fecha_publicacion']; ?></p>
                        <p><strong>Fecha de Cierre:</strong> <?php echo $fila['fecha_cierre']; ?></p>
                        <p><strong>Remuneración:</strong> S/. <?php echo $fila['remuneracion']; ?></p>
                        <p><strong>Ubicación:</strong> <?php echo $fila['ubicacion']; ?></p>
                        <p><strong>Tipo:</strong> <?php echo ucfirst($fila['tipo']); ?></p>
                        <p><strong>Cupos:</strong> <?php echo $fila['limite_postulantes']; ?></p>

                        <!-- Este es el fragmento donde se realiza la postulación -->
                        <?php if ($estado_oferta == "Disponible") { ?>
                            <form method="post" action="registrar_postulacion.php">
                                <input type="hidden" name="id_oferta" value="<?php echo $fila['id']; ?>">
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                                <button type="submit" name="postular" class="btn btn-primary w-100">Postular</button>
                            </form>
                        <?php } else { ?>
                            <button type="button" class="btn btn-secondary w-100" disabled><?php echo $estado_oferta; ?></button>
                        <?php } ?>
                    </div>
                </div>
            </div>

    <?php
            $contador++;
            if ($contador % 4 == 0) {
                echo '</div><div class="row">'; // Cerrar fila y abrir una nueva después de cada 4 tarjetas
            }
        }
        echo '</div>'; // Cerrar la última fila
    } else {
        echo "<div class='alert alert-info'>No se encontraron ofertas laborales.</div>";
    }
    ?>

    <!-- Paginación -->
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($pagina_actual > 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href="mostrar_ofertas.php?query=<?php echo $query; ?>&pagina=<?php echo $pagina_actual - 1; ?>" aria-label="Anterior">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                        <li class="page-item <?php echo $i == $pagina_actual ? 'active' : ''; ?>">
                            <a class="page-link" href="mostrar_ofertas.php?query=<?php echo $query; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($pagina_actual < $total_paginas) { ?>
                        <li class="page-item">
                            <a class="page-link" href="mostrar_ofertas.php?query=<?php echo $query; ?>&pagina=<?php echo $pagina_actual + 1; ?>" aria-label="Siguiente">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>

</div>

<?php
include("../includes/foot.php");
?>