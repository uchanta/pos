<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Usuarios
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administración usuarios</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agragar usuario</button>

      </div>

      <div class="box-body">

        <!-- ucz MODELOS DE TABLAS https://www.w3schools.com/bootstrap/bootstrap_tables.asp ESTA TABLA SE DESPLEGA EN LA PANTALLA DE ADMINISTRAR USUARIO Y CINTENDRA LOS USUARIOS DADOS DE ALTA -->
        <!-- table-responsive https://www.w3schools.com/bootstrap/bootstrap_tables.asp PARA OBTENER BARRAS DE DESPLAZAMIENTO HORIZONTALES Y VERTICALES-->
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo Login</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td>Usuario Administrador</td>
              <td>admin</td>
              <td><img src="img/usuarios/default/anonimous.jpg" class="img-thumbnail" width="40px"></td>
              <td>Administrator</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2017-12-11 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
              <tr>

              <td>1</td>
              <td>Usuario Administrador</td>
              <td>admin</td>
              <td><img src="img/usuarios/default/anonimous.jpg" class="img-thumbnail" width="40px"></td>
              <td>Administrator</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2017-12-11 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
              <tr>

              <td>1</td>
              <td>Usuario Administrador</td>
              <td>admin</td>
              <td><img src="img/usuarios/default/anonimous.jpg" class="img-thumbnail" width="40px"></td>
              <td>Administrator</td>
              <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
              <td>2017-12-11 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
              
            </tr>
          </tbody>
          
        </table>

      </div>
 
    </div>

  </section>

</div>

<!-- MODAL AGREGAR USUARIO https://www.w3schools.com/bootstrap/bootstrap_modal.asp-->
<!-- ESTA FORMA SE ABRE AL OPRIMIR EL BOTON DE AGREGAR USUARIO EN LA PANTALLA DE ADM-USR -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- cabeza del modal -->

        <div class="modal-header" style="background:#3c8dbc; color:white" >
          
        </style>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!-- MODAL BODY -->
        <!-- ENTRADA PARA EL NOMBRE -->
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL USUARIO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA CONTRASEÑAO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar password" required>
              </div>
            </div>

            <!-- seleccionar el perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Seleccionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group">
              <div clas="panel">Subir foto</div>
              <input type="file" id="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso maximo de la foto 200 Mb</p>
              <img src="img/usuarios/default/anonimous.jpg" class="img-thumbnail" width="100px">

            </div>


          </div>
        </div>

        <!-- PIE DEL MODAL  -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

      </form>
    </div>

  </div>

</div>
