<div id="back"></div>

<div class="login-box">
  <div class="login-logo">
    <img src="img/plantilla/logo-blanco-bloque.png" classs="img-responsive" style="padding:30px 100px 0px 100px">
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar al sistema</p>
    
    <form method="post">

      <!-- Casilla de usuari en el login -->
      <div class="form-grouSp has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      
      <!-- Casilla de password -->
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <!-- Boton de signin -->
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>
      <?php  
        $login = new ControladorUsuarios();
        $login -> crtIngresoUsuario();


      ?>

    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
