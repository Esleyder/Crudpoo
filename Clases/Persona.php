<?php 
 require_once("Conexion.php");
 //Clase Persona extiende de la clase conexion
 class Persona extends Conexion {
     //Atributo Protected
     protected $nombre;
     protected $cedula;
     protected $email;
     protected $sexo;
     protected $descripcion;
     protected $empresa_id;
     protected  $rh_id;

     //Constructor Clase Persona
     public function __construct($nombre,$cedula,$email,$sexo,$descripcion,$empresa_id,$rh_id) {
        //heredo el los atributos y metodos de la clase Conexion
         parent::__construct();
         $this->nombre = $nombre;
         $this->cedula=$cedula;
         $this->email=$email;
         $this->sexo=$sexo;
         $this->descripcion=$descripcion;
         $this->empresa_id=$empresa_id;
         $this->rh_id=$rh_id;
     }

// Funcion Mostrar Personas
public function getUsuarios() {
    $sql = "SELECT u.id, u.cedula, u.nombre AS usuario_nombre, u.email, u.sexo, u.descripcion,
            e.nombre AS empresa_nombre, r.nombre AS rh_nombre
            FROM usuario u, empresa e, rh r
            WHERE u.empresa_id = e.id AND u.rh_id = r.id";

    $execute = $this->obtenerConexion()->query($sql);
    $request = $execute->fetchAll(PDO::FETCH_ASSOC);
    return $request;
}

     //Funcion Insetar Persona
     public function insertarPersona() {
        
         $sql = "INSERT INTO usuario (nombre,cedula,email,sexo,descripcion,empresa_id,rh_id)
         VALUES (?,?,?,?,?,?,?)";
         $insert = $this->obtenerConexion()->prepare($sql);
 
         $parametros = array($this->cedula,$this->nombre,$this->email,$this->sexo,$this->descripcion,$this->empresa_id,$this->rh_id);
 
         $resInsert = $insert->execute($parametros);
         $idInsert = $this->obtenerConexion()->lastInsertId();
         return $idInsert;
     }
     
     //Funcion Eliminar Persona
     public function eliminarPersona($id) {
         $sql = "DELETE FROM usuario WHERE id = ?";
         $delete = $this->obtenerConexion()->prepare($sql);
 
         $parametros = array($id);
 
         $resDelete = $delete->execute($parametros);
         return $resDelete;
     }
    
     //Funcion Obterner Persona por el Id 
     public function obtenerPersonaPorId($id){
         $sql = "SELECT * FROM usuario WHERE id = ?";
         $query = $this->obtenerConexion()->prepare($sql);
         $parametros = array($id);
         $query->execute($parametros);
         $persona = $query->fetch(PDO::FETCH_ASSOC);
         return $persona;
     }
    
    //Funcion Editar Persona
    public function editarPersona($id, $nombre, $cedula, $email, $sexo, $descripcion, $empresa_id, $rh_id){
    $sql = "UPDATE usuario SET nombre = ?, cedula = ?, email = ?, sexo = ?, descripcion = ?, empresa_id = ?, rh_id = ? WHERE id = ?";
    $update = $this->obtenerConexion()->prepare($sql);
    // Los parámetros deben estar en el mismo orden que aparecen en la consulta
    $parametros = array($nombre, $cedula, $email, $sexo, $descripcion, $empresa_id, $rh_id, $id);
    $resUpdate = $update->execute($parametros);
    return $resUpdate;
}

}
?>
 