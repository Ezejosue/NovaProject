//Inicializando la función para mostrar la tabla de unidad de mesas
$(document).ready(function()
{
    showTableInventario();
    showSelectFacturas('create_factura', null);
    showSelectMaterias('create_materia', null);
    showTableDetalleFactura();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiInventarios = '../core/api/inventarios.php?site=private&action=';

// Función para llenar tabla con los datos de los registros
function fillTableInventario(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
            <tr>
                <td>${row.correlativo}</td>
                <td>${row.Materia}</td>
                <td>${row.cantidad}</td>
                <td>${row.nom_proveedor}</td>
                <td>${row.fecha_ingreso}</td>
                <td>${row.alias}</td>
                <td>
                    <a href="#" onclick="modalDetalle(${row.id_pedido})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-inventarios');
}

//Función para obtener y mostrar los registros disponibles
function showTableInventario()
{
    $.ajax({
        url: apiInventarios+ 'readInventario',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (!result.status) {
                sweetAlert(4, result.exception, null);
            }
            fillTableInventario(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función para crear una nueva factura
$('#form-create-factura').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiInventarios + 'createFactura',
        type: 'post',
        data: new FormData($('#form-create-factura')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#form-create-factura')[0].reset();
                $('#modal-create-factura').modal('hide');
                sweetAlert(1, 'Factura creada correctamente', null);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            //Se comprueba que el alias no sea repetido
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})


//Función para cargar los nombres de proveedores en el select del formulario para agregar facturas
function showSelectFacturas(idSelect, value)
{
    $.ajax({
        url: apiInventarios + 'readSelectFacturas',
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
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una opción</option>';
                }
                result.dataset.forEach(function(row){
                    if (row.id_factura != value) {
                        content += `<option value="${row.id_factura}">${row.correlativo}</option>`;
                    } else {
                        content += `<option value="${row.id_factura}" selected>${row.correlativo}</option>`;
                    }
                });
                $('#' + idSelect).html(content);
            } else {
                $('#' + idSelect).html('<option value="">No hay facturas en proceso</option>');
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

function showSelectMaterias(idSelect, value)
{
    $.ajax({
        url: apiInventarios + 'readMateriaPrima',
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
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una opción</option>';
                }
                result.dataset.forEach(function(row){
                    if (row.idMateria != value) {
                        content += `<option value="${row.idMateria}">${row.Materia}</option>`;
                    } else {
                        content += `<option value="${row.idMateria}" selected>${row.Materia}</option>`;
                    }
                });
                $('#' + idSelect).html(content);
            } else {
                $('#' + idSelect).html('<option value="">No hay opciones</option>');
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

//Función para crear una nueva factura
$('#form-create').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiInventarios + 'ingresarFactura',
        type: 'post',
        data: new FormData($('#form-create')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#form-create')[0].reset();
                $('#modal-create').modal('hide');
                sweetAlert(1, 'Factura ingresada correctamente', null);
                destroy('#tabla-inventarios');
                showTableInventario();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            //Se comprueba que el alias no sea repetido
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

function fillTableDetalleFactura(rows)
{
    let content = '';
    let total = 0;
    let content2 = '';
    let content3 = '';

    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){

        subtotal = parseFloat(row.cantidad * row.precio).toFixed(2);
        total = parseFloat(subtotal) + parseFloat(total);
        total = parseFloat(total).toFixed(2);
        content += `
            <tr>
                <td>${row.nombre_platillo}</td>
                <td>${row.cantidad}</td>
                <td>$${row.precio}</td>
                <td>$${subtotal}</td>
            </tr>
        `;
        
        $("#id-pedido").text(row.id_pedido);
    });
    content2 += `<h6>TOTAL A PAGAR: $${total}</h6>`;
    content3 += `<h6>USUARIO: $${rows.nombre_usuario}</h6>`;
    $("#total").html(content2);
    $("#usuario").html(content3);
    $('#tbody-read-detalle').html(content);
}

function showTableDetalleFactura(id)
{
    $.ajax({
        url: apiInventarios + 'readDetalle',
        type: 'post',
        data: {
            id_pedido: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (!result.status) {
                sweetAlert(4, result.exception, null);
            }
            fillTableDetalleFactura(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function modalDetalle(id)
{
    $.ajax({
        url: apiInventarios + 'getDetalle',
        type: 'post',
        data:{
            id_pedido: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-detalle')[0].reset();
                $('#id_pedido').val(id);
                console.log(result.dataset);
                showTableDetalle(id);
                $('#modal-detalle').modal('show');
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

function fillTableDetalle(rows)
{
    let content = '';
    let total = 0;
    let content2 = '';
    let content3 = '';

    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){

        subtotal = parseFloat(row.cantidad * row.precio).toFixed(2);
        total = parseFloat(subtotal) + parseFloat(total);
        total = parseFloat(total).toFixed(2);
        content += `
            <tr>
                <td>${row.nombre_platillo}</td>
                <td>${row.cantidad}</td>
                <td>$${row.precio}</td>
                <td>$${subtotal}</td>
            </tr>
        `;
        
        $("#id-pedido").text(row.id_pedido);
    });
    content2 += `<h6>TOTAL A PAGAR: $${total}</h6>`;
    content3 += `<h6>USUARIO: $${rows.nombre_usuario}</h6>`;
    $("#total").html(content2);
    $("#usuario").html(content3);
    $('#tbody-read-detalle').html(content);
}

function showTableDetalle(id)
{
    $.ajax({
        url: apiInventarios + 'readDetalle',
        type: 'post',
        data: {
            id_pedido: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (!result.status) {
                sweetAlert(4, result.exception, null);
            }
            fillTableDetalle(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function error2(response)
{
    switch (response){
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Correlativo ya existe';
            break;
        case 'Registro ocupado, no se puede eliminar':
            mensaje = 'Tipo de usuario ocupado, no se puede eliminar'
            break;
        default:
            mensaje = 'Ocurrió un problema, consulte al administrador'
            break;
    }
    return mensaje;
}