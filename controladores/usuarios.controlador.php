<?php

class ControladorUsuarios{

	// Ingreso de usuarios  La mayoria de servers requieren static de lo contrario en // la ejecución envia muchos errores inexplicables
	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
				
				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){
					// Video 30 sino tiene el estatus de activo no puede entrar al sistema
					if($respuesta["estado"] == 1){

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						echo '<script>
	                        window.location = "inicio";

						</script>';
					}else{
						echo '<br><div class="alert alert-danger">:**** El usuario aún no está activado</div>';
					}

				}else{

					echo '<br><div class="alert alert-danger">****Error al ingresar, vuelva a intentarlo</div>';
				}

			}

		}

	}
	/*========================================
	REGISTRO DE USUARIO
	=========================================*/
	static public function crtCrearUsuario(){
		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){
				
				/*=============================================
				=            VALIDAR IMAGEN                   =
				=============================================*/
				$ruta = "";
				
				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					= SE CREA EL DIRECTORIOQUE ALOJARA LA FOTO    =
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
					mkdir($directorio, 0755);

					// SE GUARDA LA nuevaFoto TIPO JPG
					// DE ACUERDO AL TIPO DE IMAGEN APLICAREMOS LA FUNCION POR DEFECTO
					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
						/*=============================================
						= GUARDAMOS LA IMAGEN EN EL DIRECTORIO        =
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen, 0, 0, 0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

					}
					// SE GUARDA LA nuevaFoto TIPO JPNG
					if($_FILES["nuevaFoto"]["type"] == "image/png"){
						/*=============================================
						= GUARDAMOS LA IMAGEN EN EL DIRECTORIO        =
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen, 0, 0, 0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);

					}
				}


				$tabla ="usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$usesomesillystringforsalt$');
				$datos = array("nombre" => $_POST["nuevoNombre"], 
								"usuario" => $_POST["nuevoUsuario"], 
								"password" => $encriptar,
								"perfil" => $_POST["nuevoPerfil"],
								"foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
				if($respuesta == "ok"){
					echo '<script>

							swal.fire({
								icon: "success",
								title: "¡El usuario ha sido grabado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then((result)=>{
									if(result.value){
										window.location = "usuarios";
									}
								});
					</script>';

				}

			}else{
				// sweetAlert https://sweetalert2.github.io/
				// https://cdn.jsdelivr.net/npm/sweetalert2@9.3.11/dist/sweetalert2.all.js 
				// https://sweetalert2.github.io/
									// type: "error",
				echo '<script>
						
						swal.fire({
						icon: "error",
						title: "¡El usuario no puede ir vacio o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

						}).then((result)=>{
							if(result.value){
								window.location = "usuarios";
							}
						});
				</script>';
			}
		}
	}
	/*=============================================
	=            MOSTRAR USUARIOS                 =
	=============================================*/
	// ctr en lugar de crt ?????
	static public function ctrMostrarUsuarios($item, $valor){
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}
	/*=============================================
	=            Editar usuario            =
	=============================================*/
	public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*=============================================
				=            VALIDAR IMAGEN                   =
				=============================================*/
				$ruta = $_POST["fotoActual"];

// && !empty($_FILES["editarFoto"]["tmp_name"] esta instrucción es para que no borre la imagen si esta no se cambia Ver inicio del video 28
				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					= SE CREA EL DIRECTORIOQUE ALOJARA LA FOTO    =
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];
					/*=============================================
					= primero preguntamos si existe otra imagen en la bd
					=============================================*/
					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);
					}else{

						mkdir($directorio, 0755);
					}

					// SE GUARDA LA nuevaFoto TIPO JPG
					// DE ACUERDO AL TIPO DE IMAGEN APLICAREMOS LA FUNCION POR DEFECTO
					if($_FILES["editarFoto"]["type"] == "image/jpeg"){
						/*=============================================
						= GUARDAMOS LA IMAGEN EN EL DIRECTORIO        =
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen, 0, 0, 0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

					}
					// SE GUARDA LA nuevaFoto TIPO JPNG
					if($_FILES["editarFoto"]["type"] == "image/png"){
						/*=============================================
						= GUARDAMOS LA IMAGEN EN EL DIRECTORIO        =
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen, 0, 0, 0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);

					}
				}
				$tabla ="usuarios";
				if($_POST["editarPassword"] != ""){
					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');

					}else{
							echo '<script>
										
										swal.fire({
										icon: "error",
										title: "¡La contraseña no puede ir vacia o llevar caracteres especiales!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false

										}).then((result)=>{
											if(result.value){
												window.location = "usuarios";
											}
										});
								</script>';

					}
				}else{
					$encriptar = $_POST["passwordActual"];
					// echo("<script>console.log('PHP111****** " .$_POST["passwordActual"]. "');</script>");

					// $encriptar = $passwordActual	;
				}

				$datos = array('nombre' => $_POST["editarNombre"], 
								'usuario' => $_POST["editarUsuario"], 
								'password' => $encriptar,
								'perfil' => $_POST["editarPerfil"],
								'foto' => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){
						echo '<script>

								swal.fire({
									icon: "success",
									title: "¡El usuario ha sido editado correctamente!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false

									}).then((result)=>{
										if(result.value){
											window.location = "usuarios";
										}
									});
						</script>';
				}else{
			
						echo '<script>
								
								swal.fire({
								icon: "error",
								title: "¡El nombre no puede ir vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then((result)=>{
									if(result.value){
										window.location = "usuarios";
									}
								});
						</script>';
				}
			}
		}
	}
}

?>