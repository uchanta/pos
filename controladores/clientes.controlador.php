<?php

class ControladorClientes{

	/* 
	CREAR CLIENTES
	*/

	static public function ctrCrearCliente(){
		// echo("<script>console.log('PHP1111: ". $_POST["editarCliente"]." -- ".$_POST["editarDocumentoId"]." -- ".$_POST["editarEmail"]." -- ". $_POST["editarTelefono"]." -- ".$_POST["editarTelefono"]." ---".$_POST["nuevaDireccion"]."');</script>");

		if(isset($_POST["nuevoCliente"])){
					
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) && 
			    preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
				preg_match('/^[#\.\-a-zA-Z0-9,:; ]+$/', $_POST["nuevaDireccion"])){
					
				$tabla = "clientes";

				$datos = array("nombre" => $_POST["nuevoCliente"], 
							"documento" => $_POST["nuevoDocumentoId"], 
							"email" => $_POST["nuevoEmail"],
							"telefono" => $_POST["nuevoTelefono"],
							"direccion" => $_POST["nuevaDireccion"],
							"fecha_nacimiento" => $_POST["nuevaFechaNacimiento"]);

				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

				if($respuesta == "ok"){
					echo '<script>

							swal.fire({
								icon: "success",
								title: "¡El cliente ha sido grabado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then((result)=>{
									if(result.value){
										window.location = "clientes";
									}
								})
					</script>';

				}

			}else{
				echo '<script>
				swal.fire({
					icon: "error",
					title: "¡El cliente no puede ir vacio o llevar caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

					}).then((result)=>{
						if(result.value){
							window.location = "clientes";
						}
					})
				</script>';

			}
		}

	}

	/* 
	MOSTRAR CLIENTES
	*/

	static public function ctrMostrarClientes($item, $valor){
		
		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

			return $respuesta;
		
	}

	/* 
	EDITAR CLIENTES
	*/

	static public function ctrEditarCliente(){
		// echo("<script>console.log('PHP1111: ". $_POST["nuevoCliente"]." -- ".$_POST["nuevoDocumentoId"]." -- ".$_POST["nuevoEmail"]." -- ". $_POST["nuevoTelefono"]." -- ".$_POST["nuevoTelefono"]." ---".$_POST["editarDireccion"]."');</script>");

		if(isset($_POST["editarCliente"])){
			// echo("<script>console.log('PHP111: ".$_POST["editarDocumentoId"]. "');</script>");
		
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) && 
			    preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
				preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
				preg_match('/^[#\.\-a-zA-Z0-9,:; ]+$/', $_POST["editarDireccion"])){
				// echo("<script>console.log('PHP222: ".$_POST["editarDocumentoId"]. "');</script>");

				$tabla = "clientes";

				$datos = array("id" => $_POST["idCliente"],
							"nombre" => $_POST["editarCliente"], 
							"documento" => $_POST["editarDocumentoId"], 
							"email" => $_POST["editarEmail"],
							"telefono" => $_POST["editarTelefono"],
							"direccion" => $_POST["editarDireccion"],
							"fecha_nacimiento" => $_POST["editarFechaNacimiento"]);
							// echo("<script>console.log('PHP333: ".$_POST["editarDocumentoId"]. "');</script>");

				$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

				if($respuesta == "ok"){
					echo '<script>

							swal.fire({
								icon: "success",
								title: "¡El cliente ha sido cambiado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then((result)=>{
									if(result.value){
										window.location = "clientes";
									}
								})
					</script>';

				}

			}else{
				echo '<script>
				swal.fire({
					icon: "error",
					title: "¡El cliente no puede ir vacio o llevar caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

					}).then((result)=>{
						if(result.value){
							window.location = "clientes";
						}
					})
				</script>';

			}
		}

	}

	/*=============================================
	=            BORRAR CLIENTE                   =
	=============================================*/

	static public function ctrEliminarCliente(){
		if(isset($_GET["idCliente"])){
			$tabla = "clientes";
			$datos = $_GET["idCliente"];

			$respuesta =  ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

						swal.fire({
							icon: "success",
							title: "El Cliente ha sido borrado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then((result)=>{
								if(result.value){
									window.location = "clientes";
								}
							})
				</script>';

			}
		}

	}


}

