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

?>