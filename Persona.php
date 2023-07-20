<?php 
 require_once("Conexion.php");
 //Clase Persona extiende de la clase conexion
 class Persona extends Conexion {
     //Atributo Privado
     private $nombre_usuario;
     //Constructor Clase Persona
     public function __construct($nombre_usuario) {
        //heredo el los atributos y metodos de la clase Conexion
         parent::__construct();
         $this->nombre_usuario = $nombre_usuario;
     }
     
     //Funcion Insetar Persona
     public function insertarPersona() {
        
         $sql = "INSERT INTO username (nombre) VALUES (?)";
         $insert = $this->obtenerConexion()->prepare($sql);
 
         $parametros = array($this->nombre_usuario);
 
         $resInsert = $insert->execute($parametros);
         $idInsert = $this->obtenerConexion()->lastInsertId();
         return $idInsert;
     }
     
     //Funcion Mostrar Personas
     public function getUsuarios() {
         $sql = "SELECT * FROM username";
         $execute = $this->obtenerConexion()->query($sql);
         $request = $execute->fetchAll(PDO::FETCH_ASSOC);
         return $request;
     }
     

     //Funcion Eliminar Persona
     public function eliminarPersona($id) {
         $sql = "DELETE FROM username WHERE id = ?";
         $delete = $this->obtenerConexion()->prepare($sql);
 
         $parametros = array($id);
 
         $resDelete = $delete->execute($parametros);
         return $resDelete;
     }
     

     //Funcion Obterner Persona por el Id 
     public function obtenerPersonaPorId($id)
     {
         $sql = "SELECT * FROM username WHERE id = ?";
         $query = $this->obtenerConexion()->prepare($sql);
         $parametros = array($id);
         $query->execute($parametros);
         $persona = $query->fetch(PDO::FETCH_ASSOC);
         return $persona;
     }
    

    //Funcion Editar Persona
    public function editarPersona($id, $nombre){
    $sql = "UPDATE username SET nombre = ? WHERE id = ?";
    $update = $this->obtenerConexion()->prepare($sql);
    $parametros = array($nombre, $id);
    $resUpdate = $update->execute($parametros);
    return $resUpdate;
    }
}
?>
 