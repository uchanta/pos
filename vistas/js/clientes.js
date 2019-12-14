/*=============================================
=       EDITAR CLIENTES                      =
=============================================*/

// Funcion obsoleta
// $(".btnEliminarUsuario").click(function(){

$(document).on("click", ".btnEditarCliente", function(){

    var idCliente = $(this).attr("idCliente");
    console.log("idCliente*****", idCliente);
    
	var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            console.log("respuesta", respuesta);
            $("#idCliente").val(respuesta["id"]);
            $("#editarCliente").val(respuesta["nombre"]);
			$("#editarDocumentoId").val(respuesta["documento"]);
			$("#editarEmail").val(respuesta["email"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDireccion").val(respuesta["direccion"]);
			$("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
			
        }
    })
})

/*=============================================
=       ELIMINAR CLIENTES                      =
=============================================*/

$(document).on("click", ".btnEliminarCliente", function(){
	
	var idCliente = $(this).attr("idCliente");
	// var fotoUsuario = $(this).attr("fotoUsuario");
	var cliente = $(this).attr("cliente");

	Swal.fire({
		icon: "warning",
		title: "¿Estas seguro de borrar el cliente?",
		text: "¡Sino estas seguro cancela la accion, el cliente y su historia se perderan!",
		showCancelButton: true,
		confirmButtonText: "Si, borrar usuario!",
		cancelButtonText: "Cancelar",
		cancelButtonColor: "#d33",
		confirmButtonColor: "#3085d6"
			
	// }).then((result)=>{	por el error de internet explorer
	}).then(function(result){
			if(result.value){
				window.location = "index.php?ruta=clientes&idCliente="+idCliente;
			}
		})
})
