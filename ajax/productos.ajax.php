<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

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
	=            EDITAR PRODUCTO                                         =
    ====================================================================*/
    
    public $idProducto;
    public $traerProductos;
    public $nombreProducto;

    public function ajaxEditarProducto(){

        if($this->traerProductos == "ok"){

        $item = null;
        $valor = null;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);

        }else if($this->nombreProducto != ""){

        $item = "descripcion";
        $valor = $this->nombreProducto;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);
        

        }else{
        
        $item = "id";
        $valor = $this->idProducto;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);
        }
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
= EDITAR PRODUCTO                  =
=============================================*/
if(isset($_POST["idProducto"])) {
    // echo("<script>console.log('PHP: " . $_POST["idUsuario"] . "');</script>");
        $editarProducto = new AjaxProductos();
        $editarProducto -> idProducto = $_POST["idProducto"];
        $editarProducto -> ajaxEditarProducto();
    
    }

/*=============================================
= TRAER PRODUCTO                  =
=============================================*/
if(isset($_POST["traerProductos"])) {
    // echo("<script>console.log('PHP: " . $_POST["idUsuario"] . "');</script>");
        $traerProductos = new AjaxProductos();
        $traerProductos -> traerProductos = $_POST["traerProductos"];
        $traerProductos -> ajaxEditarProducto();
    
    }


/*=============================================
= TRAER PRODUCTO                  =
=============================================*/
if(isset($_POST["nombreProducto"])) {
    // echo("<script>console.log('PHP: " . $_POST["idUsuario"] . "');</script>");
        $nombreProducto = new AjaxProductos();
        $nombreProducto -> nombreProducto = $_POST["nombreProducto"];
        $nombreProducto -> ajaxEditarProducto();
    
    }
?>