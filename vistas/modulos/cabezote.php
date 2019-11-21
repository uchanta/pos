
<header class="main-header">
	
	<!-- 
	logotipo = grande y pequeño para cuando se contraiga el menu
	 -->
	<a href="inicio"  class="logo">
		
		<!-- logo min -->
		<span class="logo-mini">
				<img src="img/plantilla/ml3.jpg" class="img-responsive" style="padding:10px">
			
		</span>
		
		<!-- logo normal -->
		<span class="logo-lg">
				<img src="img/plantilla/ml2.jpg" class="img-responsive" style="padding:10px 0px">
			
		</span>

	</a>
	  <!--===========================================
  		= BARRA DE NAVEGACIÓN  UCZ-- la parte superior de la hoja
  		Contiene el menu hamburger y los email, usuario admnistrador, etc =
  		============================================-->
	<nav class="navbar mavbar-static-top" role="navigation">
		<!-- Boton de navegación -->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span> 
			<!-- <span class="icon-bar"></span> 
			<span class="icon-bar"></span> 
			<span class="icon-bar"></span>  -->
		</a>

		<!-- perfil de usurio -->
		<div class="navbar-custom-menu"> 
			<ul class="nav navbar-nav">
				<li class="dropdownn user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php 
							if($_SESSION["foto"] != ""){
								echo '<img src="'.$_SESSION["foto"].'" class"user-image" height="30" width="30">';
							}else{
								echo '<img src="img/usuarios/default/anonimous.jpg" class="user-image">';
							}
						 ?>

						<span class="hidden-xs"><?php echo $_SESSION["nombre"] ?></span>
					</a>

					<!-- Dropdown-toggle -->
					<ul class="dropdown-menu">
						<li class="user-body">
							<div class="pull-right">
								<a href="salir" class="btn btn-default btn-flat">Salir</a>
							</div>
						</li>
					</ul>

				</li>
			</ul>


		</div>


		


	</nav>

</header>