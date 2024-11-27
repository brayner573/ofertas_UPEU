<?php
// Verifica si la constante RUTAGENERAL está definida, de lo contrario, la define
if(!defined('RUTAGENERAL')) {
    define('RUTAGENERAL', 'http://localhost/bolsa_laboral/');
}
?>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; UPeU 2024</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo RUTAGENERAL; ?>themplates/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo RUTAGENERAL; ?>themplates/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo RUTAGENERAL; ?>themplates/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo RUTAGENERAL; ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo RUTAGENERAL; ?>themplates/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo RUTAGENERAL; ?>js/jquery-ui.min.js"></script>
