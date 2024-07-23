<h2>Registrarse</h2>

<form class="user" action="<?php echo base_url('auth/register_process'); ?>" method="post" enctype="multipart/form-data" id="registrationForm">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br>

    <label for="snombre">Segundo Nombre:</label>
    <input type="text" id="snombre" name="snombre">
    <br>

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" required>
    <br>

    <label for="sapellido">Segundo Apellido:</label>
    <input type="text" id="sapellido" name="sapellido">
    <br>

    <label for="phone">Teléfono:</label>
    <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}" title="Ingresa un número de teléfono válido de 10 dígitos">
    <br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br>

    <label for="confirm_password">Confirmar Contraseña:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <br>

    <button type="submit">Registrarse</button>
</form>

<!-- Incluir Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Incluir Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    function checkPasswordMatch() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            document.getElementById('confirm_password').setCustomValidity('Las contraseñas no coinciden.');
        } else {
            document.getElementById('confirm_password').setCustomValidity('');
        }
    }

    document.getElementById('password').addEventListener('input', checkPasswordMatch);
    document.getElementById('confirm_password').addEventListener('input', checkPasswordMatch);

    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Evita el envío del formulario
            toastr.error('Las contraseñas no coinciden. Por favor, verifica e intenta nuevamente.');
        }
    });
</script>

