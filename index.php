<?php
require_once("Persona.php");

$objetoPersona = new Persona("");
$usuarios = $objetoPersona->getUsuarios();

// Verificar si se recibió el parámetro "id" en la URL para eliminar una persona
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["eliminar"])) {
    // Obtener el ID del registro a eliminar
    $id = $_GET["eliminar"];

    // Eliminar la persona con el ID proporcionado
    $resDelete = $objetoPersona->eliminarPersona($id);

    if ($resDelete) {
        echo "Persona eliminada con éxito.";
        header("Location: index.php");
        exit; // Importante: asegúrate de salir del script después de la redirección
    } else {
        echo "Error al eliminar la persona.";
    }
}
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
    <a href="Crear.php"><input type="button" value="Crear Usuario"></a>
    <table border="1px" width="500px" height="200px">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><a href="Editar.php?id=<?php echo $usuario['id']; ?>">Editar</a></td>
                    <td><a href="index.php?eliminar=<?php echo $usuario['id']; ?>">Eliminar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>