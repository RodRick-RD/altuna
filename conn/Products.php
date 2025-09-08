<?php
require_once "conexionBD.php";
class Products extends ConexionBD{
    public function ProductGetAll() {
        try{
            $this->conectar();
            $resultado = $this->conexion->prepare("SELECT p.*,c.categoria FROM producto p INNER JOIN categoria c ON p.id_categoria=c.id WHERE p.estado NOT IN (3);");
            $resultado->execute();
            $result = $resultado->get_result();
            $this->cerrarConexion();
        
            $filas = [];
            while ($fila = $result->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
            
        }catch(Exception $e){
            return "Error al realizar La consulta.";
        }
    }
    public function Categorias() {
        try{
            $this->conectar();
            $resultado = $this->conexion->prepare("SELECT id,categoria FROM categoria ORDER BY categoria DESC;");
            $resultado->execute();
            $result = $resultado->get_result();
            $this->cerrarConexion();
        
            $filas = [];
            while ($fila = $result->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
            
        }catch(Exception $e){
            return "Error al realizar La consulta.";
        }
    }
}
?>
