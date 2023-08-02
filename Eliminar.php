<?php



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