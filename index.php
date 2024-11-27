<?php
include("includes/head.php");
?>

<!-- Estilos adicionales para modernizar el diseño con Neumorfismo -->
<style>
    .main-section {
        background-color: #f0f2f5;
        padding: 40px 0;
    }

    .main-section h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #2b2e4a;
        letter-spacing: 1px;
    }

    .lead-text {
        color: #7e8299;
        font-size: 1.25rem;
        margin-bottom: 30px;
    }

    .image-central img {
        max-width: 30%;
        border-radius: 20px;
        box-shadow: 8px 8px 16px rgba(0, 0, 0, 0.1), -8px -8px 16px rgba(255, 255, 255, 0.8);
    }

    .card-search {
        background-color: #e0e5ec;
        border-radius: 50px;
        box-shadow: 8px 8px 16px rgba(0, 0, 0, 0.2), -8px -8px 16px rgba(255, 255, 255, 0.5);
        padding: 25px;
    }

    .input-group {
        border-radius: 30px;
        overflow: hidden;
        box-shadow: inset 8px 8px 16px rgba(0, 0, 0, 0.1), inset -8px -8px 16px rgba(255, 255, 255, 0.5);
    }

    .input-group .form-control {
        border: none;
        box-shadow: none;
        background-color: #f0f2f5;
        border-radius: 30px;
    }

    .input-group .btn-primary {
        background-color: #3a416f;
        border: none;
        border-radius: 30px;
        font-weight: bold;
        padding: 12px 30px;
        box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2), -4px -4px 12px rgba(255, 255, 255, 0.5);
    }

    .input-group .btn-primary:hover {
        background-color: #4b58a1;
    }

    .card-contact {
        background-color: #e0e5ec;
        border-radius: 20px;
        box-shadow: 8px 8px 16px rgba(0, 0, 0, 0.2), -8px -8px 16px rgba(255, 255, 255, 0.5);
        padding: 30px;
    }

    .card-contact .card-title {
        font-size: 2.5rem;
        color: #3a416f;
        margin-bottom: 20px;
    }

    .list-unstyled li {
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    .list-unstyled i {
        margin-right: 10px;
        color: #3a416f;
    }

    .list-unstyled a {
        color: #3a416f;
        text-decoration: none;
    }

    .list-unstyled a:hover {
        text-decoration: underline;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid main-section">

    <!-- Mensaje de No Autorizado -->
    <?php
        if (isset($_REQUEST['noautorizado'])) {
            echo '<div class="alert alert-danger text-center">No autorizado para acceder a esta página.</div>';
        }
    ?>

    <!-- Sección principal -->
    <div class="text-center mt-5">
        <h1 class="display-4">Encuentra el trabajo de tus sueños</h1>
        <p class="lead lead-text">Explora nuestras ofertas laborales y postúlate a las que mejor se ajusten a tu perfil.</p>
    </div>

    <!-- Imagen central -->
    <div class="text-center image-central mt-4">
        <img src="images/DALL·E 2024-09-23 12.31.18 - A detailed illustration of a wolf head logo, similar to the one shown, with the text 'Ing. de Sistemas' written below the wolf head in bold, clean, mo.webp" alt="Imagen de búsqueda de empleo" class="img-fluid">
    </div>

    <!-- Sección de búsqueda -->
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
            <div class="card card-search p-4">
                <form action="source/mostrar_ofertas.php" method="GET" class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Busca por Cargo o Área" aria-label="Buscar">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Sección de contactos -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card card-contact p-4 shadow">
                <div class="card-body">
                    <h3 class="card-title text-center">Contáctanos</h3>
                    <p class="card-text text-center">Si tienes alguna duda o consulta, no dudes en contactarnos a través de los siguientes medios:</p>
                    <ul class="list-unstyled text-center">
                        <li><i class="fas fa-envelope"></i> Email: <a href="mailto:contacto@ejemplo.com">contacto@ejemplo.com</a></li>
                        <li><i class="fas fa-phone"></i> Teléfono: <a href="tel:+1234567890">+1 234 567 890</a></li>
                        <li><i class="fas fa-map-marker-alt"></i> Dirección: Calle Ejemplo 123, Ciudad, País</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
include("includes/foot.php");
?>
