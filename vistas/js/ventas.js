/* 
CARGA LA TABLA DINAMICAMENTE

*/

// $.ajax({

//     url: "ajax/datatable-ventas.ajax.php",
//     success:function(respuesta){

//         console.log("respuesta", respuesta);

//     }

// })


//     }

// })
$('.tablaVentas').DataTable({
    "ajax": "ajax/datatable-ventas.ajax.php",
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


/* ================================================
AGREGAR PRODUCTO A LA VENTA DESDE TABLA
=================================================*/
// $(".btnEditarProducto").click(function(){  NO FUNCIONO
$(".tablaVentas tbody").on("click", "button.agregarProducto",function(){
    
    var idProducto = $(this).attr("idProducto");
    // console.log("idProducto", idProducto);

    //  borramos las clase Para activar y desaactivar el boton cuando ya se haya seleccionado
    $(this).removeClass("btn-primary agregarProducto");
    // Regresamos la clase de los botones
    $(this).removeClass("btn-default");


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
            // console.log("respuesta", respuesta);
            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];

            if(stock == 0){
                Swal.fire({
                    icon: "error",
                    title: "No hay stock disponible",
                    cancelButtonText: "Cancelar",
                   
                    });
                    
                    $("button[idProducto = '"+idProducto+"']").addClass("btn-primary agregarProducto");
                    return;

            }


            $(".nuevoProducto").append(
            
            '<div class="row" style="padding:5px 15px">'+

            '<!-- Descripcion del producto -->'+

            '<div class="col-xs-6" style="padding-right:0px">'+

              '<div class="input-group">'+

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                '<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" value="'+descripcion+'" readonly required>'+

              '</div>'+

            '</div>'+

            '<!-- Cantidad del producto -->'+

            '<div class="col-xs-3">'+

              '<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'+stock+'" required>'+ 

            '</div>'+

            '<!-- Precio del producto -->'+

            '<div class="col-xs-3" style="padding-left:0px">'+

              '<div class="input-group">'+
                
                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                '<input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+

            '</div>'+

            '</div>'+
           '</div>')

        }
    })
});

/* ================================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=================================================*/
$(".tablaVentas").on("draw.dt",function(){
    // console.log("boton");
    if (localStorage.getItem("quitarProducto") != null ){

        var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

        for(var i = 0; i < listaIdProductos.length; i++){

            $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
            $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
        }
    }
})

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");
/* ================================================
QUITAR PRODUCTO DE LA VENTA Y RECUPERACION DEL BOTON
=================================================*/
$(".formularioVenta").on("click", "button.quitarProducto",function(){
    // console.log("boton");

    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

    // Cuando se seleccionan artivulos de varia pantallas en la seleccion no se recupera por el salto de pagina
    
    /* ================================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL EQUIPO A QUITAR reactivar
    ===================================================*/
    if(localStorage.getItem("quitarProducto") == null){

        idQuitarProducto = [];

    }else{

        idQuitarProducto.concat(localStorage.getItem("quitarProducto"));

    }

    idQuitarProducto.push({"idProducto":idProducto});

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    
    // Activa los botonos los habilita
    $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default')
    $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto')
    
})
