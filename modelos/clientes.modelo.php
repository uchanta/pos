<?php

require_once "conexion.php";

class ModeloClientes{

	// Crear clientes

	static public function mdlIngresarCliente($tabla, $datos){
	
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, documento, email, telefono, direccion, fecha_nacimiento) VALUES (:nombre, :documento, :email, :telefono, :direccion, :fecha_nacimiento)");
        
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{
            
            return "error";

        }
		
		$stmt -> close();
        $stmt = null;
        
    }
    
    /* 
    mostrar clientes
    */  
    static public function mdlMostrarClientes($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();
            return $stmt -> fetch();
    
        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt -> fetchAll();

        }
        
        $stmt -> close();
        $stmt = null;
        
    }

    // editar clientes

	static public function mdlEditarCliente($tabla, $datos){
	
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE id = :id");
        // echo("<script>console.log('PHPaaaa****: ".$datos["documento"]. "');</script>");
 
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
        // echo("<script>console.log('PHPbbbb****: ".$datos["documento"]. "');</script>");
        if($stmt -> execute()){
            return "ok";
        }else{ 
            return "error";
        }
		
		$stmt -> close();
        $stmt = null;
        
    }
    /*=============================================
	BORRAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;

    }
    
    /*========================================
	=     ACTUALIZAR CLIENTE                     =
	========================================*/
	
	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id",$valor, PDO::PARAM_STR);
		
		if($stmt -> execute()){
			return 'ok';
		}else{
			return 'error';
		}
		$stmt -> close();
		$stmt = null;
	}



}

?>