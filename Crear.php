<?php
require_once("Persona.php");
require_once("Empresa.php");
require_once("Rh.php");
//Objeto Empresa
$objetoEmpresa =new Empresa();
$empresa = $objetoEmpresa->getEmpresas();
//objeto RH
$objetoRh=new Rh();
$rh=$objetoRh->getRh();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recuperamos los datos del formulario
    $cedula=$_POST['cedula'];
    $nombre=$_POST['nombre'];
    $email=$_POST['email'];
    $sexo=$_POST['sexo'];
    $descripcion=$_POST['descripcion'];
    $empresa_id=$_POST['empresa_id'];
    $rh_id=$_POST['rh_id'];

    

    // Creamos un objeto Empleado
    $persona = new Persona($cedula,$nombre,$email,$sexo,$descripcion,$empresa_id,$rh_id);

    // Insertamos el empleado en la base de datos
    $idInsertado = $persona->insertarPersona();

    // Si todo fue exitoso, puedes redirigir al usuario a una página de éxito o mostrar un mensaje
    // Por ejemplo:
    if ($idInsertado) {
        echo "Empleado insertado correctamente con el ID: " . $idInsertado;
        header("Location: index.php");
    } else {
        echo "Error al insertar el empleado en la base de datos.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Crear Usuario</title>
</head>
<body>
    <fieldset>
        <legend>Formulario Persona</legend>
      <form action="#" method="post">
            <p>Cedula: <input type="number" name="cedula" id="cedula"></p>

            <p>Nombre: <input type="text" name="nombre" id="nombre"></p>

            <p>Correo:<input type="correo" name="email"></p>

            <p>Sexo<input type="radio" name="sexo" value="Masculino">M
            <input type="radio" name="sexo" value="Femenino">F</p>

            <p><textarea name="descripcion"  rows="4" cols="50" placeholder="Escribe un comentario"></textarea></p>

            <p>Empresa<select name="empresa_id"  required>
                <?php foreach ($empresa as $empresas) : ?>
                    <option value="<?php  echo $empresas['id']; ?>"><?php echo $empresas['nombre']; ?></option>
                <?php endforeach; ?>
            </select></p>

            <p>Rh<select name="rh_id"  required>
                <?php foreach ($rh as $rhs) : ?>
                    <option value="<?php  echo $rhs['id']; ?>"><?php echo $rhs['nombre']; ?></option>
                <?php endforeach; ?>
            </select></p>

            <p><input type="submit" name="Guardar" value="Guardar"></p>
        </form>
        <a href="index.php">Volver</a>
    </fieldset>
</body>
</html>
