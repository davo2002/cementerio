<?php echo form_open('auth/login_process'); ?>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="verification_method">Método de Verificación:</label>
    <select id="verification_method" name="verification_method" required>
        <option value="email">Correo Electrónico</option>
        <option value="phone">Mensaje de Texto</option>
    </select>
    <br>
    <button type="submit">Iniciar Sesión</button>
    <?php echo form_close(); ?>