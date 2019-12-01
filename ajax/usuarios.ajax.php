<?php 

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{
	/*=============================================uczucz
	=            EDIATAR USUARIOS           =
	=============================================*/
	public $idUsuario;

	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->idUsuario;
		// ctr en lugar de crt ?????
		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		echo json_encode($respuesta);

	}
	/*=============================================
	=            Activar usuario                   =
	=============================================*/
	
	public $activarUsuario;
	public $activarId;
	
	public function ajaxActivarUsuario(){

		$tabla = "usuarios";
		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
	}

	/*====================================================================
	=            validar si el usario esta creado previamente            =
	====================================================================*/
	// Variable publica
	public $validarUsuario;

	public function ajaxValidarUsuario(){

			$item = "usuario";
			$valor = $this->validarUsuario;

			$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
			echo json_encode($respuesta);
	}
}
/*=============================================
=            EDIATAR USUARIOS           =
=============================================*/
if(isset($_POST["idUsuario"])) {
// echo("<script>console.log('PHP: " . $_POST["idUsuario"] . "');</script>");
	$editar = new AjaxUsuarios();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> ajaxEditarUsuario();

}
/*=============================================
=            Activar usuario                          =
=============================================*/
if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();
	
}

/*====================================================================
=            validar si el usario esta creado previamente            =
====================================================================*/

if(isset($_POST["validarUsuario"])){

// echo("<script>console.log('PHP: " . $_POST["validarUsuario"] . "');</script>");
	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();
}

?>