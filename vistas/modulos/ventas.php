<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Ventas
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administración Ventas</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear ventas">

          <button class="btn btn-primary">
            Agragar ventas
          </button>

        </a>

      </div>

      <div class="box-body">

        <!-- ucz MODELOS DE TABLAS https://www.w3schools.com/bootstrap/bootstrap_tables.asp ESTA TABLA SE DESPLEGA EN LA PANTALLA DE ADMINISTRAR USUARIO Y CINTENDRA LOS USUARIOS DADOS DE ALTA -->
        <!-- table-responsive https://www.w3schools.com/bootstrap/bootstrap_tables.asp PARA OBTENER BARRAS DE DESPLAZAMIENTO HORIZONTALES Y VERTICALES-->
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Código factura</th>
              <th>Cliente</th>
              <th>Vendedor</th>
              <th>Forma de pago</th>
              <th>Neto</th>
              <th>Total</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>

            <tr>

              <td>1</td>
              <td>1000123</td>
              <td>Juan Villegas</td>
              <td>Julio Gomez</td>
              <td>TC-123456789789456</td>
              <td>$ 1,000.00</td>
              <td>$ 1,190.00</td>
              <td>2019.01.25 12:02:01</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-info"><i class="fa fa-print"></i></button>
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

