        <tbody>
          <?php

            $item = null;
            $valor = null;
/* Display the information by blocka in order to not afect the performance of the server

*/
            $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

            foreach ($productos as $key => $value){
              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                      <td>'.($value["codigo"]).'</td>              
                      <td>'.($value["descripcion"]).'t</td>';
                      $item = "id";
                      $valor = $value["id_categoria"];

                      $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                      echo '
                      <td>'.($categoria["categoria"]).'</td>
                      <td>'.($value["stock"]).'</td>
                      <td>'.($value["precio_compra"]).'</td>
                      <td>'.($value["precio_venta"]).'</td>
                      <td>'.($value["fecha"]).'</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                        </div>
                      </td>
                    </tr>';
          }
          ?>

          </tbody>