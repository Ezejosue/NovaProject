//Inicializando la función para mostrar la tabla de unidad de medida
$(document).ready(function()
{
    showMesas();
    showCategorias();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiOrdenes = '../core/api/ordenes.php?site=private&action=';


var idMesa;
var variable;
var mesa;
var subtotal = 0;

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
                    content+= `<a href="#" class="btn btn-primary" style="border-radius: 10px; margin: 2px;" onclick="showPrepedido(${row.id_mesa})">
                    <h4 style="color: white; font-size: 20px;">MESA ${row.numero_mesa}</h4>
                    <i class="fas fa-pizza-slice"></i>
                    </a>`;
                });
                $('#data-mesas').html(content);
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
                let content2 = '';
                result.dataset.forEach(function(row){
                    content2+= `<a class="list-group-item list-group-item-action" onclick="showProductos(${row.id_categoria})" href="#list-item-1">${row.nombre_categoria}</a>`;
                });
                $('#lista').html(content2);
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
                let content2 = '';
                result.dataset.forEach(function(row){
                    
                    variable = row.id_platillo;
                    content2+= `
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
                                <input type="number" style="width: 50px;" max="999" min="1" id="cantidad_producto${variable}" name="cantidad_producto${variable}">
                                <a href="#"class="btn btn-success" style="border-radius: 20px" onclick="addProducto(${row.id_platillo})"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>`;
                });
                $('#productos').html(content2);
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

function showPrepedido(id){
    idMesa = id;
    var total = 0;
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
                let content3 = '';
                let content4 = '';
                total = 0;
                let content5 = '';
                result.dataset.forEach(function(row){
                    mesa = row.id_mesa;
                    subtotal = parseFloat(row.cantidad * row.precio).toFixed(2);
                    total = parseFloat(subtotal) + parseFloat(total);
                    total = parseFloat(total).toFixed(2);
                    content3+= `
                    <tr>
                        <td><img src="../resources/img/platillos/${row.imagen}" style="width: 100px; height: 100px;"> </td>
                        <td>${row.nombre_platillo}</td>
                        <td>$ ${row.precio}</td>
                        <td>${row.cantidad}</td>
                        <td>${subtotal}</td>
                        <td><a href="#" onclick="deleteProducto('${row.id_prepedido}')" class="btn btn-danger" style="border-radius: 15px;"><i class="fas fa-times"></i></a>
                        <a href="#modal-modificar" class="btn btn-primary modal-trigger" data-toggle="modal"
                                style="border-radius: 15px;"><i class="fas fa-edit"></i>
                        </a>
                        </td>
                    </tr>`;

                    content4 = `<a href="#" class="btn btn-success" style="border-radius: 15px;"><i class="fas fa-check" onclick="updateCantidad('${row.id_prepedido}')"></i></a>`;
                    content5 = `<a href="#" onclick="confirmPago(${idMesa})" class="btn btn-primary btn-sm" target="_blank">CONTINUAR</a>`;

                });
                
                $('#prepedido').html(content3);
                $('#ingresar_cantidad').html(content4);
                $('#boton-pago').html(content5);
                $('#mesa').html(idMesa);
                $('#total').html(total);
                $('#modal-orden').modal('show');
                
               
            } else {
                total = 0;
                $('#mesa').html(idMesa);
                $('#total').html(total);
                $('#prepedido').html('');
                $('#modal-orden').modal('show');
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
                sweetAlert(1, 'Producto agregado correctamente', null);
            } else {
                sweetAlert(2, result.exception, null);
                console.log(response);
            }
        } else {
            sweetAlert(1, 'Producto agregado correctamente', 'mesas.php');
            $('#modal-orden').modal('hide');
            $('#prepedido').html('');
            $('#form-agregar')[0].reset();
            $('#modal-orden').modal('show');
            
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}


//Función para modificar un registro seleccionado previamente
function updateCantidad(id)
{ console.log($('#nueva_cantidad').val());
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
                            sweetAlert(1, 'Producto eliminado del pedido', null);
                            $('#prepedido').html('');
                            $('#total').html(total);


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
        console.log('HOLA');
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
                            sweetAlert(1, 'Pedido realizado', window.open('../core/report/ticket.php'));
                        } else if (result.status == 2) {
                            sweetAlert(3, 'Pedido realizado. ' + result.exception, null);
                        }
                    } else {
                        sweetAlert(2, result.exception, null);
                    }
                } else {
                    sweetAlert(1, 'Pedido realizado', window.open('../core/report/ticket.php'));
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