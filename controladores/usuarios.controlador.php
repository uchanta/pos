<?php


class ControladorUsuarios{

// Ingreso de usuarios
	public function ctrIngresoUsuario(){

		if(sset($_POST["ingUsuario"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				$tabla = "usuarios";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsurios($tabla, $item, $valor);
				var_dump($respuesta);

			}

		}

	}

}
