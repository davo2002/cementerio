<h2>Verificación de Dos Pasos</h2>
<?php echo form_open('auth/verify_two_factor_process'); ?>
    <label for="verification_code">Código de Verificación:</label>
    <input type="text" id="verification_code" name="verification_code" required>
    <br>
    <button type="submit">Verificar</button>
<?php echo form_close(); ?>

