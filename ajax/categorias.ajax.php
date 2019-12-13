<?php 

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{

	/*====================================================================
	=            editar categoria            =
	====================================================================*/
	
	// Variable publica
	public $idCategoria;

	public function ajaxEditarCategoria(){

			$item = "id";
			$valor = $this->idCategoria;	

			$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
			echo json_encode($respuesta);
					}
}	
/*=============================================
=            EDIATAR categorias           =
=============================================*/
if(isset($_POST["idCategoria"])) {
// echo("<script>console.log('PHP: " . $_POST["idUsuario"] . "');</script>");
	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}
?>