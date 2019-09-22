//Inicializando la función para mostrar la tabla de unidad de mesas
$(document).ready(function()
{
    showTableFacturas();
    showSelectFacturas('create_factura', null);
    showSelectProveedores('create_proveedor', null);
    showSelectMaterias('create_materia', null); 
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
                <td>`
        if (row.estado == 2){
            content +=`<a href="#" onclick="modalFacturaDatos(${row.id_factura})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="modalFacturaDetalle(${row.id_factura})" class="btn btn-warning tooltipped" data-tooltip="Modificar"><i class="fa fa-info-circle"></i></a>`
                    
        } else {
            if(row.estado == 1){
                content +=`<button class="btn btn-success tooltipped" data-tooltip="Modificar"><i class="fa fa-check-circle"></i></button>
                <a href="#" onclick="modalFacturaDetalle(${row.id_factura})" class="btn btn-warning tooltipped" data-tooltip="Modificar"><i class="fa fa-info-circle"></i></a>`
    
            } else {
                if(row.estado == 0){
                content +=`<button class="btn btn-danger tooltipped" data-tooltip="Modificar"><i class="fas fa-backspace"></i></button>
                <a href="#" onclick="modalFacturaDetalle(${row.id_factura})" class="btn btn-warning tooltipped" data-tooltip="Modificar"><i class="fa fa-info-circle"></i></a>`
    
                }
            }
        }
        
        
        content +=`</td>
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
    let contentEstado = '';
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
        estado = row.estado;
        id_factura = row.id_factura;

        
        content += `
            <tr>
                <td>${row.Materia}</td>
                <td>${row.cantidad}</td>
                <td>$${row.precio}</td>
                <td>$${subtotal}</td>
                
                <td>`;
                console.log(row.estado);
                if(row.estado==2){
                content+=  `<a href="#" onclick="modalUpdateMaterias(${row.id_inventario})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                <a href="#" onclick="confirmDeleteMateria(${row.id_inventario})" class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>`;
            }else{
                content+=  `NO MODIFICABLE`;
            }
                
        content+=  `</td>
            </tr>
        `;

        console.log(row.id_inventario);
    });

    contentTotal += `<h6>TOTAL DE FACTURA: $${total}.</h6>`;
    contentResponsable += `<h6>USUARIO: ${alias}.</h6>`;
    contentFecha += `<h6>FECHA DE INGRESO: ${fecha_ingreso}.</h6>`;
    contentCorrelativo += `<h6># CORRELATIVO: ${correlativo}.</h6>`;
    /* contentEstado += `<h6>ESTADO: ${nombre_estado}.</h6>`; */
    $("#total").html(contentTotal);
    $("#correlativo").html(contentCorrelativo);
    $("#responsable").html(contentResponsable);
    $("#fecha_ingreso").html(contentFecha);
    let nombre_estado = '';

    if (total <= 0){
        $('#estado_btn').html(`<div class="row">
        <div class="col-sm-11">
            <div class="custom-control custom-switch">
                <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">CAMBIAR ESTADO</button>
            </div>
        </div>
        </div>`);
}
    

    if (estado == 2) {
        nombre_estado = 'En proceso';
    } else {
        if (estado == 1) {
            nombre_estado = 'Ingresada';
        } else {
            if (estado == 0) {
                nombre_estado = 'Anulado';
                $('#estado_btn').html("");
            }
        }
    }
    
    contentEstado += `<h6>ESTADO: ${nombre_estado}.</h6>`;

    $("#estado").html(contentEstado);
    $("#hestado").val(estado);
    $("#hid_factura").val(id_factura);
    
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
            console.log(result.dataset.id_factura);
            
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

//Función para modificar un registro seleccionado previamente
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
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#modal-update-factura').modal('hide');
                sweetAlert(1, 'Factura modificada correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-facturas');
                showTableFacturas();
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
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
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
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función para mostrar materias primas disponibles
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
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
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
        //Se muestran en consola los posibles errores de la solicitud AJAX
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
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#modal-update-materiasprimas').modal('hide');
                sweetAlert(1, 'Materia prima modificada correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                $('#modal-update-recetas').modal('hide');
                showTableRecetas(idReceta);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            //Se comprueba que el alias no sea repetido
            sweetAlert(2, error2(response), null);
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

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
        url: apiFacturas+ 'readInventario',
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
        url: apiFacturas + 'createFactura',
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
        url: apiFacturas + 'readSelectFacturas',
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
        url: apiFacturas + 'readMateriaPrima',
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


//Función para crear una nueva factura
$('#form-create').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiFacturas + 'ingresarFactura',
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

function confirmDeleteProductoFactura(id)
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar esta materia prima?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiRecetas + 'deleteMateria',
                type: 'post',
                data:{
                    idElaboracion: id
                },
                datatype: 'json'
            })
            .done(function(response){
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        sweetAlert(1, 'Materia prima eliminada correctamente', null);
                        showTableRecetas(idReceta);
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

//Función para verificar que nombre de la categoría no se repita ya que es un dato de tipo único
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