<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{

	/*====================================================================
	=            GENERAR CODIGO APARTIR DE ID CATEGORIA                   =
	====================================================================*/
	
	// Variable publica
	public $idCategoria;

	public function ajaxCrearCodigoProducto(){
        
        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);
    }
    

    /*====================================================================
	=            GENERAR CODIGO APARTIR DE ID CATEGORIA                   =
    ====================================================================*/
    
    public $idProducto;

    public function ajaxEditarProducto(){
        
        $item = "id";
        $valor = $this->idProducto;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);
    }
}	

/*=============================================
=            GENERAR CODIGO APARTIR DE ID CATEGORIA           =
=============================================*/
if(isset($_POST["idCategoria"])) {
    // echo("<script>console.log('PHP: " . $_POST["idUsuario"] . "');</script>");
        $codigoProducto = new AjaxProductos();
        $codigoProducto -> idCategoria = $_POST["idCategoria"];
        $codigoProducto -> ajaxCrearCodigoProducto();
    
    }
    
/*=============================================
= EDITAR CODIGO DEL PRODUCTO                  =
=============================================*/
if(isset($_POST["idProducto"])) {
    // echo("<script>console.log('PHP: " . $_POST["idUsuario"] . "');</script>");
        $editarProducto = new AjaxProductos();
        $editarProducto -> idProducto = $_POST["idProducto"];
        $editarProducto -> ajaxEditarProducto();
    
    }

?>