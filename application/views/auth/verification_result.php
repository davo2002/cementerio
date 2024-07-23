<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Verificación</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php if ($this->session->flashdata('message')): ?>
        <script>
            $(document).ready(function() {

                // O mostrar una notificación flotante
                $('body').append('<div id="notification" style="position:fixed;bottom:10px;right:10px;background-color:#4CAF50;color:white;padding:10px;border-radius:5px;">' +
                    '<?php echo $this->session->flashdata('message'); ?>' +
                    '</div>');

                setTimeout(function() {
                    $('#notification').fadeOut();
                }, 5000);
            });
        </script>
    <?php endif; ?>
</body>
</html>
