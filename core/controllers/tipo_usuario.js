//Inicializando la función para mostrar la tabla de tipo de usuario
$(document).ready(function()
{
    showTable();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiTipo_usuarios = '../core/api/tipo_usuario.php?site=private&action=';

// Función para llenar tabla con los datos de los registros
function fillTable(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        (row.estado == 1) ? icon = '<i class="fa fa-eye"></i>' : icon = '<i class="fa fa-eye-slash"></i>';
        content += `
            <tr>
                <td>${row.tipo}</td>
                <td>${row.descripcion}</td>
                <td><i class="material-icons">${icon}</i></td>
                <td>
                    <a href="#" onclick="modalPrivilegios(${row.id_Tipousuario}), modificar(${row.id_Tipousuario})" class="btn btn-dark" data-toggle="modal"><i class="fa fa-columns"></i></a>
                    <a href="#" onclick="modalUpdate(${row.id_Tipousuario})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="confirmDelete(${row.id_Tipousuario})" class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-tipo_usuarios');
}

//Función para obtener y mostrar los registros disponibles
function showTable()
{
    $.ajax({
        url: apiTipo_usuarios + 'read',
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
// Función para crear un nuevo registro
$('#form-create').submit(function()
{
    event.preventDefault();

    $.ajax({
        url: apiTipo_usuarios + 'create',
        type: 'post',
        data: new FormData($('#form-create')[0]),
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
                $('#form-create')[0].reset();
                sweetAlert(1, result.message, null);
                $('#modal-create').modal('hide');
                destroy('#tabla-tipo_usuarios');
                showTable();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            //Se comprueba que el nombre no esté repetido
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

//Función que muestra las acciones del tipo de usuario
function modalPrivilegios(id2)
{
    $.ajax({
        url: apiTipo_usuarios + 'getAcciones',
        type: 'post',
        data:{
            id_Tipousuario: id2
        },
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                let content = '';
                //Por cada acción se crea un checkbox con un id único
                result.dataset.forEach(function(row){
                    //Si el estado de la acción es 1, se chequea el checkbox
                    (row.estado == 1) ? check = 'checked' : check = '';
                    content+= `
                    <div class="col-sm-6 col-md-4">
                        <div class="form-check">
                            <input class="form-check-input get_value" type="checkbox" ${check} id="${row.id_vista}">
                            <label class="form-check-label" for="${row.id_vista}">
                            ${row.nombre_vista}
                            </label>
                        </div>
                        <br>
                    </div>
                    `;
                });
                $('#modal-privilegios').modal('show');
                $('#vistas').html(content);
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

// Función para mostrar formulario con registro a modificar
function modalUpdate(id)
{
    $.ajax({
        url: apiTipo_usuarios + 'get',
        type: 'post',
        data:{
            id_Tipousuario: id,
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
                $('#id_tipo_usuario').val(result.dataset.id_Tipousuario);
                $('#update_nombre_tipo').val(result.dataset.tipo);
                $('#update_descripcion').val(result.dataset.descripcion);
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
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función que verifica el estado de los checkbox para actualizar las acciones
function modificar(id3){
    $('#form-privilegios').submit(function()
    {
        event.preventDefault();
        //se declara el arreglo vacío
        var estados = [];
        //Por cada checkbox se verifica si está chequedo y se agrega el valor 1 al arreglo, si no se agrega 0
        $('.get_value').each(function(){
            if($(this).is(":checked")){
                estados.push("1");
            } else {
                estados.push("0");
            }
        });
        
        $.ajax({
            url: apiTipo_usuarios + 'updateAcciones',
            type: 'post',
            data: {
                id_Tipousuario: id3,
                estados:estados,
            },
            datatype: 'json'
        })
        .done(function(response){
            // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                if (result.status) {
                    sweetAlert(1, 'Privilegios modificados correctamente', 'tipo_usuarios.php');
                    console.log(estados);
                } else {
                    sweetAlert(2, result.exception, null);
                }
            } else {
                console.log(response);
                //Se comprueba que el nombre no esté repetido
                sweetAlert(2, error2(response), null);
            }
        })
        .fail(function(jqXHR){
            // Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
    })
}

// Función para modificar un registro seleccionado previamente
$('#form-update').submit(function()
{
    
    event.preventDefault();
    $.ajax({
        url: apiTipo_usuarios + 'update',
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
                destroy('#tabla-tipo_usuarios');
                showTable();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            //Se comprueba que el nombre no esté repetido
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

// Función para eliminar un registro seleccionado
function confirmDelete(id)
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar el tipo de usuario?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiTipo_usuarios + 'delete',
                type: 'post',
                data:{
                    id_Tipousuario: id,
                },
                datatype: 'json'
            })
            .done(function(response){
                // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        sweetAlert(1, 'Tipo de usuario eliminado correctamente', null);
                        destroy('#tabla-tipo_usuarios');
                        showTable();
                    } else {
                        sweetAlert(2, result.message, null);
                    }
                } else {
                    console.log(response);
                    sweetAlert(2, error2(response), null);
                }
            })
            .fail(function(jqXHR){
                // Se muestran en consola los posibles errores de la solicitud AJAX
                console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
            });
        }
    });
}

//Función para verificar que el tipo de usuario no se repita ya que es un dato de tipo único
function error2(response)
{
    switch (response){
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Nombre de tipo de usuario ya existe';
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
