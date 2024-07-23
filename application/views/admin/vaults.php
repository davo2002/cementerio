<h1>Bóvedas</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Nombre Persona</th>
            <th>Fecha Defunción</th>
            <th>Usuario</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vaults as $vault): ?>
        <tr>
            <td><?php echo $vault['id']; ?></td>
            <td><?php echo $vault['numero']; ?></td>
            <td><?php echo $vault['nombre_persona']; ?></td>
            <td><?php echo $vault['fecha_defuncion']; ?></td>
            <td><?php echo $vault['usuario_id']; ?></td>
            <td><?php echo $vault['estado']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
