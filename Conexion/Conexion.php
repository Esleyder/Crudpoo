<?php
class Conexion {
    protected $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO('mysql:host=localhost;dbname=pruebapoo', 'root', '');
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function obtenerConexion() {
        return $this->conexion;
    }
}
?>