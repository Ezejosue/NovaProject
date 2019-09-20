//Inicializando la función para mostrar la tabla de unidad de mesas
$(document).ready(function()
{
    showTableFacturas();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiFacturas = '../core/api/inventarios.php?site=private&action=';

// Función para llenar tabla con los datos de los registros
function fillTableFacturas(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
            <tr>
                <td>${row.correlativo}</td>
                <td>${row.nom_proveedor}</td>
                <td>${row.fecha_ingreso}</td>
                <td>${row.alias}</td>
                <td>
                    <a href="#" onclick="modalFacturaDatos(${row.id_factura})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="modalFacturaDetalle(${row.id_factura})" class="btn btn-warning tooltipped" data-tooltip="Modificar"><i class="fa fa-info-circle"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-facturas');
}

//Función para obtener y mostrar los registros disponibles
function showTableFacturas()
{
    $.ajax({
        url: apiFacturas+ 'readFacturas',
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
            fillTableFacturas(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function fillTableDetalleFactura(rows)
{
    let content = '';
    let total = 0;
    let contentTotal = '';
    let contentResponsable = '';
    let contentFecha = '';
    let contentCorrelativo = '';
    let row = '';
    console.log(rows);

    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){

        subtotal = parseFloat(row.cantidad * row.precio).toFixed(2);
        total = parseFloat(subtotal) + parseFloat(total);
        total = parseFloat(total).toFixed(2);
        alias = row.alias;
        fecha_ingreso = row.fecha_ingreso;
        correlativo = row.correlativo;

        content += `
            <tr>
                <td>${row.Materia}</td>
                <td>${row.cantidad}</td>
                <td>$${row.precio}</td>
                <td>$${subtotal}</td>
                <td>
                <a href="#" onclick="modalUpdateMaterias(${row.id_inventario})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                <a href="#" onclick="confirmDeleteMateria(${row.id_inventario})" class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;

        console.log(row.id_inventario);
        
        //$("#id-pedido").text(row.id_pedido);
    });
        contentTotal += `<h6>TOTAL DE FACTURA: $${total}.</h6>`;
        contentResponsable += `<h6>USUARIO: ${alias}.</h6>`;
        contentFecha += `<h6>FECHA DE INGRESO: ${fecha_ingreso}.</h6>`;
        contentCorrelativo += `<h6># CORRELATIVO: ${correlativo}.</h6>`;
    $("#total").html(contentTotal);
    $("#correlativo").html(contentCorrelativo);
    $("#responsable").html(contentResponsable);
    $("#fecha_ingreso").html(contentFecha);
    $('#tbody-read-detalle-factura').html(content);
    table('#tabla-detalle-factura');
}

function showTableDetalleFactura(id)
{
    $.ajax({
        url: apiFacturas + 'readDetalleFactura',
        type: 'post',
        data: {
            id_factura: id
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

//Función para cargar los nombres de proveedores en el select del formulario para agregar facturas
function showSelectProveedores(idSelect, value)
{
    $.ajax({
        url: apiFacturas + 'readProveedores',
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
                    if (row.id_proveedor != value) {
                        content += `<option value="${row.id_proveedor}">${row.nom_proveedor}</option>`;
                    } else {
                        content += `<option value="${row.id_proveedor}" selected>${row.nom_proveedor}</option>`;
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

//Función para mostrar materias primas de las recetas disponibles
function modalFacturaDatos(id)
{
    $.ajax({
        url: apiFacturas + 'getFactura',
        type: 'post',
        data:{
            id_factura: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {                
                $('#form-update-factura')[0].reset();
                $('#modal-update-factura').modal('show');
                $('#id_factura').val(result.dataset.id_factura);
                $('#update_correlativo').val(result.dataset.correlativo);
                showSelectProveedores('update_proveedor', result.dataset.id_proveedor);
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

function modalFacturaDetalle(id)
{
    $.ajax({
        url: apiFacturas + 'getFactura',
        type: 'post',
        data:{
            id_factura: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {    
                $('#form-factura')[0].reset();
                $('#modal-factura').modal('show');
                showTableDetalleFactura(result.dataset.id_factura);           
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