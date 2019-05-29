$(document).ready(function () {
    showTable();
    showSelectCargo('create_cargo', null); 
    showSelectTipo1('create_usuario', null); 
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiEmpleados = '../core/api/empleados.php?site=private&action=';

//Función para llenar tabla con los datos de los registros
function fillTable(rows) {
    let content = '';
    // Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
            <tr>
                <td>${row.nombre_empleado}</td>
                <td>${row.apellido_empleado}</td>
                <td>${row.dui}</td>
                <td>${row.direccion}</td>
                <td>${row.telefono}</td>
                <td>
                    <a href="#" onclick="modalUpdate(${row.id_empleado})" class="btn btn-info   tooltipped" data-tooltip="Modificar"><i  class="fa fa-edit"></i></a>
                    <a href="#" onclick="confirmDelete(${row.id_empleado})"class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-empleados');
    $('.materialboxed').materialbox();
    $('.tooltipped').tooltip();
}

//Función para obtener y mostrar los registros disponibles
function showTable() {
    $.ajax({
            url: apiEmpleados + 'read',
            type: 'post',
            data: null,
            datatype: 'json'
        })
        .done(function (response) {
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
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
}

//Función para cargar los tipos de usuario en el select del formulario
function showSelectCargo(idSelect, value)
{
    $.ajax({
        url: apiEmpleados + 'readCargo',
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
                    if (row.id_cargo != value) {
                        content += `<option value="${row.id_cargo}">${row.nombre_Cargo}</option>`;
                    } else {
                        content += `<option value="${row.id_cargo}" selected>${row.nombre_Cargo}</option>`;
                    }
                });
                $('#' + idSelect).html(content);
            } else {
                $('#' + idSelect).html('<option value="">No hay opciones</option>');
            }
            $('select').formSelect();
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
} 

function showSelectTipo1(idSelect, value)
{
    $.ajax({
        url: apiEmpleados + 'readUsuarios',
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
                        content += `<option value="${row.id_usuario}"selected>${row.alias}</option>`;
                    }
                });
                $('#' + idSelect).html(content);
            } else {
                $('#' + idSelect).html('<option value="">No hay opciones</option>');
            }
            $('select').formSelect();
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
        url: apiEmpleados + 'create',
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
                if (result.status == 1) {
                    sweetAlert(1, 'Empleado creado correctamente', null);
                } else if(result.status == 2) {
                    sweetAlert(3, 'Empleado creado. ' + result.exception, null);
                }
                //Se destruye la tabla de usuarios y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-empleado');
                showTable();   
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})