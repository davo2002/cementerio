<!-- Incluir Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Incluir Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')): ?>
            toastr.success('<?php echo $this->session->flashdata('success'); ?>');
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            toastr.error('<?php echo $this->session->flashdata('error'); ?>');
        <?php endif; ?>
    });
</script>
<?php if ($this->session->flashdata('message')): ?>
        <div id="notificationPanel"><?php echo $this->session->flashdata('message'); ?></div>
        <script>
            $(document).ready(function() {
                $('#notificationPanel').fadeIn();

                setTimeout(function() {
                    $('#notificationPanel').fadeOut();
                }, 5000); // Ocultar la notificación después de 5 segundos
            });
        </script>
    <?php endif; ?>
</body>
</html>