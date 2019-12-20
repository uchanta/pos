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
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
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
$(".tablaVentas tbody").on("click", "button.agregarProducto", function () {

    var idProducto = $(this).attr("idProducto");
    // console.log("idProducto", idProducto);

    //  borramos las clase Para activar y desaactivar el boton cuando ya se haya seleccionado
    $(this).removeClass("btn-primary agregarProducto");
    // Regresamos la clase de los botones
    $(this).removeClass("btn-default");


    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log("respuesta", respuesta);
            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];
            /*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/
            if (stock == 0) {
                Swal.fire({
                    icon: "error",
                    title: "No hay stock disponible",
                    confirmButtonText: "Cancelar",

                });

                $("button[idProducto = '" + idProducto + "']").addClass("btn-primary agregarProducto");
                return;

            }


            $(".nuevoProducto").append(

                '<div class="row" style="padding:5px 15px">' +

                '<!-- Descripcion del producto -->' +

                '<div class="col-xs-6" style="padding-right:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' + idProducto + '"><i class="fa fa-times"></i></button></span>' +

                '<input type="text" class="form-control agregarProducto nuevaDescripcionProducto" idProducto="' + idProducto + '" name="agregarProducto" value="' + descripcion + '" readonly required>' +

                '</div>' +

                '</div>' +

                '<!-- Cantidad del producto -->' +

                '<div class="col-xs-3">' +

                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required>' +

                '</div>' +

                '<!-- Precio del producto -->' +

                '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                '<input type="text" min="1" class="form-control nuevoPrecioProducto" precioReal="' + precio + '" name="nuevoPrecioProducto" value="' + precio + '" readonly required>' +

                '</div>' +

                '</div>' +
                '</div>')

            //    SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()
            // AGREGAR IMPUESTO
            agregarImpuesto()
            // AGREGAR PRODUCTOS EN FORMATO JSON
            listarProductos()

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS https://plugins.jquery.com/df-number-format/
            //  "vistas/plugins/jqueryNumber/jquerynumber.min.js"
            $(".nuevoPrecioProducto").number(true, 2);

        }
    })
});

/* ================================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=================================================*/
$(".tablaVentas").on("draw.dt", function () {
    // console.log("boton");
    if (localStorage.getItem("quitarProducto") != null) {

        var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

        for (var i = 0; i < listaIdProductos.length; i++) {

            $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").removeClass('btn-default');
            $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").addClass('btn-primary agregarProducto');
        }
    }
})

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");
/* ================================================
QUITAR PRODUCTO DE LA VENTA Y RECUPERACION DEL BOTON
=================================================*/
$(".formularioVenta").on("click", "button.quitarProducto", function () {
    // console.log("boton");
    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");
    // Cuando se seleccionan artivulos de varia pantallas en la seleccion no se recupera por el salto de pagina
    /* ================================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL EQUIPO A QUITAR reactivar
    ===================================================*/
    if (localStorage.getItem("quitarProducto") == null) {
        idQuitarProducto = [];
    } else {
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
    }

    idQuitarProducto.push({ "idProducto": idProducto });

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
    // Activa los botonos los habilita
    $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default')
    $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');

    if ($(".nuevoProducto").children().length == 0) {

        $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").val(0);
        $("totalVenta").val(0);  // totalVenta nuevo ???
        $("#nuevoTotalVenta").attr("totalVenta", 0);

    } else {

        // SUMAR TOTAL PRECIOS
        sumarTotalPrecios()

        // AGREGAR IMPUESTO
        agregarImpuesto()

        // AGREGAR PRODUCTOS EN FORMATO JSON
        listarProductos()


    }

})

/* ================================================
AGREGANDO PRODUCTOS DESDE EL BOTON PARA DISPOSITIVOS
===================================================*/
// $(".btnAgregarProducto").click(function(){
// Funcion obsoleta btnAgregarProducto

// solucion a error (err002): CUANDO SELECCIONAS VAIOS PRODUCTOS EN EL COMBO, DESPUES DEL TERCERO SI RESELECCIONAS EL PRIMERO TE DUPLICA LA CANTIDAD DE REGISTROS QUE VES EN EL MATCH CODE

var numProducto = 0;

$(document).on("click", ".btnAgregarProducto", function () {

    numProducto++;  // (err002)

    var datos = new FormData();

    datos.append("traerProductos", "ok");

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(" respuestarespuestarespuesta ", respuesta);

            $(".nuevoProducto").append(

                '<div class="row" style="padding:5px 15px">' +

                '<!-- Descripcion del producto DISPOSITIVO-->' +

                '<div class="col-xs-6" style="padding-right:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>' +

                '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>' +

                '<option>Selecciona el producto</option>' +

                '</select>' +

                '</div>' +

                '</div>' +

                '<!-- Cantidad del producto DISPOSITIVO-->' +

                '<div class="col-xs-3 ingresoCantidad">' +

                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>' +

                '</div>' +

                '<!-- Precio del producto DISPOSITIVO-->' +

                '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                '<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" value readonly required>' +

                '</div>' +

                '</div>' +
                '</div>'
            )

            //    AGREGAR PRODUCTOS AL SELECT min. 5:19 video 66
            respuesta.forEach(funcionForEach);

            function funcionForEach(item, index) {
                // En caso de que el stock sea cero
                if (item.stock != 0) {

                    $("#producto"+numProducto).append(
                        // $("#producto"+numProducto).append(
                        '<option idProducto="'+item.id+'" value="' + item.descripcion + '">' + item.descripcion + '</option>'

                    )

                }

            }
            // SUMAR TOTAL PRECIOS
            sumarTotalPrecios()

            // AGREGAR IMPUESTO
            agregarImpuesto()

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS https://plugins.jquery.com/df-number-format/
            //  "vistas/plugins/jqueryNumber/jquerynumber.min.js" requirement <input type="text" 
            $(".nuevoPrecioProducto").number(true, 2);
            //  $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
            // $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

            // // AGRUPAR PRODUCTOS EN FORMATO JSON
            // listarProductos()


        }
    })
})

/* ================================================
SELECCIONA EL PRODUCTO
===================================================*/
$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function () {
    // console.log("boton");
    var nombreProducto = $(this).val();
    // console.log("nombreProductosssssssssssssssssss", nombreProducto);
    var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    // console.log("nuevoPrecioProducto sssssssssssssss", nuevoPrecioProducto);
    var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
    // console.log("nuevaCantidadProductosssssssssssssssssss", $(this).parent().parent().parent().children(".ingresoCantidad").children().children(".nuevaCantidadProducto"));
    var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log("respuesta----+++++++---------", respuesta);
            // Aqui recuperas el id y no funciono vamos a trabajar con la clase
            // $(".nuevaCantidadProducto").attr("stock", respuesta["stock"]);

            $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
            $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
            $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
            $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

            // respuesta["resp++++++++++uesta", respuesta]
            // console.log("stck+++++++++++boton", respuesta["stock"]);
            // AGRUPAR PRODUCTOS EN FORMATO JSON
            listarProductos()


        }
    })
})

/* ================================================
MODIFICAR LA CANTIDAD
===================================================*/
$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function () {
  
    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    
    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal);

    // AHORA AFECTAMOS AL STOCK
    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

  // console.log("boton"); // console.log("precio ", precio.val()); // console.log("Number($(this).attr('stock'))   ", Number($(this).attr("stock"))); console.log("nuevoStock ", nuevoStock);    console.log("$(this).val(   ", $(this).val());  console.log("($(this)   ", $(this).attr("stock"));

    if (Number($(this).val()) > Number($(this).attr("stock"))) {
        // SI LA CANTIDA ES MAYOR QUE EL STOCK EXISTENTE REGRESA AL VALOR INICIAL
        $(this).val(1);

        var precioFinal = $(this).val() * precio.attr("precioReal");

        precio.val(precioFinal);
        // // SI TENEMOS MUCHOS PRODUCTOS
        // sumarTotalPrecios()
        // NO SE LA AGREGO CREO QUE SE OMITIO
        // // AGREGAR IMPUESTO
        // agregarImpuesto()

        Swal.fire({
            icon: "error",
            title: "La cantidad supera el stock!!!",
            text: "La existencia actual es:" + $(this).attr("stock") + " unidades",
            confirmButtonText: "¡Cerrar!",

        });

    }
    // SUMAR TOTAL PRECIOS
    sumarTotalPrecios()

    // AGREGAR IMPUESTO
    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos()


})

/* ================================================
SUMAR TODOS LOS PRECIOS
===================================================*/
function sumarTotalPrecios() {

    var precioItem = $(".nuevoPrecioProducto");
    var arraySumaPrecio = [];

    for (var i = 0; i < precioItem.length; i++) {

        arraySumaPrecio.push(Number($(precioItem[i]).val()));

    }

    function sumaArrayPrecios(totalVenta, numero) {
        return totalVenta + numero;
    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
    // CARGANDO EL VALOR DE LA SUMA AL CAMPO DEL TOTAL
    $("#nuevoTotalVenta").val(sumaTotalPrecio);
    $("#total").val(sumaTotalPrecio);
 
    $("#nuevoTotalVenta").attr("totalVenta",sumaTotalPrecio);

    // console.log("sumaTotalPrecio ********** ", sumaTotalPrecio);
    // console.log("nuevoTotalVenta ********** ", nuevoTotalVenta);    // console.log("precioItem ********** ", precioItem);   console.log("arraySumaPrecio ********** ", arraySumaPrecio);
}

/* ================================================
FUNCION AGREGA IMPUESTO
===================================================*/

function agregarImpuesto() {


    var impuesto = $("#nuevoImpuestoVenta").val();

    var precioTotal = $("#nuevoTotalVenta").attr("totalVenta");
    
    var precioImpuesto = Number(precioTotal * impuesto / 100);

    var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
    
    $("#nuevoTotalVenta").val(totalConImpuesto);

    $("#totalVenta").val(totalConImpuesto); // totalVenta nuevo

    $("#nuevoPrecioImpuesto").val(precioImpuesto);

    $("#nuevoPrecioNeto").val(precioTotal);

        // console.log("impuesto  ", impuesto); // console.log("precioTotal  ", precioTotal); // console.log("totalConImpuesto  ", totalConImpuesto);

}

/* ================================================
CUANDO EL IMPUESTO CAMBIA
===================================================*/

$("#nuevoImpuestoVenta").change(function () {

    agregarImpuesto();

})


/* ================================================
FORMATO AL PRECIO FINAL
===================================================*/

// PONER FORMATO AL PRECIO DE LOS PRODUCTOS https://plugins.jquery.com/df-number-format/
//  "vistas/plugins/jqueryNumber/jquerynumber.min.js" requirement <input type="text" 
$("#nuevoTotalVenta").number(true, 2);

/* ================================================
SELECCIONAR METODO DE PAGO
===================================================*/
$("#nuevoMetodoPago").change(function () {

    var metodo = $(this).val();

    if (metodo == "Efectivo") {

        $(this).parent().parent().removeClass("col-xs-6");

        $(this).parent().parent().addClass("col-xs-4");

        $(this).parent().parent().parent().children(".cajasMetodoPago").html(

            '<div class="col-xs-4">' +
                '<div class="input-group">' +

                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                    '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>' +

                '</div>' +
            '</div>' +

            '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">' +
                '<div class="input-group">' +
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                    '<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>' +
                '</div>' +
            '</div>'

        )

        // Agregar formato al precio

        $('#nuevoValorEfectivo').number(true, 2);
        $('#nuevoCambioEfectivo').number(true, 2);

        // Listar metodo en la entrada
        listarMetodos()

    } else {
        $(this).parent().parent().removeClass("col-xs-4");

        $(this).parent().parent().addClass("col-xs-6");

        $(this).parent().parent().parent().children(".cajasMetodoPago").html(

            '<div class="col-xs-6" style="padding-left:0px">' +
                '<div class="input-group">' +
                    '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Codigo Transacción" required>' +

                    '<span class="input-group-addon"><i class="fa fa-lock"></i></span>' +
                '</div>' +
            '</div>') 
    }

})

/* ================================================
CAMBIO EN EFECTIVO
===================================================*/

$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function () {
    // console.log("boton");

    var efectivo = $(this).val();

    var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val())

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children("#capturarCambioEfectivo").children().children('#nuevoCambioEfectivo');

    nuevoCambioEfectivo.val(cambio);

})

/* ================================================
CAMBIO TRANSACCIÓN
===================================================*/

$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function () {

    // Listar metodos en la entrada
    listarMetodos()

})

/* ================================================
LISTAR TODOS LOS PRODUCTOS
===================================================*/

function listarProductos() {

    var listaProductos = [];

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaCantidadProducto");

    var precio = $(".nuevoPrecioProducto");

    for (var i = 0; i < descripcion.length; i++) {

        listaProductos.push({
            "id": $(descripcion[i]).attr("idProducto"),
            "descripcion": $(descripcion[i]).val(),
            "cantidad": $(cantidad[i]).val(),
            "stock": $(cantidad[i]).attr("nuevoStock"),
            "precio": $(precio[i]).attr("precioReal"),
            "total": $(precio[i]).val()
        })
        // console.log("listaProductos  ", JSON.stringify(listaProductos));
        $("#listaProductos").val(JSON.stringify(listaProductos));
    }
}

/* ================================================
LISTA METODO DE PAGO
===================================================*/

function listarMetodos(){

    var listaMetodos = "";

    if($("#nuevoMetodoPago").val() == "Efectivo"){

        $("#listaMetodoPago").val("Efectivo");

    }else{

        $("#listaMetodoPago").val($("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val());
    }
}

