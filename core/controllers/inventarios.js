/* Inicializando la función para mostrar la tabla de unidad de mesas
 */$(document).ready(function()
{
    showTableFacturas();
    showSelectFacturas('create_factura', null);
    showSelectProveedores('create_proveedor', null);
    showSelectMaterias('create_materia', null); 
})

/* Constante para establecer la ruta y parámetros de comunicación con la API */
const apiFacturas = '../core/api/inventarios.php?site=private&action=';
/* Variable global para poder llenar tabla luego de modificar detalle de factura */
let idFactura;

/* Función para llenar tabla con los datos de los registros */
function fillTableFacturas(rows)
{
    /* Variable donde se almacena el código html para construir tabla de facturas */
    let content = '';
    /* Se recorren las filas para armar el cuerpo de la tabla y se utiliza comillas invertida para escapar los caracteres especiales */
    rows.forEach(function(row){

        /* Se empieza a llenar variable content con los datos almacenados en la variable row declarada en el foreach anterior */
        content += `
            <tr>
                <td>${row.correlativo}</td>
                <td>${row.nom_proveedor}</td>
                <td>${row.fecha_ingreso}</td>
                <td>${row.alias}</td>
                <td>`
        /* Se valida el estado de la factura para mostrar botones en referencia a su estado  */
        /* Botones para estado "en proceso" */
        if (row.estado == 2){
            content +=`<a href="#" onclick="modalFacturaDatos(${row.id_factura})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="modalFacturaDetalle(${row.id_factura})" class="btn btn-warning tooltipped" data-tooltip="Modificar"><i class="fa fa-info-circle"></i></a>`
                    
        } else {
            /* Botones para estado "ingresada" */
            if(row.estado == 1){
                content +=`<button class="btn btn-success tooltipped" data-tooltip="Modificar"><i class="fa fa-check-circle"></i></button>
                <a href="#" onclick="modalFacturaDetalle(${row.id_factura})" class="btn btn-warning tooltipped" data-tooltip="Modificar"><i class="fa fa-info-circle"></i></a>`
    
            } else {
                /* Botones para estado "anulada" */
                if(row.estado == 0){
                content +=`<button class="btn btn-danger tooltipped" data-tooltip="Modificar"><i class="fas fa-backspace"></i></button>
                <a href="#" onclick="modalFacturaDetalle(${row.id_factura})" class="btn btn-warning tooltipped" data-tooltip="Modificar"><i class="fa fa-info-circle"></i></a>`
    
                }
            }
        }
        
        /* Etiquetas de cierre de las filas de la tabla */
        content +=`</td>
        </tr>
        `;
    });
    /* Por medio del id del tbody de la tabla, se envía la varible content para que se llene en el html */
    $('#tbody-read').html(content);
    /* Por medio del id se le da formato a la tabla */
    table('#tabla-facturas');
}

/* Función para obtener y mostrar los registros disponibles */
function showTableFacturas()
{
    $.ajax({
        url: apiFacturas + 'readFacturas',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (!result.status) {
                sweetAlert(4, result.exception, null);
            }
            /* Se le envia result.dataset donde se encuentran todas las facturas que retornó la petición AJAX, para ser
            leídos por el foreach del  método fillTableFacturas */
            fillTableFacturas(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

/* Función para llenar html del modal detalle de factura */
function fillTableDetalleFactura(rows)
{

    /* Se definen variables en las que se almacenará código html */
    let content = '';
    let total = 0;
    let contentTotal = '';
    let contentResponsable = '';
    let contentFecha = '';
    let contentCorrelativo = '';
    let contentEstado = '';
    console.log(rows);

    /* Se recorren las filas para armar el cuerpo de la tabla y se utiliza comillas invertida para escapar los caracteres especiales */
    rows.forEach(function(row){

        /* Se calcula subtotal a partir de el precio y cantidad de los productos de la factura y se aproxima a 2 decimales
        por medio del método toFixed */
        subtotal = parseFloat(row.cantidad * row.precio).toFixed(2);
        /* Se suma cada subtotal al valor que ya tiene el total para tener el precio total de esa factura */
        total = parseFloat(subtotal) + parseFloat(total);
        total = parseFloat(total).toFixed(2);
        /* Se almacena en variables los datos provinientes de la petición AJAX para poder 
        mostrarlos en el html fuera del foreach */
        alias = row.alias;
        fecha_ingreso = row.fecha_ingreso;
        correlativo = row.correlativo;
        estado = row.estado;
        id_factura = row.id_factura;

        /* Se empieza a llenar la variable content */
        content += `
            <tr>`;
            /* Se valida si no hay productos registrados aún en la factura mostrará el mensaje "VACÍO" en cada fila */
            if (row.Materia != null && row.cantidad != null && row.precio != null){
                content +=`<td>${row.Materia}</td>
                    <td>${row.cantidad}</td>
                    <td>$${row.precio}</td>
                    <td>$${subtotal}</td>
                    <td>`;
            } else {
                content +=`<td>VACÍO</td>
                    <td>VACÍO</td>
                    <td>VACÍO</td>
                    <td>VACÍO</td>
                    <td>VACÍO</td>`;
            }

            /* Se valida si la factura está en el estado "en procesa", sino mostrará un mensaje "NO MODIFICABLE" */
            if(row.estado == 2){
                content+=  `<a href="#" onclick="modalUpdateProductos(${row.id_inventario})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                <a href="#" onclick="confirmDeleteProductoFactura(${row.id_inventario})" class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>`;
            }else{
                content+=  `NO MODIFICABLE`;
            }
                
        /* Etiquetas de cierre de filas de la tabla */
        content+=  `</td>
            </tr>
        `;
    });

    /* Se llenan varibale content para mostrar información de la factura */
    contentTotal += `<h6>TOTAL DE FACTURA: $${total}.</h6>`;
    contentResponsable += `<h6>USUARIO: ${alias}.</h6>`;
    contentFecha += `<h6>FECHA DE INGRESO: ${fecha_ingreso}.</h6>`;
    contentCorrelativo += `<h6># CORRELATIVO: ${correlativo}.</h6>`;

    /* Se llena el html de acada div en formulario que se encuentra en modal de detalle de factura */
    $("#total").html(contentTotal);
    $("#correlativo").html(contentCorrelativo);
    $("#responsable").html(contentResponsable);
    $("#fecha_ingreso").html(contentFecha);

    /* Variable donde se almacenará el nombre del estado de la factura */
    let nombre_estado = '';

    /* Se valida cada estado para asignarle un valor a variable nombre_estado */
    if (estado == 2) {        
        nombre_estado = 'En proceso';
        /* Se valida no poder cambiar de estado si no hay productos registrados, por medio del total se elimina el 
        botón de cambiar estado si este es 0 */
        if (total != 0) {
            $('#estado_btn').html(`<div class="row">
                                <div class="col-sm-11">
                                    <div class="custom-control custom-switch">
                                        <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">CAMBIAR ESTADO</button>
                                    </div>
                                </div>
                                </div>`);
        }        
    } else {
        if (estado == 1) {
            nombre_estado = 'Ingresada';
            $('#estado_btn').html(`<div class="row">
                                    <div class="col-sm-11">
                                        <div class="custom-control custom-switch">
                                            <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">CAMBIAR ESTADO</button>
                                        </div>
                                    </div>
                                    </div>`);
        } else {
            if (estado == 0) {
                nombre_estado = 'Anulado';
                /* Se vacía div donde se encuentra botón para cambiar estado si la factura es anulada */
                $('#estado_btn').html("");
            }
        }
    }
    
    /* Se llena content para mostrar nombre de estado de la factura */
    contentEstado += `<h6>ESTADO: ${nombre_estado}.</h6>`;
    $("#estado").html(contentEstado);
    /* Se llenan input escondidos donde se almacena el estado y el id de la factura,
    necesarios para cambiar estado de la factura */
    $("#hestado").val(estado);
    $("#hid_factura").val(id_factura);
    /* Se llena tbody de tabla de detalle de factura */
    $('#tbody-read-detalle-factura').html(content);
    /* Se le da formato a tabla por medio de su id */
    table('#tabla-detalle-factura');
}

function showTableDetalleFactura(id)
{
    /* Se le asigna valor a la variable global idFactura */
    idFactura = id;

    $.ajax({
        url: apiFacturas + 'readDetalleFactura',
        type: 'post',
        data: {
            id_factura: id
        },
        datatype: 'json'
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (!result.status) {
                sweetAlert(4, result.exception, null);
            }
            /* Se le envía result.dataset donde se encuentran datos de respuesta de la petición AJAX,
            para ser ejecutador en el foreach del método fillTableDetalleFactura */
            fillTableDetalleFactura(result.dataset);            
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

/* Función para cargar los nombres de proveedores en el select del formulario para agregar facturas */
function showSelectProveedores(idSelect, value)
{
    $.ajax({
        url: apiFacturas + 'readProveedores',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                /* Se crea varible content para llenar select */
                let content = '';
                /* Se valida si result es vacío */
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una opción</option>';
                }
                /* foreach para llenar select */
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
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

/* Función para modificar un registro seleccionado previamente */
$('#form-update-factura').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiFacturas + 'updateFactura',
        type: 'post',
        data: new FormData($('#form-update-factura')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                $('#modal-update-factura').modal('hide');
                sweetAlert(1, 'Factura modificada correctamente', null);
                /* Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados */
                destroy('#tabla-facturas');
                showTableFacturas();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            /* Se comprueba que el alias no sea repetido */
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})


/* Función para modificar un registro seleccionado previamente */
$('#form-update-producto').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiFacturas + 'updateInventario',
        type: 'post',
        data: new FormData($('#form-update-producto')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                $('#modal-update-producto').modal('hide');
                sweetAlert(1, 'Producto modificado correctamente', null);
                /* Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados */
                destroy('#tabla-detalle-factura');
                showTableDetalleFactura(idFactura);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            /* Se comprueba que el alias no sea repetido */
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

function modalUpdateProductos(id)
{
    $.ajax({
        url: apiFacturas + 'getInventario',
        type: 'post',
        data:{
            id_inventario: id
        },
        datatype: 'json'
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción */
            if (result.status) {                  
                $('#form-update-producto')[0].reset();
                $('#modal-update-producto').modal('show');
                $('#id_inventario').val(result.dataset.id_inventario);
                showSelectMaterias('update_materia', result.dataset.idMateria)
                $('#update_cantidad').val(result.dataset.cantidad);
                $('#update_precio').val(result.dataset.precio);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

/* Función para mostrar materias primas de las recetas disponibles */
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
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción */
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
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
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
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción */
            if (result.status) {    
                $('#form-factura')[0].reset();
                $('#form-estado')[0].reset();
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
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}


$("#form-estado" ).submit(function() {
    event.preventDefault();
    
    let estado = $('#hestado').val();
    let cuerpo_estado = '';
    if (estado == 2) {
        cuerpo_estado = 'ingresado';
    }

    if (estado == 1) {
        cuerpo_estado = 'anulado';
    }

    swal({
        title: 'Advertencia',
        text: '¿Cambiarás el estado a ' + cuerpo_estado + ' de esta factura?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
          actualizarEstado(); 
        }
    });

  });

function actualizarEstado()
{

    $.ajax({
        url: apiFacturas + 'updateEstado',
        type: 'post',
        data: new FormData($('#form-estado')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                sweetAlert(1, 'Estado actualizado correctamente', null);
                $('#modal-factura').modal('hide');
                destroy('#tabla-facturas');
                showTableFacturas();
                $('#modal-factura').modal('show');
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

/* Función para mostrar materias primas disponibles */
function modalUpdateMaterias(id)
{
    $.ajax({
        url: apiRecetas + 'getElaboracion',
        type: 'post',
        data:{
            id_elaboracion: id
        },
        datatype: 'json'
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción */
            if (result.status) {
                $('#form-update-materiasprimas')[0].reset();
                $('#id_receta_updatemate').val(result.dataset.id_receta);
                $('#id_elaboracion').val(result.dataset.id_elaboracion);
                showSelectMaterias('id_update_materia', result.dataset.idMateria);
                $('#cantidad_materia_update').val(result.dataset.cantidad);
                $('#modal-update-materiasprimas').modal('show');
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

$('#form-update-materiasprimas').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiRecetas + 'updateElaboracion',
        type: 'post',
        data: new FormData($('#form-update-materiasprimas')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */        
        if (isJSONString(response)) {
            const result = JSON.parse(response);            
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                $('#modal-update-materiasprimas').modal('hide');
                sweetAlert(1, 'Materia prima modificada correctamente', null);
                /* Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados */
                $('#modal-update-recetas').modal('hide');
                showTableRecetas(idReceta);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            /* Se comprueba que el alias no sea repetido */
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

/* Función para crear una nueva factura */
$('#form-create-factura').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiFacturas + 'createFactura',
        type: 'post',
        data: new FormData($('#form-create-factura')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                $('#form-create-factura')[0].reset();
                $('#form-create')[0].reset();
                $('#modal-create-factura').modal('hide');
                sweetAlert(1, 'Factura creada correctamente', null);
                showTableFacturas();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            /* Se comprueba que el correlativo no sea repetido */
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})


/* Función para cargar los nombres de proveedores en el select del formulario para agregar productos a las facturas */
function showSelectFacturas(idSelect, value)
{
    $.ajax({
        url: apiFacturas + 'readSelectFacturas',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                /* Varible content para llenar select */
                let content = '';
                /* Se valida si el valor por defecto es vacío */
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una opción</option>';
                }
                /* foreach para llenar select */
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
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function showSelectMaterias(idSelect, value)
{
    $.ajax({
        url: apiFacturas + 'readMateriaPrima',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                /* Varible content para llenar select */
                let content = '';
                /* Se valida si el valor por defecto es vacío */
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una opción</option>';
                }
                /* foreach para llenar select */
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
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

/* Función para cargar los nombres de proveedores en el select del formulario para crear facturas */
function showSelectProveedores(idSelect, value)
{
    $.ajax({
        url: apiFacturas + 'readProveedores',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                /* Varible content para llenar select */
                let content = '';
                /* Se valida si el valor por defecto es vacío */
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una opción</option>';
                }
                /* foreach para llenar select */
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
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}


/* Función para crear una nueva factura */
$('#form-create').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiFacturas + 'createDetalle',
        type: 'post',
        data: new FormData($('#form-create')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
            if (result.status) {
                $('#form-create')[0].reset();
                $('#modal-create').modal('hide');
                sweetAlert(1, 'Factura ingresada correctamente', null);
                destroy('#tabla-facturas');
                showTableFacturas();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            /* Se comprueba que el alias no sea repetido */
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        /* Se muestran en consola los posibles errores de la solicitud AJAX */
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

/* Función para eliminar producto de detalle de factura */
function confirmDeleteProductoFactura(id)
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar este producto?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiFacturas + 'deleteProducto',
                type: 'post',
                data:{
                    id_inventario: id
                },
                datatype: 'json'
            })
            .done(function(response){
                /* Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola */
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    /* Se comprueba si el resultado es satisfactorio, sino se muestra la excepción */
                    if (result.status) {
                        sweetAlert(1, 'Producto eliminado correctamente', null);
                        $('#form-factura')[0].reset();
                        $('#form-estado')[0].reset();
                        showTableDetalleFactura(idFactura);
                    } else {
                        sweetAlert(2, result.exception, null);
                    }
                } else {
                    console.log(response);
                }
            })
            .fail(function(jqXHR){
                /* Se muestran en consola los posibles errores de la solicitud AJAX */
                console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
            });
        }
    });
}

/* Función para verificar que nombre de la categoría no se repita ya que es un dato de tipo único */
function error2(response){
    switch (response){
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Nombre de receta ya existe';
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