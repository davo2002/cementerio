<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión del Cementerio - Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="<?php echo base_url("assets/archivos/LOGO.png") ?>">
  <style>
    #notificationPanel {
      position: fixed;
      bottom: 10px;
      right: 10px;
      background-color: #4CAF50;
      color: white;
      padding: 15px;
      border-radius: 5px;
      display: none;
      z-index: 1000;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="">Gestión del Cementerio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
          <a class="nav-link" href="admin">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="bovedas">Bóvedas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="catastro">Catastro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="documentos">Documentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="eventos">Eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pagos">Pagos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="usuarios">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="auth/logout">Cerrar Sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="notificationIcon">Notificaciones <span class="badge" id="notificationCount">0</span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div id="notificationPanel">
    <!-- Notificaciones serán añadidas aquí mediante JavaScript -->
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="<?php echo base_url('path/to/notificacion.js'); ?>"></script>
</body>
</html>
