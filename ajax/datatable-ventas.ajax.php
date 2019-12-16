<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class TablaProductosVentas{
    // MOSTAR LA TABLA DE LOS PRODUCTOS

    public function mostrarTablaProductosVentas(){

      $item = null;
			$valor = null;

			$productos = ControladorProductos::ctrMostrarProductos($item, $valor);
      
            $datosJson = '{
        "data": [';

        for($i = 0; $i < count($productos); $i++){
          // 
          //  TRAEMOS LA IMAGEN
          // 
          $imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
          // 
          //  STOCK
          //  
          if($productos[$i]["stock"] <= 10){
            $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
          }else if($productos[$i]["stock"] > 11  && $productos[$i]["stock"] <= 15){
            $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
          }else{
            $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
          }
          // **********************************************
          //  TRAEMOS LAS ACCIONES
          // ***************************************************************************
          $botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button>";
          
            $datosJson .='[
                "'.($i+1).'",
                "'.$imagen.'",
                "'.$productos[$i]["codigo"].'",
                "'.$productos[$i]["descripcion"].'",
                "'.$stock.'",
                "'.$botones.'"
              ],';
        }
        // para borrar la ultima coma del arreglo que y ano debe ir
        $datosJson = substr($datosJson, 0, -1);
        $datosJson.= ']
      }';
      echo $datosJson;
     
    }

}

/* 
ACTIVAR TABLA DE PRODUCTOS
*/
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();


?>