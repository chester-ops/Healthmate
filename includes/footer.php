<?php
$page = getCurrentPage();

// Getting sidebar
getSidebar($userRole, $page);
?>
<!-- Jquery File -->
<script src="../dist/js/jquery.min.js"></script>
<!-- Site JS File -->
<script src="../dist/js/main.js"></script>
</div>
<footer class="dashboard-footer d-flex align-items-center">
    <div class="copyright">Copyright ©
        <?php echo date("Y"); ?> <span>HealthMate</span>. All Rights Reserved
    </div>
</footer>
</body>

</html>