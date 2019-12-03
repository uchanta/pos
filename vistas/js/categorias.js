
/*=============================================
=            EDITAR categoria              =
=============================================*/
$(".btnEditarCategoria").click(function(){
// $(".tables").on("click", ".btnEditarCategoria", function(){
    var idCategoria = $(this).attr("idCategoria");
        // console.log("idUsuario*****", idUsuario);
    var datos = new FormData();
    datos.append("idCategoria", idCategoria);
            // console.log("datos*****", datos[idUsuario]);
    $.ajax({

        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
            // console.log("respuesta", respuesta);
            $("#editarCategoria").val(respuesta["categoria"]);
            $("#idCategoria").val(respuesta["id"]);
        
        }
    })
})

/*=============================================
=            ELIMINAR CATEGORIA               =
=============================================*/
$(".btnEliminarCategoria").click(function(){

    var idCategoria = $(this).attr("idCategoria");

    Swal.fire({
        icon: "warning",
        title: "¿Estas seguro de borrar la categoria",
        text: "¡Sino lo estas puedes cancelar la accion!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar categoria",

    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
        }
        
    })
})

