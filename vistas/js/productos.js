/* 
CARGA LA TABLA DINAMICAMENTE

*/

// $.ajax({

//     url: "ajax/datatable-productos.ajax.php",
//     success:function(respuesta){

//         console.log("respuesta", respuesta);

//     }

// })
$('.tablaProductos').DataTable({
    "ajax": "ajax/datatable-productos.ajax.php",
    "deferRender": true,
    "retrive": true,
    "processing": true,

    "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",        
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    }


})

/* 
CAPTURANDO  LA CATEGORIA PARA ASIGNAR EL CODIGO
*/ 

$("#nuevaCategoria").change(function(){
    
    var idCategoria = $(this).val();    

    var datos = new FormData();

    datos.append("idCategoria", idCategoria);

    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            if(!respuesta){
                var nuevoCodigo = idCategoria + "01";
                $("#nuevoCodigo").val(nuevoCodigo);
            }else{
                var nuevoCodigo = Number(respuesta["codigo"]) + 1;
                $("#nuevoCodigo").val(nuevoCodigo);
                // console.log("nuevoCodigo", nuevoCodigo);
                // console.log("respuesta", respuesta);
            }
        }
    })
})

/* 
AGREGANDO PRECIO DE VENTA
*/ 
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){
    if($(".porcentaje").prop("checked")){
        
        var valorPorcentaje = $(".nuevoPorcentaje").val();

        var porcentaje = Number($("#nuevoPrecioCompra").val() * valorPorcentaje / 100) + Number($("#nuevoPrecioCompra").val());

        var editarPorcentaje = Number($("#editarPrecioCompra").val() * valorPorcentaje / 100) + Number($("#editarPrecioCompra").val());

        // console.log("Porcentaje", porcentaje);
        $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop("readonly",true);

        $("#editarPrecioVenta").val(editarPorcentaje);
        $("#editarPrecioVenta").prop("readonly",true);
    }
})

/* 
CAMBIO DE PORCENTAJE
*/  
$(".nuevoPorcentaje").change(function(){

    if($(".porcentaje").prop("checked")){

        var valorPorcentaje = $(this).val();
        // var valorPorcentaje = $(this).val();

        var porcentaje = Number($("#nuevoPrecioCompra").val() * valorPorcentaje / 100) + Number($("#nuevoPrecioCompra").val());

        var editarPorcentaje = Number($("#editarPrecioCompra").val() * valorPorcentaje / 100) + Number($("#editarPrecioCompra").val());

        $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop("readonly",true);
        
        $("#editarPrecioVenta").val(editarPorcentaje);
        $("#editarPrecioVenta").prop("readonly",true);
    }
})

// http://icheck.fronteed.com/   callback
$(".porcentaje").on("ifUnchecked", function(){
    $("#nuevoPrecioVenta").prop("readonly",false);
    $("#editarPrecioVenta").prop("readonly",false);
})

$(".porcentaje").on("ifChecked", function(){
    $("#nuevoPrecioVenta").prop("readonly",true);
    $("#editarPrecioVenta").prop("readonly",true);
})

/*=============================================
=         SUBIENDO IMAGEN DE UN PRODUCTO      =
=============================================*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	// console.log("imagen", imagen);

	/*=============================================
    =       VALIDAR EL FORMATO DE LA IMAGEN          =
    =============================================*/
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    	$(".nuevaImagen").val("");
		Swal.fire({
			  // icon: 'error',
			  title: "Error al subir la imgen",
			  text: "¡La imagen debe estar en formato JPG o PNG!",
			  type: "error",
			  confirmButtonText: '¡Cerrar!'
			  // footer: '<a href>Why do I have this issue?</a>'
		});
    }else if(imagen["size"] > 2000000){
    	$(".nuevaImagen").val("");
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

/* EDITAR PRODUCTO */
// $(".btnEditarProducto").click(function(){  NO FUNCIONO
$(".tablaProductos tbody").on("click", "button.btnEditarProducto",function(){
    var idProducto = $(this).attr("idProducto");
    console.log("idProducto", idProducto);
    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
        //    console.log("respuesta", respuesta);

           var datosCategoria = new FormData();
           datosCategoria.append("idCategoria", respuesta["id_categoria"]);

            $.ajax({
                url:"ajax/categorias.ajax.php",
                method: "POST",
                data: datosCategoria,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){
                    console.log("respuesta", respuesta);
                    $("#editarCategoria").val(respuesta["id"]);
                    $("#editarCategoria").html(respuesta["categoria"]);
                }
           })
                $("#editarCodigo").val(respuesta["codigo"]);
                $("#editarDescripcion").val(respuesta["descripcion"]);
                $("#editarStock").val(respuesta["stock"]);
                $("#editarPrecioCompra").val(respuesta["precio_compra"]);
                $("#editarPrecioVenta").val(respuesta["precio_venta"]);
                if(respuesta["imagen"] != ""){
                    $("#imagenActual").val(respuesta["imagen"]);
                    $(".previsualizar").attr("scr", respuesta["imagen"]);

            }
            
            
        }
    })
})

/* BORRAR PRODUCTO */
// $(".btnEditarProducto").click(function(){  NO FUNCIONO

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto",function(){
    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    console.log("idProducto", idProducto)
	Swal.fire({
		icon: "warning",
		title: "¿Estas seguro de borrar el producto?",
		text: "¡Sino estas seguro cancela la accion, el producto y su historia se perderan!",
		showCancelButton: true,
		confirmButtonText: "Si, borrar producto!",
		cancelButtonText: "Cancelar",
		cancelButtonColor: "#d33",
		confirmButtonColor: "#3085d6"
			
	    // }).then(function(result){
        }).then((result) => {
		if(result.value){
			window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;
		}
	})
})