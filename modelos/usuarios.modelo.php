<?php
require_once "conexion.php";

class ModeloUsuarios{

	// Mostrar usuarios

	static public function mdlMostrarUsuarios($tabla, $item, $valor){
		// $stmt = Conexion::conectar()->prepare();
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
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
	// REGISTRO DE usuarios
	static public function mdlIngresarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");

		// foto en realidad es la direccion donde esta almacenada
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		echo "$datos";
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt -> close();
		$stmt = null;
	}	

}

?>