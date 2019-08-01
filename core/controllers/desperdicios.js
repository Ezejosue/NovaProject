//Inicializando la función para mostrar la tabla de materias primas y los select de los formularios
$(document).ready(function()
{
    showTable();
    showSelectPlatillo('create_platillo', 0);
    showSelectAlias('create_alias', 0);
    showSelectEmpleados('create_empleado', 0);
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiDesperdicios = '../core/api/desperdicios.php?site=private&action=';

//Función para llenar tabla con los datos de los registros
function fillTable(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
            <tr>
                <td>${row.nombre_platillo}</td>
                <td>${row.alias}</td>
                <td>${row.nombre_empleado}</td>
                <td>
                    <a href="#" onclick="modalUpdate(${row.id_desperdicios})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="confirmDelete(${row.id_desperdicios})" class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-desperdicios');
}

//Función para obtener y mostrar los registros disponibles
function showTable()
{
    $.ajax({
        url: apiDesperdicios + 'read',
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
            fillTable(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función para cargar los tipos de unidad de medida en el select del formulario
function showSelectPlatillo(idSelect, value)
{
    $.ajax({
        url: apiDesperdicios + 'readPlatillo',
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
                    if (row.id_platillo != value) {
                        content += `<option value="${row.id_platillo}">${row.nombre_platillo}</option>`;
                    } else {
                        content += `<option value="${row.id_platillo}" selected>${row.nombre_platillo}</option>`;
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

//Función para cargar los tipos de unidad de medida en el select del formulario
function showSelectAlias(idSelect, value)
{
    $.ajax({
        url: apiDesperdicios + 'readUsuario',
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
                    if (row.id_usuario != value) {
                        content += `<option value="${row.id_usuario}">${row.alias}</option>`;
                    } else {
                        content += `<option value="${row.id_usuario}" selected>${row.alias}</option>`;
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

//Función para cargar los tipos de unidad de medida en el select del formulario
function showSelectEmpleados(idSelect, value)
{
    $.ajax({
        url: apiDesperdicios + 'readEmpleados',
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
                    if (row.id_empleado != value) {
                        content += `<option value="${row.id_empleado}">${row.nombre_empleado}</option>`;
                    } else {
                        content += `<option value="${row.id_empleado}" selected>${row.nombre_empleado}</option>`;
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


//Función para crear un nuevo registro
$('#form-create').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiDesperdicios + 'create',
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
                sweetAlert(1, 'Desperdicio creado correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-desperdicios');
                showTable();
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

//Función para mostrar formulario con registro a modificar
function modalUpdate(id)
{
    $.ajax({
        url: apiDesperdicios + 'get',
        type: 'post',
        data:{
            id_desperdicios: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                console.log(result.dataset);
                $('#form-update')[0].reset();
                $('#id_desperdicios').val(result.dataset.id_desperdicios);
                showSelectPlatillo('update_id_platillo', result.dataset.id_platillo);
                showSelectAlias('update_id_usuario', result.dataset.id_usuario);
                showSelectEmpleados('update_id_empleado', result.dataset.id_empleado);
                $('#foto_materia').val(result.dataset.foto);
                (result.dataset.estado == 1) ? $('#update_estado').prop('checked', true) : $('#update_estado').prop('checked', false);
                $('#modal-update').modal('show');
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

//Función para modificar un registro seleccionado previamente
$('#form-update').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiDesperdicios + 'update',
        type: 'post',
        data: new FormData($('#form-update')[0]),
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
                $('#modal-update').modal('hide');
                sweetAlert(1, 'Desperdicio modificado correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-mdesperdicios');
                showTable();
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

//Función para eliminar un registro seleccionado
function confirmDelete(id)
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
                url: apiDesperdicios + 'delete',
                type: 'post',
                data:{
                    idMateria: id
                },
                datatype: 'json'
            })
            .done(function(response){
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        sweetAlert(1, 'Desperdicio eliminado correctamente', null);
                        destroy('#tabla-desperdicios');
                        showTable();
                    } else {
                        sweetAlert(2, result.exception, null);
                    }
                } else {
                    swal({
                        title: 'Advertencia',
                        text: 'Registro ocupado, no se puede borrar materia prima.',
                        icon: 'error',
                        buttons: ['Aceptar'],
                        closeOnClickOutside: true,
                        closeOnEsc: true
                    })
                }
            })
            .fail(function(jqXHR){
                //Se muestran en consola los posibles errores de la solicitud AJAX
                console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
            });
        }
    });
}

//Función para verificar que nombre de la categoria no se repita ya que es un dato de tipo único
function error2(response){
    switch (response){
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Nombre de materia prima ya existe';
            break;
        default:
            mensaje = 'Ocurrió un problema, consulte al administrador'
            break;
    }
    return mensaje;
}