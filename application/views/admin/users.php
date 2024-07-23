
<div class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <h2>Usuarios</h2>
      <table class="table table-striped">
        <thead>
          <tr>
          <th>#</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Verificado</th>
          </tr>
        </thead>
        <tbody>
            <?php if(!empty($usuarios)): ?>
                <?php foreach($usuarios as $c): ?>
                    <tr>
                        <th scope="row"><?php echo $c->id;?></th>
                        <td><?php echo $c->nombre;?> <?php echo $c->snombre;?> <?php echo  $c->apellido;?> <?php echo $c->sapellido;?></td>
                        <td><?php echo $c->email;?></td>
                        <td><?php echo $c->phone;?></td>
                        <td><?php echo $c->direccion;?></td>
                        <td><?php if ($c->verificado == 1): ?>
                            <span class="badge badge-success">Verificado</span>
                            <?php else: ?>
                                <span class="badge badge-danger">No verificado</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <td><button class="btn btn-sm btn-primary">Ver</button></td>
          </tr>
          <!-- Más filas de documentos aquí -->
        </tbody>
      </table>
    </div>
  </div>
</div>
