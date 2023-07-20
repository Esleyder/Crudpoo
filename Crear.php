<?php
require_once("Persona.php");

$mensajeRegistro = ""; // Inicializamos el mensaje de registro vacío

// Verificar si se envió el formulario de creación de usuarios
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nombre_usuario"])) {
        $nombre = $_POST["nombre_usuario"];
        // Crear un objeto Persona con el nombre proporcionado
        $persona = new Persona($nombre);
        // Guardar la persona
        $idInsertado = $persona->insertarPersona();
        if ($idInsertado) {
            $mensajeRegistro = "Persona registrada con ID: " . $nombre;
        } else {
            $mensajeRegistro = "Error al registrar la persona.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>
<body>
    <fieldset>
        <legend>Formulario Persona</legend>
        <!-- Mostrar mensaje de registro -->
        <?php if ($mensajeRegistro) : ?>
            <p style="color: <?php echo $idInsertado ? 'green' : 'red'; ?>"><?php echo $mensajeRegistro; ?></p>
        <?php endif; ?>

        <form action="#" method="post">
            <p>Nombre: <input type="text" name="nombre_usuario" id="nombre_usuario"></p>
            <p><input type="submit" name="Guardar" value="Guardar"></p>
        </form>
        <a href="index.php">Volver</a>
    </fieldset>
</body>
</html>
