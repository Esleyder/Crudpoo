<?php
require_once("./Clases/Persona.php");
require_once("./Clases/Empresa.php");
require_once("./Clases/Rh.php");

// Verificamos si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Obtenemos el ID de la persona a editar
    $id = $_GET['id'];

    // Creamos una instancia de la clase Persona
    $objetoPersona = new Persona(null, null, null, null, null, null, null);

    // Obtenemos los datos de la persona a través de su ID
    $persona = $objetoPersona->obtenerPersonaPorId($id);

    // Si la persona no existe en la base de datos, redirigimos a la página principal
    if (!$persona) {
        header("Location: index.php");
        exit;
    }
} else {
    // Si no se proporciona un ID válido, redirigimos a la página principal
    header("Location: index.php");
    exit;
}



if (isset($_POST['Editar'])) {
    // Obtener los valores actualizados del formulario
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $descripcion = $_POST['descripcion'];
    $empresa_id = $_POST['empresa_id'];
    $rh_id = $_POST['rh_id'];

    // Actualizar los datos de la persona en la base de datos
    $resUpdate = $objetoPersona->editarPersona($id, $nombre, $cedula, $email, $sexo, $descripcion, $empresa_id, $rh_id);

    // Verificar si la actualización fue exitosa
    if ($resUpdate) {
        // Redirigir a la página principal o mostrar un mensaje de éxito
        header("Location: index.php");
        exit;
    } else {
        // Mostrar un mensaje de error o manejar el error de alguna manera
        echo "Error al actualizar la persona";
    }
}

 
$objetoEmpresa = new Empresa();
$empresas = $objetoEmpresa->getEmpresas();

$objetoRh = new Rh();
$rhs = $objetoRh->getRh();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Editar Usuario</title>
</head>
<body>
<fieldset>
    <legend>Formulario Persona</legend>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?php echo $persona['id']; ?>">

        <p>Cedula: <input type="number" name="cedula" value="<?php echo $persona['cedula']; ?>"></p>

        <p>Nombre: <input type="text" name="nombre" value="<?php echo $persona['nombre']; ?>"></p>

        <p>Correo:<input type="email" name="email" value="<?php echo $persona['email']; ?>"></p>

        <p>Sexo
            <input type="radio" name="sexo" value="Masculino" <?php if ($persona['sexo'] === 'Masculino') echo 'checked'; ?>>M
            <input type="radio" name="sexo" value="Femenino" <?php if ($persona['sexo'] === 'Femenino') echo 'checked'; ?>>F
        </p>

        <p><textarea name="descripcion" rows="4" cols="50" placeholder="Escribe un comentario"><?php echo $persona['descripcion']; ?></textarea></p>

        <p>Empresa
            <select name="empresa_id" required>
                <?php foreach ($empresas as $empresa) : ?>
                    <option value="<?php echo $empresa['id']; ?>" <?php if ($persona['empresa_id'] === $empresa['id']) echo 'selected'; ?>><?php echo $empresa['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>Rh
            <select name="rh_id" required>
                <?php foreach ($rhs as $rh) : ?>
                    <option value="<?php echo $rh['id']; ?>" <?php if ($persona['rh_id'] === $rh['id']) echo 'selected'; ?>><?php echo $rh['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p><input type="submit" name="Editar" value="Editar"></p>
    </form>
    <a href="index.php">Volver</a>
</fieldset>
</body>
</html>
