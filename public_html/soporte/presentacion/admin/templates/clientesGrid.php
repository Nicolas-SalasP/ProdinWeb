<table border="1">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Dominio</th>
            <th>Planta</th>
            <th>Área</th>
            <th>Cargo</th>
            <th>Anexo</th>
            <th>Cuenta</th>
            <th>User</th>
            <th>Password</th>

        </tr>
    </thead>
    <tbody >
        <?php foreach ($view->clientes as $cliente):  // uso la otra sintaxis de php para templates ?>
            <tr>
                <td><?php echo $cliente['idregPersonal'];?></td>
                <td><?php echo $cliente['nombrePersonal'];?></td>
                <td><?php echo $cliente['correoPersonal'];?></td>
                <td><?php echo $cliente['dominioPersonal'];?></td>
                <td><?php echo $cliente['plantaPersonal'];?></td>
                <td><?php echo $cliente['areaPersonal'];?></td>
                <td><?php echo $cliente['cargoPersonal'];?></td>
                <td><?php echo $cliente['anexoPersonal'];?></td>
                <td><?php echo $cliente['detCuenta'];?></td>
                <td><?php echo $cliente['detUser'];?></td>
                <td><?php echo $cliente['detPassword'];?></td>
<!--                <td><a class="edit" href="javascript:void(0);" data-id="<?php echo $cliente['id'];?>">Editar</a></td>
                <td><a class="delete" href="javascript:void(0);" data-id="<?php echo $cliente['id'];?>">Borrar</a></td> -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
