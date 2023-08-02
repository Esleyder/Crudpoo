<?php
require_once("./Conexion/Conexion.php");


class Empresa extends Conexion{
protected $id;
protected $nit;
protected $nombre;


public function getEmpresas() {
    $sql = "SELECT * FROM empresa";
    $execute = $this->ObtenerConexion()->query($sql);
    $request = $execute->fetchAll(PDO::FETCH_ASSOC);
    return $request;
}





}


?>