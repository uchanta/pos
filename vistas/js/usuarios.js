/*=============================================
=            SUBIENDO FOTO DE USUARIO        =
=============================================*/

$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	// console.log("imagen", imagen);

	/*=============================================
    =       VALIDAR EL FORMATO DE LA IMAGEN          =
    =============================================*/
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    	$(".nuevaFoto").val("");
		Swal.fire({
			  // icon: 'error',
			  title: "Error al subir la imgen",
			  text: "¡La imagen debe estar en formato JPG o PNG!",
			  type: "error",
			  confirmButtonText: '¡Cerrar!'
			  // footer: '<a href>Why do I have this issue?</a>'
		});
    }else if(imagen["size"] > 2000000){
    	$(".nuevaFoto").val("");
		Swal.fire({
			  // icon: 'error',
			  title: 'Error al subir la imgen',
			  text: '¡La imagen debe pesar mas 2Mb!',
			  type: "error",
			  confirmButtonText: '¡Cerrar!'
			  });

    }else{
    	var datosImagen = new FileReader;
    	datosImagen.readAsDataURL(imagen);
    	$(datosImagen).on("load", function(event){
    		var rutaImagen = event.target.result;
    		$(".previsualizar").attr("src", rutaImagen);
    	})
    }
})

/*=============================================
=            EDITAR USUARIO              =
=============================================*/
// $(".btnEditarUsuario").click(function(){
$(document).on("click", ".btnEditarUsuario", function(){
	var idUsuario = $(this).attr("idUsuario");
		// console.log("idUsuario*****", idUsuario);

	var datos = new FormData();
	datos.append("idUsuario", idUsuario);
          // console.log("datos*****", datos[idUsuario]);
	$.ajax({

		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);

			$("#fotoActual").val(respuesta["foto"]);
			$("#passwordActual").val(respuesta["password"]);

			if(respuesta["foto"] != "")
				$(".previsualizar").attr("src", respuesta["foto"]);
		},
         error: function(jqxhr, status, exception) {
             console.log('jqxhr:', jqxhr);
             console.log('status:', status);
             console.log('Exception:', exception);
        }
	});
})
/*=============================================
=            Activar usuario                  =
=============================================*/
// $(".btnActivar").

$(document).on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datosm = new FormData();
	datosm.append("activarId", idUsuario);
	datosm.append("activarUsuario", estadoUsuario);

	$.ajax({

		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datosm,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

		}
	})

	if(estadoUsuario == 0){
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario',1);

	}else{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario',0);



	}

});