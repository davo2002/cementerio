<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Eventos</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Padre</th>
                        <th>Nombre Persona</th>
                        <th>Para Persona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?php echo $event['id']; ?></td>
                        <td><?php echo $event['tipo']; ?></td>
                        <td><?php echo $event['fecha']; ?></td>
                        <td><?php echo $event['hora']; ?></td>
                        <td><?php echo $event['padre']; ?></td>
                        <td><?php echo $event['nombre_persona']; ?></td>
                        <td><?php echo $event['para_persona']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
