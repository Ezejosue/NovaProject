//Inicialización de las funciones que muestran la tabla y el tipo de usuario
$(document).ready(function()
{
    showTable();
    showSelectTipo('create_tipo', null);
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiUsuarios = '../core/api/usuarios.php?site=private&action=';

//Función para llenar tabla con los datos de los registros
function fillTable(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        (row.estado_usuario == 1) ? icon = '<i class="fa fa-eye"></i>' : icon = '<i class="fa fa-eye-slash"></i>';
        content += `
            <tr>
                <td><img src=" ../resources/img/usuarios/${row.foto_usuario}"> </td>
                <td>${row.alias}</td>
                <td>${row.fecha_creacion}</td>
                <td>${row.tipo}</td>
                <td><i class="material-icons">${icon}</i></td>
                <td>
                    <a href="#" onclick="modalUpdate(${row.id_usuario})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="confirmDelete(${row.id_usuario}, '${row.foto_usuario}')" class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-usuarios');
}

//Función para obtener y mostrar los registros disponibles
function showTable()
{
    $.ajax({
        url: apiUsuarios + 'read',
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

//Función para cargar los tipos de usuario en el select del formulario
function showSelectTipo(idSelect, value)
{
    $.ajax({
        url: apiUsuarios + 'readTipoUsuario2',
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
                    if (row.id_Tipousuario != value) {
                        content += `<option value="${row.id_Tipousuario}">${row.tipo}</option>`;
                    } else {
                        content += `<option value="${row.id_Tipousuario}" selected>${row.tipo}</option>`;
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
        url: apiUsuarios + 'create',
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
                sweetAlert(1, 'Usuario creado correctamente', null);
                //Se destruye la tabla de usuarios y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-usuarios');
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
        url: apiUsuarios + 'get',
        type: 'post',
        data:{
            id_usuario: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-update')[0].reset();
                $('#id_usuario').val(result.dataset.id_usuario);
                $('#update_alias').val(result.dataset.alias);
                showSelectTipo('update_tipo', result.dataset.id_Tipousuario);
                $('#foto_usuario').val(result.dataset.foto_usuario);
                (result.dataset.estado_usuario == 1) ? $('#update_estado').prop('checked', true) : $('#update_estado').prop('checked', false);
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
        url: apiUsuarios + 'update',
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
                sweetAlert(1, 'Usuario modificado correctamente', null);
                //Se destruye la tabla de usuarios y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-usuarios');
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
        text: '¿Quiere eliminar el usuario?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiUsuarios + 'delete',
                type: 'post',
                data:{
                    id_usuario: id
                },
                datatype: 'json'
            })
            .done(function(response){
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        sweetAlert(1, 'Usuario eliminado correctamente', null);
                        destroy('#tabla-usuarios');
                        showTable();
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

//Función para verificar que el alias del usuario no se repita ya que es un dato de tipo único
function error2(response)
{
    switch (response){
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Nombre de usuario ya existe';
            break;
        default:
            mensaje = 'Ocurrió un problema, consulte al administrador'
            break;
    }
    return mensaje;
}