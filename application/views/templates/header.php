<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración del Cementerio</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link rel="icon" type="image/png" href="<?php echo base_url("assets/archivos/LOGO.png") ?>">
  <link rel="icon" type="image/png" href="<?php echo base_url("assets/archivos/LOGO.png") ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        #notificationPanel {
            position: fixed;
            bottom: 10px;
            right: 10px;
            color: white;
            padding: 15px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }
        .success {
            background-color: #4CAF50;
        }
        .error {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
                <li><a href="<?php echo site_url('auth/login'); ?>">Iniciar Sesión</a></li>
                <li><a href="<?php echo site_url('auth/register'); ?>">Registrarse</a></li>
        </ul>
    </nav>
    <div class="container">
