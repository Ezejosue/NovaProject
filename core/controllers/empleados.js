//Inicializando la función para mostrar la tabla de empleados
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
    // Se recorren las filas para armar el cuerpo de la tabla y se utiliza comillas invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
            <tr>
                <td>${row.nombre_empleado}</td>
                <td>${row.apellido_empleado}</td>
                <td>${row.dui}</td>
                <td>${row.direccion}</td>
                <td>${row.correo}</td>
                <td>
                    <a href="#" onclick="modalEmpleado(${row.id_empleado})" class="btn btn-dark tooltipped" data-tooltip="Ver más"><i  class="fa fa-address-card"></i></a>
                    <a href="#" onclick="modalUpdate(${row.id_empleado})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i  class="fa fa-edit"></i></a>
                    <a href="#" onclick="confirmDelete(${row.id_empleado})"class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-empleados');
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

function modalEmpleado(id)
{
    $.ajax({
        url: apiEmpleados + 'get',
        type: 'post',
        data:{
            id_empleado: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                var nombre = '&nbsp' + result.dataset.nombre_empleado;
                var apellido = '&nbsp' + result.dataset.apellido_empleado;
                var dui = '&nbsp' + result.dataset.dui;
                var direccion = '&nbsp' + result.dataset.direccion;
                var telefono = '&nbsp' + result.dataset.telefono;
                var genero = result.dataset.genero;
                var genero_string = '';
                var nacimiento = '&nbsp' + result.dataset.fecha_nacimiento;
                var nacionalidad = '&nbsp' + result.dataset.nacionalidad;
                var correo = '&nbsp' + result.dataset.correo;
                var cargo = '&nbsp' + result.dataset.nombre_cargo;
                var usuario = '&nbsp' + result.dataset.alias;
                if(genero == "M") {
                    genero_string = '&nbspMasculino'
                } else if(genero == "F") {
                    genero_string = '&nbspFemenino'
                } else {
                    genero_string = '';
                }
                $("#info-nombre").html(nombre);
                $("#info-apellido").html(apellido);
                $("#info-dui").html(dui);
                $("#info-direccion").html(direccion);
                $("#info-telefono").html(telefono);
                $("#info-genero").html(genero_string);
                $("#info-nacimiento").html(nacimiento);
                $("#info-nacionalidad").html(nacionalidad);
                $("#info-correo").html(correo);
                $("#info-cargo").html(cargo);
                $("#info-usuario").html(usuario);
                $('#modal-empleado').modal('show');
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

//Función para cargar los cargos en el select del formulario
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
                    content += '<option value="" disabled selected>Seleccione un cargo</option>';
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
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
} 

//Función para cargar los usuarios en el select del formulario
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
                    content += '<option value="" disabled selected>Seleccione un usuario</option>';
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
                //Se destruye la tabla de usuarios y se vuelve a crear para que muestre los cambios realizados
                $('#form-create')[0].reset();
                $('#modal-create').modal('hide');
                sweetAlert(1, 'Empleado creado correctamente', null);
                destroy('#tabla-empleados');
                showTable();
            } else {
                sweetAlert(2, result.exception, null);
                console.log(response);
            }
        } else {
            console.log(response);

            //Se comprueba que el dui no este repetido
            sweetAlert(2, error2(response), null);

        }
     
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

// Función para eliminar un registro seleccionado
function confirmDelete(id)
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar el empleado?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiEmpleados + 'delete',
                type: 'post',
                data:{
                    id_empleado: id
                },
                datatype: 'json'
            })
            .done(function(response){
                // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        sweetAlert(1, 'Empleado eliminado correctamente', null);
                        destroy('#tabla-empleados');
                        showTable();
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
    });
}

// Función para mostrar formulario con registro a modificar
function modalUpdate(id)
{
    $.ajax({
        url: apiEmpleados + 'get',
        type: 'post',
        data:{
            id_empleado: id
        },
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-update')[0].reset();
                $('#id_empleado').val(result.dataset.id_empleado);
                $('#update_nombre').val(result.dataset.nombre_empleado);
                $('#update_apellido').val(result.dataset.apellido_empleado);
                $('#update_dui').val(result.dataset.dui);
                $('#update_direccion').val(result.dataset.direccion);
                $('#update_telefono').val(result.dataset.telefono);
                $('#update_genero').val(result.dataset.genero);
                $('#update_fecha').val(result.dataset.fecha_nacimiento);
                $('#update_nacionalidad').val(result.dataset.nacionalidad);
                $('#update_email').val(result.dataset.correo);
                showSelectCargo('update_cargo', result.dataset.id_cargo);
                showSelectTipo1('update_usuario', result.dataset.id_usuario);
                $('#modal-update').modal('show');
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

// Función para modificar un registro seleccionado previamente
$('#form-update').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiEmpleados + 'update',
        type: 'post',
        data: new FormData($('#form-update')[0]),
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
                $('#modal-update').modal('hide');
                sweetAlert(1, result.message, null);
                destroy('#tabla-empleados');
                showTable();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
             //Se comprueba que el dui no este repetido
             sweetAlert(2, error2(response), null);
        } 
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

//Función que muestra el mensaje de error cuando un dato de tipo único está repetido
function error2(response)
{
    switch (response) {
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Datos de empleado duplicados';
            break;
        default:
            mensaje = 'Ocurrió un problema, consulte al administrador';
            break;
    }
    return mensaje;
}

