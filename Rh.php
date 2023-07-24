<?php

class Rh extends Conexion{
protected $id;
protected $nombre;


public function getRh() {
    $sql = "SELECT * FROM rh";
    $execute = $this->ObtenerConexion()->query($sql);
    $request = $execute->fetchAll(PDO::FETCH_ASSOC);
    return $request;
}





}


?>