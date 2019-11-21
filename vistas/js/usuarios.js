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
			  icon: 'error',
			  title: 'Error al subir la imgen',
			  text: '¡La imagen debe estar en formato JPG o PNG!',
			  confirmButtonText: '¡Cerrar!'
			  // footer: '<a href>Why do I have this issue?</a>'
		});
    }else if(imagen["size"] > 2000000){
    	$(".nuevaFoto").val("");
		Swal.fire({
			  icon: 'error',
			  title: 'Error al subir la imgen',
			  text: '¡La imagen debe pesar mas 2Mb!',
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
=            EDITAR USUARIO    
btnEditarUsuario              =
=============================================*/
$(".btnEditarUsuario").click(function(){
	var idUsuario = $(this).attr("idUsuario");
	// console.log("idUsuario",idUsuario);
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType:false,
		processData: false,
		dataType:"json",
		success: function(respuesta){
			console.log("respuesta", respuesta);
		}
	});
})
