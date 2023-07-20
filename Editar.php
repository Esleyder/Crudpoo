<?php
require_once("Persona.php");

// Crear una instancia de Persona al cargar la página
$objetoPersona = new Persona("");

// Verificar si se recibió el parámetro "id" en la URL
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Obtener los datos de la persona por su ID
    $datosPersona = $objetoPersona->obtenerPersonaPorId($id);

    // Verificar si se encontró la persona
    if ($datosPersona) {
        // Mostrar el formulario de edición
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Usuario</title>
        </head>
        <body>
            <h1>Editar Usuario</h1>
            <form action="Editar.php?id=<?php echo $id; ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $datosPersona['id']; ?>">
                <label for="nombre">Nombre de usuario:</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $datosPersona['nombre']; ?>" required>
                <br><br>
                <input type="submit" value="Editar">
            </form>
            <a href="index.php">Volver</a>
        </body>
        </html>
        <?php
    } else {
        echo "No se encontró la persona con el ID proporcionado.";
    }
}

// Verificar si se recibió el formulario de edición de usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"], $_POST["nombre_usuario"])) {
    $id = $_POST["id"];
    $nuevoNombre = $_POST["nombre_usuario"];

    // Editar la persona con el ID proporcionado utilizando la instancia existente
    $resUpdate = $objetoPersona->editarPersona($id, $nuevoNombre);

    if ($resUpdate) {
        echo "Persona actualizada con éxito.";
        // Redireccionar al usuario a index.php
        header("Location: index.php");
        exit; // Asegúrate de salir del script después de la redirección
    } else {
        echo "Error al actualizar la persona.";
    }
}
?>
