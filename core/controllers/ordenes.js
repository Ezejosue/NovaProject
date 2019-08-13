//Inicializando la función para mostrar la tabla de unidad de medida
$(document).ready(function()
{
    showMesas();
    showCategorias();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiOrdenes = '../core/api/ordenes.php?site=private&action=';
var idMesa;
var numero_platillo;
var subtotal = 0;
var total = 0;
 //variable que define el cuerpo de la tabla
 let cuerpo_tabla;

//Función que muestra las mesas con estado activo en ordenes.php
function showMesas(){
    $.ajax({
        url: apiOrdenes + 'readMesas',
        type: 'post',
        data: null,
        datatype: 'json' 
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                let content = '';
                result.dataset.forEach(function(row){
                    //Se crea un botón por cada mesa existente en la base y a través del boton se manda el id_mesa para mostrar el pre pedido correspondiente a cada mesa
                    content+= `<a href="#" class="btn btn-primary" style="border-radius: 10px; margin: 2px;" onclick="showPrepedido(${row.id_mesa})">
                    <h4 style="color: white; font-size: 20px;">MESA ${row.numero_mesa}</h4>
                    <i class="fas fa-pizza-slice"></i>
                    </a>`;
                });
                //Luego de terminar el ciclo, see colocan todos los botones generados en la pantalla
                $('#data-mesas').html(content);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función que muestra las mesas activas en el modal de modificar la mesa del pre pedido
function showModificarMesas(id){
    $.ajax({
        url: apiOrdenes + 'readMesas',
        type: 'post',
        data: {
            idMesa: id
        },
        datatype: 'json' 
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                /* if (result.dataset.id_mesa = idMesa){
                }
                    console.log('BIEEEN');
                } else {
                    console.log('Terrible');
                } */
                let content = '';
                result.dataset.forEach(function(row){
                    //Se crea un botón por cada mesa existente en la base y a través del boton se manda el id_mesa para mostrar el pre pedido correspondiente a cada mesa
                    content+= `<a href="#" class="btn btn-primary" style="border-radius: 10px; margin: 2px;" onclick="updateNumeroMesa(${row.id_mesa}, ${id})">
                    <h4 style="color: white; font-size: 20px;">MESA ${row.numero_mesa}</h4>
                    <i class="fas fa-pizza-slice"></i>
                    </a>`;
                });
                $('#data-modificar-mesas').html(content);
            } else {

            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función que muestra las categorias de los productos
function showCategorias(){
    $.ajax({
        url: apiOrdenes + 'readCategorias',
        type: 'post',
        data: null,
        datatype: 'json' 
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                let lista = '';
                result.dataset.forEach(function(row){
                    //Se crea una sección en la lista por cada categoria existente en la base
                    lista+= `<a class="list-group-item list-group-item-action" onclick="showProductos(${row.id_categoria})" href="#list-item-1">${row.nombre_categoria}</a>`;
                });
                $('#lista-categorias').html(lista);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función que muestra los productos correspondientes a su categoría
function showProductos(id){
    $.ajax({
        url: apiOrdenes + 'readProductos',
        type: 'post',
        data: {
            idCategoria: id
        },
        datatype: 'json' 
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                let tarjeta_producto = '';
                result.dataset.forEach(function(row){
                    //se le asigna a la variable numero_platillo el id_platillo por cada producto existente en la base
                    numero_platillo = row.id_platillo;
                    //se crea una tarjeta y un input para la cantidad con id unico para cada producto
                    tarjeta_producto+= `
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="card text-center">
                            <div class="card-header">
                                ${row.nombre_platillo}
                            </div>
                            <div class="card-body">
                                <img src="../resources/img/platillos/${row.imagen}" class="card-img-top">
                                <br>
                                <br>
                                <h5 class="card-text">$ ${row.precio}</h5>
                            </div>
                            <div class="card-footer">
                                <input type="number" style="width: 50px;" max="999" min="1" id="cantidad_producto${numero_platillo}" name="cantidad_producto${numero_platillo}">
                                <a href="#"class="btn btn-success" style="border-radius: 20px" onclick="addProducto(${row.id_platillo})"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>`;
                });
                $('#productos').html(tarjeta_producto);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función que muestra el pre pedido de la mesa seleccionada
function showPrepedido(id){
    idMesa = id;
    $.ajax({
        url: apiOrdenes + 'readPrepedido',
        type: 'post',
        data: {
            idMesa: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                cuerpo_tabla = '';
                //variable que crea un boton de modificar la cantidad por cada producto agregado al pre pedido
                let boton_modificar_cantidad = '';
                //variable que crea el boton de generar la factura y solo se muestra cuando hay productos agregados al pre pedido
                let boton_pago = '';
                //variable que crea el boton para cambiar de mesa el pre pedido actual
                let boton_modificar_mesa = '';
                total = 0;
                result.dataset.forEach(function(row){
                    //En este ciclo se obtiene el subtotal por cada producto que se obtiene en la consulta y tambien el total
                    subtotal = parseFloat(row.cantidad * row.precio).toFixed(2);
                    total = parseFloat(subtotal) + parseFloat(total);
                    total = parseFloat(total).toFixed(2);
                    cuerpo_tabla += `
                    <tr>
                        <td><img src="../resources/img/platillos/${row.imagen}" style="width: 100px; height: 100px;"> </td>
                        <td>${row.nombre_platillo}</td>
                        <td>$ ${row.precio}</td>
                        <td>${row.cantidad}</td>
                        <td>${subtotal}</td>
                        <td><a href="#" onclick="deleteProducto('${row.id_prepedido}')" class="btn btn-danger" style="border-radius: 15px;" data-toggle="tooltip" data-placement="right" title="Eliminar producto"><i class="fas fa-times"></i></a>
                        <a href="#modal-modificar" class="btn btn-primary modal-trigger" data-toggle="modal" style="border-radius: 15px;" data-tooltip="tooltip" data-placement="right" title="Editar cantidad"><i class="fas fa-edit"></i>
                        </a>
                        </td>
                    </tr>`;

                    boton_modificar_cantidad = `<a href="#" class="btn btn-success" style="border-radius: 15px;"><i class="fas fa-check" onclick="updateCantidad('${row.id_prepedido}')"></i></a>`;
                    boton_pago = `<button onclick="confirmPago(${idMesa})" class="btn btn-primary btn-sm">CONTINUAR</button>`;
                    boton_modificar_mesa = `<a href="#modal-modificar-mesa" class="btn btn-info modal-trigger" data-toggle="modal"
                    style="border-radius: 20px; margin: 15px;" data-tooltip="tooltip" data-placement="right"
                    title="Mover productos a otra mesa" onclick="showModificarMesas(${idMesa})"><i class="fas fa-utensils"></i></a>`;
                });
                $('#prepedido').html(cuerpo_tabla);
                $('#ingresar_cantidad').html(boton_modificar_cantidad);
                $('#boton-pago').html(boton_pago);
                $('#boton-modificar-mesa').html(boton_modificar_mesa);
                $('#mesa').html(idMesa);
                $('#total').html(total);
                $('#modal-orden').modal('show');
            } else {
                total = 0;
                $('#mesa').html(idMesa);
                $('#total').html(total);
                $('#prepedido').html('');
                $('#boton-modificar-mesa').html('');
                $('#boton-pago').html('');
                $('#modal-orden').modal('show');
                console.log('Vacio');
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function addProducto(id){
    $.ajax({
        url: apiOrdenes + 'createPrepedido',
        type: 'post',
        data: {
            platillo: id,
            cantidad: $('#cantidad_producto'+id).val(),
            idMesa: idMesa
        } ,
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                showPrepedido(idMesa);
                sweetAlert(1, 'Producto agregado correctamente', null);
            } else {
                sweetAlert(2, result.exception, null);
                console.log(response);
            }
        } else {
            console.log(response);
            
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}


//Función para modificar un registro seleccionado previamente
function updateCantidad(id)
{
    $.ajax({
        
        url: apiOrdenes + 'updateCantidad',
        type: 'post',
        data: {
            id_prepedido: id,
            cantidad: $('#nueva_cantidad').val()
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#modal-modificar').modal('hide');
                if (result.status == 1) {
                    showPrepedido(idMesa);
                    sweetAlert(1, 'Cantidad modificada correctamente', null);
                } else if(result.status == 2) {
                    sweetAlert(3, 'Cantidad modificada. ' + result.exception, null);
                } else if(result.status == 3) {
                    sweetAlert(1, 'Cantidad modificada. ' + result.exception, null);
                }

            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function updateNumeroMesa(id, id2){
    idMesaNueva = id;
    $.ajax({
        url: apiOrdenes + 'updateNumeroMesa',
        type: 'post',
        data: {
            idMesaNueva: id,
            idMesa: id2
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                sweetAlert(1, 'Mesa modificada correctamente', 'ordenes.php');
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función para eliminar un registro seleccionado
function deleteProducto(id)
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar el producto?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiOrdenes + 'deleteProducto',
                type: 'post',
                data:{
                    id_prepedido: id
                },
                datatype: 'json'
            })
            .done(function(response){
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        if (result.status == 1) {
                            showPrepedido(idMesa);
                            $('#total').html(total);
                            sweetAlert(1, 'Producto eliminado del pedido', null);
                        } else if (result.status == 2) {
                            sweetAlert(3, 'Producto eliminado. ' + result.exception, null);
                        }
                    } else {
                        sweetAlert(2, result.exception, null);
                    }
                } else {
                    console.log(response);
                }
            })
            .fail(function(jqXHR){
                //Se muestran en consola los posibles errores de la solicitud AJAX
                console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
            });
        }
    });
}

function confirmPago(id)
{
    event.preventDefault();
    swal({
        title: 'Advertencia',
        text: '¿Quiere realizar el pedido?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiOrdenes + 'createPedido',
                type: 'post',
                datatype: 'json',
                data: {
                    idMesa: id
                } 
            })
            .done(function(response){
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        if (result.status == 1) {
                            sweetAlert(1, 'Pedido realizado', ('../core/report/ticket.php'));
                        } else if (result.status == 2) {
                            sweetAlert(3, 'Pedido realizado. ' + result.exception, null);
                        }
                    } else {
                        sweetAlert(2, result.exception, null);
                    }
                } else {
                    sweetAlert(1, 'Pedido realizado', ('../core/report/ticket.php'));
                }
            })
            .fail(function(jqXHR){
                //Se muestran en consola los posibles errores de la solicitud AJAX
                console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
            });
        }
    });
}