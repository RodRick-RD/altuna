<?php
require_once "conexionBD.php";
class User extends ConexionBD{
    public function infoUser($id) {
        try{
            $this->conectar();
            $resultado = $this->conexion->prepare("SELECT nombre,estado,cargo FROM usuario WHERE Id=?;");
            $resultado->bind_param('i',$id);
            $resultado->execute();
            $result = $resultado->get_result();
            $this->cerrarConexion();

            return $result->fetch_assoc();
            
        }catch(Exception $e){
            return "Error al realizar La consulta.";
        }
    }
}
?>
