<?php
require_once("./Clases/Persona.php");

$objetoPersona = new Persona("112",1111,"Brayan","brayan@gmail.com","Maculino","",0,0);
$usuarios = $objetoPersona->getUsuarios();

require_once("Eliminar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Personas</title>
</head>
<body>
    <h1>Listado de Personas</h1>
    <a href="./Crear.php"><input type="button" value="Crear Usuario"></a>
    <table border="1px" width="500px" height="200px">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Sexo</th>
                <th>Descripcion</th>
                <th>Empresa</th>
                <th>RH</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($usuarios as $usuario) : ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['cedula']; ?></td>
            <td><?php echo $usuario['usuario_nombre']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><?php echo $usuario['sexo']; ?></td>
            <td><?php echo $usuario['descripcion']; ?></td>
            <td><?php echo $usuario['empresa_nombre']; ?></td>
            <td><?php echo $usuario['rh_nombre']; ?></td>
            <td><a href="Editar.php?id=<?php echo $usuario['id']; ?>">Editar</a></td>
            <td><a href="index.php?eliminar=<?php echo $usuario['id']; ?>">Eliminar</a></td>
        </tr>
    <?php endforeach; ?>
</tbody>
    </table>
</body>
</html>
