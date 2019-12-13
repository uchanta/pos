<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Productos
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administración productos</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">Agragar producto</button>

      </div>

      <!-- body -->
      <div class="box-body">

        <!-- ucz MODELOS DE TABLAS https://www.w3schools.com/bootstrap/bootstrap_tables.asp ESTA TABLA SE DESPLEGA EN LA PANTALLA DE ADMINISTRAR USUARIO Y CINTENDRA LOS USUARIOS DADOS DE ALTA -->
        <!-- table-responsive https://www.w3schools.com/bootstrap/bootstrap_tables.asp PARA OBTENER BARRAS DE DESPLAZAMIENTO HORIZONTALES Y VERTICALES-->
        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Agregado</th>
              <th>Acciones</th>
            </tr>
          </thead>

        </table>

      </div>
 
    </div>

  </section>

</div>

<!-- MODAL AGREGAR PRODUCTO 
https://www.w3schools.com/bootstrap/bootstrap_modal.asp-->
<!-- ESTA FORMA SE ABRE AL OPRIMIR EL BOTON DE AGREGAR USUARIO EN LA PANTALLA DE ADM-USR -->
<div id="modalAgregarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- cabeza del modal -->

        <div class="modal-header" style="background:#3c8dbc; color:white" >
          
        </style>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!-- MODAL BODY -->

        <div class="modal-body">
          <div class="box-body">

            <!-- seleccionar categoria -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  <option value="">Seleccionar categoría</option>

                    <?php
                      $item = null;
                      $valor = null;

                      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                      foreach($categorias as $key => $value){

                        echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                      }
                    ?>

                </select>
              </div>
            </div>

        <!-- ENTRADA PARA EL CODIGO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar codigo" readonly required>
              </div>
            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" id="nuevaDescripcion" name="nuevaDescripcion" placeholder="Ingresar descripcion" required>
              </div>
            </div>


            <!-- ENTRADA PARA STOCK -->
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  <input type="number" class="form-control input-lg" id="nuevoStock" name="nuevoStock" min="0" placeholder="Stock" required>
                </div>
              </div>

            <!-- ENTRADA PARA PRECIO DE COMPRA -->
            <div class="form-group">
            <!-- para que el campo no este tan pequeño en celular o tablet cambiamos de col-xs-6 a 12 -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>
                </div>
              </div>

              <!-- ENTRADA PARA PRECIO DE VENTA  -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>
                </div>
                <br>
                  <!-- CHECK BOX PARA PORCENTAJE -->
                  <div class="col-xs-6">
                    <div class="form-group">  
                      <label>
                        <input type="checkbox" class="minimal porcentaje">
                        Utilizar porcentaje
                      </label>
                    </div>
                  </div>
                  <!-- ENTRADA DE EL PORCENTAJE -->
                  <div class="col-xs-6" style="padding:0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>

              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group">
              <div clas="panel">SUBIR IMAGEN</div>
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso maximo de la imagen 2Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>


          </div>
        </div>

        <!-- PIE DEL MODAL  -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>
        <?php
          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();       
                      
        ?>

    </div>

  </div>

</div>

<!-- MODAL EDITAR PRODUCTO  -->

<div id="modalEditarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- cabeza del modal -->

        <div class="modal-header" style="background:#3c8dbc; color:white" >
          

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!-- MODAL BODY -->

        <div class="modal-body">
          <div class="box-body">

            <!-- seleccionar categoria -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editarCategoria" readonly required>
                  <option id="editarCategoria"></option>
                </select>
              </div>
            </div>

        <!-- ENTRADA PARA EL CODIGO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>
              </div>
            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>
              </div>
            </div>


            <!-- ENTRADA PARA STOCK -->
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>
                </div>
              </div>

            <!-- ENTRADA PARA PRECIO DE COMPRA -->
            <div class="form-group row">
            <!-- para que el campo no este tan pequeño en celular o tablet cambiamos de col-xs-6 a 12 -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" required>
                </div>
              </div>

              <!-- ENTRADA PARA PRECIO DE VENTA  -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" readonly required>
                </div>
                <br>
                  <!-- CHECK BOX PARA PORCENTAJE -->
                  <div class="col-xs-6">
                    <div class="form-group">  
                      <label>
                        <input type="checkbox" class="minimal porcentaje">
                        Utilizar porcentaje
                      </label>
                    </div>
                  </div>
                  <!-- ENTRADA DE EL PORCENTAJE -->
                  <div class="col-xs-6" style="padding:0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>

              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group">
              <div clas="panel">SUBIR IMAGEN</div>
              <input type="file" class="nuevaImagen" name="editarImagen">
              <p class="help-block">Peso maximo de la imagen 2Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

            </div>


          </div>
        </div>

        <!-- PIE DEL MODAL  -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>
          <?php
            $editProducto = new ControladorProductos();
            $editProducto -> ctrEditarProducto();
          ?>

    </div>

  </div>

</div>
<?php
  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();
?>
