<?php

class ConexionBD {
    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $baseDeDatos = "naturaltunas";
    public $conexion;

    public function conectar() {
        try{
            $this->conexion = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->baseDeDatos);

            // Verificar la conexión
            if ($this->conexion->connect_error) {
                die("Error de conexión: " . $this->conexion->connect_error);
            }
        }catch(Exception $e){
            die("fallo de conexion BBDD: ".$e->getMessage());
        }
        
       
    }
    public function cerrarConexion() {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
    
}

//$conexionBD = new ConexionBD();
//$conexionBD->conectar();

// Realizar operaciones en la base de datos...

// Cerrar la conexión al finalizar
//$conexionBD->cerrarConexion();

?>
